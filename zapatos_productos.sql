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
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(45) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `activo` char(1) DEFAULT 'S',
  `id_categoria_fk` int(11) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria_fk` (`id_categoria_fk`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria_fk`) REFERENCES `modelo_zapato` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (27,'Zapato negro punta redonda',95000.00,'S',1,'https://i.ibb.co/sprFYGpq/8060-cn-011-d53462abe3d5805a9916802969612285-1024-1024.webp'),(28,'Zapato marrón punta redonda',95000.00,'S',1,'https://i.ibb.co/gZyD2XTx/D-810816-CBT107480294746-032026-O.webp'),(29,'Zapato negro punta cuadrada',105000.00,'S',1,'https://i.ibb.co/kgmjzX9n/zapato-cuero-hombre-500-negro-renno-1-4207fe944464b28e7817619419196418-1024-1024.webp'),(30,'Zapato marrón punta cuadrada',105000.00,'S',1,'https://i.ibb.co/Fq0bmSgc/zapato-cuero-hombre-500-chocolate-renno-4-001999177bfd1697a817619419196508-1024-1024.webp'),(31,'Zapato negro punta fina',103000.00,'S',1,'https://i.ibb.co/CFX1QCF/mariachi-negro-web-2b617c51db39e70e6b17361210628788-480-0.webp'),(32,'Zapato marrón punta fina',103000.00,'S',1,'https://i.ibb.co/MYNVN2z/31-Lff-Fj-R-a-L.jpg'),(33,'Zapato negro Chukka',125000.00,'S',1,'https://http2.mlstatic.com/D_603929-MLA108882196483_032026-C.jpg'),(34,'Zapato marrón Chukka',125000.00,'S',1,'https://i.ibb.co/QF53yx7B/images-q-tbn-ANd9-Gc-R0-Zr8-TKJBd1x-YNc-Zl2kn1j8n-CZY0-Pfzqjq-IA-s.jpg'),(35,'Botas de vestir negras',75000.00,'S',1,'https://i.ibb.co/9Hb4j2xy/81-Xj-F2tro-L-SY500.jpg'),(36,'Botas de vestir marrones',75000.00,'S',1,'https://i.ibb.co/RGtTLKsR/61-Mhzipwtp-L-SY500.jpg'),(37,'Botas chelsea negras',120000.00,'S',1,'https://i.ibb.co/FqdBbJBg/gemini-generated-image-ap0myzap0myzap0m-e60a290f2c338aa51a17718777272327-480-0.webp'),(38,'Botas chelsea marrones',120000.00,'S',1,'https://i.ibb.co/YBkBg6T1/KMKBOOT-1200-X1200-1-500x500.jpg'),(39,'Borcegos coling marrones',165000.00,'S',1,'https://i.ibb.co/20HSj3Rk/HCBO00887021-03-800x.jpg'),(40,'Borcegos coling negros',165000.00,'S',1,'https://i.ibb.co/603wmS5C/HCBO00887011-01.jpg'),(41,'Borcegos amarillos',173000.00,'S',1,'https://i.ibb.co/cSWp2XQn/HCBO00990060-A1-01-144dc03b-060c-48e6-8b9a-bd35137c4712-800x.jpg'),(42,'Borcegos marrón claro',167000.00,'S',1,'https://i.ibb.co/CpxybkdS/BORCEGO2-13211-HUMEL-1.png');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-05  9:15:54
