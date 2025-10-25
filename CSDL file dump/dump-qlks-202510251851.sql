-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: qlks
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blogdulich`
--

DROP TABLE IF EXISTS `blogdulich`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogdulich` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(255) NOT NULL,
  `noi_dung` text NOT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `tac_gia` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogdulich`
--

LOCK TABLES `blogdulich` WRITE;
/*!40000 ALTER TABLE `blogdulich` DISABLE KEYS */;
INSERT INTO `blogdulich` VALUES (1,'khách sạn kì thúch sạn kì thú','test',NULL,'Phong Lê','2025-10-22 06:11:32','2025-10-22 06:11:32');
/*!40000 ALTER TABLE `blogdulich` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danhgia`
--

DROP TABLE IF EXISTS `danhgia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `danhgia` (
  `danhgia_id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoidung_id` int(11) NOT NULL,
  `khachsan_id` int(11) NOT NULL,
  `diem` int(11) DEFAULT NULL CHECK (`diem` between 1 and 5),
  `binh_luan` text DEFAULT NULL,
  `ngay_danhgia` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`danhgia_id`),
  KEY `nguoidung_id` (`nguoidung_id`),
  KEY `danhgia_ibfk_2` (`khachsan_id`),
  CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`nguoidung_id`),
  CONSTRAINT `danhgia_ibfk_2` FOREIGN KEY (`khachsan_id`) REFERENCES `khachsan` (`khachsan_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danhgia`
--

LOCK TABLES `danhgia` WRITE;
/*!40000 ALTER TABLE `danhgia` DISABLE KEYS */;
/*!40000 ALTER TABLE `danhgia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `datphong`
--

