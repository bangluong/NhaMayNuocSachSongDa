-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 21, 2021 lúc 05:49 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhamaynuocsongda`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bacgia`
--

CREATE TABLE `bacgia` (
  `ma_bac_gia` int(11) NOT NULL,
  `muc_tieu_thu_dau` float NOT NULL,
  `muc_tieu_thu_cuoi` float NOT NULL,
  `gia` float NOT NULL,
  `ma_nv` int(11) NOT NULL,
  `ma_nhom_tieu_thu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bacgia`
--

INSERT INTO `bacgia` (`ma_bac_gia`, `muc_tieu_thu_dau`, `muc_tieu_thu_cuoi`, `gia`, `ma_nv`, `ma_nhom_tieu_thu`) VALUES
(1, 0, 10, 6000, 1, 1),
(2, 10, 15, 7500, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chisonuoc`
--

CREATE TABLE `chisonuoc` (
  `ma_csn` int(11) NOT NULL,
  `cs_cu` float NOT NULL,
  `cs_moi` float NOT NULL,
  `ma_ky` int(11) NOT NULL,
  `ma_nv` int(11) NOT NULL,
  `ma_kh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chisonuoc`
--

INSERT INTO `chisonuoc` (`ma_csn`, `cs_cu`, `cs_moi`, `ma_ky`, `ma_nv`, `ma_kh`) VALUES
(43, 0, 5, 7, 7, 1),
(44, 5, 15, 7, 7, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `ma_hd` int(11) NOT NULL,
  `ma_kh` int(11) NOT NULL,
  `ma_csn` int(11) NOT NULL,
  `luong_tieu_thu` float NOT NULL,
  `thanh_tien` float NOT NULL,
  `thue` float NOT NULL,
  `phi_ntsh` float NOT NULL,
  `ngay_tao` date NOT NULL,
  `ma_nv` int(11) NOT NULL,
  `trang_thai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`ma_hd`, `ma_kh`, `ma_csn`, `luong_tieu_thu`, `thanh_tien`, `thue`, `phi_ntsh`, `ngay_tao`, `ma_nv`, `trang_thai`) VALUES
(34, 1, 43, 5, 51250, 3750, 10000, '2021-08-21', 7, 0),
(35, 1, 44, 10, 92500, 7500, 10000, '2021-08-21', 7, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `ma_kh` int(11) NOT NULL,
  `ho_ten` text NOT NULL,
  `dc` text NOT NULL,
  `sdt` int(11) NOT NULL,
  `ma_cong_to` int(11) NOT NULL,
  `ngay_them` date NOT NULL,
  `cong_no` float DEFAULT NULL,
  `ma_nhom_tieu_thu` int(11) NOT NULL,
  `ma_nv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`ma_kh`, `ho_ten`, `dc`, `sdt`, `ma_cong_to`, `ngay_them`, `cong_no`, `ma_nhom_tieu_thu`, `ma_nv`) VALUES
(1, 'Nguyễn Lương Bằng', 'hà nội', 123456789, 12, '2021-08-14', 0, 1, 1),
(2, 'Đinh Tiến Bộ', 'hà nội', 23569, 125, '2021-08-21', 0, 1, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kytinhtien`
--

CREATE TABLE `kytinhtien` (
  `ma_ky` int(11) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `kytinhtien`
--

INSERT INTO `kytinhtien` (`ma_ky`, `ngay_bat_dau`, `ngay_ket_thuc`) VALUES
(7, '2021-06-28', '2021-07-28'),
(8, '2021-07-28', '2021-08-28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhomtieuthu`
--

CREATE TABLE `nhomtieuthu` (
  `ma_nhom_tieu_thu` int(11) NOT NULL,
  `ten_nhom_tieu_thu` text NOT NULL,
  `mo_ta` text NOT NULL,
  `ma_nv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhomtieuthu`
--

INSERT INTO `nhomtieuthu` (`ma_nhom_tieu_thu`, `ten_nhom_tieu_thu`, `mo_ta`, `ma_nv`) VALUES
(1, 'hộ gia đình', '', 1),
(2, 'sản xuất', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `ma_nv` int(11) NOT NULL,
  `ho_ten` text NOT NULL,
  `sdt` int(11) NOT NULL,
  `ten_dang_nhap` text NOT NULL,
  `mat_khau` text NOT NULL,
  `rule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`ma_nv`, `ho_ten`, `sdt`, `ten_dang_nhap`, `mat_khau`, `rule`) VALUES
(7, 'admin', 123456789, 'admin', '0192023a7bbd73250516f069df18b500', 0),
(8, 'user 1', 123456789, 'user1', '81dc9bdb52d04dc20036dbd8313ed055', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bacgia`
--
ALTER TABLE `bacgia`
  ADD PRIMARY KEY (`ma_bac_gia`);

--
-- Chỉ mục cho bảng `chisonuoc`
--
ALTER TABLE `chisonuoc`
  ADD PRIMARY KEY (`ma_csn`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`ma_hd`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ma_kh`);

--
-- Chỉ mục cho bảng `kytinhtien`
--
ALTER TABLE `kytinhtien`
  ADD PRIMARY KEY (`ma_ky`),
  ADD UNIQUE KEY `ngay_bat_dau` (`ngay_bat_dau`),
  ADD UNIQUE KEY `ngay_ket_thuc` (`ngay_ket_thuc`);

--
-- Chỉ mục cho bảng `nhomtieuthu`
--
ALTER TABLE `nhomtieuthu`
  ADD PRIMARY KEY (`ma_nhom_tieu_thu`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ma_nv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bacgia`
--
ALTER TABLE `bacgia`
  MODIFY `ma_bac_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `chisonuoc`
--
ALTER TABLE `chisonuoc`
  MODIFY `ma_csn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `ma_hd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `kytinhtien`
--
ALTER TABLE `kytinhtien`
  MODIFY `ma_ky` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `ma_nv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
