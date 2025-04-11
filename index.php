<?php
session_start();

require_once 'config/database.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/SuKienController.php';
require_once 'app/controllers/ThanhToanController.php';

$authController = new AuthController($conn);
$suKienController = new SuKienController($conn);
$thanhToanController = new ThanhToanController($conn);

$action = isset($_GET['action']) ? $_GET['action'] : '';

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
    default:
        include 'app/views/TrangChu/trangchu.php';
        break;
}
?>