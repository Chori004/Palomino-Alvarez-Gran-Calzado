-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: zapatos
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `producto_variante`
--

DROP TABLE IF EXISTS `producto_variante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto_variante` (
  `id_variante` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto_fk` int(11) NOT NULL,
  `talle` decimal(3,1) NOT NULL,
  `vendido` char(1) DEFAULT 'N',
  `activo` char(1) DEFAULT 'S',
  `condicion` enum('roto','estable') DEFAULT 'estable',
  PRIMARY KEY (`id_variante`),
  KEY `id_producto_fk` (`id_producto_fk`),
  CONSTRAINT `producto_variante_ibfk_1` FOREIGN KEY (`id_producto_fk`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_variante`
--

LOCK TABLES `producto_variante` WRITE;
/*!40000 ALTER TABLE `producto_variante` DISABLE KEYS */;
INSERT INTO `producto_variante` VALUES (20,27,42.0,'N','S','estable'),(21,28,41.0,'S','S','estable'),(22,27,41.0,'S','S','estable'),(23,28,38.0,'N','S','estable'),(24,42,44.0,'N','S','estable'),(25,39,38.0,'N','S','estable'),(26,47,36.0,'N','S','estable'),(27,28,41.0,'S','S','estable'),(28,28,41.0,'S','S','estable'),(29,27,44.0,'S','S','estable'),(30,27,40.0,'S','S','estable');
/*!40000 ALTER TABLE `producto_variante` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-24 21:50:39
