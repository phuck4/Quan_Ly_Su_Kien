<?php
require_once __DIR__ . '/../models/SuKienModel.php';

class SuKienController {
    private $model;

    public function __construct($conn) {
        $this->model = new SuKienModel($conn);
    }

    // Xử lý đăng ký sự kiện
    public function dangKySuKien() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenSuKien = filter_input(INPUT_POST, 'tenSuKien', FILTER_SANITIZE_STRING);
            $tenNguoiDangKy = filter_input(INPUT_POST, 'tenNguoiDangKy', FILTER_SANITIZE_STRING);
            $soDienThoai = filter_input(INPUT_POST, 'soDienThoai', FILTER_SANITIZE_STRING);
            $diaDiem = filter_input(INPUT_POST, 'diaDiem', FILTER_SANITIZE_STRING);
            $ngayBatDau = filter_input(INPUT_POST, 'ngayBatDau', FILTER_SANITIZE_STRING);
            $ngayKetThuc = filter_input(INPUT_POST, 'ngayKetThuc', FILTER_SANITIZE_STRING);
            $maLoai = filter_input(INPUT_POST, 'maLoai', FILTER_SANITIZE_NUMBER_INT);
            $soNguoiThamGia = filter_input(INPUT_POST, 'soNguoiThamGia', FILTER_SANITIZE_NUMBER_INT);
            $moTaChiTietSuKien = filter_input(INPUT_POST, 'moTaChiTietSuKien', FILTER_SANITIZE_STRING);

            if (empty($tenSuKien) || empty($tenNguoiDangKy) || empty($soDienThoai) || empty($diaDiem) || empty($ngayBatDau) || empty($ngayKetThuc) || empty($maLoai) || empty($soNguoiThamGia)) {
                // Trả về JSON để xử lý bằng JavaScript
                echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin!']);
                exit();
            }

            // Chuyển định dạng ngày từ datetime-local sang date (YYYY-MM-DD)
            $ngayBatDau = date('Y-m-d', strtotime($ngayBatDau));
            $ngayKetThuc = date('Y-m-d', strtotime($ngayKetThuc));

            $maSK = $this->model->dangKySuKien($tenSuKien, $tenNguoiDangKy, $soDienThoai, $diaDiem, $ngayBatDau, $ngayKetThuc, $maLoai, $soNguoiThamGia, $moTaChiTietSuKien);
            if ($maSK) {
                // Trả về JSON để xử lý bằng JavaScript
                echo json_encode(['success' => true, 'maSK' => $maSK]);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Đăng ký sự kiện thất bại!']);
                exit();
            }
        }
    }

    // Lấy danh sách sự kiện
    public function layTatCaSuKien() {
        return $this->model->layTatCaSuKien();
    }
}
?>