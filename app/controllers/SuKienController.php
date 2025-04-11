<?php
require_once __DIR__ . '/../models/SuKienModel.php';

class SuKienController {
    private $model;

    public function __construct($db) {
        $this->model = new SuKienModel($db);
    }

    // Xử lý đăng ký sự kiện
    public function dangKySuKien() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tenNguoiDangKy = $_POST['tenNguoiDangKy'];
            $soDienThoai = $_POST['soDienThoai'];
            $diaDiem = $_POST['diaDiem'];
            $ngayBatDau = $_POST['ngayBatDau'];
            $ngayKetThuc = $_POST['ngayKetThuc'];
            $maLoai = $_POST['maLoai'];
            $soNguoiThamGia = $_POST['soNguoiThamGia'];
            $moTaChiTietSuKien = $_POST['moTaChiTietSuKien'];

            if ($this->model->dangKySuKien($tenNguoiDangKy, $soDienThoai, $diaDiem, $ngayBatDau, $ngayKetThuc, $maLoai, $soNguoiThamGia, $moTaChiTietSuKien)) {
                $maSK = $this->model->conn->insert_id; // Lấy mã sự kiện vừa thêm
                header("Location: /ThanhToan/thanhtoan.php?maSK=" . $maSK);
            } else {
                echo "Đăng ký sự kiện thất bại!";
            }
        }
    }

    // Lấy danh sách sự kiện
    public function layTatCaSuKien() {
        return $this->model->LayTatCaSuKien();
    }
}
?>