<?php
require_once __DIR__ . '/../models/ThanhToanModel.php';
require_once __DIR__ . '/../models/SuKienModel.php';

class ThanhToanController {
    private $thanhToanModel;
    private $suKienModel;

    public function __construct($db) {
        $this->thanhToanModel = new ThanhToanModel($db);
        $this->suKienModel = new SuKienModel($db);
    }

    // Xử lý thanh toán
    public function xuLyThanhToan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $maSK = $_POST['maSK'];
            $tenNguoiDangKy = $_POST['tenNguoiDangKy'];
            $tongTien = $_POST['tongTien'];

            if ($this->thanhToanModel->themThanhToan($maSK, $tenNguoiDangKy, $tongTien)) {
                header("Location: /ThanhToan/thanhtoan.php?success=thanhtoan&maSK=" . $maSK);
            } else {
                echo "Thanh toán thất bại!";
            }
        }
    }

    // Xác nhận thanh toán
    public function xacNhanThanhToan($maThanhToan) {
        if ($this->thanhToanModel->capNhatThanhToan($maThanhToan, 'Đã thanh toán')) {
            header("Location: /NguoiDung/user.php?success=thanhtoan");
        } else {
            echo "Xác nhận thanh toán thất bại!";
        }
    }

    // Lấy thông tin thanh toán và sự kiện để hiển thị
    public function layThongTinThanhToan($maSK) {
        $suKien = $this->suKienModel->laySuKienTheoMa($maSK);
        $thanhToan = $this->thanhToanModel->layThanhToanTheoMaSK($maSK);
        return ['suKien' => $suKien, 'thanhToan' => $thanhToan];
    }

    // Lấy tất cả thanh toán cho trang quản lý
    public function layTatCaThanhToan() {
        return $this->thanhToanModel->layTatCaThanhToan();
    }
}
?>