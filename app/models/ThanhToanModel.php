<?php
require_once __DIR__ . '/../config/database.php';

class ThanhToanModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Thêm thông tin thanh toán
    public function themThanhToan($maSK, $tenNguoiDangKy, $tongTien, $trangThaiThanhToan = 'Chưa thanh toán') {
        $sql = "INSERT INTO thanhtoan (maSK, tenNguoiDangKy, tongTien, trangThaiThanhToan) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isds", $maSK, $tenNguoiDangKy, $tongTien, $trangThaiThanhToan);
        return $stmt->execute();
    }

    // Cập nhật trạng thái thanh toán
    public function capNhatThanhToan($maThanhToan, $trangThaiThanhToan) {
        $sql = "UPDATE thanhtoan SET trangThaiThanhToan = ? WHERE maThanhToan = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $trangThaiThanhToan, $maThanhToan);
        return $stmt->execute();
    }

    // Lấy thông tin thanh toán theo mã sự kiện
    public function layThanhToanTheoMaSK($maSK) {
        $sql = "SELECT * FROM thanhtoan WHERE maSK = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $maSK);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Lấy tất cả thanh toán (dành cho trang quản lý)
    public function layTatCaThanhToan() {
        $sql = "SELECT t.*, s.tenSuKien, l.tenLoai 
                FROM thanhtoan t 
                JOIN sukien s ON t.maSK = s.maSK 
                JOIN loaisukien l ON s.maLoai = l.maLoai";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
?>