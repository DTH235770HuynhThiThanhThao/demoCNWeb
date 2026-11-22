-- ============================================================
-- Shop quản lý cửa hàng điện thoại
-- Đồ án Công nghệ Web PHP
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--
DROP DATABASE IF EXISTS `shop_dienthoai`;
CREATE DATABASE IF NOT EXISTS `shop_dienthoai` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `shop_dienthoai`;

-- --------------------------------------------------------
-- Table: danhmuc
-- --------------------------------------------------------
CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL,
  `tendanhmuc` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `danhmuc` (`id`, `tendanhmuc`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'OPPO'),
(4, 'Xiaomi');

-- --------------------------------------------------------
-- Table: diachi
-- --------------------------------------------------------
CREATE TABLE `diachi` (
  `id` int(11) NOT NULL,
  `nguoidung_id` int(11) NOT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `macdinh` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `diachi` (`id`, `nguoidung_id`, `diachi`, `macdinh`) VALUES
(1, 1, '01 Võ Văn Ngân, Thủ Đức, TP. Hồ Chí Minh', 1),
(2, 2, '123 Đinh Tiên Hoàng, Bình Thạnh, TP. Hồ Chí Minh', 1),
(3, 3, '45 Nguyễn Trãi, Quận 5, TP. Hồ Chí Minh', 1),
(4, 4, '78 Lê Lợi, Quận 1, TP. Hồ Chí Minh', 1),
(5, 5, '22 Phan Xích Long, Phú Nhuận, TP. Hồ Chí Minh', 1);

-- --------------------------------------------------------
-- Table: donhang
-- --------------------------------------------------------
CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `nguoidung_id` int(11) NOT NULL,
  `diachi_id` int(11) DEFAULT NULL,
  `ngay` datetime NOT NULL DEFAULT current_timestamp(),
  `tongtien` float NOT NULL DEFAULT 0,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trangthai` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Chờ xác nhận, 1: Đã duyệt, 2: Đang giao, 3: Hoàn thành, 4: Đã hủy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `donhang` (`id`, `nguoidung_id`, `diachi_id`, `ngay`, `tongtien`, `ghichu`) VALUES
(1, 4, 4, '2024-10-01 09:15:00', 29990000, 'Giao hàng giờ hành chính'),
(2, 4, 4, '2024-10-05 14:30:00', 15990000, NULL),
(3, 5, 5, '2024-10-10 10:00:00', 22990000, 'Gọi trước khi giao'),
(4, 5, 5, '2024-10-15 16:45:00', 5990000,  NULL),
(5, 4, 4, '2024-10-20 08:30:00', 36990000, 'Hàng dễ vỡ, đóng gói cẩn thận'),
(6, 5, 5, '2024-10-25 13:00:00', 4590000,  NULL),
(7, 4, 4, '2024-11-01 11:20:00', 17990000, NULL);

-- --------------------------------------------------------
-- Table: donhangct
-- --------------------------------------------------------
CREATE TABLE `donhangct` (
  `id` int(11) NOT NULL,
  `donhang_id` int(11) NOT NULL,
  `mathang_id` int(11) NOT NULL,
  `dongia` float NOT NULL DEFAULT 0,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `thanhtien` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `donhangct` (`id`, `donhang_id`, `mathang_id`, `dongia`, `soluong`, `thanhtien`) VALUES
(1, 1, 1,  29990000, 1, 29990000),
(2, 2, 11, 15990000, 1, 15990000),
(3, 3, 2,  22990000, 1, 22990000),
(4, 4, 38, 5990000,  1, 5990000),
(5, 5, 7,  36990000, 1, 36990000),
(6, 6, 39, 4590000,  1, 4590000),
(7, 7, 21, 17990000, 1, 17990000);

-- --------------------------------------------------------
-- Table: mathang
-- --------------------------------------------------------
CREATE TABLE `mathang` (
  `id` int(11) NOT NULL,
  `tenmathang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mota` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `giagoc` float NOT NULL DEFAULT 0,
  `giaban` float NOT NULL DEFAULT 0,
  `soluongton` int(11) NOT NULL DEFAULT 0,
  `hinhanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phienban` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mausac` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuvienanh` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `danhmuc_id` int(11) NOT NULL,
  `luotxem` int(11) NOT NULL DEFAULT 0,
  `luotmua` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `mathang` (`id`, `tenmathang`, `mota`, `giagoc`, `giaban`, `soluongton`, `hinhanh`, `danhmuc_id`, `luotxem`, `luotmua`) VALUES

-- ===== APPLE (danhmuc_id = 1) =====
(1,  'iPhone 18 Pro 256GB',
 '<p><strong>Màn hình:</strong> 6.3 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A19 Pro, 3nm thế hệ 2</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 5x | Trước 12MP</p><p><strong>Pin:</strong> 3.800 mAh, sạc 25W, MagSafe 25W</p>',
 32990000, 29990000, 15, 'images/products/a1.jpg', 1, 320, 12),

(2,  'iPhone 17 Pro Max 256GB',
 '<p><strong>Màn hình:</strong> 6.9 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A18 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 5x | Trước 24MP</p><p><strong>Pin:</strong> 4.685 mAh, sạc 30W, MagSafe 25W</p>',
 26990000, 22990000, 20, 'images/products/a2.jpg', 1, 580, 25),

(3,  'iPhone 16 Pro Max 256GB',
 '<p><strong>Màn hình:</strong> 6.9 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A18 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP Fusion + 48MP UltraWide + 12MP tele 5x | Trước 12MP</p><p><strong>Pin:</strong> 4.685 mAh, sạc 27W, MagSafe 25W</p>',
 32990000, 28990000, 18, 'images/products/a3.jpg', 1, 740, 38),

(4,  'iPhone 15 Pro Max 256GB Titan Xanh',
 '<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A17 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 5x | Trước 12MP</p><p><strong>Pin:</strong> 4.422 mAh, sạc 27W, MagSafe 15W</p>',
 34990000, 26990000, 25, 'images/products/a4.jpg', 1, 1200, 65),

(5,  'iPhone 15 Pro Max 512GB Titan Trắng',
 '<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A17 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 512GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 5x | Trước 12MP</p><p><strong>Pin:</strong> 4.422 mAh, sạc 27W, MagSafe 15W</p>',
 42990000, 36990000, 12, 'images/products/a5.jpg', 1, 890, 32),

(6,  'iPhone 15 Pro 256GB Titan Tự Nhiên',
 '<p><strong>Màn hình:</strong> 6.1 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A17 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 3x | Trước 12MP</p><p><strong>Pin:</strong> 3.274 mAh, sạc 27W, MagSafe 15W</p>',
 29990000, 23990000, 22, 'images/products/a6.jpg', 1, 760, 44),

(7,  'iPhone 15 Plus 128GB Xanh Dương',
 '<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 60Hz</p><p><strong>Chip:</strong> Apple A16 Bionic, 4nm</p><p><strong>RAM/ROM:</strong> 6GB / 128GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide | Trước 12MP</p><p><strong>Pin:</strong> 4.383 mAh, sạc 20W, MagSafe 15W</p>',
 26990000, 20990000, 30, 'images/products/a7.jpg', 1, 650, 38),

(8,  'iPhone 14 Pro Max 256GB Tím',
 '<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 120Hz ProMotion, Dynamic Island</p><p><strong>Chip:</strong> Apple A16 Bionic, 4nm</p><p><strong>RAM/ROM:</strong> 6GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 3x | Trước 12MP</p><p><strong>Pin:</strong> 4.323 mAh, sạc 27W, MagSafe 15W</p>',
 32990000, 24990000, 18, 'images/products/a8.jpg', 1, 980, 55),

(9,  'iPhone 14 Plus 128GB Xanh',
 '<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 60Hz</p><p><strong>Chip:</strong> Apple A15 Bionic, 5nm</p><p><strong>RAM/ROM:</strong> 6GB / 128GB</p><p><strong>Camera:</strong> 12MP chính + 12MP UltraWide | Trước 12MP</p><p><strong>Pin:</strong> 4.325 mAh, sạc 20W, MagSafe 15W</p>',
 26990000, 18990000, 25, 'images/products/a9.jpg', 1, 720, 42),

(10, 'iPhone 14 128GB Tím',
 '<p><strong>Màn hình:</strong> 6.1 inch Super Retina XDR OLED, 60Hz</p><p><strong>Chip:</strong> Apple A15 Bionic, 5nm</p><p><strong>RAM/ROM:</strong> 6GB / 128GB</p><p><strong>Camera:</strong> 12MP chính + 12MP UltraWide | Trước 12MP TrueDepth</p><p><strong>Pin:</strong> 3.279 mAh, sạc 20W, MagSafe 15W</p>',
 22990000, 16990000, 35, 'images/products/a10.jpg', 1, 1050, 68),

-- ===== SAMSUNG (danhmuc_id = 2) =====
(11, 'Samsung Galaxy S23 Ultra 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.8 inch Dynamic AMOLED 2X, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 200MP + 12MP UW + 10MP tele 3x + 10MP tele 10x | Trước 12MP, kèm S Pen</p><p><strong>Pin:</strong> 5.000 mAh, sạc 45W</p>',
 18990000, 15990000, 20, 'images/products/s1.jpg', 2, 850, 42),

(12, 'Samsung Galaxy Z Fold5 5G 256GB',
 '<p><strong>Màn hình:</strong> 7.6 inch Dynamic AMOLED 2X gập + 6.2 inch cover, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP + 12MP UW + 10MP tele 3x | Cover 10MP + Trong 4MP</p><p><strong>Pin:</strong> 4.400 mAh, sạc 25W</p>',
 42990000, 36990000, 10, 'images/products/s2.jpg', 2, 430, 15),

(13, 'Samsung Galaxy Z Flip5 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.7 inch Dynamic AMOLED 2X gập + 3.4 inch Flex Window, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 12MP chính + 12MP UltraWide | Trước 10MP</p><p><strong>Pin:</strong> 3.700 mAh, sạc 25W</p>',
 24990000, 19990000, 15, 'images/products/s3.jpg', 2, 620, 28),

(14, 'Samsung Galaxy S23+ 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.6 inch Dynamic AMOLED 2X, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 12MP UW + 10MP tele 3x | Trước 12MP</p><p><strong>Pin:</strong> 4.700 mAh, sạc 45W</p>',
 16990000, 14490000, 18, 'images/products/s4.jpg', 2, 540, 26),

(15, 'Samsung Galaxy S23 5G 128GB',
 '<p><strong>Màn hình:</strong> 6.1 inch Dynamic AMOLED 2X, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 50MP chính + 12MB UW + 10MP tele 3x | Trước 12MP</p><p><strong>Pin:</strong> 3.900 mAh, sạc 25W</p>',
 13990000, 11990000, 25, 'images/products/s5.jpg', 2, 760, 48),

(16, 'Samsung Galaxy S23 FE 5G 128GB',
 '<p><strong>Màn hình:</strong> 6.4 inch Dynamic AMOLED 2X, 120Hz</p><p><strong>Chip:</strong> Exynos 2200</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 50MP chính + 12MP UW + 8MP tele 3x | Trước 10MP</p><p><strong>Pin:</strong> 4.500 mAh, sạc 25W</p>',
 14990000, 10990000, 28, 'images/products/s6.jpg', 2, 680, 55),

(17, 'Samsung Galaxy S22 Ultra 5G 128GB',
 '<p><strong>Màn hình:</strong> 6.8 inch Dynamic AMOLED 2X, 120Hz, Dynamic Island</p><p><strong>Chip:</strong> Snapdragon 8 Gen 1</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 108MP + 12MP UW + 10MP tele 3x + 10MP tele 10x | Trước 40MP, kèm S Pen</p><p><strong>Pin:</strong> 5.000 mAh, sạc 45W</p>',
 24990000, 17990000, 15, 'images/products/s7.jpg', 2, 920, 62),

(18, 'Samsung Galaxy Z Fold4 5G 256GB',
 '<p><strong>Màn hình:</strong> 7.6 inch Dynamic AMOLED 2X gập + 6.2 inch cover, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8+ Gen 1</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP + 12MP UW + 10MP tele 3x | Cover 10MP + Trong 4MP</p><p><strong>Pin:</strong> 4.400 mAh, sạc 25W</p>',
 32990000, 24990000, 12, 'images/products/s8.jpg', 2, 490, 18),

(19, 'Samsung Galaxy A54 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.4 inch Super AMOLED, 120Hz</p><p><strong>Chip:</strong> Exynos 1380</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 12MP UW + 5MP macro | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 25W</p>',
 12990000, 9990000, 35, 'images/products/s9.jpg', 2, 870, 68),

(20, 'Samsung Galaxy A34 5G 128GB',
 '<p><strong>Màn hình:</strong> 6.6 inch Super AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 1080</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 48MP chính + 8MP UW + 5MP macro | Trước 13MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 25W</p>',
 9990000, 7990000, 40, 'images/products/s10.jpg', 2, 980, 82),

-- ===== OPPO (danhmuc_id = 3) =====
(21, 'OPPO Find N2 Flip 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.8 inch AMOLED gập + 3.26 inch ngoài, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 9000+</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW | Trước 32MP</p><p><strong>Pin:</strong> 4.300 mAh, sạc SUPERVOOC 44W</p>',
 20990000, 17990000, 12, 'images/products/o1.jpg', 3, 510, 20),

(22, 'OPPO Find X5 Pro 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.7 inch AMOLED, 120Hz, Hasselblad</p><p><strong>Chip:</strong> Snapdragon 8 Gen 1</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 50MB UW + 13MP tele 2x | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 80W + AirVOOC 50W</p>',
 24990000, 19990000, 10, 'images/products/o2.jpg', 3, 420, 16),

(23, 'OPPO Reno10 Pro+ 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.74 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8+ Gen 1</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 32MP tele + 8MP UW | Trước 32MP</p><p><strong>Pin:</strong> 4.700 mAh, sạc SUPERVOOC 100W</p>',
 20990000, 17990000, 18, 'images/products/o3.jpg', 3, 390, 18),

(24, 'OPPO Reno10 Pro 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.74 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 778G 5G</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 32MP tele + 8MP UW | Trước 32MP</p><p><strong>Pin:</strong> 4.600 mAh, sạc SUPERVOOC 80W</p>',
 16990000, 13990000, 20, 'images/products/o4.jpg', 3, 460, 30),

(25, 'OPPO Reno10 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.74 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 7050</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 64MP chính + 32MP tele + 8MP UW | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 67W</p>',
 12990000, 10990000, 28, 'images/products/o5.jpg', 3, 530, 36),

(26, 'OPPO Reno8 Pro 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.7 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 8100 Max</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW + 2MP macro | Trước 32MP</p><p><strong>Pin:</strong> 4.500 mAh, sạc SUPERVOOC 80W</p>',
 14990000, 11990000, 22, 'images/products/o6.jpg', 3, 440, 28),

(27, 'OPPO Reno8 T 5G 128GB',
 '<p><strong>Màn hình:</strong> 6.7 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 695 5G</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 108MP chính + 2MP macro + 2MP độ sâu | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 67W</p>',
 10990000, 8490000, 30, 'images/products/o7.jpg', 3, 580, 42),

(28, 'OPPO A98 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.72 inch IPS LCD, 120Hz</p><p><strong>Chip:</strong> Snapdragon 695 5G</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 64MP chính + 2MP macro + 2MP độ sâu | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 67W</p>',
 9990000, 7990000, 35, 'images/products/o8.jpg', 3, 620, 48),

(29, 'OPPO A78 256GB',
 '<p><strong>Màn hình:</strong> 6.43 inch AMOLED, 90Hz</p><p><strong>Chip:</strong> Snapdragon 680</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 2MP độ sâu | Trước 8MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 67W</p>',
 7990000, 5990000, 42, 'images/products/o9.jpg', 3, 710, 60),

(30, 'OPPO A58 128GB',
 '<p><strong>Màn hình:</strong> 6.72 inch IPS LCD, 90Hz</p><p><strong>Chip:</strong> MediaTek Helio G85</p><p><strong>RAM/ROM:</strong> 6GB / 128GB</p><p><strong>Camera:</strong> 50MP chính + 2MP độ sâu | Trước 8MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 33W</p>',
 5990000, 4290000, 50, 'images/products/o10.jpg', 3, 830, 72),

-- ===== XIAOMI (danhmuc_id = 4) =====
(31, 'Xiaomi 13T 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.67 inch AMOLED, 144Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 8200 Ultra</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 12MP UW + 50MP tele 2.7x (Leica) | Trước 20MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 67W</p>',
 13990000, 11990000, 22, 'images/products/x1.jpg', 4, 480, 27),

(32, 'Xiaomi 13 Lite 5G 256GB',
 '<p><strong>Màn hình:</strong> 6.55 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 7 Gen 1</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW + 2MP macro | Trước 32MP + 8MP UW</p><p><strong>Pin:</strong> 4.500 mAh, sạc nhanh 67W</p>',
 10990000, 8990000, 28, 'images/products/x2.jpg', 4, 390, 22),

(33, 'Xiaomi Redmi Note 12 Pro 5G 256GB Tím',
 '<p><strong>Màn hình:</strong> 6.67 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 1080</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 200MP chính + 8MP UW + 2MP macro | Trước 16MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 67W</p>',
 9990000, 7490000, 35, 'images/products/x3.jpg', 4, 820, 65),

(34, 'Xiaomi Redmi Note 12 Pro 5G 128GB Xanh',
 '<p><strong>Màn hình:</strong> 6.67 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 1080</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 200MP chính + 8MP UW + 2MP macro | Trước 16MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 67W</p>',
 8990000, 6490000, 40, 'images/products/x4.jpg', 4, 750, 58),

(35, 'Xiaomi Redmi Note 12S 256GB',
 '<p><strong>Màn hình:</strong> 6.43 inch AMOLED, 90Hz</p><p><strong>Chip:</strong> MediaTek Helio G96</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 108MP chính + 8MP UW + 2MP macro | Trước 16MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 33W</p>',
 6990000, 5490000, 45, 'images/products/x5.jpg', 4, 680, 50),

(36, 'Xiaomi Redmi Note 12 256GB',
 '<p><strong>Màn hình:</strong> 6.67 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 4 Gen 1</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW + 2MP macro | Trước 13MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 33W</p>',
 5990000, 4590000, 55, 'images/products/x6.jpg', 4, 950, 88),

(37, 'Xiaomi Redmi 12 Pro 4G 256GB',
 '<p><strong>Màn hình:</strong> 6.67 inch IPS LCD, 90Hz</p><p><strong>Chip:</strong> MediaTek Helio G99</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW + 2MP macro | Trước 16MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 33W</p>',
 5490000, 4190000, 50, 'images/products/x7.jpg', 4, 580, 44),

(38, 'Xiaomi Redmi 12 128GB',
 '<p><strong>Màn hình:</strong> 6.79 inch IPS LCD, 90Hz</p><p><strong>Chip:</strong> MediaTek Helio G88</p><p><strong>RAM/ROM:</strong> 4GB / 128GB</p><p><strong>Camera:</strong> 50MP chính + 8MB UW + 2MP macro | Trước 8MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 18W</p>',
 4490000, 3290000, 60, 'images/products/x8.jpg', 4, 1100, 95),

(39, 'Xiaomi Redmi 12C 64GB',
 '<p><strong>Màn hình:</strong> 6.71 inch IPS LCD, 60Hz</p><p><strong>Chip:</strong> MediaTek Helio G85</p><p><strong>RAM/ROM:</strong> 3GB / 64GB</p><p><strong>Camera:</strong> 50MP chính + 2MP độ sâu | Trước 5MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 10W</p>',
 3490000, 2490000, 70, 'images/products/x9.jpg', 4, 1250, 110),

(40, 'Xiaomi Redmi A2 32GB',
 '<p><strong>Màn hình:</strong> 6.52 inch IPS LCD, 60Hz</p><p><strong>Chip:</strong> MediaTek Helio G36</p><p><strong>RAM/ROM:</strong> 2GB / 32GB</p><p><strong>Camera:</strong> 8MP chính + 0.08MP AI | Trước 5MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 10W</p>',
 2490000, 1790000, 80, 'images/products/x10.jpg', 4, 1400, 130);

-- Cập nhật dữ liệu mẫu về Phiên bản (dung lượng), Màu sắc và Thư viện ảnh màu cho các dòng máy nổi bật
UPDATE `mathang` SET `phienban` = '128GB, 256GB, 512GB, 1TB', `mausac` = 'Titan Sa Mạc, Titan Tự Nhiên, Titan Đen, Titan Trắng', `thuvienanh` = 'a1.jpg, a2.jpg, a3.jpg, a4.jpg' WHERE `id` = 1;
UPDATE `mathang` SET `phienban` = '256GB, 512GB, 1TB', `mausac` = 'Titan Tự Nhiên, Titan Xanh, Titan Đen', `thuvienanh` = 'a2.jpg, a3.jpg, a4.jpg' WHERE `id` = 2;
UPDATE `mathang` SET `phienban` = '256GB, 512GB, 1TB', `mausac` = 'Titan Sa Mạc, Titan Tự Nhiên, Titan Trắng, Titan Đen', `thuvienanh` = 'a3.jpg, a1.jpg, a5.jpg, a6.jpg' WHERE `id` = 3;
UPDATE `mathang` SET `phienban` = '256GB, 512GB, 1TB', `mausac` = 'Titan Xanh, Titan Tự Nhiên, Titan Trắng', `thuvienanh` = 'a4.jpg, a6.jpg, a5.jpg' WHERE `id` = 4;
UPDATE `mathang` SET `phienban` = '256GB, 512GB, 1TB', `mausac` = 'Titan Trắng, Titan Xanh, Titan Tự Nhiên', `thuvienanh` = 'a5.jpg, a4.jpg, a6.jpg' WHERE `id` = 5;
UPDATE `mathang` SET `phienban` = '128GB, 256GB, 512GB', `mausac` = 'Titan Tự Nhiên, Titan Xanh, Titan Đen, Titan Trắng', `thuvienanh` = 'a6.jpg, a4.jpg, a1.jpg, a5.jpg' WHERE `id` = 6;
UPDATE `mathang` SET `phienban` = '128GB, 256GB, 512GB', `mausac` = 'Xanh Dương, Hồng, Vàng, Đen', `thuvienanh` = 'a7.jpg, a8.jpg, a9.jpg, a10.jpg' WHERE `id` = 7;
UPDATE `mathang` SET `phienban` = '128GB, 256GB, 512GB, 1TB', `mausac` = 'Tím Deep Purple, Vàng Gold, Bạc Silver, Đen Space Black', `thuvienanh` = 'a8.jpg, a9.jpg, a10.jpg, a1.jpg' WHERE `id` = 8;
UPDATE `mathang` SET `phienban` = '256GB, 512GB', `mausac` = 'Xanh Botanic, Đen Phantom, Kem Cotton, Tím Lilac', `thuvienanh` = 's1.jpg, s2.jpg, s3.jpg, s4.jpg' WHERE `id` = 11;
UPDATE `mathang` SET `phienban` = '256GB, 512GB, 1TB', `mausac` = 'Xanh Icy, Đen Phantom, Kem Ivory', `thuvienanh` = 's2.jpg, s1.jpg, s3.jpg' WHERE `id` = 12;
UPDATE `mathang` SET `phienban` = '256GB, 512GB', `mausac` = 'Xanh Mint, Tím Fancy, Xám Indie, Kem Latte', `thuvienanh` = 's3.jpg, s4.jpg, s5.jpg, s6.jpg' WHERE `id` = 13;
UPDATE `mathang` SET `phienban` = '256GB, 512GB', `mausac` = 'Xanh Botanic, Kem Cotton, Đen Phantom', `thuvienanh` = 's4.jpg, s5.jpg, s1.jpg' WHERE `id` = 14;
UPDATE `mathang` SET `phienban` = '256GB', `mausac` = 'Tím Ánh Sao, Đen Khói', `thuvienanh` = 'o1.jpg, o2.jpg' WHERE `id` = 21;
UPDATE `mathang` SET `phienban` = '256GB, 512GB', `mausac` = 'Trắng Gốm, Đen Men', `thuvienanh` = 'o2.jpg, o1.jpg' WHERE `id` = 22;
UPDATE `mathang` SET `phienban` = '256GB', `mausac` = 'Tím Thạch Anh, Xám Ánh Trăng', `thuvienanh` = 'o3.jpg, o4.jpg' WHERE `id` = 23;
UPDATE `mathang` SET `phienban` = '128GB, 256GB', `mausac` = 'Xanh Tuyết Sơn, Đen Cổ Điển, Xanh Đồng Cỏ', `thuvienanh` = 'x1.jpg, x2.jpg, x3.jpg' WHERE `id` = 31;
UPDATE `mathang` SET `phienban` = '128GB, 256GB', `mausac` = 'Hồng Lite, Xanh Lite, Đen Lite', `thuvienanh` = 'x2.jpg, x1.jpg, x3.jpg' WHERE `id` = 32;
UPDATE `mathang` SET `phienban` = '128GB, 256GB', `mausac` = 'Tím Ánh Sao, Xanh Bầu Trời, Đen Nửa Đêm', `thuvienanh` = 'x3.jpg, x4.jpg, x5.jpg' WHERE `id` = 33;

-- --------------------------------------------------------
-- Table: nguoidung
-- --------------------------------------------------------
CREATE TABLE `nguoidung` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sodienthoai` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `matkhau` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hoten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loai` tinyint(4) NOT NULL DEFAULT 3,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  `hinhanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Mật khẩu tất cả tài khoản mặc định: 'abc123' => md5 = 'e99a18c428cb38d5f260853678922e03'
INSERT INTO `nguoidung` (`id`, `email`, `sodienthoai`, `matkhau`, `hoten`, `loai`, `trangthai`, `hinhanh`) VALUES
(1, 'admin@shop.com',     '0901234567', 'e99a18c428cb38d5f260853678922e03', 'Nguyễn Quản Trị',   1, 1, NULL),
(2, 'nv1@shop.com',       '0912345678', 'e99a18c428cb38d5f260853678922e03', 'Trần Nhân Viên',    2, 1, NULL),
(3, 'nv2@shop.com',       '0923456789', 'e99a18c428cb38d5f260853678922e03', 'Lê Thị Nhân Viên',  2, 1, NULL),
(4, 'kh1@gmail.com',      '0934567890', 'e99a18c428cb38d5f260853678922e03', 'Nguyễn Thị Thu An', 3, 1, NULL),
(5, 'kh2@gmail.com',      '0945678901', 'e99a18c428cb38d5f260853678922e03', 'Hồ Xuân Minh',      3, 1, NULL),
(6, 'admin_duc@shop.com', '0988888888', 'e99a18c428cb38d5f260853678922e03', 'Admin Đức',         1, 1, NULL);

-- --------------------------------------------------------
-- Indexes
-- --------------------------------------------------------
ALTER TABLE `danhmuc`   ADD PRIMARY KEY (`id`);
ALTER TABLE `diachi`    ADD PRIMARY KEY (`id`), ADD KEY `nguoidung_id` (`nguoidung_id`);
ALTER TABLE `donhang`   ADD PRIMARY KEY (`id`), ADD KEY `nguoidung_id` (`nguoidung_id`), ADD KEY `diachi_id` (`diachi_id`);
ALTER TABLE `donhangct` ADD PRIMARY KEY (`id`), ADD KEY `donhang_id` (`donhang_id`), ADD KEY `mathang_id` (`mathang_id`);
ALTER TABLE `mathang`   ADD PRIMARY KEY (`id`), ADD KEY `danhmuc_id` (`danhmuc_id`);
ALTER TABLE `nguoidung` ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
-- AUTO_INCREMENT
-- --------------------------------------------------------
ALTER TABLE `danhmuc`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `diachi`    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `donhang`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
ALTER TABLE `donhangct` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
ALTER TABLE `mathang`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
ALTER TABLE `nguoidung` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- --------------------------------------------------------
-- Foreign Keys
-- --------------------------------------------------------
ALTER TABLE `diachi`
  ADD CONSTRAINT `diachi_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON UPDATE CASCADE;

ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON UPDATE CASCADE;

ALTER TABLE `donhangct`
  ADD CONSTRAINT `donhangct_ibfk_1` FOREIGN KEY (`donhang_id`) REFERENCES `donhang` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `donhangct_ibfk_2` FOREIGN KEY (`mathang_id`) REFERENCES `mathang` (`id`) ON UPDATE CASCADE;

ALTER TABLE `mathang`
  ADD CONSTRAINT `mathang_ibfk_1` FOREIGN KEY (`danhmuc_id`) REFERENCES `danhmuc` (`id`) ON UPDATE CASCADE;

-- --------------------------------------------------------
-- Table: giohang
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `giohang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoidung_id` int(11) NOT NULL,
  `mathang_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_nguoidung_mathang` (`nguoidung_id`, `mathang_id`),
  KEY `mathang_id` (`mathang_id`),
  CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`mathang_id`) REFERENCES `mathang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
-- Table: phieunhap
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `phieunhap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoidung_id` int(11) NOT NULL,
  `nhacungcap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngaynhap` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tongtien` decimal(15,0) NOT NULL DEFAULT 0,
  `ghichu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nguoidung_id` (`nguoidung_id`),
  CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `phieunhap` (`id`, `nguoidung_id`, `nhacungcap`, `ngaynhap`, `tongtien`, `ghichu`) VALUES
(1, 1, 'Apple Việt Nam Chính Hãng', '2024-11-10 09:30:00', 396000000, 'Nhập lô hàng iPhone thế hệ mới đợt 1'),
(2, 2, 'Samsung Electronics Vina', '2024-11-15 14:15:00', 214000000, 'Bổ sung Galaxy S23 Ultra và Z Flip5'),
(3, 1, 'Nhà phân phối Digiworld (DGW)', '2024-11-18 10:00:00', 145000000, 'Lô máy Xiaomi và OPPO đợt cuối năm');

-- --------------------------------------------------------
-- Table: phieunhapct
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `phieunhapct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phieunhap_id` int(11) NOT NULL,
  `mathang_id` int(11) NOT NULL,
  `gianhap` decimal(15,0) NOT NULL,
  `soluong` int(11) NOT NULL,
  `thanhtien` decimal(15,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phieunhap_id` (`phieunhap_id`),
  KEY `mathang_id` (`mathang_id`),
  CONSTRAINT `phieunhapct_ibfk_1` FOREIGN KEY (`phieunhap_id`) REFERENCES `phieunhap` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `phieunhapct_ibfk_2` FOREIGN KEY (`mathang_id`) REFERENCES `mathang` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `phieunhapct` (`id`, `phieunhap_id`, `mathang_id`, `gianhap`, `soluong`, `thanhtien`) VALUES
(1, 1, 1, 26000000, 8, 208000000),
(2, 1, 3, 23500000, 8, 188000000),
(3, 2, 11, 13500000, 10, 135000000),
(4, 2, 13, 15800000, 5, 79000000),
(5, 3, 21, 14500000, 6, 87000000),
(6, 3, 31, 9666667, 6, 58000000);

-- --------------------------------------------------------
-- Table: thongtin
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `thongtin` (
  `id` int(11) NOT NULL DEFAULT 1,
  `tencuahang` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Thanh Thảo Shop',
  `slogan` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Thu cũ đổi mới trợ giá đến 2 triệu • Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng',
  `sodienthoai` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '076 3841190',
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'thanhthaoshop@gmail.com',
  `diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '18 Ung Văn Khiêm, phường Đông Xuyên, TP Long Xuyên, An Giang',
  `giomocua` varchar(150) COLLATE utf8_unicode_ci DEFAULT '08:00 - 21:30 (Tất cả các ngày trong tuần)',
  `gioithieu` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `thongtin` (`id`, `tencuahang`, `slogan`, `sodienthoai`, `email`, `diachi`, `giomocua`, `gioithieu`) VALUES
(1, 'Thanh Thảo Shop', 'Thu cũ đổi mới trợ giá đến 2 triệu • Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng', '076 3841190', 'thanhthaoshop@gmail.com', '18 Ung Văn Khiêm, phường Đông Xuyên, TP Long Xuyên, An Giang', '08:00 - 21:30 (Tất cả các ngày trong tuần)', 'Thanh Thảo Shop là hệ thống bán lẻ điện thoại di động chính hãng uy tín, chuyên cung cấp các dòng smartphone mới nhất từ 4 thương hiệu hàng đầu: Apple, Samsung, OPPO và Xiaomi với mức giá cạnh tranh cùng dịch vụ hậu mãi tận tâm.');

-- --------------------------------------------------------
-- Table: hinhanh
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `hinhanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duongdan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loai` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `thutu` int(11) NOT NULL DEFAULT 1,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `hinhanh` (`id`, `tieude`, `duongdan`, `loai`, `thutu`, `trangthai`) VALUES
(1, 'Logo chính Thanh Thảo Shop', 'logo1.jpg', 'logo', 1, 1),
(2, 'Siêu phẩm công nghệ mới - Đặt trước ngay', 'h4.jpg', 'banner_chinh', 1, 1),
(3, 'Lễ hội mua sắm giảm sốc đến 50%', 'h5.jpg', 'banner_chinh', 2, 1),
(4, 'Ưu đãi trả góp 0% lãi suất - Thủ tục nhanh', 'h6.jpg', 'banner_chinh', 3, 1),
(5, 'Thu cũ đổi mới trợ giá cực khủng', 'h7.jpg', 'banner_chinh', 4, 1),
(6, 'Điện thoại chính hãng bảo hành 12 tháng', 'h1.jpg', 'banner_phu', 1, 1),
(7, 'Siêu ưu đãi công nghệ - Mua là có quà', 'h2.jpg', 'banner_phu', 2, 1),
(8, 'Thanh Thảo Shop Flagship Store', 'h3.jpg', 'banner_phu', 3, 1);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
