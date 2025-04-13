<?php
if (!class_exists('ThanhToanModel')) {
    class ThanhToanModel {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        // Lấy tất cả thanh toán
        public function layTatCaThanhToan() {
            $sql = "SELECT t.*, s.tenSuKien, l.tenLoai 
                    FROM thanhtoan t 
                    JOIN sukien s ON t.maSK = s.maSK 
                    JOIN loaisukien l ON s.maLoai = l.maLoai";
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

        // Lấy thanh toán theo mã sự kiện
        public function layThanhToanTheoMaSK($maSK) {
            $sql = "SELECT * FROM thanhtoan WHERE maSK = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $maSK);
            $stmt->execute();
            $result = $stmt->get_result();
            $thanhToan = $result->fetch_assoc();
            $stmt->close();
            return $thanhToan;
        }

        // Thêm thanh toán mới
        public function themThanhToan($maSK, $tenNguoiDangKy, $tongTien, $trangThaiThanhToan) {
            $sql = "INSERT INTO thanhtoan (maSK, tenNguoiDangKy, tongTien, trangThaiThanhToan) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isds", $maSK, $tenNguoiDangKy, $tongTien, $trangThaiThanhToan);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
    }
}
?>