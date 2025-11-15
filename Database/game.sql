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
  `TiendaId` int(11) NOT NULL,
  PRIMARY KEY (`CopiaVideojuegoId`),
  KEY `VideojuegoId` (`VideojuegoId`),
  KEY `TiendaId` (`TiendaId`),
  CONSTRAINT `copiasvideojuegos_ibfk_1` FOREIGN KEY (`VideojuegoId`) REFERENCES `videojuegos` (`VideojuegoId`) ON DELETE CASCADE,
  CONSTRAINT `fk_copias_tienda` FOREIGN KEY (`TiendaId`) REFERENCES `tiendas` (`TiendaId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copiasvideojuegos`
--

LOCK TABLES `copiasvideojuegos` WRITE;
/*!40000 ALTER TABLE `copiasvideojuegos` DISABLE KEYS */;
INSERT INTO `copiasvideojuegos` VALUES (6,234.00,23.00,23.00,23,17,1);
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
  KEY `videojuego` (`VideojuegoId`),
  CONSTRAINT `modificaciones_ibfk_1` FOREIGN KEY (`TrabajadorId`) REFERENCES `trabajadores` (`TrabajadorId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modificaciones`
--

LOCK TABLES `modificaciones` WRITE;
/*!40000 ALTER TABLE `modificaciones` DISABLE KEYS */;
INSERT INTO `modificaciones` VALUES (1,'Eliminar Videojuego','2025-11-15 18:05:06',2,NULL,7),(2,'Eliminar Videojuego','2025-11-15 18:05:08',2,NULL,10),(3,'Insertar Videojuego','2025-11-15 18:05:38',2,NULL,12),(4,'Insertar Copia de Videojuego','2025-11-15 18:05:57',2,3,NULL),(5,'Insertar Videojuego','2025-11-15 18:14:18',2,NULL,13),(6,'Eliminar Videojuego','2025-11-15 18:14:22',2,NULL,13),(7,'Eliminar Videojuego','2025-11-15 18:17:18',2,NULL,12),(8,'Insertar Videojuego','2025-11-15 18:22:06',2,NULL,14),(9,'Insertar Copia de Videojuego','2025-11-15 18:22:16',2,4,NULL),(10,'Eliminar Copia de Videojuego','2025-11-15 18:24:19',2,4,NULL),(11,'Insertar Videojuego','2025-11-15 18:24:59',2,NULL,15),(12,'Eliminar Videojuego','2025-11-15 18:25:10',2,NULL,14),(13,'Eliminar Videojuego','2025-11-15 18:25:11',2,NULL,15),(14,'Insertar Videojuego','2025-11-15 18:25:47',2,NULL,16),(15,'Insertar Copia de Videojuego','2025-11-15 18:25:56',2,5,NULL),(16,'Eliminar Videojuego','2025-11-15 18:26:04',2,NULL,16),(17,'Insertar Videojuego','2025-11-15 18:47:06',2,NULL,17),(18,'Insertar Copia de Videojuego','2025-11-15 18:47:57',2,6,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajadores`
--

LOCK TABLES `trabajadores` WRITE;
/*!40000 ALTER TABLE `trabajadores` DISABLE KEYS */;
INSERT INTO `trabajadores` VALUES (2,'Admin','User','12345678A',NULL,NULL,'admin','admin',1),(8,'Cremu','SAD ASD','ASS','1990-05-04','cristian.bermudo90@somo.eus','adminprueba','$2y$10$EXqMrqCgohuDhZPpt48E/OeQbcs5cpx2POD6eILSXRFgJLUUi15km',1),(10,'Christian','Bermudo MuÃ±oz','22755527H','2001-12-05','christian_220@msn.com','adminprueba2','$2y$10$SlBWbytnhXneNdy202pbmemV209MsqINdSR80RVPdLwjFT.ZTfNcC',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videojuegos`
--

LOCK TABLES `videojuegos` WRITE;
/*!40000 ALTER TABLE `videojuegos` DISABLE KEYS */;
INSERT INTO `videojuegos` VALUES (17,'Titanic',1300,'ea','pc');
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

-- Dump completed on 2025-11-15 20:17:12
