<?php
if (!class_exists('TaiKhoanModel')) {
    class TaiKhoanModel {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function dangKy($tenDangNhap, $matKhau) {
            $sql = "INSERT INTO taikhoan (tenDangNhap, matKhau, vaiTro) VALUES (?, ?, 'Customer')";
            $stmt = $this->conn->prepare($sql);
            $hashedPassword = password_hash($matKhau, PASSWORD_DEFAULT);
            $stmt->bind_param("ss", $tenDangNhap, $hashedPassword);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }

        public function dangNhap($email, $matKhau) {
            $sql = "SELECT * FROM taikhoan WHERE tenDangNhap = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();

            if ($user && password_verify($matKhau, $user['matKhau'])) {
                return $user;
            }
            return false;
        }
    }
}
?>