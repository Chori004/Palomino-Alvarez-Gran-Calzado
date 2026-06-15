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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (27,'Zapato negro punta redonda',95000.00,'S',1,'https://i.ibb.co/sprFYGpq/8060-cn-011-d53462abe3d5805a9916802969612285-1024-1024.webp'),(28,'Zapato marrón punta redonda',95000.00,'S',1,'https://i.ibb.co/gZyD2XTx/D-810816-CBT107480294746-032026-O.webp'),(29,'Zapato negro punta cuadrada',105000.00,'S',1,'https://i.ibb.co/kgmjzX9n/zapato-cuero-hombre-500-negro-renno-1-4207fe944464b28e7817619419196418-1024-1024.webp'),(30,'Zapato marrón punta cuadrada',105000.00,'S',1,'https://i.ibb.co/Fq0bmSgc/zapato-cuero-hombre-500-chocolate-renno-4-001999177bfd1697a817619419196508-1024-1024.webp'),(31,'Zapato negro punta fina',103000.00,'S',1,'https://i.ibb.co/CFX1QCF/mariachi-negro-web-2b617c51db39e70e6b17361210628788-480-0.webp'),(32,'Zapato marrón punta fina',103000.00,'S',1,'https://i.ibb.co/MYNVN2z/31-Lff-Fj-R-a-L.jpg'),(33,'Zapato negro Chukka',125000.00,'S',1,'https://http2.mlstatic.com/D_603929-MLA108882196483_032026-C.jpg'),(34,'Zapato marrón Chukka',125000.00,'S',1,'https://i.ibb.co/QF53yx7B/images-q-tbn-ANd9-Gc-R0-Zr8-TKJBd1x-YNc-Zl2kn1j8n-CZY0-Pfzqjq-IA-s.jpg'),(35,'Botas de vestir negras',75000.00,'S',1,'https://i.ibb.co/9Hb4j2xy/81-Xj-F2tro-L-SY500.jpg'),(36,'Botas de vestir marrones',75000.00,'S',1,'https://i.ibb.co/RGtTLKsR/61-Mhzipwtp-L-SY500.jpg'),(37,'Botas chelsea negras',120000.00,'S',1,'https://i.ibb.co/FqdBbJBg/gemini-generated-image-ap0myzap0myzap0m-e60a290f2c338aa51a17718777272327-480-0.webp'),(38,'Botas chelsea marrones',120000.00,'S',1,'https://i.ibb.co/YBkBg6T1/KMKBOOT-1200-X1200-1-500x500.jpg'),(39,'Borcegos coling marrones',165000.00,'S',1,'https://i.ibb.co/20HSj3Rk/HCBO00887021-03-800x.jpg'),(40,'Borcegos coling negros',165000.00,'S',1,'https://i.ibb.co/603wmS5C/HCBO00887011-01.jpg'),(41,'Borcegos amarillos',173000.00,'S',1,'https://i.ibb.co/cSWp2XQn/HCBO00990060-A1-01-144dc03b-060c-48e6-8b9a-bd35137c4712-800x.jpg'),(42,'Borcegos marrón claro',167000.00,'S',1,'https://i.ibb.co/CpxybkdS/BORCEGO2-13211-HUMEL-1.png'),(47,'Mocasines negros',105000.00,'S',2,'https://i.ibb.co/BVpbbGmp/CC0370-CN-1.jpg'),(48,'Mocasines marrón',105000.00,'S',2,'https://i.ibb.co/bSpjkL2/shopping-q-tbn-ANd9-Gc-RXHZjpoik-GIP3um0-I4px2k3q8-AWc-dj-Mk-CI1sy-QB4r39c-Ml-Qj-Wi-J0vc1rz-QXm2-L8-Lfab.webp'),(49,'Tacones negros',75000.00,'S',2,'https://i.ibb.co/XfLNpcM7/715-PKr-B2ot-L-AC-SY575.jpg'),(50,'Tacones blancos',75000.00,'S',2,'https://i.ibb.co/JRtXn8c4/D-NQ-NP-2-X-635860-MLA109596752958-042026-F.webp'),(51,'Stilleto negros',70000.00,'S',2,'https://i.ibb.co/XZRWmncb/D-NQ-NP-2-X-961552-MLA83117173958-032025-F.webp'),(52,'Stilleto beige',77000.00,'S',2,'https://i.ibb.co/Zz8Hyh55/v3-682b5c682dfcdf1b6617791066921129-1024-1024.webp'),(53,'Stilleto marrones',82000.00,'S',2,'https://i.ibb.co/ZzYfNtqQ/D-NQ-NP-2-X-640367-MLA109960576511-042026-F.webp'),(54,'Cuñas negras',62000.00,'S',2,'https://i.ibb.co/N6zkDq4Y/D-NQ-NP-2-X-870308-MLA106858999707-022026-F.webp'),(55,'Cuñas marrones',65000.00,'S',2,'https://i.ibb.co/nMCqJTLh/9d938fd9-a0ea-41de-88c2-394911594a28.png'),(56,'Botines marron claro',85000.00,'S',2,'https://i.ibb.co/Qv6qRrbB/D-NQ-NP-2-X-665801-CBT106501730749-022026-F.webp'),(57,'Botines marron oscuro',87000.00,'S',2,'https://i.ibb.co/5hhSBZYQ/D-NQ-NP-2-X-893304-MLA111226565929-052026-F.webp'),(58,'Botas altas negras',140000.00,'S',2,'https://i.ibb.co/0pZhNmmq/D-NQ-NP-2-X-944744-MLA111397919045-052026-F.webp'),(59,'Botas altas marrones',140000.00,'S',2,'https://i.ibb.co/39HBNsKD/D-NQ-NP-2-X-765024-MLA110459034670-052026-F.webp'),(60,'Sandalias marrones',75000.00,'S',2,'https://i.ibb.co/k6QnpG3T/257daee6-25c2-44c6-831c-ed98792f7a28.png'),(61,'Zapatillas kickers blancas',25000.00,'S',3,'https://i.ibb.co/99qybpCp/4832386.jpg'),(62,'Zapatillas kickers negras',27000.00,'S',3,'https://i.ibb.co/p61WvwpZ/4832406.jpg'),(63,'Borcegos marrones',67000.00,'S',3,'https://i.ibb.co/xqzBLyHh/shopping-q-tbn-ANd9-Gc-Qp-ABTapi-N2-IB8-Lp-Wtg-Lk-Owt7-B8a-Rc-C31-t0i2-Rslt803n-JRh-Un-Smpty4ad-VOx8-EWx-g.webp'),(64,'Borcegos negros',65000.00,'S',3,'https://i.ibb.co/zHGmZSTh/shopping-q-tbn-ANd9-Gc-T3-Qv-F8209tmieua3c-MUxd-Oh1zbi-Rz2-ZQBi1h-PDKIv-CBQDl-Lo-IIA4i-DUJPNZNq-DJKy-YR.webp'),(65,'Botas de lluvia negras',25000.00,'S',3,'https://i.ibb.co/bMxfRn6G/shopping-q-tbn-ANd9-Gc-Qky-NS8wb2joscs-Vi5-W-Nj-TUC94a-Mkjdb-l-Pj-BV1zfnt-LK4vq7-DVa-YDhl7f-YUnv-Ax-OVL.webp'),(66,'Zapatos kicker negro',105000.00,'S',3,'https://i.ibb.co/v63b7yJH/10540642-800.jpg'),(67,'Zapatos kickers marrones',107000.00,'S',3,'https://i.ibb.co/8nc6MyX2/1798307-1200-1200-v-638718697829330000-width-1200-height-1200-aspect-true.jpg');
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

-- Dump completed on 2026-06-12  9:11:30
