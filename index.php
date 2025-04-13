<?php
session_start();

// Yêu cầu các file cần thiết
require_once 'config/database.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/SuKienController.php';
require_once 'app/controllers/ThanhToanController.php';

// Khởi tạo các controller
$authController = new AuthController($conn);
$suKienController = new SuKienController($conn);
$thanhToanController = new ThanhToanController($conn);

// Lấy tham số action từ URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Điều hướng dựa trên action
switch ($action) {
    case 'dangKy':
        $authController->dangKy();
        break;
    case 'dangNhap':
        $authController->dangNhap();
        break;
    case 'dangXuat':
        $authController->dangXuat();
        break;
    case 'dangKySuKien':
        $suKienController->dangKySuKien();
        break;
    case 'xuLyThanhToan':
        $thanhToanController->xuLyThanhToan();
        break;
    case 'user':
        if (!isset($_SESSION['user']) || $_SESSION['user']['vaiTro'] !== 'Customer') {
            header("Location: /Quan_Ly_Su_Kien/app/views/auth/login.php");
            exit();
        }
        $suKienList = $suKienController->layTatCaSuKien();
        include 'app/views/NguoiDung/user.php';
        break;
    case 'quanly':
        if (!isset($_SESSION['user']) || $_SESSION['user']['vaiTro'] !== 'Admin') {
            header("Location: /Quan_Ly_Su_Kien/app/views/auth/login.php");
            exit();
        }
        $thanhToanList = $thanhToanController->layTatCaThanhToan();
        include 'app/views/Quanly/quanly.php';
        break;
    case 'thanhtoan':
        if (!isset($_SESSION['user']) || $_SESSION['user']['vaiTro'] !== 'Customer') {
            header("Location: /Quan_Ly_Su_Kien/app/views/auth/login.php");
            exit();
        }
        $maSK = isset($_GET['maSK']) ? filter_var($_GET['maSK'], FILTER_SANITIZE_NUMBER_INT) : null;
        if (!$maSK) {
            echo "<script>alert('Không tìm thấy mã sự kiện!'); window.location.href='/Quan_Ly_Su_Kien/index.php?action=user';</script>";
            exit();
        }
        $thongTin = $thanhToanController->layThongTinThanhToan($maSK);
        $suKien = $thongTin['suKien'];
        $thanhToan = $thongTin['thanhToan'];
        include 'app/views/ThanhToan/thanhtoan.php';
        break;
    default:
        include 'app/views/TrangChu/trangchu.php';
        break;
}
?>