-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 19, 2024 lúc 06:34 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `figure_store`
--
CREATE DATABASE IF NOT EXISTS `figure_store` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `figure_store`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `administrators`
--

CREATE TABLE `administrators` (
  `ID` int(11) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Password` text NOT NULL,
  `FullName` varchar(250) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `PhoneNumber` int(15) NOT NULL,
  `Gender` int(11) NOT NULL,
  `Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `administrators`
--

INSERT INTO `administrators` (`ID`, `Email`, `Password`, `FullName`, `Address`, `PhoneNumber`, `Gender`, `Role`) VALUES
(1, 'phatcao82@gmail.com', '123456789', 'Tăng Gia Phát', 'TPHCM', 333669832, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `ID` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `CreateAt` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`ID`, `Name`, `CreateAt`, `UpdateAt`, `status`) VALUES
(43, 'Mô Hình Chính Hãng', '2024-11-17 23:02:01', NULL, 1),
(44, 'Evil Studios', '2024-11-19 08:00:05', NULL, 1),
(45, 'Cai Studio', '2024-11-19 08:00:12', NULL, 1),
(46, 'C2 Studio', '2024-11-19 08:00:19', NULL, 1),
(47, 'TJ x BW STUDIO', '2024-11-19 08:00:23', NULL, 1),
(48, 'Space Seven Collectible', '2024-11-19 08:00:33', NULL, 1),
(49, 'LK Studio', '2024-11-19 08:00:37', NULL, 1),
(50, 'DT Studio', '2024-11-19 08:00:46', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `ParentID` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `CreateAt` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `ParentID`, `status`, `CreateAt`, `UpdateAt`) VALUES
(59, 'One Piece', 0, 1, '2024-11-17 23:04:16', NULL),
(60, 'Dragon Ball', 0, 1, '2024-11-17 23:04:21', NULL),
(61, 'Naruto', 0, 1, '2024-11-17 23:04:24', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Password` text NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Birthday` date DEFAULT NULL,
  `Address` text NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `CreateAt` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `code` int(12) NOT NULL,
  `verify` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`ID`, `Email`, `Password`, `Name`, `Birthday`, `Address`, `PhoneNumber`, `CreateAt`, `Status`, `code`, `verify`) VALUES
(5, 'vuductien2908@gmail.com', '123', 'Đức Tiến', '2023-12-14', 'Cần Thơ', '312312312', '2022-12-11 21:28:38', 1, 2378, 1),
(6, 'nguyenvanA@gmail.com', '123456789', 'Tiến Vũ', '2023-03-22', '182 Trần Hưng Đạo', '0333669832', '2023-03-13 17:51:19', 1, 0, 0),
(11, 'vdtien2001024@student.ctuet.edu.vn', '123', 'Vũ Đức Tiến', '2023-12-11', 'Cần Thơ', '0333669832', '2023-12-29 09:39:12', 1, 4868, 0),
(12, 'vuuductien2908@gmail.com', '123', 'Đức Tiến', '2023-12-11', 'Cần Thơ', '0333669832', '2023-12-29 09:53:11', 1, 536, 0),
(13, 'phatcao82@gmail.com', 'Giaphat123', 'Tăng Gia Phát', '2004-03-12', 'TPHCM', '123456678', '2024-11-17 23:07:39', 1, 6359, 1),
(14, 'phatru245@gmail.com', 'Giaphat123', 'Tăng Gia Phátt', '2004-03-12', 'TPHCM', '12344552', '2024-11-17 23:13:02', 1, 2969, 1),
(15, 'phatne0312@gmail.com', '123456789', 'Phát Nè', '2004-12-03', 'TPHM', '1234567890', '2024-11-18 21:24:12', 1, 5698, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `NameReceive` varchar(250) NOT NULL,
  `PhoneReceive` int(11) NOT NULL,
  `AddressReceive` text NOT NULL,
  `Note` text NOT NULL,
  `Total` decimal(18,0) NOT NULL DEFAULT 0,
  `payment` int(11) NOT NULL DEFAULT 0,
  `StatusOrder` int(11) NOT NULL DEFAULT 1,
  `CustomerID` int(11) NOT NULL,
  `UpdateAt` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `CreateAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`ID`, `OrderDate`, `NameReceive`, `PhoneReceive`, `AddressReceive`, `Note`, `Total`, `payment`, `StatusOrder`, `CustomerID`, `UpdateAt`, `status`, `CreateAt`) VALUES
(30, '2023-12-28 12:29:42', 'Quách phú Thành', 3131313, 'Cần Thơ', 'Không lấy', '599000', 0, 3, 5, '2024-11-17 23:43:29', 1, '2023-12-28 12:29:42'),
(31, '2023-12-28 17:21:13', 'Demo', 131313123, 'KG', 'nhanh', '560000', 0, 3, 5, '2024-11-17 23:43:30', 1, '2023-12-28 17:21:13'),
(32, '2023-12-28 17:27:51', 'demo', 313123131, 'KG', 'Demo', '299000', 0, 3, 5, '2024-11-17 23:43:30', 1, '2023-12-28 17:27:51'),
(33, '2023-12-28 17:33:04', 'ấn danh', 2147483647, 'Kiên Giang', 'Cần thơ', '600000', 0, 3, 5, '2024-11-17 23:43:31', 1, '2023-12-28 17:33:04'),
(34, '2023-12-28 18:47:58', 'Lưu Vũ Tuyển', 3123123, 'KG', 'Giao Nhanh', '299000', 0, 3, 5, '2024-11-17 23:43:31', 1, '2023-12-28 18:47:58'),
(35, '2023-12-28 18:48:49', 'Lưu Vũ Tuyển', 2147483647, 'KG', 'Giao Nhanh', '300000', 0, 3, 5, '2024-11-17 23:43:32', 1, '2023-12-28 18:48:49'),
(36, '2023-12-28 18:50:40', 'Abc', 122312332, 'Cần Thơ', 'Giao nhanh', '560000', 0, 3, 5, '2024-11-17 23:43:33', 1, '2023-12-28 18:50:40'),
(37, '2023-12-28 18:57:49', 'Demo', 2147483647, 'Cần Thơ', 'Giao nhanh', '599000', 0, 3, 5, '2024-11-17 23:43:33', 1, '2023-12-28 18:57:49'),
(38, '2023-12-28 19:01:20', 'qưedqweqw', 2147483647, 'Cần THơ', 'demo', '599000', 0, 3, 5, '2024-11-17 23:43:33', 1, '2023-12-28 19:01:20'),
(39, '2023-12-28 19:04:39', 'demo', 13212313, 'dưqdqwd', 'dqwdqwd', '560000', 0, 3, 5, '2024-11-17 23:43:34', 1, '2023-12-28 19:04:39'),
(40, '2023-12-28 19:05:39', 'dweqweqw', 321312312, 'êqwqw', 'Giao', '400000', 0, 3, 5, '2024-11-17 23:43:34', 1, '2023-12-28 19:05:39'),
(41, '2023-12-28 19:06:23', 'Đinh Quang Huy', 2147483647, 'Cần thơ', 'Giao ngoài giờ', '400000', 0, 3, 5, '2024-11-17 23:43:35', 1, '2023-12-28 19:06:23'),
(42, '2023-12-28 19:07:41', 'Demo', 321312313, 'Cần Thơ', 'Giao ngoài giờ', '400000', 0, 3, 5, '2024-11-17 23:43:35', 1, '2023-12-28 19:07:41'),
(43, '2023-12-28 19:16:21', 'Vũ Đức Tiến', 333660932, 'Kiên Giang', 'Giao nhanh', '598000', 0, 2, 5, '2023-12-28 19:24:44', 1, '2023-12-28 19:16:21'),
(44, '2023-12-28 19:17:02', 'Vũ Đức Tiến', 2147483647, 'Kiên Giang', 'Giao NHanh', '299000', 1, 2, 5, '2023-12-28 19:21:44', 1, '2023-12-28 19:17:02'),
(45, '2023-12-28 19:51:54', 'Đinh Thanh Trọng', 2147483647, 'Kiên Giang', 'demo', '599000', 1, 1, 5, NULL, 1, '2023-12-28 19:51:54'),
(46, '2023-12-28 19:55:20', 'Nguyễn Hoàng Vinh', 1231312, 'Demo', 'demo', '599000', 1, 1, 5, NULL, 1, '2023-12-28 19:55:20'),
(47, '2023-12-28 19:58:49', 'Demo', 123131233, 'abc', 'Nhanh', '560000', 1, 1, 5, NULL, 1, '2023-12-28 19:58:49'),
(48, '2023-12-28 22:55:48', 'Nguyễn Hoàng Vĩnh', 312313123, 'AN giang', 'Demo', '560000', 1, 1, 5, NULL, 1, '2023-12-28 22:55:48'),
(49, '2024-11-17 23:44:11', 'Tăng Gia Phát', 522350848, 'TPHCM', '123', '960000', 1, 1, 13, NULL, 1, '2024-11-17 23:44:11'),
(50, '2024-11-18 21:19:22', 'Phát', 123456677, 'TPHCM', '123', '8000000', 0, 1, 13, NULL, 1, '2024-11-18 21:19:22'),
(51, '2024-11-18 21:22:46', 'Phát', 213123, 'TPHCM', '12321321312', '2000000', 1, 1, 13, NULL, 1, '2024-11-18 21:22:46'),
(52, '2024-11-18 21:23:03', 'Phát', 123213, '21313', '12321312', '1500000', 0, 1, 13, NULL, 1, '2024-11-18 21:23:03'),
(53, '2024-11-19 10:38:11', 'Phát', 978211542, 'TPHCM', '123', '3400000', 1, 1, 15, NULL, 1, '2024-11-19 10:38:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Price` decimal(18,0) NOT NULL,
  `PromotionPrice` decimal(18,0) NOT NULL,
  `Size` text NOT NULL,
  `Description` text NOT NULL,
  `Img` text NOT NULL,
  `Discount` int(11) DEFAULT NULL,
  `Hot` tinyint(1) DEFAULT NULL,
  `Detail` text NOT NULL,
  `ViewCount` int(11) NOT NULL DEFAULT 0,
  `CateID` int(11) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `CreateAt` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ID`, `Name`, `Price`, `PromotionPrice`, `Size`, `Description`, `Img`, `Discount`, `Hot`, `Detail`, `ViewCount`, `CateID`, `SupplierID`, `BrandID`, `Status`, `CreateAt`, `UpdateAt`) VALUES
(42, 'Boa Hancook', '1200000', '960000', '16', '<p>123</p>', 'acfda389ee0941e0827b7b344731e7bd.jpg', 20, 1, '<p>123</p>', 0, 59, 13, 43, 1, '2024-11-17 23:20:35', NULL),
(43, 'Mô hình Law', '1500000', '1500000', '16', '<p>123</p>', '9e91ff56c15e9474c8d77ebd7423d59f.jpg', 0, 1, '<p>123</p>', 0, 59, 13, 43, 1, '2024-11-17 23:23:02', '2024-11-17 23:23:51'),
(44, 'Luffy cưỡi bò', '1600000', '1440000', '16', '<p>123</p>', '7f642eeff4e6cfc32d053f98212fdc70.jpg', 10, 1, '<p>123</p>', 0, 59, 13, 43, 1, '2024-11-17 23:25:11', NULL),
(45, 'Mô Hình Naruto', '2000000', '1600000', '16', '<p>123</p>', '710e808257ee36586431bce7feb0ea4d.jpg', 20, 1, '<p>123</p>', 0, 61, 15, 43, 1, '2024-11-17 23:28:03', NULL),
(46, 'Mô Hình Gohan', '2000000', '1600000', '16', '<p>123</p>', '0249a73485b7d1960f21f21523e61950.jpg', 25, 1, '<p>123</p>', 0, 60, 14, 43, 1, '2024-11-17 23:29:05', NULL),
(47, 'Mô Hình Naruto - Rasengan', '4000000', '3600000', '16', '<p>123</p>', '6fee9472773a9ff3b4c8776483b44623.jpg', 20, 1, '<p>123</p>', 0, 61, 16, 43, 1, '2024-11-17 23:30:31', NULL),
(48, 'Mô Hình sasuke', '3500000', '3300000', '16', '<p>123</p>', 'c994175c6fa14f0dc1da81d9031f839c.jpg', 20, 1, '<p>123</p>', 0, 61, 14, 43, 1, '2024-11-17 23:31:51', '2024-11-17 23:34:28'),
(49, 'Mô Hình kakashi', '3400000', '3400000', '16', '<p>123</p>', '5deecb0ec613f8f64cc95e6d3c3abea7.jpg', 0, 1, '<p>123</p>', 0, 61, 15, 43, 1, '2024-11-17 23:32:55', '2024-11-17 23:34:49'),
(50, 'Mô hình Vegeta', '2000000', '2000000', '16', '<p>123</p>', '0ea4b409449b67989b3397b91934f9eb.jpg', 0, 1, '<p>123</p>', 0, 60, 14, 43, 1, '2024-11-17 23:33:49', NULL),
(51, 'Mô Hình Akainu', '2000000', '2000000', '16', '<p>123</p>', '987316c6be363d6b3703c00898fb3015.jpg', 0, 1, '<p>123</p>', 0, 59, 13, 43, 1, '2024-11-17 23:35:31', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `ID` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `CreateAt` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `suppliers`
--

INSERT INTO `suppliers` (`ID`, `Name`, `Email`, `PhoneNumber`, `Address`, `Status`, `CreateAt`, `UpdateAt`) VALUES
(13, 'Anime Universe', 'animeuniverse.vn@gmail.com', '+84 28 3930 219', '118C Nguyễn Đình Chiểu, Phường 6, Quận 3, Hồ Chí Minh', 1, '2024-11-17 23:02:55', NULL),
(14, 'FVN Store', 'contact@fvnstore.vn', '+84 28 3832 320', ' 204 Nguyễn Trãi, Phường 3, Quận 5, Hồ Chí Minh', 1, '2024-11-17 23:03:13', NULL),
(15, 'Tokyo Store', 'tokyo.store.vn@gmail.com', '+84 28 3920 199', '74A Trần Hưng Đạo, Quận 1, Hồ Chí Minh', 1, '2024-11-17 23:03:37', NULL),
(16, 'Manga Club', 'manga.club.vn@gmail.com', '+84 93 292 2323', '12A Nguyễn Hữu Cảnh, Phường 22, Quận Bình Thạnh, Hồ Chí Minh', 1, '2024-11-17 23:04:00', NULL);



--
-- Chỉ mục cho bảng `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);



--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BrandID` (`BrandID`),
  ADD KEY `CateID` (`CateID`),
  ADD KEY `SupplierID` (`SupplierID`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID`);



--
-- AUTO_INCREMENT cho bảng `administrators`
--
ALTER TABLE `administrators`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;


--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`ID`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`BrandID`) REFERENCES `brands` (`ID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`CateID`) REFERENCES `categories` (`ID`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`SupplierID`) REFERENCES `suppliers` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
