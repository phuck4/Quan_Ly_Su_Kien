<?php
require_once __DIR__ . '/../models/ThanhToanModel.php';
require_once __DIR__ . '/../models/SuKienModel.php';

class ThanhToanController {
    private $thanhToanModel;
    private $suKienModel;

    public function __construct($conn) {
        $this->thanhToanModel = new ThanhToanModel($conn);
        $this->suKienModel = new SuKienModel($conn);
    }

    // Lấy thông tin thanh toán
    public function layThongTinThanhToan($maSK) {
        $suKien = $this->suKienModel->laySuKienTheoMa($maSK);
        $thanhToan = $this->thanhToanModel->layThanhToanTheoMaSK($maSK);
        return [
            'suKien' => $suKien,
            'thanhToan' => $thanhToan
        ];
    }

    // Xử lý thanh toán
    public function xuLyThanhToan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maSK = filter_input(INPUT_POST, 'maSK', FILTER_SANITIZE_NUMBER_INT);
            $tenNguoiDangKy = filter_input(INPUT_POST, 'tenNguoiDangKy', FILTER_SANITIZE_STRING);
            $tongTien = filter_input(INPUT_POST, 'tongTien', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $paymentMethod = filter_input(INPUT_POST, 'paymentMethod', FILTER_SANITIZE_STRING);

            if (empty($maSK) || empty($tenNguoiDangKy) || empty($tongTien) || empty($paymentMethod)) {
                echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin!']);
                exit();
            }

            $result = $this->thanhToanModel->themThanhToan($maSK, $tenNguoiDangKy, $tongTien, 'Đã thanh toán');
            if ($result) {
                // Tạo mã giao dịch ngẫu nhiên
                $maGiaoDich = '#PAY' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                echo json_encode(['success' => true, 'maGiaoDich' => $maGiaoDich]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Thêm thanh toán thất bại!']);
            }
            exit();
        }
    }

    // Lấy danh sách thanh toán
    public function layTatCaThanhToan() {
        return $this->thanhToanModel->layTatCaThanhToan();
    }
}
?>

- **Thay đổi**:
  - Sửa `xuLyThanhToan` để trả về JSON với `success`, `maGiaoDich` (nếu thành công), và `message` (nếu thất bại).
  - Tạo mã giao dịch ngẫu nhiên (ví dụ: `#PAY123456`).

---

### Bước 4: Sửa file `app/models/ThanhToanModel.php`
Đảm bảo `ThanhToanModel.php` có phương thức `themThanhToan` để thêm bản ghi thanh toán.

**File `app/models/ThanhToanModel.php` (đã sửa):**

```php
<?php
class ThanhToanModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Lấy tất cả thanh toán
    public function layTatCaThanhToan() {
        $sql = "SELECT t.*, s.tenSuKien, l.tenLoai 
                FROM thanhtoan t 
                JOIN sukien s ON t.maSK = s.maSK 
                JOIN loaisukien l ON s.maLoai = l.maLoai";
        $result = $this->conn->query($sql);
        $data = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
        return $data;
    }

    // Lấy thanh toán theo mã sự kiện
    public function layThanhToanTheoMaSK($maSK) {
        $sql = "SELECT * FROM thanhtoan WHERE maSK = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $maSK);
        $stmt->execute();
        $result = $stmt->get_result();
        $thanhToan = $result->fetch_assoc();
        $stmt->close();
        return $thanhToan;
    }

    // Thêm thanh toán mới
    public function themThanhToan($maSK, $tenNguoiDangKy, $tongTien, $trangThaiThanhToan) {
        $sql = "INSERT INTO thanhtoan (maSK, tenNguoiDangKy, tongTien, trangThaiThanhToan) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isds", $maSK, $tenNguoiDangKy, $tongTien, $trangThaiThanhToan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>