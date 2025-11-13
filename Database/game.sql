-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: game
-- ------------------------------------------------------
-- Server version	5.7.43-log

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
-- Table structure for table `almacenes`
--

DROP TABLE IF EXISTS `almacenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `almacenes` (
  `AlmacenId` int(11) NOT NULL AUTO_INCREMENT,
  `TiendaId` int(11) NOT NULL,
  PRIMARY KEY (`AlmacenId`),
  KEY `TiendaId` (`TiendaId`),
  CONSTRAINT `almacenes_ibfk_1` FOREIGN KEY (`TiendaId`) REFERENCES `tiendas` (`TiendaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacenes`
--

LOCK TABLES `almacenes` WRITE;
/*!40000 ALTER TABLE `almacenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `almacenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `copiasvideojuegos`
--

DROP TABLE IF EXISTS `copiasvideojuegos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `copiasvideojuegos` (
  `CopiaVideojuegoId` int(11) NOT NULL AUTO_INCREMENT,
  `PrecioNuevo` decimal(8,2) DEFAULT NULL,
  `PrecioSeminuevo` decimal(8,2) DEFAULT NULL,
  `PrecioCompraGame` decimal(8,2) DEFAULT NULL,
  `Unidades` int(11) DEFAULT '0',
  `VideojuegoId` int(11) NOT NULL,
  `AlmacenId` int(11) NOT NULL,
  PRIMARY KEY (`CopiaVideojuegoId`),
  KEY `VideojuegoId` (`VideojuegoId`),
  KEY `AlmacenId` (`AlmacenId`),
  CONSTRAINT `copiasvideojuegos_ibfk_1` FOREIGN KEY (`VideojuegoId`) REFERENCES `videojuegos` (`VideojuegoId`),
  CONSTRAINT `copiasvideojuegos_ibfk_2` FOREIGN KEY (`AlmacenId`) REFERENCES `almacenes` (`AlmacenId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copiasvideojuegos`
--

LOCK TABLES `copiasvideojuegos` WRITE;
/*!40000 ALTER TABLE `copiasvideojuegos` DISABLE KEYS */;
/*!40000 ALTER TABLE `copiasvideojuegos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modificaciones`
--

DROP TABLE IF EXISTS `modificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modificaciones` (
  `ModificacionId` int(11) NOT NULL AUTO_INCREMENT,
  `TipoMovimiento` varchar(50) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TrabajadorId` int(11) NOT NULL,
  `CopiaVideojuegoId` int(11) DEFAULT NULL,
  `VideojuegoId` int(11) DEFAULT NULL,
  PRIMARY KEY (`ModificacionId`),
  KEY `modificaciones_ibfk_1` (`TrabajadorId`),
  KEY `modificaciones_ibfk_2` (`CopiaVideojuegoId`),
  CONSTRAINT `modificaciones_ibfk_1` FOREIGN KEY (`TrabajadorId`) REFERENCES `trabajadores` (`TrabajadorId`),
  CONSTRAINT `modificaciones_ibfk_2` FOREIGN KEY (`CopiaVideojuegoId`) REFERENCES `copiasvideojuegos` (`CopiaVideojuegoId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modificaciones`
--

LOCK TABLES `modificaciones` WRITE;
/*!40000 ALTER TABLE `modificaciones` DISABLE KEYS */;
INSERT INTO `modificaciones` VALUES (1,'Insertar','2025-11-12 22:57:45',2,NULL,5),(2,'Eliminar','2025-11-12 22:58:09',2,NULL,5);
/*!40000 ALTER TABLE `modificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiendas`
--

DROP TABLE IF EXISTS `tiendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiendas` (
  `TiendaId` int(11) NOT NULL AUTO_INCREMENT,
  `Direccion` varchar(100) NOT NULL,
  `Pais` enum('España','Portugal') NOT NULL DEFAULT 'España',
  PRIMARY KEY (`TiendaId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiendas`
--

LOCK TABLES `tiendas` WRITE;
/*!40000 ALTER TABLE `tiendas` DISABLE KEYS */;
INSERT INTO `tiendas` VALUES (1,'Calle Falsa 123','España');
/*!40000 ALTER TABLE `tiendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabajadores`
--

DROP TABLE IF EXISTS `trabajadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trabajadores` (
  `TrabajadorId` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Dni` varchar(9) NOT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Email` varchar(75) DEFAULT NULL,
  `Usuario` varchar(40) NOT NULL,
  `Contrasena` varchar(225) NOT NULL,
  `TiendaId` int(11) NOT NULL,
  PRIMARY KEY (`TrabajadorId`),
  UNIQUE KEY `Dni` (`Dni`),
  UNIQUE KEY `Usuario` (`Usuario`),
  KEY `TiendaId` (`TiendaId`),
  CONSTRAINT `trabajadores_ibfk_1` FOREIGN KEY (`TiendaId`) REFERENCES `tiendas` (`TiendaId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajadores`
--

LOCK TABLES `trabajadores` WRITE;
/*!40000 ALTER TABLE `trabajadores` DISABLE KEYS */;
INSERT INTO `trabajadores` VALUES (2,'Admin','User','12345678A',NULL,NULL,'admin','admin',1),(3,'Christian','Bermudo MuÃ±oz','22755528H','2025-11-12','christian_220@msn.com','christian@gmail.com','$2y$10$diBOw0iB2CvawG8ptsV7x.903HTBwMynKiMMsWVrgZa5dh8mEDMAS',1);
/*!40000 ALTER TABLE `trabajadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videojuegos`
--

DROP TABLE IF EXISTS `videojuegos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `videojuegos` (
  `VideojuegoId` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo` varchar(75) NOT NULL,
  `AnioPublicacion` int(11) DEFAULT NULL,
  `EstudioDesarrollo` varchar(50) DEFAULT NULL,
  `Plataforma` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`VideojuegoId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videojuegos`
--

LOCK TABLES `videojuegos` WRITE;
/*!40000 ALTER TABLE `videojuegos` DISABLE KEYS */;
/*!40000 ALTER TABLE `videojuegos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-13  0:04:58
