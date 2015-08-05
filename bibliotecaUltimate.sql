-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: biblioteca
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acciones`
--

DROP TABLE IF EXISTS `acciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acciones` (
  `id_accion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_accion` char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'A -> alta. B -> baja. M -> modificacion',
  PRIMARY KEY (`id_accion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acciones`
--

LOCK TABLES `acciones` WRITE;
/*!40000 ALTER TABLE `acciones` DISABLE KEYS */;
INSERT INTO `acciones` VALUES (1,'A'),(2,'B'),(3,'M');
/*!40000 ALTER TABLE `acciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autores`
--

DROP TABLE IF EXISTS `autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_autor` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT INTO `autores` VALUES (8,'Coelho, Paulo',0),(9,'Heinlein, Robert A.',0),(10,'Blake Crouch',0),(11,'Tolkien J. R. R.',0),(12,'Paula Hawkins',0),(13,'Paula Hawkins',1),(14,'Antologia Romanticas',0),(15,'Cielo Latini',0),(16,'John Green',1),(17,'John Green',1),(18,'Borges',1),(19,'Borges',1),(21,'Garcia Marquez',1),(22,'Garcia MArquez',1),(23,'a',1),(24,'a',1),(25,'b',1),(26,'c',1),(27,'d',1),(28,'Emma',1),(29,'Emma',1),(30,'l',1),(31,'l',1),(32,'k',1),(33,'k',1),(34,'z',1),(35,'pala',1),(36,'david',1),(37,'una mas',1),(38,'otro',1),(39,'NUevo',1),(40,'nuevo2',1),(41,'nuevo3',1),(42,'nuevo4',1),(43,'1',1),(44,'1',1),(45,'2',1),(46,'2',1),(47,'3',1),(48,'3',1),(49,'4',1),(50,'4',1),(51,'5',1),(52,'6',1);
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracteristicas`
--