DROP TABLE IF EXISTS `datphong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datphong` (
  `datphong_id` int(11) NOT NULL AUTO_INCREMENT,
  `nguoidung_id` int(11) NOT NULL,
  `phong_id` int(11) NOT NULL,
  `ngay_dat` date NOT NULL,
  `ngay_den` date NOT NULL,
  `ngay_di` date NOT NULL,
  `tong_tien` decimal(12,2) NOT NULL,
  `trang_thai` enum('cho_xac_nhan','da_coc','da_thanh_toan','huy') DEFAULT 'cho_xac_nhan',
  PRIMARY KEY (`datphong_id`),
  KEY `nguoidung_id` (`nguoidung_id`),
  KEY `datphong_ibfk_2` (`phong_id`),
  CONSTRAINT `datphong_ibfk_1` FOREIGN KEY (`nguoidung_id`) REFERENCES `nguoidung` (`nguoidung_id`),
  CONSTRAINT `datphong_ibfk_2` FOREIGN KEY (`phong_id`) REFERENCES `phong` (`phong_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_datphong_phong` FOREIGN KEY (`phong_id`) REFERENCES `phong` (`phong_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datphong`
--

LOCK TABLES `datphong` WRITE;
/*!40000 ALTER TABLE `datphong` DISABLE KEYS */;
INSERT INTO `datphong` VALUES (7,2,7,'2025-10-25','2025-10-26','2025-10-29',600000.00,'cho_xac_nhan'),(8,2,12,'2025-10-25','2025-11-01','2025-11-08',2940000.00,'cho_xac_nhan');
/*!40000 ALTER TABLE `datphong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hinhanhkhachsan`
--

DROP TABLE IF EXISTS `hinhanhkhachsan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hinhanhkhachsan` (
  `hinhanh_id` int(11) NOT NULL AUTO_INCREMENT,
  `khachsan_id` int(11) NOT NULL,
  `duong_dan` varchar(255) NOT NULL,
  PRIMARY KEY (`hinhanh_id`),
  KEY `HinhAnhKhachSan_ibfk_1` (`khachsan_id`),
  CONSTRAINT `HinhAnhKhachSan_ibfk_1` FOREIGN KEY (`khachsan_id`) REFERENCES `khachsan` (`khachsan_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hinhanhkhachsan`
--

LOCK TABLES `hinhanhkhachsan` WRITE;
/*!40000 ALTER TABLE `hinhanhkhachsan` DISABLE KEYS */;
INSERT INTO `hinhanhkhachsan` VALUES (29,17,'uploads/khachsan/1761392005_a1.jpg'),(30,10,'uploads/khachsan/1761392041_zz.jpg'),(31,11,'uploads/khachsan/1761392051_images.jpg'),(32,12,'uploads/khachsan/1761392062_images (2).jpg'),(33,13,'uploads/khachsan/1761392073_images (1).jpg'),(34,14,'uploads/khachsan/1761392083_a3.jpg'),(35,15,'uploads/khachsan/1761392092_a2.jpg'),(36,16,'uploads/khachsan/1761392100_a1.jpg');
/*!40000 ALTER TABLE `hinhanhkhachsan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `khachsan`
--

DROP TABLE IF EXISTS `khachsan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `khachsan` (
  `khachsan_id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_khach_san` varchar(150) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `xep_hang` int(11) DEFAULT NULL CHECK (`xep_hang` between 1 and 5),
  `trang_thai` enum('hoat_dong','ngung') DEFAULT 'hoat_dong',
  PRIMARY KEY (`khachsan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khachsan`
--

LOCK TABLES `khachsan` WRITE;
/*!40000 ALTER TABLE `khachsan` DISABLE KEYS */;
INSERT INTO `khachsan` VALUES (10,'Khách sạn Sài Gòn Pearl','92 Nguyễn Hữu Cảnh, Bình Thạnh, Hồ Chí Minh','Khách sạn cao cấp gần trung tâm, tiện nghi hiện đại, hồ bơi ngoài trời.',3,'hoat_dong'),(11,'Khách sạn Biển Xanh','15 Trần Phú, Hải Châu, Đà Nẵng','View biển tuyệt đẹp, gần cầu Rồng, dịch vụ thân thiện.',4,'hoat_dong'),(12,'Hanoi Elegance Hotel','8 Hàng Bạc, Hoàn Kiếm, Hà Nội','Phong cách cổ điển, gần Hồ Gươm, phù hợp cho khách du lịch.',4,'hoat_dong'),(13,'Nha Trang Sunset Resort','10 Trần Phú, Lộc Thọ, Nha Trang','Resort ven biển, có spa và nhà hàng hải sản nổi tiếng.',5,'hoat_dong'),(14,'Dalat Dream Hotel','3 Nguyễn Chí Thanh, Phường 1, Lâm Đồng','Khách sạn nhỏ xinh giữa trung tâm Đà Lạt, gần chợ đêm.',3,'hoat_dong'),(15,'Paradise Island Resort','1 Bãi Dài, Phú Quốc, Kiên Giang','Resort cao cấp trên đảo, có bãi biển riêng và dịch vụ đưa đón sân bay.',3,'hoat_dong'),(16,'Huế Heritage Hotel','12 Lê Lợi, Phú Hội, Thừa Thiên Huế','Gần Đại Nội, phong cách truyền thống Huế, dịch vụ chuyên nghiệp.',5,'hoat_dong'),(17,'Khach sạn minh trang','Thành Phố Hồ Chí Minh','khách sạn nổi tiếng với dịch vụ tốt và hài lòng của khách hàng',3,'hoat_dong');
/*!40000 ALTER TABLE `khachsan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nguoidung`
--

DROP TABLE IF EXISTS `nguoidung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nguoidung` (
  `nguoidung_id` int(11) NOT NULL AUTO_INCREMENT,
  `taikhoan_id` int(11) NOT NULL,
  `ho_ten` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nguoidung_id`),
  UNIQUE KEY `taikhoan_id` (`taikhoan_id`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `fk_taikhoan_nguoidung` FOREIGN KEY (`taikhoan_id`) REFERENCES `taikhoan` (`taikhoan_id`) ON DELETE CASCADE,
  CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`taikhoan_id`) REFERENCES `taikhoan` (`taikhoan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nguoidung`
--

LOCK TABLES `nguoidung` WRITE;
/*!40000 ALTER TABLE `nguoidung` DISABLE KEYS */;
INSERT INTO `nguoidung` VALUES (1,1,'Admin Hệ Thống','admin@qlks.com','0900000000'),(2,2,'Nguyễn Văn A','a@gmail.com','0912345678'),(3,3,'phong lê','phong@gmail.com','123456789'),(5,7,'test','phongpro400102@gmail.com','1234567890');
/*!40000 ALTER TABLE `nguoidung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phong`
--

DROP TABLE IF EXISTS `phong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phong` (
  `phong_id` int(11) NOT NULL AUTO_INCREMENT,
  `khachsan_id` int(11) NOT NULL,
  `ten_phong` varchar(100) NOT NULL,
  `loai_phong` varchar(50) DEFAULT NULL,
  `gia` decimal(12,2) NOT NULL,
  `so_luong` int(11) DEFAULT 1,
  `mo_ta` text DEFAULT NULL,
  PRIMARY KEY (`phong_id`),
  KEY `phong_ibfk_1` (`khachsan_id`),
  CONSTRAINT `phong_ibfk_1` FOREIGN KEY (`khachsan_id`) REFERENCES `khachsan` (`khachsan_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phong`
--

LOCK TABLES `phong` WRITE;
/*!40000 ALTER TABLE `phong` DISABLE KEYS */;
INSERT INTO `phong` VALUES (7,10,'Phòng cặp đôi','tình nhân',200000.00,1,'Phòng dành cho các cặp đôi yêu nhau'),(8,10,'phòng gia đình','đông người',200000.00,1,'phòng dành cho gia dình sum vầy bên nhau'),(9,11,'Phòng cặp đôi','tình nhân',300000.00,2,'phòng dành cho các cặp đôi'),(10,12,'phòng gia đình','đông người',300000.00,1,'phòng dành cho gia đình'),(11,13,'Phòng view biển','vip',500000.00,1,'phòng view biển nha Trang siêu đẹp thoáng mát sạch sẽ'),(12,14,'phòng tình nhân','tình nhân',600000.00,1,'phòng gần chợ đêm'),(13,15,'Phòng view biển','vip',500000.00,1,'phòng sạch sẽ thoáng mát'),(14,16,'Phòng cặp đôi','tình nhân',400000.00,1,'phòng tình yêu');
/*!40000 ALTER TABLE `phong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taikhoan`
--

DROP TABLE IF EXISTS `taikhoan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `taikhoan` (
  `taikhoan_id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_dang_nhap` varchar(100) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `vai_tro` enum('khach_hang','admin') DEFAULT 'khach_hang',
  PRIMARY KEY (`taikhoan_id`),
  UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taikhoan`
--

LOCK TABLES `taikhoan` WRITE;
/*!40000 ALTER TABLE `taikhoan` DISABLE KEYS */;
INSERT INTO `taikhoan` VALUES (1,'admin','$2y$10$Wwv.WzNN2bb5xkjIZZ.65ORSZm6Jlsk2whRzMgvTQ0bM5QIHH77ay','admin'),(2,'khach1','$2y$10$8XSrg5U6jBvobn/qPHORyevmK5s4lisJGDPkiwvPXI0JBfQrXHtMq','khach_hang'),(3,'khach3','123456','khach_hang'),(5,'admin2','$2y$10$6hDwsAcs/rw3cF.BORzwtup3/L9z3zP3gYHychJ3XQWXhcPWDKhBW','admin'),(6,'admin3','$2y$10$FdLmVXdmEyDcch9KB9BKyuETrvtNiPemIUnxXKryCCFIfoJcp0pRS','admin'),(7,'khach2','$2y$10$it80MAK7BNY.nfYblre8FO4BgOJRD/6d9AT1wT2AmsaHNdkfzswh6','khach_hang');
/*!40000 ALTER TABLE `taikhoan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thanhtoan`
--

DROP TABLE IF EXISTS `thanhtoan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `thanhtoan` (
  `thanhtoan_id` int(11) NOT NULL AUTO_INCREMENT,
  `datphong_id` int(11) NOT NULL,
  `so_tien` decimal(12,2) NOT NULL,
  `hinh_thuc` enum('dat_coc','chuyen_khoan','tien_mat') NOT NULL,
  `ngay_tt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`thanhtoan_id`),
  KEY `fk_datphong_thanhtoan` (`datphong_id`),
  CONSTRAINT `fk_datphong_thanhtoan` FOREIGN KEY (`datphong_id`) REFERENCES `datphong` (`datphong_id`) ON DELETE CASCADE,
  CONSTRAINT `thanhtoan_ibfk_1` FOREIGN KEY (`datphong_id`) REFERENCES `datphong` (`datphong_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thanhtoan`
--

LOCK TABLES `thanhtoan` WRITE;
/*!40000 ALTER TABLE `thanhtoan` DISABLE KEYS */;
/*!40000 ALTER TABLE `thanhtoan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uudai`
--

DROP TABLE IF EXISTS `uudai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uudai` (
  `uudai_id` int(11) NOT NULL AUTO_INCREMENT,
  `khachsan_id` int(11) NOT NULL,
  `tieu_de` varchar(255) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `giam_gia` decimal(5,2) DEFAULT NULL,
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  PRIMARY KEY (`uudai_id`),
  KEY `khachsan_id` (`khachsan_id`),
  CONSTRAINT `uudai_ibfk_1` FOREIGN KEY (`khachsan_id`) REFERENCES `khachsan` (`khachsan_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uudai`
--

LOCK TABLES `uudai` WRITE;
/*!40000 ALTER TABLE `uudai` DISABLE KEYS */;
INSERT INTO `uudai` VALUES (2,14,'ưu đãi ngày 8/3','nhân ngày nhà 8/3 khách sạn giảm giá sâu cho quý khách đến khách sạn',30.00,'2025-10-25','2025-10-27');
/*!40000 ALTER TABLE `uudai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'qlks'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-25 18:51:11
