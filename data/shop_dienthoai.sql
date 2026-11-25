-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: shop_dienthoai
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `shop_dienthoai`
--

/*!40000 DROP DATABASE IF EXISTS `shop_dienthoai`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `shop_dienthoai` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `shop_dienthoai`;

--
-- Table structure for table `baohanh`
--

DROP TABLE IF EXISTS `baohanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baohanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donhang_id` int(11) DEFAULT NULL,
  `mathang_id` int(11) NOT NULL,
  `tenkhachhang` varchar(150) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `soimei` varchar(50) DEFAULT NULL,
  `ngaymua` date DEFAULT NULL,
  `hanbaohanh` date DEFAULT NULL,
  `tinhtrangloi` text NOT NULL,
  `ngaytiepnhan` datetime NOT NULL DEFAULT current_timestamp(),
  `trangthai` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Tiếp nhận kiểm tra, 1: Đang sửa chữa / Gửi hãng, 2: Đã sửa xong - Chờ trả khách, 3: Đã bàn giao khách, 4: Từ chối bảo hành / Hết hạn',
  `ghichu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mathang_id` (`mathang_id`),
  KEY `donhang_id` (`donhang_id`),
  CONSTRAINT `baohanh_ibfk_1` FOREIGN KEY (`mathang_id`) REFERENCES `mathang` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baohanh`
--

LOCK TABLES `baohanh` WRITE;
/*!40000 ALTER TABLE `baohanh` DISABLE KEYS */;
INSERT INTO `baohanh` VALUES (1,1,1,'Nguyễn Thị Thu An','0934567890','352938101234567','2024-10-01','2025-10-01','Màn hình bị sọc ngang, pin chai nhanh hết','2026-11-01 09:00:00',1,'Đã liên hệ Apple Service, chờ linh kiện'),(2,NULL,11,'Trần Văn Bình','0912233445','358921076543210','2025-05-15','2026-05-15','Loa ngoài phát ra tiếng rè, mic đàm thoại mờ','2026-11-10 14:30:00',2,'Đã thay loa và micro, chờ khách đến nhận'),(3,3,2,'Hồ Xuân Minh','0945678901',NULL,'2024-10-10','2025-10-10','Máy không nhận sạc, cổng Lightning bị lỏng','2026-11-15 10:15:00',0,NULL),(4,NULL,38,'Lê Thị Lan','0977888999','860456321098765','2025-08-20','2026-08-20','Màn hình cảm ứng mất một góc, không phản hồi','2026-11-18 16:00:00',3,'Đã thay màn hình, bàn giao 19/11/2026'),(5,NULL,21,'Phạm Quốc Dũng','0966554433',NULL,'2024-02-10','2025-02-10','Pin phồng, máy tắt đột ngột khi dùng','2026-11-20 08:30:00',4,'Hết hạn bảo hành, đề nghị khách trả chi phí sửa chữa');
/*!40000 ALTER TABLE `baohanh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danhgia`
--

DROP TABLE IF EXISTS `danhgia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `danhgia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mathang_id` int(11) NOT NULL,
  `nguoidung_id` int(11) NOT NULL,
  `donhang_id` int(11) NOT NULL,
  `sosao` tinyint(4) NOT NULL,
  `noidung` text NOT NULL,
  `ngaydanhgia` datetime NOT NULL DEFAULT current_timestamp(),
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `mathang_id` (`mathang_id`),
  KEY `nguoidung_id` (`nguoidung_id`),
  KEY `donhang_id` (`donhang_id`),
  CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`mathang_id`) REFERENCES `mathang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `danhgia_ibfk_2` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `danhgia_ibfk_3` FOREIGN KEY (`donhang_id`) REFERENCES `donhang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danhgia`
--

LOCK TABLES `danhgia` WRITE;
/*!40000 ALTER TABLE `danhgia` DISABLE KEYS */;
INSERT INTO `danhgia` VALUES (1,1,4,1,5,'Máy đẹp xuất sắc, màu Titan Sa Mạc bên ngoài sang hơn trong ảnh nhiều. Màn hình 120Hz siêu mượt, pin trâu dùng cả ngày không hết. Đóng gói rất kỹ càng, giao hàng nhanh 2h đúng hẹn!','2024-10-02 15:30:00',1),(2,2,5,3,5,'Sản phẩm chính hãng VN/A nguyên seal, kích hoạt bảo hành chuẩn 12 tháng tại Thảo Mobile. Rất hài lòng về chất lượng dịch vụ và tư vấn nhiệt tình.','2024-10-12 11:15:00',1);
/*!40000 ALTER TABLE `danhgia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danhmuc`
--

DROP TABLE IF EXISTS `danhmuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tendanhmuc` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danhmuc`
--

LOCK TABLES `danhmuc` WRITE;
/*!40000 ALTER TABLE `danhmuc` DISABLE KEYS */;
INSERT INTO `danhmuc` VALUES (1,'Apple'),(2,'Samsung'),(3,'OPPO'),(4,'Xiaomi');
/*!40000 ALTER TABLE `danhmuc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diachi`
--

DROP TABLE IF EXISTS `diachi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diachi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoidung_id` int(11) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `macdinh` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `nguoidung_id` (`nguoidung_id`),
  CONSTRAINT `diachi_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diachi`
--

LOCK TABLES `diachi` WRITE;
/*!40000 ALTER TABLE `diachi` DISABLE KEYS */;
INSERT INTO `diachi` VALUES (1,1,'01 Võ Văn Ngân, Thủ Đức, TP. Hồ Chí Minh',1),(2,2,'123 Đinh Tiên Hoàng, Bình Thạnh, TP. Hồ Chí Minh',1),(3,3,'45 Nguyễn Trãi, Quận 5, TP. Hồ Chí Minh',1),(4,4,'78 Lê Lợi, Quận 1, TP. Hồ Chí Minh',1),(5,5,'22 Phan Xích Long, Phú Nhuận, TP. Hồ Chí Minh',1);
/*!40000 ALTER TABLE `diachi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donhang`
--

DROP TABLE IF EXISTS `donhang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donhang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoidung_id` int(11) NOT NULL,
  `diachi_id` int(11) DEFAULT NULL,
  `ngay` datetime NOT NULL DEFAULT current_timestamp(),
  `tongtien` float NOT NULL DEFAULT 0,
  `ghichu` varchar(255) DEFAULT NULL,
  `trangthai` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Chờ xác nhận, 1: Đã duyệt, 2: Đang giao, 3: Hoàn thành, 4: Đã hủy',
  PRIMARY KEY (`id`),
  KEY `nguoidung_id` (`nguoidung_id`),
  KEY `diachi_id` (`diachi_id`),
  CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donhang`
--

LOCK TABLES `donhang` WRITE;
/*!40000 ALTER TABLE `donhang` DISABLE KEYS */;
INSERT INTO `donhang` VALUES (1,4,4,'2024-10-01 09:15:00',29990000,'Giao hàng giờ hành chính',3),(2,4,4,'2024-10-05 14:30:00',15990000,NULL,3),(3,5,5,'2024-10-10 10:00:00',22990000,'Gọi trước khi giao',3),(4,5,5,'2024-10-15 16:45:00',5990000,NULL,3),(5,4,4,'2024-10-20 08:30:00',36990000,'Hàng dễ vỡ, đóng gói cẩn thận',3),(6,5,5,'2024-10-25 13:00:00',4590000,NULL,2),(7,4,4,'2024-11-01 11:20:00',17990000,NULL,1);
/*!40000 ALTER TABLE `donhang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donhangct`
--

DROP TABLE IF EXISTS `donhangct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donhangct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donhang_id` int(11) NOT NULL,
  `mathang_id` int(11) NOT NULL,
  `dongia` float NOT NULL DEFAULT 0,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `thanhtien` float NOT NULL DEFAULT 0,
  `phienban` varchar(100) DEFAULT NULL,
  `mausac` varchar(100) DEFAULT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `donhang_id` (`donhang_id`),
  KEY `mathang_id` (`mathang_id`),
  CONSTRAINT `donhangct_ibfk_1` FOREIGN KEY (`donhang_id`) REFERENCES `donhang` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `donhangct_ibfk_2` FOREIGN KEY (`mathang_id`) REFERENCES `mathang` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donhangct`
--

LOCK TABLES `donhangct` WRITE;
/*!40000 ALTER TABLE `donhangct` DISABLE KEYS */;
INSERT INTO `donhangct` (`id`, `donhang_id`, `mathang_id`, `dongia`, `soluong`, `thanhtien`) VALUES (1,1,1,29990000,1,29990000),(2,2,11,15990000,1,15990000),(3,3,2,22990000,1,22990000),(4,4,38,5990000,1,5990000),(5,5,7,36990000,1,36990000),(6,6,39,4590000,1,4590000),(7,7,21,17990000,1,17990000);
/*!40000 ALTER TABLE `donhangct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `giohang`
--

DROP TABLE IF EXISTS `giohang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giohang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoidung_id` int(11) NOT NULL,
  `mathang_id` int(11) NOT NULL,
  `phienban` varchar(100) NOT NULL DEFAULT '',
  `mausac` varchar(100) NOT NULL DEFAULT '',
  `hinhanh` varchar(255) DEFAULT NULL,
  `giaban` decimal(15,2) NOT NULL DEFAULT 0.00,
  `soluong` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_nguoidung_bienthe` (`nguoidung_id`,`mathang_id`,`phienban`,`mausac`),
  KEY `mathang_id` (`mathang_id`),
  CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`mathang_id`) REFERENCES `mathang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giohang`
--

LOCK TABLES `giohang` WRITE;
/*!40000 ALTER TABLE `giohang` DISABLE KEYS */;
/*!40000 ALTER TABLE `giohang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hinhanh`
--

DROP TABLE IF EXISTS `hinhanh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hinhanh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(255) NOT NULL,
  `duongdan` varchar(255) NOT NULL,
  `loai` varchar(50) NOT NULL,
  `thutu` int(11) NOT NULL DEFAULT 1,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hinhanh`
--

LOCK TABLES `hinhanh` WRITE;
/*!40000 ALTER TABLE `hinhanh` DISABLE KEYS */;
INSERT INTO `hinhanh` VALUES (1,'Logo chính Thảo Mobile','logo2.jpg','logo',1,1),(6,'Điện thoại chính hãng bảo hành 12 tháng','h1.jpg','banner_phu',1,1),(7,'Siêu ưu đãi công nghệ - Mua là có quà','h2.jpg','banner_phu',2,1),(8,'Thảo Mobile Flagship Store','h3.jpg','banner_phu',3,1),(11,'Siêu phẩm công nghệ mới - Ưu đãi đặc quyền','h8.jpg','banner_chinh',1,1),(12,'Lễ hội mua sắm smartphone chính hãng','h9.jpg','banner_chinh',2,1),(13,'Flash Sale giá sốc - Giao nhanh 2H','h10.jpg','banner_chinh',3,1),(14,'Thu cũ đổi mới - Trợ giá cực hấp dẫn','h11.jpg','banner_chinh',4,1);
/*!40000 ALTER TABLE `hinhanh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mathang`
--

DROP TABLE IF EXISTS `mathang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mathang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenmathang` varchar(255) NOT NULL,
  `mota` text DEFAULT NULL,
  `giagoc` float NOT NULL DEFAULT 0,
  `giaban` float NOT NULL DEFAULT 0,
  `soluongton` int(11) NOT NULL DEFAULT 0,
  `hinhanh` varchar(255) DEFAULT NULL,
  `phienban` varchar(255) DEFAULT NULL,
  `mausac` varchar(255) DEFAULT NULL,
  `thuvienanh` text DEFAULT NULL,
  `danhmuc_id` int(11) NOT NULL,
  `luotxem` int(11) NOT NULL DEFAULT 0,
  `luotmua` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `danhmuc_id` (`danhmuc_id`),
  CONSTRAINT `mathang_ibfk_1` FOREIGN KEY (`danhmuc_id`) REFERENCES `danhmuc` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mathang`
--

LOCK TABLES `mathang` WRITE;
/*!40000 ALTER TABLE `mathang` DISABLE KEYS */;
INSERT INTO `mathang` VALUES (1,'iPhone 18 Pro 256GB','<p><strong>Màn hình:</strong> 6.3 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A19 Pro, 3nm thế hệ 2</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 5x | Trước 12MP</p><p><strong>Pin:</strong> 3.800 mAh, sạc 25W, MagSafe 25W</p>',32990000,29990000,15,'images/products/a1.jpg','256GB:29990000, 512GB:34990000, 1TB:40990000','Đỏ Burgundy, Băng Thanh, Bạc, Đen','a1.jpg, iphone-18-pro-max-bangthanh.jpg, iphone-18-pro-max-bac.jpg, iphone-18-pro-max-den.jpg',1,321,12),(2,'iPhone 17 Pro Max 256GB','<p><strong>Màn hình:</strong> 6.9 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A18 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 5x | Trước 24MP</p><p><strong>Pin:</strong> 4.685 mAh, sạc 30W, MagSafe 25W</p>',26990000,22990000,20,'images/products/a2.jpg','256GB:22990000, 512GB:27990000, 1TB:33990000','Cam Vũ Trụ, Bạc, Xanh Đen','a2.jpg, iphone-17-pro-max.jpg, iphone-17-pro-max-xanh đen.jpg',1,587,25),(3,'iPhone 16 Pro Max 256GB','<p><strong>Màn hình:</strong> 6.9 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A18 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP Fusion + 48MP UltraWide + 12MP tele 5x | Trước 12MP</p><p><strong>Pin:</strong> 4.685 mAh, sạc 27W, MagSafe 25W</p>',32990000,28990000,18,'images/products/a3.jpg','256GB:28990000, 512GB:33990000, 1TB:39990000','Titan Sa Mạc, Titan Tự Nhiên, Titan Trắng, Titan Đen','a3.jpg, 16promax-titan-tunhien.jpg, 16promax-titan-trag.jpg, apple-iphone-16-pro-max-512gb-đen.jpg',1,742,38),(4,'iPhone 15 Pro Max 256GB Titan Xanh','<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A17 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 5x | Trước 12MP</p><p><strong>Pin:</strong> 4.422 mAh, sạc 27W, MagSafe 15W</p>',34990000,26990000,25,'images/products/a4.jpg','256GB:26990000, 512GB:31990000, 1TB:37990000','Titan Xanh','a4.jpg',1,1201,65),(5,'iPhone 15 Pro Max 512GB Titan Trắng','<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A17 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 512GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 5x | Trước 12MP</p><p><strong>Pin:</strong> 4.422 mAh, sạc 27W, MagSafe 15W</p>',42990000,36990000,12,'images/products/a5.jpg','256GB:31990000, 512GB:36990000, 1TB:42990000','Titan Trắng','a5.jpg',1,890,32),(6,'iPhone 15 Pro 256GB Titan Tự Nhiên','<p><strong>Màn hình:</strong> 6.1 inch Super Retina XDR OLED, 120Hz ProMotion</p><p><strong>Chip:</strong> Apple A17 Pro, 3nm</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 3x | Trước 12MP</p><p><strong>Pin:</strong> 3.274 mAh, sạc 27W, MagSafe 15W</p>',29990000,23990000,22,'images/products/a6.jpg','128GB:20990000, 256GB:23990000, 512GB:28990000, 1TB:33990000','Titan Tự Nhiên','a6.jpg',1,760,44),(7,'iPhone 15 Plus 128GB Xanh Dương','<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 60Hz</p><p><strong>Chip:</strong> Apple A16 Bionic, 4nm</p><p><strong>RAM/ROM:</strong> 6GB / 128GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide | Trước 12MP</p><p><strong>Pin:</strong> 4.383 mAh, sạc 20W, MagSafe 15W</p>',26990000,20990000,30,'images/products/a7.jpg','128GB:20990000, 256GB:23990000, 512GB:28990000','Xanh Dương','a7.jpg',1,650,38),(8,'iPhone 14 Pro Max 256GB Tím','<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 120Hz ProMotion, Dynamic Island</p><p><strong>Chip:</strong> Apple A16 Bionic, 4nm</p><p><strong>RAM/ROM:</strong> 6GB / 256GB</p><p><strong>Camera:</strong> 48MP chính + 12MP UltraWide + 12MP tele 3x | Trước 12MP</p><p><strong>Pin:</strong> 4.323 mAh, sạc 27W, MagSafe 15W</p>',32990000,24990000,18,'images/products/a8.jpg','128GB:21990000, 256GB:24990000, 512GB:29990000, 1TB:34990000','Tím Deep Purple','a8.jpg',1,983,55),(9,'iPhone 14 Plus 128GB Xanh','<p><strong>Màn hình:</strong> 6.7 inch Super Retina XDR OLED, 60Hz</p><p><strong>Chip:</strong> Apple A15 Bionic, 5nm</p><p><strong>RAM/ROM:</strong> 6GB / 128GB</p><p><strong>Camera:</strong> 12MP chính + 12MP UltraWide | Trước 12MP</p><p><strong>Pin:</strong> 4.325 mAh, sạc 20W, MagSafe 15W</p>',26990000,18990000,25,'images/products/a9.jpg','128GB:18990000, 256GB:21990000, 512GB:26990000','Xanh Dương','a9.jpg',1,721,42),(10,'iPhone 14 128GB Tím','<p><strong>Màn hình:</strong> 6.1 inch Super Retina XDR OLED, 60Hz</p><p><strong>Chip:</strong> Apple A15 Bionic, 5nm</p><p><strong>RAM/ROM:</strong> 6GB / 128GB</p><p><strong>Camera:</strong> 12MP chính + 12MP UltraWide | Trước 12MP TrueDepth</p><p><strong>Pin:</strong> 3.279 mAh, sạc 20W, MagSafe 15W</p>',22990000,16990000,35,'images/products/a10.jpg','128GB:16990000, 256GB:19990000, 512GB:24990000','Tím, Xanh Dương, Đen, Đỏ, Trắng, Vàng','a10.jpg, 14-xanh.jpg, 14-den.jpg, 14-do.jpg, 14-trang.jpg, 14-vang.jpg',1,1053,68),(11,'Samsung Galaxy S23 Ultra 5G 256GB','<p><strong>Màn hình:</strong> 6.8 inch Dynamic AMOLED 2X, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 200MP + 12MP UW + 10MP tele 3x + 10MP tele 10x | Trước 12MP, kèm S Pen</p><p><strong>Pin:</strong> 5.000 mAh, sạc 45W</p>',18990000,15990000,20,'images/products/s1.jpg','256GB:15990000:8GB, 512GB:18990000:12GB, 1TB:23990000:16GB','Xanh Botanic','s1.jpg',2,852,42),(12,'Samsung Galaxy Z Fold5 5G 256GB','<p><strong>Màn hình:</strong> 7.6 inch Dynamic AMOLED 2X gập + 6.2 inch cover, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP + 12MP UW + 10MP tele 3x | Cover 10MP + Trong 4MP</p><p><strong>Pin:</strong> 4.400 mAh, sạc 25W</p>',42990000,36990000,10,'images/products/s2.jpg','256GB:36990000, 512GB:40990000, 1TB:46990000','Xanh Icy','s2.jpg',2,430,15),(13,'Samsung Galaxy Z Flip5 5G 256GB','<p><strong>Màn hình:</strong> 6.7 inch Dynamic AMOLED 2X gập + 3.4 inch Flex Window, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 12MP chính + 12MP UltraWide | Trước 10MP</p><p><strong>Pin:</strong> 3.700 mAh, sạc 25W</p>',24990000,19990000,15,'images/products/s3.jpg','256GB:19990000, 512GB:22990000','Xanh Mint','s3.jpg',2,620,28),(14,'Samsung Galaxy S23+ 5G 256GB','<p><strong>Màn hình:</strong> 6.6 inch Dynamic AMOLED 2X, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 12MP UW + 10MP tele 3x | Trước 12MP</p><p><strong>Pin:</strong> 4.700 mAh, sạc 45W</p>',16990000,14490000,18,'images/products/s4.jpg','256GB:14490000, 512GB:16990000','Kem Cotton','s4.jpg',2,540,26),(15,'Samsung Galaxy S23 5G 128GB','<p><strong>Màn hình:</strong> 6.1 inch Dynamic AMOLED 2X, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8 Gen 2 for Galaxy</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 50MP chính + 12MB UW + 10MP tele 3x | Trước 12MP</p><p><strong>Pin:</strong> 3.900 mAh, sạc 25W</p>',13990000,11990000,25,'images/products/s5.jpg','128GB:11990000, 256GB:13490000','Đen Phantom','s5.jpg',2,760,48),(16,'Samsung Galaxy S23 FE 5G 128GB','<p><strong>Màn hình:</strong> 6.4 inch Dynamic AMOLED 2X, 120Hz</p><p><strong>Chip:</strong> Exynos 2200</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 50MP chính + 12MP UW + 8MP tele 3x | Trước 10MP</p><p><strong>Pin:</strong> 4.500 mAh, sạc 25W</p>',14990000,10990000,28,'images/products/s6.jpg','128GB:10990000, 256GB:12490000','Xanh Mint','s6.jpg',2,680,55),(17,'Samsung Galaxy S22 Ultra 5G 128GB','<p><strong>Màn hình:</strong> 6.8 inch Dynamic AMOLED 2X, 120Hz, Dynamic Island</p><p><strong>Chip:</strong> Snapdragon 8 Gen 1</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 108MP + 12MP UW + 10MP tele 3x + 10MP tele 10x | Trước 40MP, kèm S Pen</p><p><strong>Pin:</strong> 5.000 mAh, sạc 45W</p>',24990000,17990000,15,'images/products/s7.jpg','128GB:17990000, 256GB:19990000, 512GB:22990000','Đỏ Burgundy','s7.jpg',2,920,62),(18,'Samsung Galaxy Z Fold4 5G 256GB','<p><strong>Màn hình:</strong> 7.6 inch Dynamic AMOLED 2X gập + 6.2 inch cover, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8+ Gen 1</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP + 12MP UW + 10MP tele 3x | Cover 10MP + Trong 4MP</p><p><strong>Pin:</strong> 4.400 mAh, sạc 25W</p>',32990000,24990000,12,'images/products/s8.jpg','256GB:24990000, 512GB:27990000','Xám Titan','s8.jpg',2,491,18),(19,'Samsung Galaxy A54 5G 256GB','<p><strong>Màn hình:</strong> 6.4 inch Super AMOLED, 120Hz</p><p><strong>Chip:</strong> Exynos 1380</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 12MP UW + 5MP macro | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 25W</p>',12990000,9990000,35,'images/products/s9.jpg','128GB:8490000, 256GB:9990000','Xanh Dũng Mãnh','s9.jpg',2,870,68),(20,'Samsung Galaxy A34 5G 128GB','<p><strong>Màn hình:</strong> 6.6 inch Super AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 1080</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 48MP chính + 8MP UW + 5MP macro | Trước 13MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 25W</p>',9990000,7990000,40,'images/products/s10.jpg','128GB:7990000, 256GB:8990000','Bạc Kiêu Hãnh','s10.jpg',2,980,82),(21,'OPPO Find N2 Flip 5G 256GB','<p><strong>Màn hình:</strong> 6.8 inch AMOLED gập + 3.26 inch ngoài, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 9000+</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW | Trước 32MP</p><p><strong>Pin:</strong> 4.300 mAh, sạc SUPERVOOC 44W</p>',20990000,17990000,12,'images/products/o1.jpg','256GB:17990000','Tím Ánh Sao','o1.jpg',3,510,20),(22,'OPPO Find X5 Pro 5G 256GB','<p><strong>Màn hình:</strong> 6.7 inch AMOLED, 120Hz, Hasselblad</p><p><strong>Chip:</strong> Snapdragon 8 Gen 1</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 50MB UW + 13MP tele 2x | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 80W + AirVOOC 50W</p>',24990000,19990000,10,'images/products/o2.jpg','256GB:19990000, 512GB:22990000','Trắng Gốm','o2.jpg',3,420,16),(23,'OPPO Reno10 Pro+ 5G 256GB','<p><strong>Màn hình:</strong> 6.74 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 8+ Gen 1</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 32MP tele + 8MP UW | Trước 32MP</p><p><strong>Pin:</strong> 4.700 mAh, sạc SUPERVOOC 100W</p>',20990000,17990000,18,'images/products/o3.jpg','256GB:17990000, 512GB:20990000','Tím Thạch Anh','o3.jpg',3,390,18),(24,'OPPO Reno10 Pro 5G 256GB','<p><strong>Màn hình:</strong> 6.74 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 778G 5G</p><p><strong>RAM/ROM:</strong> 12GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 32MP tele + 8MP UW | Trước 32MP</p><p><strong>Pin:</strong> 4.600 mAh, sạc SUPERVOOC 80W</p>',16990000,13990000,20,'images/products/o4.jpg','256GB:13990000','Xám Ánh Trăng','o4.jpg',3,460,30),(25,'OPPO Reno10 5G 256GB','<p><strong>Màn hình:</strong> 6.74 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 7050</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 64MP chính + 32MP tele + 8MP UW | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 67W</p>',12990000,10990000,28,'images/products/o5.jpg','128GB:9490000, 256GB:10990000','Xanh Băng Tuyết','o5.jpg',3,530,36),(26,'OPPO Reno8 Pro 5G 256GB','<p><strong>Màn hình:</strong> 6.7 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 8100 Max</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW + 2MP macro | Trước 32MP</p><p><strong>Pin:</strong> 4.500 mAh, sạc SUPERVOOC 80W</p>',14990000,11990000,22,'images/products/o6.jpg','256GB:11990000','Xanh Men Ngọc','o6.jpg',3,440,28),(27,'OPPO Reno8 T 5G 128GB','<p><strong>Màn hình:</strong> 6.7 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 695 5G</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 108MP chính + 2MP macro + 2MP độ sâu | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 67W</p>',10990000,8490000,30,'images/products/o7.jpg','128GB:8490000, 256GB:9490000','Vàng Hừng Đông','o7.jpg',3,580,42),(28,'OPPO A98 5G 256GB','<p><strong>Màn hình:</strong> 6.72 inch IPS LCD, 120Hz</p><p><strong>Chip:</strong> Snapdragon 695 5G</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 64MP chính + 2MP macro + 2MP độ sâu | Trước 32MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 67W</p>',9990000,7990000,35,'images/products/o8.jpg','256GB:7990000','Xanh Mơ Mộng','o8.jpg',3,620,48),(29,'OPPO A78 256GB','<p><strong>Màn hình:</strong> 6.43 inch AMOLED, 90Hz</p><p><strong>Chip:</strong> Snapdragon 680</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 2MP độ sâu | Trước 8MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 67W</p>',7990000,5990000,42,'images/products/o9.jpg','128GB:5190000, 256GB:5990000','Xanh Ngọc','o9.jpg',3,710,60),(30,'OPPO A58 128GB','<p><strong>Màn hình:</strong> 6.72 inch IPS LCD, 90Hz</p><p><strong>Chip:</strong> MediaTek Helio G85</p><p><strong>RAM/ROM:</strong> 6GB / 128GB</p><p><strong>Camera:</strong> 50MP chính + 2MP độ sâu | Trước 8MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc SUPERVOOC 33W</p>',5990000,4290000,50,'images/products/o10.jpg','128GB:4290000','Đen Dạ Quang','o10.jpg',3,830,72),(31,'Xiaomi 13T 5G 256GB','<p><strong>Màn hình:</strong> 6.67 inch AMOLED, 144Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 8200 Ultra</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 12MP UW + 50MP tele 2.7x (Leica) | Trước 20MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 67W</p>',13990000,11990000,22,'images/products/x1.jpg','256GB:11990000, 512GB:13490000','Xanh Tuyết Sơn','x1.jpg',4,480,27),(32,'Xiaomi 13 Lite 5G 256GB','<p><strong>Màn hình:</strong> 6.55 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 7 Gen 1</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW + 2MP macro | Trước 32MP + 8MP UW</p><p><strong>Pin:</strong> 4.500 mAh, sạc nhanh 67W</p>',10990000,8990000,28,'images/products/x2.jpg','128GB:7990000, 256GB:8990000','Hồng Lite','x2.jpg',4,390,22),(33,'Xiaomi Redmi Note 12 Pro 5G 256GB Tím','<p><strong>Màn hình:</strong> 6.67 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 1080</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 200MP chính + 8MP UW + 2MP macro | Trước 16MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 67W</p>',9990000,7490000,35,'images/products/x3.jpg','128GB:6490000, 256GB:7490000','Tím Ánh Sao','x3.jpg',4,820,65),(34,'Xiaomi Redmi Note 12 Pro 5G 128GB Xanh','<p><strong>Màn hình:</strong> 6.67 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> MediaTek Dimensity 1080</p><p><strong>RAM/ROM:</strong> 8GB / 128GB</p><p><strong>Camera:</strong> 200MP chính + 8MP UW + 2MP macro | Trước 16MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 67W</p>',8990000,6490000,40,'images/products/x4.jpg','128GB:6490000, 256GB:7490000','Xanh Bầu Trời','x4.jpg',4,750,58),(35,'Xiaomi Redmi Note 12S 256GB','<p><strong>Màn hình:</strong> 6.43 inch AMOLED, 90Hz</p><p><strong>Chip:</strong> MediaTek Helio G96</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 108MP chính + 8MP UW + 2MP macro | Trước 16MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 33W</p>',6990000,5490000,45,'images/products/x5.jpg','256GB:5490000','Xanh Ngọc Trai','x5.jpg',4,680,50),(36,'Xiaomi Redmi Note 12 256GB','<p><strong>Màn hình:</strong> 6.67 inch AMOLED, 120Hz</p><p><strong>Chip:</strong> Snapdragon 4 Gen 1</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW + 2MP macro | Trước 13MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 33W</p>',5990000,4590000,55,'images/products/x6.jpg','128GB:3990000, 256GB:4590000','Xanh Băng Giá','x6.jpg',4,951,88),(37,'Xiaomi Redmi 12 Pro 4G 256GB','<p><strong>Màn hình:</strong> 6.67 inch IPS LCD, 90Hz</p><p><strong>Chip:</strong> MediaTek Helio G99</p><p><strong>RAM/ROM:</strong> 8GB / 256GB</p><p><strong>Camera:</strong> 50MP chính + 8MP UW + 2MP macro | Trước 16MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc nhanh 33W</p>',5490000,4190000,50,'images/products/x7.jpg','128GB:3690000, 256GB:4190000','Xám Khoáng Thạch','x7.jpg',4,581,44),(38,'Xiaomi Redmi 12 128GB','<p><strong>Màn hình:</strong> 6.79 inch IPS LCD, 90Hz</p><p><strong>Chip:</strong> MediaTek Helio G88</p><p><strong>RAM/ROM:</strong> 4GB / 128GB</p><p><strong>Camera:</strong> 50MP chính + 8MB UW + 2MP macro | Trước 8MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 18W</p>',4490000,3290000,60,'images/products/x8.jpg','128GB:3290000','Bạc Ánh Cực Quang','x8.jpg',4,1100,95),(39,'Xiaomi Redmi 12C 64GB','<p><strong>Màn hình:</strong> 6.71 inch IPS LCD, 60Hz</p><p><strong>Chip:</strong> MediaTek Helio G85</p><p><strong>RAM/ROM:</strong> 3GB / 64GB</p><p><strong>Camera:</strong> 50MP chính + 2MP độ sâu | Trước 5MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 10W</p>',3490000,2490000,70,'images/products/x9.jpg','64GB:2490000, 128GB:2890000','Xanh Hải Quân','x9.jpg',4,1250,110),(40,'Xiaomi Redmi A2 32GB','<p><strong>Màn hình:</strong> 6.52 inch IPS LCD, 60Hz</p><p><strong>Chip:</strong> MediaTek Helio G36</p><p><strong>RAM/ROM:</strong> 2GB / 32GB</p><p><strong>Camera:</strong> 8MP chính + 0.08MP AI | Trước 5MP</p><p><strong>Pin:</strong> 5.000 mAh, sạc 10W</p>',2490000,1790000,80,'images/products/x10.jpg','32GB:1790000','Đen Cổ Điển','x10.jpg',4,1400,130);
/*!40000 ALTER TABLE `mathang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nguoidung`
--

DROP TABLE IF EXISTS `nguoidung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nguoidung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `sodienthoai` varchar(10) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `loai` tinyint(4) NOT NULL DEFAULT 3,
  `trangthai` tinyint(4) NOT NULL DEFAULT 1,
  `hinhanh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nguoidung`
--

LOCK TABLES `nguoidung` WRITE;
/*!40000 ALTER TABLE `nguoidung` DISABLE KEYS */;
INSERT INTO `nguoidung` VALUES (1,'admin@shop.com','0901234567','e99a18c428cb38d5f260853678922e03','Nguyễn Quản Trị',1,1,NULL),(2,'nv1@shop.com','0912345678','e99a18c428cb38d5f260853678922e03','Trần Nhân Viên',2,1,NULL),(3,'nv2@shop.com','0923456789','e99a18c428cb38d5f260853678922e03','Lê Thị Nhân Viên',2,1,NULL),(4,'kh1@gmail.com','0934567890','e99a18c428cb38d5f260853678922e03','Nguyễn Thị Thu An',3,1,NULL),(5,'kh2@gmail.com','0945678901','e99a18c428cb38d5f260853678922e03','Hồ Xuân Minh',3,1,NULL),(6,'admin_duc@shop.com','0988888888','e99a18c428cb38d5f260853678922e03','Admin Đức',1,1,NULL);
/*!40000 ALTER TABLE `nguoidung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phieunhap`
--

DROP TABLE IF EXISTS `phieunhap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phieunhap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoidung_id` int(11) NOT NULL,
  `nhacungcap` varchar(255) NOT NULL,
  `ngaynhap` datetime NOT NULL DEFAULT current_timestamp(),
  `tongtien` decimal(15,0) NOT NULL DEFAULT 0,
  `ghichu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nguoidung_id` (`nguoidung_id`),
  CONSTRAINT `phieunhap_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phieunhap`
--

LOCK TABLES `phieunhap` WRITE;
/*!40000 ALTER TABLE `phieunhap` DISABLE KEYS */;
INSERT INTO `phieunhap` VALUES (1,1,'Apple Việt Nam Chính Hãng','2024-11-10 09:30:00',396000000,'Nhập lô hàng iPhone thế hệ mới đợt 1'),(2,2,'Samsung Electronics Vina','2024-11-15 14:15:00',214000000,'Bổ sung Galaxy S23 Ultra và Z Flip5'),(3,1,'Nhà phân phối Digiworld (DGW)','2024-11-18 10:00:00',145000000,'Lô máy Xiaomi và OPPO đợt cuối năm');
/*!40000 ALTER TABLE `phieunhap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phieunhapct`
--

DROP TABLE IF EXISTS `phieunhapct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phieunhapct` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phieunhapct`
--

LOCK TABLES `phieunhapct` WRITE;
/*!40000 ALTER TABLE `phieunhapct` DISABLE KEYS */;
INSERT INTO `phieunhapct` VALUES (1,1,1,26000000,8,208000000),(2,1,3,23500000,8,188000000),(3,2,11,13500000,10,135000000),(4,2,13,15800000,5,79000000),(5,3,21,14500000,6,87000000),(6,3,31,9666667,6,58000000);
/*!40000 ALTER TABLE `phieunhapct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thongtin`
--

DROP TABLE IF EXISTS `thongtin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thongtin` (
  `id` int(11) NOT NULL DEFAULT 1,
  `tencuahang` varchar(255) NOT NULL DEFAULT 'Thảo Mobile',
  `slogan` varchar(255) DEFAULT 'Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng',
  `sodienthoai` varchar(50) NOT NULL DEFAULT '0357185269',
  `email` varchar(150) NOT NULL DEFAULT 'thaomobile@gmail.com',
  `diachi` varchar(255) NOT NULL DEFAULT 'Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp',
  `giomocua` varchar(150) DEFAULT '08:00 - 21:30 (Tất cả các ngày trong tuần)',
  `gioithieu` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thongtin`
--

LOCK TABLES `thongtin` WRITE;
/*!40000 ALTER TABLE `thongtin` DISABLE KEYS */;
INSERT INTO `thongtin` VALUES (1,'Thảo Mobile','Giao nhanh 2H miễn phí • Bảo hành chính hãng 12 tháng','0357185269','thaomobile@gmail.com','Số 570, ấp An Hòa, xã Lai Vung, tỉnh Đồng Tháp','08:00 - 21:30 (Tất cả các ngày trong tuần)','Thảo Mobile là hệ thống bán lẻ điện thoại di động chính hãng uy tín, chuyên cung cấp các dòng smartphone mới nhất từ 4 thương hiệu hàng đầu: Apple, Samsung, OPPO và Xiaomi với mức giá cạnh tranh cùng dịch vụ hậu mãi tận tâm.');
/*!40000 ALTER TABLE `thongtin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'shop_dienthoai'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-24 13:10:31
