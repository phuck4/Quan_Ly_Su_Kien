-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 09, 2025 lúc 11:33 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `loaisukien` (
  `maLoai` int(11) NOT NULL,
  `tenLoai` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `sukien` (
  `maSK` int(11) NOT NULL,
  `tenNguoiDangKy` varchar(50) NOT NULL,
  `soDienThoai` varchar(15) NOT NULL,
  `diaDiem` varchar(255) NOT NULL,
  `ngayBatDau` date NOT NULL,
  `ngayKetThuc` date NOT NULL,
  `maLoai` int(11) NOT NULL,
  `soNguoiThamGia` int(11) NOT NULL,
  `moTaChiTietSuKien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `tenDangNhap` varchar(50) NOT NULL,
  `matKhau` varchar(255) NOT NULL,
  `vaiTro` enum('Admin','Customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `thanhtoan` (
  `maThanhToan` int(11) NOT NULL,
  `maSK` int(11) NOT NULL,
  `tenNguoiDangKy` varchar(50) NOT NULL,
  `tongTien` decimal(10,0) NOT NULL,
  `trangThaiThanhToan` enum('Chưa thanh toán','Đã thanh toán') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `loaisukien`
  ADD PRIMARY KEY (`maLoai`);

ALTER TABLE `sukien`
  ADD PRIMARY KEY (`maSK`),
  ADD KEY `maLoai` (`maLoai`);

ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `thanhtoan`
  ADD PRIMARY KEY (`maThanhToan`),
  ADD KEY `maSK` (`maSK`);

ALTER TABLE `loaisukien`
  MODIFY `maLoai` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `sukien`
  MODIFY `maSK` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `thanhtoan`
  MODIFY `maThanhToan` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `sukien`
  ADD CONSTRAINT `sukien_ibfk_1` FOREIGN KEY (`maLoai`) REFERENCES `loaisukien` (`maLoai`);

ALTER TABLE `thanhtoan`
  ADD CONSTRAINT `thanhtoan_ibfk_1` FOREIGN KEY (`maSK`) REFERENCES `sukien` (`maSK`);
COMMIT;
