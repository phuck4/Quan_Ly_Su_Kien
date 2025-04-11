<?php
require_once __DIR__ . 'Quan_Ly_Su_Kien/config/database.php';

class TaiKhoanModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Hàm đăng ký tài khoản
    public function dangKy($tenDangNhap, $matKhau, $vaiTro = 'Customer') {
        // Mã hóa mật khẩu bằng md5 (cách đơn giản, thực tế nên dùng password_hash)
        $matKhauHash = md5($matKhau);
        $sql = "INSERT INTO taikhoan (tenDangNhap, matKhau, vaiTro) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $tenDangNhap, $matKhauHash, $vaiTro);
        return $stmt->execute();
    }

    // Hàm kiểm tra đăng nhập
    public function dangNhap($tenDangNhap, $matKhau) {
        $matKhauHash = md5($matKhau);
        $sql = "SELECT * FROM taikhoan WHERE tenDangNhap = ? AND matKhau = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $tenDangNhap, $matKhauHash);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Trả về thông tin tài khoản nếu đúng
    }
}
?>