<?php
if (!class_exists('SuKienModel')) {
    class SuKienModel {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        // Lấy tất cả sự kiện
        public function layTatCaSuKien() {
            $sql = "SELECT * FROM sukien";
            $result = $this->conn->query($sql);
            $data = [];
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                $result->free();
            }
            return $data;
        }

        // Đăng ký sự kiện mới
        public function dangKySuKien($tenSuKien, $tenNguoiDangKy, $soDienThoai, $diaDiem, $ngayBatDau, $ngayKetThuc, $maLoai, $soNguoiThamGia, $moTaChiTietSuKien) {
            $sql = "INSERT INTO sukien (tenSuKien, tenNguoiDangKy, soDienThoai, diaDiem, ngayBatDau, ngayKetThuc, maLoai, soNguoiThamGia, moTaChiTietSuKien) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $moTaChiTietSuKien = !empty($moTaChiTietSuKien) ? $moTaChiTietSuKien : null;
            $stmt->bind_param("sssssssis", $tenSuKien, $tenNguoiDangKy, $soDienThoai, $diaDiem, $ngayBatDau, $ngayKetThuc, $maLoai, $soNguoiThamGia, $moTaChiTietSuKien);
            $result = $stmt->execute();

            if ($result) {
                $maSK = $this->conn->insert_id;
                $stmt->close();
                return $maSK;
            }

            $stmt->close();
            return false;
        }

        // Lấy thông tin sự kiện theo mã sự kiện
        public function laySuKienTheoMa($maSK) {
            $sql = "SELECT * FROM sukien WHERE maSK = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $maSK);
            $stmt->execute();
            $result = $stmt->get_result();
            $suKien = $result->fetch_assoc();

            $stmt->close();
            return $suKien;
        }
    }
}
?>