DROP TABLE IF EXISTS `caracteristicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracteristicas` (
  `id_caracteristicas` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion_caracteristica` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_caracteristicas`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracteristicas`
--

LOCK TABLES `caracteristicas` WRITE;
/*!40000 ALTER TABLE `caracteristicas` DISABLE KEYS */;
INSERT INTO `caracteristicas` VALUES (10,'Violencia',0),(11,'Lenguaje Adulto',0),(12,'c',1),(13,'caracte',1);
/*!40000 ALTER TABLE `caracteristicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clasificaciones`
--

DROP TABLE IF EXISTS `clasificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clasificaciones` (
  `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion_clasificacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_clasificacion_padre` int(11) DEFAULT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_clasificacion`),
  KEY `id_clasificacion_padre` (`id_clasificacion_padre`),
  CONSTRAINT `clasificaciones_ibfk_1` FOREIGN KEY (`id_clasificacion_padre`) REFERENCES `clasificaciones` (`id_clasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificaciones`
--

LOCK TABLES `clasificaciones` WRITE;
/*!40000 ALTER TABLE `clasificaciones` DISABLE KEYS */;
INSERT INTO `clasificaciones` VALUES (1,'Genero',NULL,0),(11,'Terror',1,0),(12,'Drama',1,0),(13,'Ciencia Ficcion',1,0),(14,'Infantil',1,0),(15,'Biografias',1,0),(16,'Fantasia',13,0);
/*!40000 ALTER TABLE `clasificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultas` (
  `id_consultas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Usuario',
  `email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `borrado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_consultas`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` VALUES (1,'DAvid','david@mail.com','Queria hacer una consulta.\r\nGRacias.','2015-07-28 00:40:41',0),(2,'DAvid','david@mail.com','otra consulta mia.\r\nGracias.','2015-07-28 01:44:47',0),(3,'Emma','ema@Ema','Soy Emma','2015-07-28 19:20:36',0);
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editoriales`
--

DROP TABLE IF EXISTS `editoriales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_editorial` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editoriales`
--

LOCK TABLES `editoriales` WRITE;
/*!40000 ALTER TABLE `editoriales` DISABLE KEYS */;
INSERT INTO `editoriales` VALUES (6,'Planeta',0),(7,'Ballantine Books',0),(8,'Thomas &amp; Mercer',0),(9,'MINOTAURO',0),(10,'Plaza & Janes',0),(11,'Nube de Tinta',0),(12,'e',1),(13,'edit',1),(14,'1',1),(15,'2',1),(16,'3',1),(17,'4',1),(18,'66',1),(19,'7',1),(20,'8',1),(21,'9',1),(22,'0',1),(23,'11',1),(24,'r',1),(25,'t',1),(26,'y',1),(27,'u',1),(28,'i',1),(29,'3',1),(30,'sd',1);
/*!40000 ALTER TABLE `editoriales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos`
--

DROP TABLE IF EXISTS `fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `rutaArchivo_foto` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `id_libro_foto` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_foto`),
  KEY `id_libro_foto` (`id_libro_foto`),
  CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`id_libro_foto`) REFERENCES `libro` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos`
--

LOCK TABLES `fotos` WRITE;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;
INSERT INTO `fotos` VALUES (9,'recursos/imagenes/libros/1437279250.png',9,0),(10,'recursos/imagenes/libros/1437280158.png',10,0),(11,'recursos/imagenes/libros/1437280381.png',11,0),(12,'recursos/imagenes/libros/1438034618.png',12,0),(13,'recursos/imagenes/libros/1438035436.png',13,0),(14,'recursos/imagenes/libros/1438052811.png',14,0),(15,'recursos/imagenes/libros/1438052896.png',15,0),(16,'recursos/imagenes/libros/1438052999.png',16,0),(17,'recursos/imagenes/libros/1438053241.png',17,0);
/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idioma`
--

DROP TABLE IF EXISTS `idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idioma` (
  `id_idioma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_idioma`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idioma`
--

LOCK TABLES `idioma` WRITE;
/*!40000 ALTER TABLE `idioma` DISABLE KEYS */;
INSERT INTO `idioma` VALUES (1,'Castellano'),(2,'Ingles'),(3,'Frances');
/*!40000 ALTER TABLE `idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_libro` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ISBN_libro` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `paginas_libro` int(4) NOT NULL,
  `idioma_libro` int(11) NOT NULL,
  `publicacion_libro` int(4) NOT NULL,
  `disponibilidad_libro` tinyint(1) NOT NULL,
  `destacado_libro` tinyint(1) NOT NULL,
  `id_autor_libro` int(11) NOT NULL,
  `id_editorial_libro` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_libro`),
  KEY `id_autor_libro` (`id_autor_libro`),
  KEY `id_editorial_libro` (`id_editorial_libro`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_autor_libro`) REFERENCES `autores` (`id_autor`),
  CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`id_editorial_libro`) REFERENCES `editoriales` (`id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (9,'El Alquimista','9788408033431',354,1,2001,1,1,8,6,0),(10,'Between planets','9780345260703',288,1,2009,1,1,9,7,0),(11,'Pines','9781612183954',320,2,2014,1,1,10,8,0),(12,'La Comunidad del Anillo - SeÃ±or de los Anillos I','9789505471140',514,2,2003,1,1,11,9,0),(13,'Las Dos Torres - SeÃ±or de los Anillos II','9789505471157',522,2,2004,1,1,11,9,0),(14,'La Chica del Tren','9789504946403',496,1,2015,1,1,12,6,0),(15,'Ay, Amor','9789506443436',368,3,2015,1,1,14,10,0),(16,'Abzurdah','9789504915317',296,2,2015,1,1,15,6,0),(17,'Ciudades de Papel','9789871997039',368,1,2015,1,1,16,11,0);
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro_caracteristica`
--

DROP TABLE IF EXISTS `libro_caracteristica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro_caracteristica` (
  `fk_caracteristica` int(11) NOT NULL,
  `fk_libro` int(11) NOT NULL,
  PRIMARY KEY (`fk_caracteristica`,`fk_libro`),
  KEY `fk_libro` (`fk_libro`),
  CONSTRAINT `libro_caracteristica_ibfk_1` FOREIGN KEY (`fk_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `libro_caracteristica_ibfk_2` FOREIGN KEY (`fk_caracteristica`) REFERENCES `caracteristicas` (`id_caracteristicas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro_caracteristica`
--

LOCK TABLES `libro_caracteristica` WRITE;
/*!40000 ALTER TABLE `libro_caracteristica` DISABLE KEYS */;
INSERT INTO `libro_caracteristica` VALUES (11,9),(10,10),(10,11),(11,11),(10,12),(10,13),(11,14),(11,15),(11,16),(10,17);
/*!40000 ALTER TABLE `libro_caracteristica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro_clasificacion`
--

DROP TABLE IF EXISTS `libro_clasificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro_clasificacion` (
  `fk_clasificacion` int(11) NOT NULL,
  `fk_libro` int(11) NOT NULL,
  PRIMARY KEY (`fk_clasificacion`,`fk_libro`),
  KEY `fk_libro` (`fk_libro`),
  CONSTRAINT `libro_clasificacion_ibfk_1` FOREIGN KEY (`fk_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `libro_clasificacion_ibfk_2` FOREIGN KEY (`fk_clasificacion`) REFERENCES `clasificaciones` (`id_clasificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro_clasificacion`
--

LOCK TABLES `libro_clasificacion` WRITE;
/*!40000 ALTER TABLE `libro_clasificacion` DISABLE KEYS */;
INSERT INTO `libro_clasificacion` VALUES (12,9),(13,10),(11,11),(13,12),(16,12),(13,13),(16,13),(12,14),(12,15),(15,16),(11,17);
/*!40000 ALTER TABLE `libro_clasificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listamail`
--

DROP TABLE IF EXISTS `listamail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listamail` (
  `id_mail` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Usuario',
  `email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_mail`),
  UNIQUE KEY `EMAIL` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listamail`
--

LOCK TABLES `listamail` WRITE;
/*!40000 ALTER TABLE `listamail` DISABLE KEYS */;
/*!40000 ALTER TABLE `listamail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_autores`
--

DROP TABLE IF EXISTS `log_autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_autores` (
  `id_log_autor` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_log_autor` date NOT NULL,
  `hora_log_autor` time NOT NULL,
  `id_accion_log_autor` int(11) NOT NULL,
  `id_autor_log_autor` int(11) NOT NULL,
  `id_usuario_log_autor` int(11) NOT NULL,
  PRIMARY KEY (`id_log_autor`),
  KEY `id_autor_log_autor` (`id_autor_log_autor`),
  KEY `id_usuario_log_autor` (`id_usuario_log_autor`),
  KEY `id_accion_log_autor` (`id_accion_log_autor`),
  CONSTRAINT `log_autores_ibfk_1` FOREIGN KEY (`id_autor_log_autor`) REFERENCES `autores` (`id_autor`),
  CONSTRAINT `log_autores_ibfk_2` FOREIGN KEY (`id_usuario_log_autor`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `log_autores_ibfk_3` FOREIGN KEY (`id_accion_log_autor`) REFERENCES `acciones` (`id_accion`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_autores`
--

LOCK TABLES `log_autores` WRITE;
/*!40000 ALTER TABLE `log_autores` DISABLE KEYS */;
INSERT INTO `log_autores` VALUES (8,'2015-07-19','01:10:56',1,8,1),(9,'2015-07-19','01:28:14',1,9,1),(10,'2015-07-19','01:31:38',1,10,1),(11,'2015-07-19','23:39:56',1,11,1),(12,'2015-07-28','00:03:02',1,12,1),(13,'2015-07-28','00:03:02',1,13,1),(14,'2015-07-28','00:03:28',2,13,1),(15,'2015-07-28','00:04:09',1,14,1),(16,'2015-07-28','00:09:21',1,15,1),(17,'2015-07-28','00:11:45',1,16,1),(18,'2015-07-28','00:11:45',1,17,1),(19,'2015-07-28','00:12:29',2,17,1),(20,'2015-07-28','12:48:15',1,18,1),(21,'2015-07-28','12:48:15',1,19,1),(22,'2015-07-28','12:54:45',1,21,1),(23,'2015-07-28','12:58:15',1,22,1),(24,'2015-07-28','13:03:04',1,23,1),(25,'2015-07-28','13:07:14',1,24,1),(26,'2015-07-28','14:56:15',1,25,1),(27,'2015-07-28','14:56:25',1,26,1),(28,'2015-07-28','14:56:30',2,24,1),(29,'2015-07-28','14:56:33',2,22,1),(30,'2015-07-28','14:56:43',1,27,1),(31,'2015-07-28','14:57:38',1,28,1),(32,'2015-07-28','14:57:38',1,29,1),(33,'2015-07-28','14:57:52',1,30,1),(34,'2015-07-28','14:57:52',1,31,1),(35,'2015-07-28','14:58:28',1,32,1),(36,'2015-07-28','14:58:29',1,33,1),(37,'2015-07-28','15:01:19',2,33,1),(38,'2015-07-28','15:03:36',1,34,1),(39,'2015-07-28','15:03:47',1,35,1),(40,'2015-07-28','15:04:20',1,36,1),(41,'2015-07-28','15:04:32',2,28,1),(42,'2015-07-28','15:04:34',2,29,1),(43,'2015-07-28','15:04:45',2,36,1),(44,'2015-07-28','15:05:14',1,37,1),(45,'2015-07-28','15:05:23',2,37,1),(46,'2015-07-28','15:07:15',2,35,1),(47,'2015-07-28','15:08:28',2,19,1),(48,'2015-07-28','15:08:44',2,23,1),(49,'2015-07-28','15:09:02',2,34,1),(50,'2015-07-28','15:09:04',2,31,1),(51,'2015-07-28','15:09:06',2,32,1),(52,'2015-07-28','15:09:08',2,30,1),(53,'2015-07-28','15:09:16',2,25,1),(54,'2015-07-28','15:09:18',2,26,1),(55,'2015-07-28','15:09:20',2,27,1),(56,'2015-07-28','15:09:27',2,21,1),(57,'2015-07-28','15:09:35',1,38,1),(58,'2015-07-28','15:09:43',2,38,1),(59,'2015-07-28','15:09:49',2,18,1),(60,'2015-07-28','15:09:52',2,21,1),(61,'2015-07-28','15:11:32',2,16,1),(62,'2015-07-28','15:11:48',1,39,1),(63,'2015-07-28','15:11:53',2,39,1),(64,'2015-07-28','15:12:15',1,40,1),(65,'2015-07-28','15:12:22',2,40,1),(66,'2015-07-28','15:12:34',1,41,1),(67,'2015-07-28','15:12:38',1,42,1),(68,'2015-07-28','15:12:45',2,42,1),(69,'2015-07-28','15:12:55',2,41,1),(70,'2015-07-28','15:13:26',1,43,1),(71,'2015-07-28','15:13:26',1,44,1),(72,'2015-07-28','15:13:29',1,45,1),(73,'2015-07-28','15:13:29',1,46,1),(74,'2015-07-28','15:13:33',1,47,1),(75,'2015-07-28','15:13:33',1,48,1),(76,'2015-07-28','15:13:39',1,49,1),(77,'2015-07-28','15:13:39',1,50,1),(78,'2015-07-28','15:14:40',1,51,1),(79,'2015-07-28','15:14:51',1,52,1),(80,'2015-07-28','15:14:58',2,51,1),(81,'2015-07-28','15:15:07',2,43,1),(82,'2015-07-28','15:15:09',2,44,1),(83,'2015-07-28','15:15:11',2,44,1),(84,'2015-07-28','15:15:15',2,44,1),(85,'2015-07-28','15:15:24',2,45,1),(86,'2015-07-28','15:15:27',2,46,1),(87,'2015-07-28','15:15:30',2,46,1),(88,'2015-07-28','15:15:48',2,47,1),(89,'2015-07-28','15:15:50',2,48,1),(90,'2015-07-28','15:15:52',2,48,1),(91,'2015-07-28','15:16:01',2,49,1),(92,'2015-07-28','15:16:03',2,50,1),(93,'2015-07-28','15:16:05',2,50,1),(94,'2015-07-28','15:16:18',2,52,1);
/*!40000 ALTER TABLE `log_autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_caracteristicas`
--

DROP TABLE IF EXISTS `log_caracteristicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_caracteristicas` (
  `id_log_caracteristica` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_log_caracteristica` date NOT NULL,
  `hora_log_caracteristica` time NOT NULL,
  `caracteristica_nombre_anterior_log_caracteristica` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `caracteristica_nombre_nuevo_log_caracteristica` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_accion_log_caracteristica` int(11) NOT NULL,
  `id_caracteristica_log_caracteristica` int(11) NOT NULL,
  `id_usuario_log_caracteristica` int(11) NOT NULL,
  PRIMARY KEY (`id_log_caracteristica`),
  KEY `id_accion_log_caracteristica` (`id_accion_log_caracteristica`),
  KEY `id_caracteristica_log_caracteristica` (`id_caracteristica_log_caracteristica`),
  KEY `id_usuario_log_caracteristica` (`id_usuario_log_caracteristica`),
  CONSTRAINT `log_caracteristicas_ibfk_1` FOREIGN KEY (`id_accion_log_caracteristica`) REFERENCES `acciones` (`id_accion`),
  CONSTRAINT `log_caracteristicas_ibfk_2` FOREIGN KEY (`id_caracteristica_log_caracteristica`) REFERENCES `caracteristicas` (`id_caracteristicas`),
  CONSTRAINT `log_caracteristicas_ibfk_3` FOREIGN KEY (`id_usuario_log_caracteristica`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_caracteristicas`
--

LOCK TABLES `log_caracteristicas` WRITE;
/*!40000 ALTER TABLE `log_caracteristicas` DISABLE KEYS */;
INSERT INTO `log_caracteristicas` VALUES (12,'2015-07-19','00:54:38','-','Violencia',1,10,1),(13,'2015-07-19','00:54:48','-','Lenguaje Adulto',1,11,1),(14,'2015-07-28','14:59:14','-','c',1,12,1),(15,'2015-07-28','14:59:34','-','caracte',1,13,1),(16,'2015-07-28','16:28:41','c','-',2,12,1),(17,'2015-07-28','16:28:44','caracte','-',2,13,1);
/*!40000 ALTER TABLE `log_caracteristicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_clasificaciones`
--

DROP TABLE IF EXISTS `log_clasificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_clasificaciones` (
  `id_log_clasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_log_clasificacion` date NOT NULL,
  `hora_log_clasificacion` time NOT NULL,
  `id_accion_log_clasificacion` int(11) NOT NULL,
  `id_usuario_log_clasificacion` int(11) NOT NULL,
  `id_clasificacion_log_clasificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_log_clasificacion`),
  KEY `id_accion_log_clasificacion` (`id_accion_log_clasificacion`),
  KEY `id_usuario_log_clasificacion` (`id_usuario_log_clasificacion`),
  KEY `id_clasificacion_log_clasificacion` (`id_clasificacion_log_clasificacion`),
  CONSTRAINT `log_clasificaciones_ibfk_1` FOREIGN KEY (`id_accion_log_clasificacion`) REFERENCES `acciones` (`id_accion`),
  CONSTRAINT `log_clasificaciones_ibfk_2` FOREIGN KEY (`id_usuario_log_clasificacion`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `log_clasificaciones_ibfk_3` FOREIGN KEY (`id_clasificacion_log_clasificacion`) REFERENCES `clasificaciones` (`id_clasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_clasificaciones`
--

LOCK TABLES `log_clasificaciones` WRITE;
/*!40000 ALTER TABLE `log_clasificaciones` DISABLE KEYS */;
INSERT INTO `log_clasificaciones` VALUES (1,'2015-06-22','00:33:21',1,1,1),(11,'2015-07-19','00:53:07',1,1,11),(12,'2015-07-19','00:53:27',1,1,12),(13,'2015-07-19','00:53:39',1,1,13),(14,'2015-07-19','23:11:14',1,1,14),(15,'2015-07-19','23:11:52',1,1,15),(16,'2015-07-19','23:12:48',1,1,16);
/*!40000 ALTER TABLE `log_clasificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_editoriales`
--

DROP TABLE IF EXISTS `log_editoriales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_editoriales` (
  `id_log_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_log_editorial` date NOT NULL,
  `hora_log_editorial` time NOT NULL,
  `editorial_nombre_anterior_log_editorial` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `editorial_nombre_nuevo_log_editorial` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_accion_log_editorial` int(11) NOT NULL,
  `id_editorial_log_editorial` int(11) NOT NULL,
  `id_usuario_log_editorial` int(11) NOT NULL,
  PRIMARY KEY (`id_log_editorial`),
  KEY `id_editorial_log_editorial` (`id_editorial_log_editorial`),
  KEY `id_usuario_log_editorial` (`id_usuario_log_editorial`),
  KEY `id_accion_log_editorial` (`id_accion_log_editorial`),
  CONSTRAINT `log_editoriales_ibfk_1` FOREIGN KEY (`id_editorial_log_editorial`) REFERENCES `editoriales` (`id_editorial`),
  CONSTRAINT `log_editoriales_ibfk_2` FOREIGN KEY (`id_usuario_log_editorial`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `log_editoriales_ibfk_3` FOREIGN KEY (`id_accion_log_editorial`) REFERENCES `acciones` (`id_accion`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_editoriales`
--

LOCK TABLES `log_editoriales` WRITE;
/*!40000 ALTER TABLE `log_editoriales` DISABLE KEYS */;
INSERT INTO `log_editoriales` VALUES (6,'2015-07-19','01:11:02','-','Planeta',1,6,1),(7,'2015-07-19','01:28:16','-','Ballantine Books',1,7,1),(8,'2015-07-19','01:31:41','-','Thomas &amp; Mercer',1,8,1),(9,'2015-07-19','23:40:03','-','MINOTAURO',1,9,1),(10,'2015-07-28','00:04:39','-','Plaza & Janes',1,10,1),(11,'2015-07-28','00:12:53','-','Nube de Tinta',1,11,1),(12,'2015-07-28','14:58:56','-','e',1,12,1),(13,'2015-07-28','14:59:04','-','edit',1,13,1),(14,'2015-07-28','15:06:06','e','-',2,12,1),(15,'2015-07-28','15:16:31','-','1',1,14,1),(16,'2015-07-28','15:16:34','-','2',1,15,1),(17,'2015-07-28','15:16:37','-','3',1,16,1),(18,'2015-07-28','15:16:41','-','4',1,17,1),(19,'2015-07-28','15:16:56','2','-',2,15,1),(20,'2015-07-28','15:16:58','3','-',2,16,1),(21,'2015-07-28','15:17:04','1','-',2,14,1),(22,'2015-07-28','15:17:19','4','-',2,17,1),(23,'2015-07-28','15:17:31','-','66',1,18,1),(24,'2015-07-28','15:17:34','-','7',1,19,1),(25,'2015-07-28','15:17:37','-','8',1,20,1),(26,'2015-07-28','15:17:40','-','9',1,21,1),(27,'2015-07-28','15:17:43','-','0',1,22,1),(28,'2015-07-28','15:17:46','-','11',1,23,1),(29,'2015-07-28','15:17:57','0','-',2,22,1),(30,'2015-07-28','15:18:03','66','-',2,18,1),(31,'2015-07-28','15:18:21','7','-',2,19,1),(32,'2015-07-28','15:18:23','edit','-',2,13,1),(33,'2015-07-28','15:18:35','7','-',2,19,1),(34,'2015-07-28','15:18:48','8','-',2,20,1),(35,'2015-07-28','15:18:51','9','-',2,21,1),(36,'2015-07-28','15:18:53','9','-',2,21,1),(37,'2015-07-28','15:18:57','11','-',2,23,1),(38,'2015-07-28','15:19:20','-','r',1,24,1),(39,'2015-07-28','15:19:22','-','t',1,25,1),(40,'2015-07-28','15:19:24','-','y',1,26,1),(41,'2015-07-28','15:19:28','-','u',1,27,1),(42,'2015-07-28','15:19:31','-','i',1,28,1),(43,'2015-07-28','15:19:42','-','3',1,29,1),(44,'2015-07-28','15:19:45','-','sd',1,30,1),(45,'2015-07-28','16:27:43','r','-',2,24,1),(46,'2015-07-28','16:27:46','y','-',2,26,1),(47,'2015-07-28','16:27:49','t','-',2,25,1),(48,'2015-07-28','16:27:53','t','-',2,25,1),(49,'2015-07-28','16:28:10','u','-',2,27,1),(50,'2015-07-28','16:28:13','i','-',2,28,1),(51,'2015-07-28','16:28:15','i','-',2,28,1),(52,'2015-07-28','16:28:18','i','-',2,28,1),(53,'2015-07-28','16:28:33','3','-',2,29,1),(54,'2015-07-28','16:28:35','sd','-',2,30,1);
/*!40000 ALTER TABLE `log_editoriales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_libros`
--

DROP TABLE IF EXISTS `log_libros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_libros` (
  `id_log_libro` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_log_libro` date NOT NULL,
  `hora_log_libro` time NOT NULL,
  `id_accion_log_libro` int(11) NOT NULL,
  `id_libro_log_libro` int(11) NOT NULL,
  `id_usuario_log_libro` int(11) NOT NULL,
  PRIMARY KEY (`id_log_libro`),
  KEY `id_accion_log_libro` (`id_accion_log_libro`),
  KEY `id_libro_log_libro` (`id_libro_log_libro`),
  KEY `id_usuario_log_libro` (`id_usuario_log_libro`),
  CONSTRAINT `log_libros_ibfk_1` FOREIGN KEY (`id_accion_log_libro`) REFERENCES `acciones` (`id_accion`),
  CONSTRAINT `log_libros_ibfk_2` FOREIGN KEY (`id_libro_log_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `log_libros_ibfk_3` FOREIGN KEY (`id_usuario_log_libro`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_libros`
--

LOCK TABLES `log_libros` WRITE;
/*!40000 ALTER TABLE `log_libros` DISABLE KEYS */;
INSERT INTO `log_libros` VALUES (14,'2015-07-19','01:14:10',1,9,1),(15,'2015-07-19','01:29:18',1,10,1),(16,'2015-07-19','01:33:01',1,11,1),(17,'2015-07-19','23:43:53',1,12,1),(18,'2015-07-19','23:45:34',1,13,1),(19,'2015-07-27','19:03:39',3,12,1),(20,'2015-07-27','19:17:16',3,13,1),(21,'2015-07-28','00:06:51',1,14,1),(22,'2015-07-28','00:08:17',1,15,1),(23,'2015-07-28','00:09:59',1,16,1),(24,'2015-07-28','00:14:01',1,17,1);
/*!40000 ALTER TABLE `log_libros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nivel_acceso` int(2) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_usuario`
--

LOCK TABLES `tipos_usuario` WRITE;
/*!40000 ALTER TABLE `tipos_usuario` DISABLE KEYS */;
INSERT INTO `tipos_usuario` VALUES (1,'administrador',50),(2,'super-administrador',99);
/*!40000 ALTER TABLE `tipos_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `clave_usuario` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta_usuario` date NOT NULL,
  `fecha_baja_usuario` date DEFAULT NULL,
  `id_tipo_tipo_usuario` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  KEY `id_tipo_tipo_usuario` (`id_tipo_tipo_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'25d55ad283aa400af464c76d713c07ad','David','2015-06-14',NULL,2,0),(2,'25d55ad283aa400af464c76d713c07ad','Admin','2015-06-21',NULL,1,0),(3,'25d55ad283aa400af464c76d713c07ad','Emma','2015-06-21','2015-06-21',1,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-04 23:53:45
