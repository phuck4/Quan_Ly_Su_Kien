<?php
    $host = "localhost";
    $user = "root";
    $pass = "123456";
    $dbname = "quan_ly_su_kien";

    $conn = mysqli_connect($host,$user,$pass,$dbname);

    if(!$conn -> connect_error){
        die("Kết nối thất bại!".$conn->connect_error);
    }
?>