-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2025 lúc 04:20 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_lkpc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 1,
  `thanhtien` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '0001_01_01_000001_create_cache_table', 1),
(6, '0001_01_01_000002_create_jobs_table', 1),
(7, '2025_03_30_125857_create_users_table', 1),
(8, '2025_03_31_171049_create_sessions_table', 1),
(9, '2025_04_04_034420_create_products_table', 2),
(10, '2025_04_04_034600_create_products_details_table', 2),
(11, '2025_04_09_102943_create_orders_table', 3),
(12, '2025_04_09_102949_create_order_details_table', 3),
(13, '2025_04_09_131129_create_cart_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `yourname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT '2025-04-09 10:41:13',
  `total_price` decimal(10,2) NOT NULL,
  `delivery` enum('Chờ xử lý','Đang giao','Đã giao','Đã hủy') NOT NULL DEFAULT 'Chờ xử lý',
  `payment_method` enum('Tiền mặt','Chuyển khoản') NOT NULL,
  `status` enum('Xác nhận','Chờ xác nhận','Hủy') NOT NULL DEFAULT 'Chờ xác nhận',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `yourname`, `phone`, `email`, `address`, `order_date`, `total_price`, `delivery`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(85, 'member', 'Leader AOV', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-11 14:40:15', 2500000.00, 'Chờ xử lý', 'Tiền mặt', 'Chờ xác nhận', '2025-04-11 07:40:15', '2025-04-11 07:40:15'),
(86, 'member', 'Leader AOV', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-11 14:40:22', 1500000.00, 'Chờ xử lý', 'Tiền mặt', 'Chờ xác nhận', '2025-04-11 07:40:22', '2025-04-11 07:40:22'),
(87, 'member', 'Leader AOV', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-11 14:40:28', 9999000.00, 'Đã hủy', 'Tiền mặt', 'Hủy', '2025-04-11 07:40:28', '2025-04-15 07:38:17'),
(88, 'member', 'Leader AOV', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-11 14:40:33', 12299000.00, 'Đã giao', 'Tiền mặt', 'Xác nhận', '2025-04-11 07:40:33', '2025-04-15 07:38:10'),
(89, 'member', 'Leader AOV', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-11 14:40:45', 10000000.00, 'Chờ xử lý', 'Tiền mặt', 'Chờ xác nhận', '2025-04-11 07:40:45', '2025-04-11 07:40:45'),
(90, 'member', 'Leader AOV', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-11 14:51:47', 5000000.00, 'Đang giao', 'Tiền mặt', 'Xác nhận', '2025-04-11 07:51:47', '2025-04-15 07:36:14'),
(91, 'member', 'Robot', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-15 15:17:29', 12000000.00, 'Chờ xử lý', 'Tiền mặt', 'Xác nhận', '2025-04-15 08:17:29', '2025-04-15 19:05:58'),
(92, 'member', 'Robot', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-16 02:06:43', 1500000.00, 'Chờ xử lý', 'Tiền mặt', 'Chờ xác nhận', '2025-04-15 19:06:43', '2025-04-15 19:06:43'),
(93, 'member', 'Robot', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '2025-04-16 02:08:02', 15597000.00, 'Chờ xử lý', 'Tiền mặt', 'Chờ xác nhận', '2025-04-15 19:08:02', '2025-04-15 19:08:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `MaSP` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `dongia` decimal(10,2) NOT NULL,
  `thanhtien` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `MaSP`, `hinhanh`, `tensanpham`, `so_luong`, `dongia`, `thanhtien`, `created_at`, `updated_at`) VALUES
(38, 85, '4', '1743787741.png', 'CPU Intel Core i5-12400F (Tray, cũ đẹp)', 1, 2500000.00, 2500000.00, '2025-04-11 07:40:15', '2025-04-11 07:40:15'),
(39, 86, '5', '1743787948.jpg', 'CPU Intel Core i3-12100F (Tray, cũ đẹp)', 1, 1500000.00, 1500000.00, '2025-04-11 07:40:22', '2025-04-11 07:40:22'),
(40, 87, '9', '1743788582.jpg', 'Mainboard ASUS TUF GAMING Z890-PLUS WIFI DDR5', 1, 9999000.00, 9999000.00, '2025-04-11 07:40:28', '2025-04-11 07:40:28'),
(41, 88, '14', '1743789239.jpg', 'MSI RTX 4060 Ti VENTUS 2X BLACK 8G OC', 1, 12299000.00, 12299000.00, '2025-04-11 07:40:33', '2025-04-11 07:40:33'),
(42, 89, '4', '1743787741.png', 'CPU Intel Core i5-12400F (Tray, cũ đẹp)', 4, 2500000.00, 10000000.00, '2025-04-11 07:40:45', '2025-04-11 07:40:45'),
(43, 90, '4', '1743787741.png', 'CPU Intel Core i5-12400F (Tray, cũ đẹp)', 2, 2500000.00, 5000000.00, '2025-04-11 07:51:47', '2025-04-11 07:51:47'),
(44, 91, '29', '1743790744.jpg', 'Màn hình Asus Pro Art PA279CV', 1, 12000000.00, 12000000.00, '2025-04-15 08:17:29', '2025-04-15 08:17:29'),
(45, 92, '5', '1743787948.jpg', 'CPU Intel Core i3-12100F (Tray, cũ đẹp)', 1, 1500000.00, 1500000.00, '2025-04-15 19:06:43', '2025-04-15 19:06:43'),
(46, 93, '8', '1743788387.jpg', 'CPU AMD Ryzen 5 8500G', 3, 4199000.00, 12597000.00, '2025-04-15 19:08:02', '2025-04-15 19:08:02'),
(47, 93, '5', '1743787948.jpg', 'CPU Intel Core i3-12100F (Tray, cũ đẹp)', 2, 1500000.00, 3000000.00, '2025-04-15 19:08:02', '2025-04-15 19:08:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `danhmuc` enum('Mainboard','CPU','RAM','SSD','VGA','Case','ManHinh') NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `dongia` decimal(10,2) NOT NULL,
  `phanloai` varchar(255) NOT NULL,
  `status` enum('con_hang','het_hang') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `danhmuc`, `hinhanh`, `tensanpham`, `dongia`, `phanloai`, `status`, `created_at`, `updated_at`) VALUES
(5, 'CPU', '1743787948.jpg', 'CPU Intel Core i3-12100F (Tray, cũ đẹp)', 1500000.00, 'Intel', 'con_hang', '2025-04-04 10:32:28', '2025-04-04 10:32:28'),
(6, 'CPU', '1743788147.jpg', 'CPU Intel Core i5-14400 (UP TO 4.7GHZ, 10 NHÂN 16 LUỒNG, 20MB CACHE, 65W)', 4700000.00, 'Intel', 'con_hang', '2025-04-04 10:35:47', '2025-04-04 10:36:10'),
(7, 'CPU', '1743788295.jpg', 'CPU AMD Ryzen 9 7900X', 10999000.00, 'AMD', 'con_hang', '2025-04-04 10:38:15', '2025-04-04 10:38:15'),
(8, 'CPU', '1743788387.jpg', 'CPU AMD Ryzen 5 8500G', 4199000.00, 'AMD', 'con_hang', '2025-04-04 10:39:48', '2025-04-04 10:39:48'),
(9, 'Mainboard', '1743788582.jpg', 'Mainboard ASUS TUF GAMING Z890-PLUS WIFI DDR5', 9999000.00, 'Mainboard ASUS', 'con_hang', '2025-04-04 10:43:02', '2025-04-04 10:43:02'),
(10, 'Mainboard', '1743788677.jpg', 'Mainboard ASUS ROG STRIX B760-F GAMING WIFI DDR5', 6599000.00, 'Mainboard ASUS', 'con_hang', '2025-04-04 10:44:37', '2025-04-04 10:44:37'),
(11, 'Mainboard', '1743788809.jpg', 'Mainboard MSI MAG Z890 TOMAHAWK WIFI', 9499000.00, 'Mainboard MSI', 'con_hang', '2025-04-04 10:46:49', '2025-04-04 10:46:49'),
(12, 'Mainboard', '1743788915.jpg', 'Mainboard Gigabyte Z890 AORUS MASTER', 16999000.00, 'Mainboard Gigabyte', 'con_hang', '2025-04-04 10:48:35', '2025-04-04 10:48:35'),
(13, 'VGA', '1743789100.jpg', 'Gigabyte RTX 4070 SUPER WINDFORCE OC-12G', 18599000.00, 'Gigabyte', 'con_hang', '2025-04-04 10:51:40', '2025-04-04 10:51:40'),
(14, 'VGA', '1743789239.jpg', 'MSI RTX 4060 Ti VENTUS 2X BLACK 8G OC', 12299000.00, 'MSI', 'con_hang', '2025-04-04 10:53:59', '2025-04-04 10:53:59'),
(15, 'VGA', '1743789352.jpg', 'Gigabyte RTX 5070 AORUS MASTER 12G', 29499000.00, 'Gigabyte', 'con_hang', '2025-04-04 10:55:52', '2025-04-04 10:55:52'),
(16, 'VGA', '1743789429.jpg', 'INNO3D RTX 3060 TWIN X2 12GB', 7699000.00, 'INNO3D', 'con_hang', '2025-04-04 10:57:09', '2025-04-04 10:57:09'),
(17, 'RAM', '1743789635.jpg', 'Ram Desktop Gskill RIPJAWS M5 RGB WHITE 32GB', 2999000.00, 'DDR5 6000MHz', 'con_hang', '2025-04-04 11:00:35', '2025-04-04 11:04:07'),
(18, 'RAM', '1743789717.jpg', 'Ram Desktop Kingston Fury Beast RGB 32GB', 1999000.00, 'DDR4 3200Mhz', 'con_hang', '2025-04-04 11:01:57', '2025-04-04 11:01:57'),
(19, 'RAM', '1743789916.jpeg', 'Ram Desktop Kingston Fury Beast16GB', 1399000.00, 'DDR4 3200Mhz', 'con_hang', '2025-04-04 11:05:16', '2025-04-04 11:05:16'),
(20, 'RAM', '1743789996.jpg', 'Ram Desktop Corsair Vengeance RGB White Heatspreader32GB', 3399000.00, 'DDR5 6000MHz', 'con_hang', '2025-04-04 11:06:36', '2025-04-04 11:06:36'),
(21, 'SSD', '1743790086.jpg', 'Ổ cứng SSD Samsung 870 EVO 500GB SATA III 6Gb/s 2.5 inch', 1499000.00, 'Samsung', 'con_hang', '2025-04-04 11:08:06', '2025-04-04 11:08:06'),
(22, 'SSD', '1743790165.jpg', 'Ổ cứng SSD WD Green 480GB SATA 2.5 inch', 899000.00, 'WD Green', 'con_hang', '2025-04-04 11:09:25', '2025-04-04 11:09:25'),
(23, 'SSD', '1743790224.jpg', 'Ổ cứng SSD Lexar NS100 128GB Sata3 2.5 inch', 410000.00, 'Lexar', 'con_hang', '2025-04-04 11:10:24', '2025-04-04 11:10:24'),
(24, 'SSD', '1743790327.jpg', 'Ổ cứng SSD KIOXIA Exceria Plus G3 1TB Gen 4x4', 1749000.00, 'KIOXIA Exceria Plus G3', 'con_hang', '2025-04-04 11:12:07', '2025-04-04 11:12:07'),
(25, 'Case', '1743790422.jpg', 'Vỏ Case Asus TUF Gaming GT302 ARGB Black', 3199000.00, 'Asus TUF màu đen', 'con_hang', '2025-04-04 11:13:42', '2025-04-04 11:13:42'),
(26, 'Case', '1743790480.jpg', 'Vỏ Case Asus GR701 ROG Hyperion White Edition', 9999000.00, 'Case Asus Trắng', 'con_hang', '2025-04-04 11:14:40', '2025-04-04 11:14:40'),
(27, 'Case', '1743790533.jpg', 'Vỏ Case ASUS A21 BLK', 1399000.00, 'Case ASUS Màu Đen', 'con_hang', '2025-04-04 11:15:33', '2025-04-04 11:15:33'),
(28, 'Case', '1743790599.jpg', 'Vỏ case JONSBO TK-0 Black', 2800000.00, 'Case JONSBO Đen', 'con_hang', '2025-04-04 11:16:39', '2025-04-04 11:16:39'),
(29, 'ManHinh', '1743790744.jpg', 'Màn hình Asus Pro Art PA279CV', 12000000.00, 'Asus Pro Art', 'con_hang', '2025-04-04 11:19:04', '2025-04-04 11:19:04'),
(30, 'ManHinh', '1743790808.jpg', 'Màn hình LG UltraGear 24GS65F-B', 3389000.00, 'LG', 'con_hang', '2025-04-04 11:20:08', '2025-04-04 11:20:08'),
(31, 'ManHinh', '1743790856.jpg', 'Màn hình AOC 27G10ZE', 3999000.00, 'AOC', 'con_hang', '2025-04-04 11:20:56', '2025-04-04 11:20:56'),
(32, 'ManHinh', '1743790914.jpg', 'Màn hình Samsung Odyssey OLED G8 G80SD', 23999000.00, 'Samsung Odyssey', 'con_hang', '2025-04-04 11:21:54', '2025-04-04 11:21:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_details`
--

CREATE TABLE `products_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `thongsokythuat` text NOT NULL,
  `chitietsanpham` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_details`
--

INSERT INTO `products_details` (`id`, `product_id`, `thongsokythuat`, `chitietsanpham`, `created_at`, `updated_at`) VALUES
(5, 5, 'Socket: Intel LGA 1700\r\nSố nhân: 4\r\nSố luồng: 8\r\nXung nhịp tối đa: 4.3 Ghz', 'CPU Intel Core i3-12100F là CPU thế hệ thứ 12 của Intel (Alder Lake) trên nền Socket LGA 1700 với kiến trúc hoàn toàn mới cho hiệu năng vượt trội so với người tiền nhiệm.\r\nĐây là phiên bản không tích hợp iGPU để giảm giá thành, khi sử dụng bắt buộc phải có card đồ họa rời.', '2025-04-04 10:32:28', '2025-04-04 10:32:28'),
(6, 6, 'Socket: LGA 1700\r\nSố nhân: 10\r\nSố luồng: 16\r\nXung nhịp cơ bản: 2.5 GHz\r\nXung nhịp tối đa: 4.7 GHz\r\nBộ nhớ Cache L2 / L3: 9.5/ 20 MB\r\nĐiện năng tiêu thụ: 65W', 'Hiệu năng CPU Intel Core i5-14400\r\nCPU Intel Core i5-14400 với 6 nhân P và 4 nhân E, cung cấp tổng cộng 16 luồng thông qua công nghệ siêu phân luồng. CPU được cho là có xung nhịp cơ bản 2,5 GHz và có thể tăng tốc lên tới 4,7 GHz. Ghi được 2464 điểm trong bài kiểm tra lõi đơn và 13373 điểm trong các bài kiểm tra Geekbench đa lõi, rõ ràng CPU này vượt trội so với các tiền nhiệm, như 13400, có chung cấu hình CPU nhưng có xung nhịp boost thấp hơn 100 MHz.', '2025-04-04 10:35:47', '2025-04-04 10:35:47'),
(7, 7, 'Số nhân: 12\r\nSố luồng: 24 luồng\r\nXung nhịp boost tối đa: 5.6 GHz\r\nHỗ trợ PCI-e 5.0\r\nHỗ trợ ép xung', 'Trang bị những công nghệ tiên tiến nhất\r\nAMD Ryzen 9 7900X sinh ra dành cho những công việc về công nghệ đỉnh nhất như coding, AI, giả lập, …Và để hỗ trợ vào khả năng xử lý mạnh mẽ đó, AMD đã mang đến cho sản phẩm của mình những công nghệ như:\r\n\r\nAMD StoreMI: Tăng tốc khả năng xử lý, lưu trữ của những ổ cứng HDD và SSD bao gồm cả khả năng tăng tốc thời gian tải, khởi động, phản hồi từ hệ thống đến người dùng.\r\nAMD \"Zen 4\" Core: Nhân xử lý tốc độ cao và tiên tiến nhất hiện nay, phục vụ cho khả năng làm việc và chơi game tối ưu.\r\nAMD Ryzen™ VR-Ready Premium: Nâng cấp trải nghiệm VR đối với người dùng chuyên nghiệp.', '2025-04-04 10:38:16', '2025-04-04 10:38:16'),
(8, 8, 'Số nhân, số luồng: 6 nhân 12 luồng\r\nXung nhịp CPU: 3.5 – 5.0 GHz\r\nBộ nhớ Cache (L2+L3): 22 MB\r\nTDP: 65W\r\nKiến trúc: 2 x Zen4, 4 x Zen4c\r\nBus ram hỗ trợ: Up to 5200MT/s\r\nCard đồ họa: Tích hợp sẵn AMD Radeon™ 740M', 'Kiến ​​trúc lai kết hợp \"Zen 4\" và \"Zen 4c\"\r\nSở hữu kiến trúc lai khá đặc biệt \"Zen 4\" và \"Zen 4c\"  bộ vi xử lý AMD Ryzen 5 8500G so với cấu trúc chỉ Zen 4 hay Zen 4c Đơn cử trong đó là khả năng giảm mức tiêu thụ điện sẽ giảm đi khi hoạt động ở hiệu suất cao.\r\n\r\nHỗ trợ đồ họa với thông số ấn tượng\r\nAMD Ryzen 5 8500G với cấu trúc lai và APU được trang bị 6 nhân/12 luồng cho ra xung nhịp cơ bản 3.5GHz và đạt 5.0GHz ở giai đoạn Boost; Bộ đệm L3 là 16 MB trong khi Bộ đệm L2 là 6 MB. Thông số cơ bản mà chiếc CPU này đem lại sẽ thật sự làm bạn ấn tượng khi trải nghiệm thực tế.  \r\n\r\nMẫu CPU này được thiết kế để tạo nên một bộ PC gaming tuyệt vời khi AMD Radeon 740M có đơn vị tính toán gấp đôi so với 710M và có thể chạy các tựa game eSports và một số tựa game AAA cách mượt mà và ổn định.\r\n\r\nHỗ trợ bộ nhớ DDR5-5200\r\nBộ nhớ là điểm sẽ khiến bạn nên lựa chọn chiếc CPU AMD Ryzen 5 8500G này, hỗ trợ cho bộ nhớ loại DDR5 và tốc độ cao nhất có thể đạt là 5200MT/s nên bạn có thể yên tâm khi khi thực hiện đa dạng các tác vụ mà vẫn đạt được sự ổn định', '2025-04-04 10:39:48', '2025-04-04 10:39:48'),
(9, 9, 'Chipset: Intel Z890\r\nSocket: Intel LGA1851\r\nKích thước: ATX\r\nSố khe RAM: 4 DDR5', NULL, '2025-04-04 10:43:02', '2025-04-04 10:43:02'),
(10, 10, 'Socket: LGA1700 h\r\nKích thước: ATX\r\nKhe cắm RAM: 4 khe (Tối đa 128GB)\r\nKhe cắm mở rộng: 1 x PCIe 3.0 x16 slot, 2 x PCIe 3.0 x1 slots', NULL, '2025-04-04 10:44:37', '2025-04-04 10:44:37'),
(11, 11, 'Socket: LGA 1851 hỗ trợ CPU Intel® Core™ Ultra Processors (Series 2)\r\nKích thước: ATX\r\nKhe cắm RAM: 4 khe (Tối đa 256GB)\r\nKhe cắm mở rộng: 3x PCI-E x16 slot', 'Hỗ trợ CPU Intel thế hệ mới nhất\r\nMainboard MSI MAG Z890 TOMAHAWK WIFI sử dụng socket LGA 1851, hỗ trợ các bộ vi xử lý Intel Core Ultra Processor, mang đến hiệu năng xử lý mạnh mẽ cho các tác vụ nặng và game đòi hỏi cấu hình cao.\r\n\r\nGiải pháp tản nhiệt tối ưu\r\nMSI MAG Z890 TOMAHAWK WIFI được trang bị hệ thống tản nhiệt mở rộng với heatsink lớn cho khu vực VRM, đảm bảo nhiệt độ luôn được kiểm soát ngay cả khi hoạt động ở cường độ cao. Khe cắm M.2 Shield Frozr giúp SSD M.2 luôn mát mẻ, duy trì hiệu năng ổn định và kéo dài tuổi thọ.\r\nKết nối tốc độ cao\r\nMainboard PC MSI MAG Z890 TOMAHAWK WIFI mang đến khả năng kết nối siêu tốc với giải pháp mạng 5G LAN và WiFi 7, đảm bảo đường truyền ổn định và tốc độ cao cho trải nghiệm chơi game online mượt mà và làm việc hiệu quả.\r\nHỗ trợ bộ nhớ DDR5 tốc độ cao\r\nMSI MAG Z890 TOMAHAWK WIFI hỗ trợ bộ nhớ DDR5 với tốc độ cao, mang đến băng thông rộng rãi và hiệu năng vượt trội cho hệ thống. Công nghệ Memory Boost giúp tối ưu hóa hiệu năng RAM, đảm bảo ổn định và tương thích tối đa.', '2025-04-04 10:46:49', '2025-04-04 10:46:49'),
(12, 12, 'Chipset: Intel Z890\r\nSocket: Intel LGA 1851\r\nHỗ trợ CPU Intel® Core™ Ultra\r\nKích thước: ATX\r\nSố khe RAM: 4 khe DDR5', 'Công nghệ mạng tiên tiến\r\nMainboard này có thể hỗ trợ Wi-Fi 6E hoặc Wi-Fi 7, mang lại tốc độ mạng không dây nhanh hơn, phù hợp với các kết nối băng thông lớn, giảm độ trễ khi chơi game và làm việc trực tuyến.\r\nTích hợp mạng LAN 2.5G hoặc 10G giúp tốc độ mạng dây nhanh và ổn định hơn.\r\nHệ thống tản nhiệt và quản lý điện năng tốt\r\nZ890 có thể được trang bị hệ thống tản nhiệt hiệu quả hơn cho VRM và các thành phần quan trọng khác, đảm bảo bo mạch luôn hoạt động ổn định ngay cả khi CPU và GPU bị ép xung.\r\nThiết kế nguồn điện cải tiến giúp cung cấp điện năng ổn định hơn, tăng cường độ bền và tuổi thọ cho hệ thống.\r\nSố lượng cổng kết nối phong phú\r\nZ890 sẽ hỗ trợ nhiều cổng kết nối hiện đại như Thunderbolt 4, USB 4.0, USB 3.2 Gen 2x2, giúp truyền dữ liệu nhanh hơn và kết nối với nhiều thiết bị ngoại vi khác nhau.\r\nHỗ trợ nhiều khe M.2 hơn cho ổ cứng SSD NVMe, giúp mở rộng dung lượng lưu trữ và tốc độ truy xuất dữ liệu.\r\nHỗ trợ ép xung mạnh mẽ\r\nĐược trang bị công nghệ ép xung tiên tiến cho CPU và RAM, giúp người dùng khai thác tối đa hiệu suất của hệ thống mà không làm giảm độ ổn định. Điều này đặc biệt có ích cho các game thủ và người dùng chuyên nghiệp.\r\nTính năng BIOS và phần mềm tối ưu\r\nDòng Z890 sẽ đi kèm với BIOS được cải tiến, giao diện thân thiện với người dùng và nhiều tính năng tùy chỉnh. Các tính năng bảo mật và quản lý hệ thống cũng được cải tiến để tăng cường sự linh hoạt và bảo vệ dữ liệu.', '2025-04-04 10:48:35', '2025-04-04 10:48:35'),
(13, 13, 'Nhân đồ họa: NVIDIA® GeForce RTX™ 4070 Super\r\nNhân CUDA: 7168\r\nDung lượng bộ nhớ: 12GB GDDR6X\r\nTốc độ bộ nhớ: 21 Gbps\r\nGiao diện bộ nhớ: 192-bit\r\nNguồn khuyến nghị: 750W', 'Hiệu năng Card màn hình RTX 4070 Super\r\nSo với thế hệ tiền nhiệm\r\nNếu so sánh trực tiếp với RTX 4070, thì phiên bản Super giống một màn lột xác mạnh về khả năng xử lý đồ họa. Thay vì 5888 nhân CUDA, chúng ta có 7168 nhân CUDA trên GPU AD104-350-A1, tiến trình 5nm TSMC. Hơn 35 tỷ transistor trên bề mặt die GPU monolithic này được chia thành 224 TMU, 80 ROP và 56 Stream Microprocessors. Cùng với đó là 56 nhân ray tracing, 224 nhân tensor xử lý thuật toán deep learning, và 48MB bộ nhớ đệm L2. Đây cũng là một yếu tố cải thiện lớn giữa RTX 4070 Super so với 4070 ra mắt gần tròn 1 năm trước, khi bản cũ chỉ có 36MB cache L2.', '2025-04-04 10:51:40', '2025-04-04 10:51:40'),
(14, 14, 'Nhân đồ họa: NVIDIA® GeForce RTX™ 4060 Ti\r\nNhân CUDA: 4352\r\nBộ nhớ: 8GB GDDR6\r\nGiao thức bộ nhớ: 128-bit\r\nNguồn khuyến nghị: 650W', 'VGA RTX 4060 Ti VENTUS 2X 8G OC mang đến một thiết kế tập trung vào hiệu suất nhằm duy trì các yếu tố cần thiết để xử lý mọi dữ liệu cùng chương trình cần thiết. Việc bố trí quạt kép với một thiết kế cứng cáp cho phép card đồ họa trông sắc nét này phù hợp với mọi bộ PC của bạn.', '2025-04-04 10:53:59', '2025-04-04 10:53:59'),
(15, 15, 'Nhân đồ hoạ: NVIDIA® GeForce RTX™ 5070\r\nDung lượng bộ nhớ: 12Gb GDDR7\r\nSố nhân CUDA : 6144\r\nNguồn đề xuất: 750W', 'Ưu Điểm Nổi Bật Của GeForce RTX™ 5070\r\nSở hữu công nghệ tiên tiến nhất, GeForce RTX™ 5070 mang lại hiệu suất cao nhất thị trường, khả năng tương thích với tất cả các hệ thống máy tính hiện nay và được khách hàng đánh giá cao về độ bền và độ tin cậy.', '2025-04-04 10:55:52', '2025-04-04 10:55:52'),
(16, 16, 'Dung lượng bộ nhớ: 12GB GDDR6\r\nBoost Clock: 1792(MHz)\r\nBăng thông: 192-bit\r\nKết nối: 1x HDMI 2.1, 3x DisplayPort 1.4a\r\nNguồn yêu cầu: 550W', NULL, '2025-04-04 10:57:09', '2025-04-04 10:57:09'),
(17, 17, 'Loại Ram: DDR5\r\nDung Lượng: 32GB (16GBx2)\r\nBus: 6000 Mhz\r\nĐộ Trễ: 36-48-48-96', NULL, '2025-04-04 11:00:35', '2025-04-04 11:00:35'),
(18, 18, 'Loại RAM: Ram PC DDR4\r\nDung lượng: 32GB ( 32)\r\nBus: 3200Mhz\r\nĐộ trễ: CL17-17-17\r\nKích thước: 133.35 x 43 x 8.2mm', NULL, '2025-04-04 11:01:57', '2025-04-04 11:01:57'),
(19, 19, 'Loại RAM: Ram PC DDR4\r\nDung lượng: 16GB (2*8GB)\r\nBus: 3200Mhz\r\nĐộ trễ: CL17-17-17\r\nKích thước: 133.35 x 43 x 8.2mm', NULL, '2025-04-04 11:05:16', '2025-04-04 11:05:16'),
(20, 20, 'Dung lượng: 32GB ( 2x16GB)\r\nChuẩn RAM: DDR5\r\nTốc độ bộ nhớ: 6000 MHz\r\nCAS: CL 40-40-40-77', NULL, '2025-04-04 11:06:36', '2025-04-04 11:06:36'),
(21, 21, 'Ổ cứng SSD chuẩn SATA III\r\nDung lượng: 500GB\r\nTốc độ đọc: 560Mb/s\r\nTốc độ ghi: 530Mb/s', 'Ổ cứng SSD Samsung 870 EVO 500GB SATA III 6Gb/s 2.5 inch là một trong những ổ cứng SSD chuẩn SATA III nhanh nhất và tốt nhất hiện có trên thị trường. \r\n\r\nỔ cứng SSD dành cho mọi nhà\r\nỔ cứng SSD Samsung 870 EVO 500GB SATA III là giải pháp ổ cứng tuyệt vời nhất để nâng cấp cho máy tính để bàn, laptop của bạn.', '2025-04-04 11:08:06', '2025-04-04 11:08:06'),
(22, 22, 'Dung lượng: 480GB\r\nKích thước: 2.5\"\r\nKết nối: SATA 3\r\nTốc độ đọc / ghi (tối đa): 545MB/s', 'Chất lượng đã được kiểm chứng\r\nỔ cứng SSD Western Digital Green Sata III đã vượt qua tất cả các bài test về khả năng tương thích và độ tin cậy, và được chứng nhận bởi WD FIT Labs.\r\n\r\nPhần mềm quản lý WD SSD Dashboard đi kèm\r\nWD SSD Dashborad cung cấp cho bạn một bộ công cụ mạnh mẽ để theo dõi những thứ như hiệu năng, sức khỏe ổ đĩa, cập nhật phiên bản firmware, các thuộc tính SMART, và nhiều hơn nữa.', '2025-04-04 11:09:25', '2025-04-04 11:09:25'),
(23, 23, 'SSD SATA III 6Gbs\r\nTốc độ đọc: 520 Mb/s\r\nTốc độ ghi: 450Mb/s\r\nTương thích tốt với cả laptop và máy tính để bàn', NULL, '2025-04-04 11:10:24', '2025-04-04 11:10:24'),
(24, 24, 'Dung lượng: 1TB\r\nTốc độ đọc ghi: Đọc 5000MB/s Ghi 3900MB/s\r\nGiao diện: NVME Gen 4x4', 'Dung lượng lớn, không gian lưu trữ thoải mái\r\nVới dung lượng lên đến 1TB, KIOXIA EXCERIA PLUS G3 1TB cung cấp đủ không gian cho người dùng lưu trữ hệ điều hành, các ứng dụng yêu thích, game, cũng như các tệp dữ liệu cá nhân mà không lo hết dung lượng. Dung lượng lớn giúp bạn không phải thường xuyên quản lý và xóa bớt các tệp tin, giúp quá trình sử dụng trở nên tiện lợi và hiệu quả hơn.', '2025-04-04 11:12:07', '2025-04-04 11:12:07'),
(25, 25, 'Tương thích các linh kiện BTF\r\nThiết kế độc đáo có thể hoán đổi mặt hông 2 bên cho nhau\r\nTương thích các Mainboard dạng kết nối ở phía sau\r\nPhần mặt trên có thể tháo rời\r\nMặt trước dạng MESH giúp làm mát hiệu quả\r\nĐi kèm 4 quạt tản nhiệt ARGB 140mm', NULL, '2025-04-04 11:13:42', '2025-04-04 11:13:42'),
(26, 26, 'Kích thước siêu rộng với dạng full tower\r\nNhận diện thương hiệu dễ dàng với logo ROG được dập nổi ở mọi nơi\r\nPhù hợp cho Mainboard kích thước E-ATX và VGA độ dài rộng lên tới 460x130mm\r\nHỗ trợ Radiator 420mm x 2\r\nTrang bị 2 cổng type C công suất lên tới 60w\r\nĐi kèm 4 quạt PWM\r\nKhông gian thông thoáng với thiết kế thông minh giúp tản nhiệt hiệu quả\r\nDễ dàng đồng bộ hệ sinh thái led AURA SYNC', NULL, '2025-04-04 11:14:40', '2025-04-04 11:14:40'),
(27, 27, 'Không gian đi dây rộng rãi lên tới 33mm mặt sau\r\nMặt trước dạng lưới đễ dàng tản nhiệt\r\nHỗ trợ AIO 360mm & VGA độ dài 380mm\r\nPhù hợp tản nhiệt khí 165mm\r\nThiết kế dạng mới giúp đi dây từ mặt sau của Mainboard giúp gọn gàng hơn\r\nTương thích Mainboard m-ATX', NULL, '2025-04-04 11:15:33', '2025-04-04 11:15:33'),
(28, 28, 'Kích thước: 235mm (Rộng) * 250mm (Sâu) * 280mm (Cao)\r\nChất liệu: Hợp kim nhôm 2.5mm + Thép 1mm + Gỗ 16mm\r\nKhay ổ đĩa: 1 x 3.5\" HDD hoặc 1 x 2.5\" SSD\r\nLoại bo mạch chủ: ITX\r\nHỗ trợ nguồn PSU: SFX ≤160mm\r\nTrọng lượng tịnh: 4.3kg', NULL, '2025-04-04 11:16:39', '2025-04-04 11:16:39'),
(29, 29, 'Màn hình 27 inch 4K UHD (3840 x 2160) đèn nền LED với tấm nền IPS góc nhìn rộng 178°\r\nTiêu chuẩn màu quốc tế đạt 100% phổ màu sRGB và 100% phổ màu Rec.709\r\nMàn hình đạt chứng nhận Calman Verified nhờ được hiệu chuẩn trước khi xuất xưởng để mang lại độ chính xác màu tuyệt vời Delta E < 2\r\nKết nối mở rộng bao gồm DP qua USB-C™ với 65W Power Delivery, DisplayPort, HDMI, USB 3.0 hub\r\nCông nghệ Adaptive-Sync (40 ~ 60Hz) cho nội dung chuyển động với hành động nhanh và loại bỏ hiện tượng xé hình\r\nCác tính năng ProArt Preset và ProArt Palette độc quyền của ASUS cung cấp nhiều loại thông số màu sắc có thể điều chỉnh\r\nThiết kế tiện dụng với độ nghiêng + 35° ~ -5°, xoay ± 45°, trục xoay ± 90° và điều chỉnh chiều cao 150mm cho trải nghiệm xem thoải mái', NULL, '2025-04-04 11:19:04', '2025-04-04 11:19:04'),
(30, 30, 'Kích thước: 23.8 inch\r\nĐộ phân giải: FHD 1920 x 1080\r\nTấm nền: IPS\r\nTần số quét: 180Hz\r\nThời gian phản hồi: 1ms GtG\r\nĐộ sáng: 300 nits\r\nTỉ lệ tương phản: 1000:1\r\nTương thích ngàm VESA: 100x100mm\r\nCổng kết nối: 1x HDMI, 1x DisplayPort, 1x Audio 3.5mm', NULL, '2025-04-04 11:20:09', '2025-04-04 11:20:09'),
(31, 31, 'Kích thước: 27 inch\r\nĐộ phân giải: FHD 1920 x 1080\r\nCông nghệ tấm nền: IPS\r\nTần số quét: 260Hz\r\nThời gian phản hồi: 0,5ms MPRT/1ms GtG\r\nĐộ sáng: 300 nits\r\nTỉ lệ tương phản: 1000:1\r\nTương thích ngàm VESA: 100 x 100 mm\r\nCổng kết nối: HDMI2.0(HDR) x2, DP1.4(HDR) x1, đầu ra âm thanh', NULL, '2025-04-04 11:20:56', '2025-04-04 11:20:56'),
(32, 32, 'Kích thước: 32 inch\r\nĐộ phân giải: UHD 3840 x 2160\r\nTấm nền: OLED\r\nTần số quét: 240Hz\r\nThời gian phản hồi: 0.03ms\r\nTích hợp loa: 2x 10W\r\nĐộ sáng: 250 nits\r\nTỉ lệ tương phản: 1,000,000:1\r\nTương thích VESA: 100x100mm\r\nOS tích hợp Tizen™\r\nKết nối không dây: Wifi 5 + Bluetooth 5.2\r\nCổng kết nối:\r\n1x USB-B 3.0 / 3.1/3.2 Gen 1\r\n2x USB-A 3.0 / 3.1/3.2 Gen 1\r\n2x HDMI 2.1\r\n1x DisplayPort 1.4\r\nPhụ kiện: dây nguồn, dây HDMI, dây DP', NULL, '2025-04-04 11:21:54', '2025-04-04 11:21:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `yourname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Member') NOT NULL DEFAULT 'Member',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `yourname`, `phone`, `email`, `address`, `password`, `role`, `created_at`, `updated_at`) VALUES
('admin', 'Nguyễn Tiến Tuấn', '0784615786', 'superpowerdn@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '$2y$12$PJ8womo7Ixf9yfPgel9KtuZ/aGYd/qFTp6ya2zXCRGaqt2c8Cktve', 'Admin', '2025-04-02 20:11:52', '2025-04-02 20:11:52'),
('member', 'Robot', '1131131130', 'andanh@gmail.com', 'Hải Phòng, Thanh Khê, Đà Nẵng', '$2y$12$iISPHtwBZt.sZDFy3VU4temwzuR6zNfEhx3sk45fDqJE00tLN/U3C', 'Member', '2025-04-02 20:13:28', '2025-04-08 18:55:58'),
('member123', 'Thành Viên', '0905311540', 'hoangsad002@gmail.com', 'Đà Nẵng', '$2y$12$7EyLkZlJpB/FfJOdRi2cNeXOVBztsjyT55kSb5VkX9OQzEvkx9E2a', 'Member', '2025-04-15 07:22:18', '2025-04-15 07:22:18');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_product_id_foreign` (`product_id`),
  ADD KEY `cart_username_foreign` (`username`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products_details`
--
ALTER TABLE `products_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `products_details`
--
ALTER TABLE `products_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_username_foreign` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products_details`
--
ALTER TABLE `products_details`
  ADD CONSTRAINT `products_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
