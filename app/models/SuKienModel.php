<?php
require_once __DIR__ . '/../config/database.php';

class SuKienModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả sự kiện
    public function LayTatCaSuKien() {
        $sql = "SELECT * FROM sukien";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Đăng ký sự kiện mới
    public function dangKySuKien($tenNguoiDangKy, $soDienThoai, $diaDiem, $ngayBatDau, $ngayKetThuc, $maLoai, $soNguoiThamGia, $moTaChiTietSuKien) {
        $sql = "INSERT INTO sukien (tenNguoiDangKy, soDienThoai, diaDiem, ngayBatDau, ngayKetThuc, maLoai, soNguoiThamGia, moTaChiTietSuKien) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssiis", $tenNguoiDangKy, $soDienThoai, $diaDiem, $ngayBatDau, $ngayKetThuc, $maLoai, $soNguoiThamGia, $moTaChiTietSuKien);
        return $stmt->execute();
    }

    // Lấy thông tin sự kiện theo mã sự kiện
    public function laySuKienTheoMa($maSK) {
        $sql = "SELECT * FROM sukien WHERE maSK = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $maSK);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>