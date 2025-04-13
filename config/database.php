<?php
    // Thông tin kết nối cơ sở dữ liệu
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "qlsk";

    // Tạo kết nối MySQLi
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Đặt charset để tránh lỗi ký tự
    $conn->set_charset("utf8mb4");

    return $conn;
?>