<?php
require_once __DIR__ . '/../models/TaiKhoanModel.php';

class AuthController {
    private $taiKhoanModel;

    public function __construct($conn) {
        $this->taiKhoanModel = new TaiKhoanModel($conn);
    }

    public function dangKy() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenDangNhap = filter_input(INPUT_POST, 'tenDangNhap', FILTER_SANITIZE_STRING);
            $matKhau = $_POST['matKhau'];
            $confirmMatKhau = $_POST['confirmMatKhau'];

            if (empty($tenDangNhap) || empty($matKhau) || empty($confirmMatKhau)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!'); window.location.href='/Quan_Ly_Su_Kien/app/views/auth/SignUp.php';</script>";
                return;
            }

            if ($matKhau !== $confirmMatKhau) {
                echo "<script>alert('Mật khẩu xác nhận không khớp!'); window.location.href='/Quan_Ly_Su_Kien/app/views/auth/SignUp.php';</script>";
                return;
            }

            $result = $this->taiKhoanModel->dangKy($tenDangNhap, $matKhau);
            if ($result) {
                echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.'); window.location.href='/Quan_Ly_Su_Kien/app/views/auth/login.php';</script>";
            } else {
                echo "<script>alert('Đăng ký thất bại! Tên đăng nhập đã tồn tại.'); window.location.href='/Quan_Ly_Su_Kien/app/views/auth/SignUp.php';</script>";
            }
        } else {
            include __DIR__ . '/../views/auth/SignUp.php';
        }
    }

    public function dangNhap() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $matKhau = $_POST['pswd'];
            $vaiTro = filter_input(INPUT_POST, 'vaiTro', FILTER_SANITIZE_STRING);

            if (empty($email) || empty($matKhau) || empty($vaiTro)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!'); window.location.href='/Quan_Ly_Su_Kien/app/views/auth/login.php';</script>";
                return;
            }

            $user = $this->taiKhoanModel->dangNhap($email, $matKhau);
            if ($user && $user['vaiTro'] === $vaiTro) {
                $_SESSION['user'] = $user;
                if ($vaiTro === 'Customer') {
                    header("Location: /Quan_Ly_Su_Kien/index.php?action=user");
                } else {
                    header("Location: /Quan_Ly_Su_Kien/index.php?action=quanly");
                }
                exit();
            } else {
                echo "<script>alert('Đăng nhập thất bại! Kiểm tra lại email, mật khẩu hoặc vai trò.'); window.location.href='/Quan_Ly_Su_Kien/app/views/auth/login.php';</script>";
            }
        } else {
            include __DIR__ . '/../views/auth/login.php';
        }
    }

    public function dangXuat() {
        session_destroy();
        header("Location: /Quan_Ly_Su_Kien/app/views/auth/login.php");
        exit();
    }
}
?>