<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "qlsk";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Kết nối thất bại! " . $conn->connect_error);
    }
?>