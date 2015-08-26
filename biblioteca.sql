/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.17 : Database - biblioteca
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`biblioteca` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `biblioteca`;

/*Table structure for table `acciones` */

DROP TABLE IF EXISTS `acciones`;

CREATE TABLE `acciones` (
  `id_accion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_accion` char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'A -> alta. B -> baja. M -> modificacion',
  PRIMARY KEY (`id_accion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `acciones` */

insert  into `acciones`(`id_accion`,`nombre_accion`) values (1,'A'),(2,'B'),(3,'M');

/*Table structure for table `autores` */

DROP TABLE IF EXISTS `autores`;

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_autor` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `autores` */

insert  into `autores`(`id_autor`,`nombre_autor`,`borrado`) values (8,'Coelho, Paulo',1),(9,'Heinlein, Robert A.',0),(10,'Blake Crouch',0),(11,'Tolkien J. R. R.',0),(12,'Paula Hawkins',0),(13,'Paula Hawkins',1),(14,'Antologia Romanticas',0),(15,'Cielo Latini',0),(16,'John Green',1),(17,'John Green',1),(18,'Borges',1),(19,'Borges',1),(21,'Garcia Marquez',1),(22,'Garcia MArquez',1),(23,'a',1),(24,'a',1),(25,'b',1),(26,'c',1),(27,'d',1),(28,'Emma',1),(29,'Emma',1),(30,'l',1),(31,'l',1),(32,'k',1),(33,'k',1),(34,'z',1),(35,'pala',1),(36,'david',1),(37,'una mas',1),(38,'otro',1),(39,'NUevo',1),(40,'nuevo2',1),(41,'nuevo3',1),(42,'nuevo4',1),(43,'1',1),(44,'1',1),(45,'2',1),(46,'2',1),(47,'3',1),(48,'3',1),(49,'4',1),(50,'4',1),(51,'5',1),(52,'6',1),(53,'Sin Autor',0),(54,'h',1),(55,'h',1),(56,'l',1),(57,'qwe',0),(58,'qwe1',1),(59,'qwe2',0),(60,'qwe3s',1),(61,'qwe4',0),(62,'qwe55',1);

/*Table structure for table `caracteristicas` */

DROP TABLE IF EXISTS `caracteristicas`;

CREATE TABLE `caracteristicas` (
  `id_caracteristicas` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion_caracteristica` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_caracteristicas`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `caracteristicas` */

insert  into `caracteristicas`(`id_caracteristicas`,`denominacion_caracteristica`,`borrado`) values (10,'Violencia',0),(11,'Lenguaje Adulto',0),(12,'c',1),(13,'caracte',1),(14,'eee3',1),(15,'eeee',1);

/*Table structure for table `clasificaciones` */

DROP TABLE IF EXISTS `clasificaciones`;

CREATE TABLE `clasificaciones` (
  `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion_clasificacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_clasificacion_padre` int(11) DEFAULT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_clasificacion`),
  KEY `id_clasificacion_padre` (`id_clasificacion_padre`),
  CONSTRAINT `clasificaciones_ibfk_1` FOREIGN KEY (`id_clasificacion_padre`) REFERENCES `clasificaciones` (`id_clasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `clasificaciones` */

insert  into `clasificaciones`(`id_clasificacion`,`denominacion_clasificacion`,`id_clasificacion_padre`,`borrado`) values (1,'Genero',NULL,0),(11,'Terror',1,0),(12,'Drama',1,0),(13,'Ciencia Ficcion',1,0),(14,'Infantil',1,0),(15,'Biografias',1,0),(16,'Fantasia',13,0);

/*Table structure for table `consultas` */

DROP TABLE IF EXISTS `consultas`;

CREATE TABLE `consultas` (
  `id_consultas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Usuario',
  `email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `borrado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_consultas`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `consultas` */

insert  into `consultas`(`id_consultas`,`nombre`,`email`,`mensaje`,`fecha`,`borrado`) values (1,'DAvid','david@mail.com','Queria hacer una consulta.\r\nGRacias.','2015-07-27 21:40:41',0),(2,'DAvid','david@mail.com','otra consulta mia.\r\nGracias.','2015-07-27 22:44:47',0),(3,'Emma','ema@Ema','Soy Emma','2015-07-28 16:20:36',1),(4,'leo','leo@dfg','xfgxdgd','2015-08-12 17:40:11',1);

/*Table structure for table `editoriales` */

DROP TABLE IF EXISTS `editoriales`;

CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_editorial` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `editoriales` */

insert  into `editoriales`(`id_editorial`,`nombre_editorial`,`borrado`) values (6,'Planeta',0),(7,'Ballantine Books',0),(8,'Thomas &amp; Mercer',0),(9,'MINOTAURO',0),(10,'Plaza & Janes',0),(11,'Nube de Tinta',0),(12,'eee',1),(13,'edit',1),(14,'1',1),(15,'2',1),(16,'3',1),(17,'4',1),(18,'66',1),(19,'7',1),(20,'8',1),(21,'9',1),(22,'0',1),(23,'11',1),(24,'r',1),(25,'t',1),(26,'y',1),(27,'u',1),(28,'i',1),(29,'3',1),(30,'sd',1),(31,'Salamandra',0),(32,'ggg3',1);

/*Table structure for table `fotos` */

DROP TABLE IF EXISTS `fotos`;

CREATE TABLE `fotos` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `rutaArchivo_foto` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `id_libro_foto` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_foto`),
  KEY `id_libro_foto` (`id_libro_foto`),
  CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`id_libro_foto`) REFERENCES `libro` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `fotos` */

insert  into `fotos`(`id_foto`,`rutaArchivo_foto`,`id_libro_foto`,`borrado`) values (9,'recursos/imagenes/libros/1437279250.png',9,0),(10,'recursos/imagenes/libros/1437280158.png',10,0),(11,'recursos/imagenes/libros/1437280381.png',11,0),(12,'recursos/imagenes/libros/1438034618.png',12,0),(13,'recursos/imagenes/libros/1438035436.png',13,0),(14,'recursos/imagenes/libros/1438052811.png',14,0),(15,'recursos/imagenes/libros/1438052896.png',15,0),(16,'recursos/imagenes/libros/1438052999.png',16,0),(17,'recursos/imagenes/libros/1438053241.png',17,0);

/*Table structure for table `idioma` */

DROP TABLE IF EXISTS `idioma`;

CREATE TABLE `idioma` (
  `id_idioma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_idioma`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `idioma` */

insert  into `idioma`(`id_idioma`,`nombre`) values (1,'Castellano'),(2,'Ingles'),(3,'Frances');

/*Table structure for table `libro` */

DROP TABLE IF EXISTS `libro`;

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

/*Data for the table `libro` */

insert  into `libro`(`id_libro`,`titulo_libro`,`ISBN_libro`,`paginas_libro`,`idioma_libro`,`publicacion_libro`,`disponibilidad_libro`,`destacado_libro`,`id_autor_libro`,`id_editorial_libro`,`borrado`) values (9,'El Alquimista','9788408033431',354,1,2001,1,1,8,6,0),(10,'Between planets','9780345260703',288,1,2009,1,1,9,7,0),(11,'Pines','9781612183954',320,2,2014,1,1,10,8,0),(12,'La Comunidad del Anillo - SeÃ±or de los Anillos I','9789505471140',514,2,2003,1,1,11,9,0),(13,'Las Dos Torres - SeÃ±or de los Anillos II','9789505471157',522,2,2004,1,1,11,9,0),(14,'La Chica del Tren','9789504946403',496,1,2015,1,1,12,6,0),(15,'Ay, Amor','9789506443436',368,3,2015,1,1,14,10,0),(16,'Abzurdah','9789504915317',296,2,2015,1,1,15,6,0),(17,'Ciudades de Papel','9789871997039',368,1,2015,1,1,16,11,0);

/*Table structure for table `libro_caracteristica` */

DROP TABLE IF EXISTS `libro_caracteristica`;

CREATE TABLE `libro_caracteristica` (
  `fk_caracteristica` int(11) NOT NULL,
  `fk_libro` int(11) NOT NULL,
  PRIMARY KEY (`fk_caracteristica`,`fk_libro`),
  KEY `fk_libro` (`fk_libro`),
  CONSTRAINT `libro_caracteristica_ibfk_1` FOREIGN KEY (`fk_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `libro_caracteristica_ibfk_2` FOREIGN KEY (`fk_caracteristica`) REFERENCES `caracteristicas` (`id_caracteristicas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `libro_caracteristica` */

insert  into `libro_caracteristica`(`fk_caracteristica`,`fk_libro`) values (11,9),(10,10),(10,11),(11,11),(10,12),(10,13),(11,14),(11,15),(11,16),(10,17);

/*Table structure for table `libro_clasificacion` */

DROP TABLE IF EXISTS `libro_clasificacion`;

CREATE TABLE `libro_clasificacion` (
  `fk_clasificacion` int(11) NOT NULL,
  `fk_libro` int(11) NOT NULL,
  PRIMARY KEY (`fk_clasificacion`,`fk_libro`),
  KEY `fk_libro` (`fk_libro`),
  CONSTRAINT `libro_clasificacion_ibfk_1` FOREIGN KEY (`fk_libro`) REFERENCES `libro` (`id_libro`),
  CONSTRAINT `libro_clasificacion_ibfk_2` FOREIGN KEY (`fk_clasificacion`) REFERENCES `clasificaciones` (`id_clasificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `libro_clasificacion` */

insert  into `libro_clasificacion`(`fk_clasificacion`,`fk_libro`) values (12,9),(13,10),(11,11),(13,12),(16,12),(13,13),(16,13),(12,14),(12,15),(15,16),(11,17);

/*Table structure for table `listamail` */

DROP TABLE IF EXISTS `listamail`;

CREATE TABLE `listamail` (
  `id_mail` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Usuario',
  `email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_mail`),
  UNIQUE KEY `EMAIL` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `listamail` */

/*Table structure for table `log_autores` */

DROP TABLE IF EXISTS `log_autores`;

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
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `log_autores` */

insert  into `log_autores`(`id_log_autor`,`fecha_log_autor`,`hora_log_autor`,`id_accion_log_autor`,`id_autor_log_autor`,`id_usuario_log_autor`) values (8,'2015-07-19','01:10:56',1,8,1),(9,'2015-07-19','01:28:14',1,9,1),(10,'2015-07-19','01:31:38',1,10,1),(11,'2015-07-19','23:39:56',1,11,1),(12,'2015-07-28','00:03:02',1,12,1),(13,'2015-07-28','00:03:02',1,13,1),(14,'2015-07-28','00:03:28',2,13,1),(15,'2015-07-28','00:04:09',1,14,1),(16,'2015-07-28','00:09:21',1,15,1),(17,'2015-07-28','00:11:45',1,16,1),(18,'2015-07-28','00:11:45',1,17,1),(19,'2015-07-28','00:12:29',2,17,1),(20,'2015-07-28','12:48:15',1,18,1),(21,'2015-07-28','12:48:15',1,19,1),(22,'2015-07-28','12:54:45',1,21,1),(23,'2015-07-28','12:58:15',1,22,1),(24,'2015-07-28','13:03:04',1,23,1),(25,'2015-07-28','13:07:14',1,24,1),(26,'2015-07-28','14:56:15',1,25,1),(27,'2015-07-28','14:56:25',1,26,1),(28,'2015-07-28','14:56:30',2,24,1),(29,'2015-07-28','14:56:33',2,22,1),(30,'2015-07-28','14:56:43',1,27,1),(31,'2015-07-28','14:57:38',1,28,1),(32,'2015-07-28','14:57:38',1,29,1),(33,'2015-07-28','14:57:52',1,30,1),(34,'2015-07-28','14:57:52',1,31,1),(35,'2015-07-28','14:58:28',1,32,1),(36,'2015-07-28','14:58:29',1,33,1),(37,'2015-07-28','15:01:19',2,33,1),(38,'2015-07-28','15:03:36',1,34,1),(39,'2015-07-28','15:03:47',1,35,1),(40,'2015-07-28','15:04:20',1,36,1),(41,'2015-07-28','15:04:32',2,28,1),(42,'2015-07-28','15:04:34',2,29,1),(43,'2015-07-28','15:04:45',2,36,1),(44,'2015-07-28','15:05:14',1,37,1),(45,'2015-07-28','15:05:23',2,37,1),(46,'2015-07-28','15:07:15',2,35,1),(47,'2015-07-28','15:08:28',2,19,1),(48,'2015-07-28','15:08:44',2,23,1),(49,'2015-07-28','15:09:02',2,34,1),(50,'2015-07-28','15:09:04',2,31,1),(51,'2015-07-28','15:09:06',2,32,1),(52,'2015-07-28','15:09:08',2,30,1),(53,'2015-07-28','15:09:16',2,25,1),(54,'2015-07-28','15:09:18',2,26,1),(55,'2015-07-28','15:09:20',2,27,1),(56,'2015-07-28','15:09:27',2,21,1),(57,'2015-07-28','15:09:35',1,38,1),(58,'2015-07-28','15:09:43',2,38,1),(59,'2015-07-28','15:09:49',2,18,1),(60,'2015-07-28','15:09:52',2,21,1),(61,'2015-07-28','15:11:32',2,16,1),(62,'2015-07-28','15:11:48',1,39,1),(63,'2015-07-28','15:11:53',2,39,1),(64,'2015-07-28','15:12:15',1,40,1),(65,'2015-07-28','15:12:22',2,40,1),(66,'2015-07-28','15:12:34',1,41,1),(67,'2015-07-28','15:12:38',1,42,1),(68,'2015-07-28','15:12:45',2,42,1),(69,'2015-07-28','15:12:55',2,41,1),(70,'2015-07-28','15:13:26',1,43,1),(71,'2015-07-28','15:13:26',1,44,1),(72,'2015-07-28','15:13:29',1,45,1),(73,'2015-07-28','15:13:29',1,46,1),(74,'2015-07-28','15:13:33',1,47,1),(75,'2015-07-28','15:13:33',1,48,1),(76,'2015-07-28','15:13:39',1,49,1),(77,'2015-07-28','15:13:39',1,50,1),(78,'2015-07-28','15:14:40',1,51,1),(79,'2015-07-28','15:14:51',1,52,1),(80,'2015-07-28','15:14:58',2,51,1),(81,'2015-07-28','15:15:07',2,43,1),(82,'2015-07-28','15:15:09',2,44,1),(83,'2015-07-28','15:15:11',2,44,1),(84,'2015-07-28','15:15:15',2,44,1),(85,'2015-07-28','15:15:24',2,45,1),(86,'2015-07-28','15:15:27',2,46,1),(87,'2015-07-28','15:15:30',2,46,1),(88,'2015-07-28','15:15:48',2,47,1),(89,'2015-07-28','15:15:50',2,48,1),(90,'2015-07-28','15:15:52',2,48,1),(91,'2015-07-28','15:16:01',2,49,1),(92,'2015-07-28','15:16:03',2,50,1),(93,'2015-07-28','15:16:05',2,50,1),(94,'2015-07-28','15:16:18',2,52,1),(95,'2015-08-12','17:41:41',1,53,1),(96,'2015-08-12','17:48:29',1,54,1),(97,'2015-08-12','17:48:29',1,55,1),(98,'2015-08-12','17:48:43',1,56,1),(99,'2015-08-12','17:49:07',2,55,1),(100,'2015-08-12','17:49:15',2,54,1),(101,'2015-08-12','17:49:17',2,55,1),(102,'2015-08-17','23:14:04',2,8,1),(103,'2015-08-17','23:19:05',2,56,1),(104,'2015-08-17','23:20:10',2,23,1),(105,'2015-08-17','23:59:41',3,15,1),(106,'2015-08-18','00:09:33',3,15,1),(107,'2015-08-18','00:12:22',3,15,1),(108,'2015-08-18','00:15:58',3,15,1),(109,'2015-08-18','00:17:10',3,15,1),(110,'2015-08-18','00:18:56',3,15,1),(111,'2015-08-18','00:19:16',3,9,1),(112,'2015-08-18','00:19:50',3,9,1),(113,'2015-08-18','00:20:11',3,9,1),(114,'2015-08-18','00:21:31',3,9,1),(115,'2015-08-18','00:22:56',3,15,1),(116,'2015-08-18','00:26:13',3,15,1),(117,'2015-08-18','00:26:33',3,15,1),(118,'2015-08-18','00:31:49',1,57,1),(119,'2015-08-18','00:35:23',1,58,1),(120,'2015-08-18','00:42:21',1,59,1),(121,'2015-08-18','01:32:32',1,60,1),(122,'2015-08-18','01:32:48',3,60,1),(123,'2015-08-18','18:12:28',2,58,1),(124,'2015-08-18','18:55:32',1,61,1),(125,'2015-08-18','19:02:02',2,60,1),(126,'2015-08-25','21:20:19',1,62,1),(127,'2015-08-25','21:20:43',3,62,1),(128,'2015-08-25','21:20:53',2,62,1);

/*Table structure for table `log_caracteristicas` */

DROP TABLE IF EXISTS `log_caracteristicas`;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `log_caracteristicas` */

insert  into `log_caracteristicas`(`id_log_caracteristica`,`fecha_log_caracteristica`,`hora_log_caracteristica`,`caracteristica_nombre_anterior_log_caracteristica`,`caracteristica_nombre_nuevo_log_caracteristica`,`id_accion_log_caracteristica`,`id_caracteristica_log_caracteristica`,`id_usuario_log_caracteristica`) values (12,'2015-07-19','00:54:38','-','Violencia',1,10,1),(13,'2015-07-19','00:54:48','-','Lenguaje Adulto',1,11,1),(14,'2015-07-28','14:59:14','-','c',1,12,1),(15,'2015-07-28','14:59:34','-','caracte',1,13,1),(16,'2015-07-28','16:28:41','c','-',2,12,1),(17,'2015-07-28','16:28:44','caracte','-',2,13,1),(18,'2015-08-24','19:37:05','-','eee',1,14,1),(19,'2015-08-24','19:38:40','-','eeee',1,15,1),(20,'2015-08-24','19:38:45','eee','eee3',3,14,1),(21,'2015-08-24','19:39:09','eeee','-',2,15,1),(22,'2015-08-24','19:39:10','eee3','-',2,14,1);

/*Table structure for table `log_clasificaciones` */

DROP TABLE IF EXISTS `log_clasificaciones`;

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

/*Data for the table `log_clasificaciones` */

insert  into `log_clasificaciones`(`id_log_clasificacion`,`fecha_log_clasificacion`,`hora_log_clasificacion`,`id_accion_log_clasificacion`,`id_usuario_log_clasificacion`,`id_clasificacion_log_clasificacion`) values (1,'2015-06-22','00:33:21',1,1,1),(11,'2015-07-19','00:53:07',1,1,11),(12,'2015-07-19','00:53:27',1,1,12),(13,'2015-07-19','00:53:39',1,1,13),(14,'2015-07-19','23:11:14',1,1,14),(15,'2015-07-19','23:11:52',1,1,15),(16,'2015-07-19','23:12:48',1,1,16);

/*Table structure for table `log_editoriales` */

DROP TABLE IF EXISTS `log_editoriales`;

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `log_editoriales` */

insert  into `log_editoriales`(`id_log_editorial`,`fecha_log_editorial`,`hora_log_editorial`,`editorial_nombre_anterior_log_editorial`,`editorial_nombre_nuevo_log_editorial`,`id_accion_log_editorial`,`id_editorial_log_editorial`,`id_usuario_log_editorial`) values (6,'2015-07-19','01:11:02','-','Planeta',1,6,1),(7,'2015-07-19','01:28:16','-','Ballantine Books',1,7,1),(8,'2015-07-19','01:31:41','-','Thomas &amp; Mercer',1,8,1),(9,'2015-07-19','23:40:03','-','MINOTAURO',1,9,1),(10,'2015-07-28','00:04:39','-','Plaza & Janes',1,10,1),(11,'2015-07-28','00:12:53','-','Nube de Tinta',1,11,1),(12,'2015-07-28','14:58:56','-','e',1,12,1),(13,'2015-07-28','14:59:04','-','edit',1,13,1),(14,'2015-07-28','15:06:06','e','-',2,12,1),(15,'2015-07-28','15:16:31','-','1',1,14,1),(16,'2015-07-28','15:16:34','-','2',1,15,1),(17,'2015-07-28','15:16:37','-','3',1,16,1),(18,'2015-07-28','15:16:41','-','4',1,17,1),(19,'2015-07-28','15:16:56','2','-',2,15,1),(20,'2015-07-28','15:16:58','3','-',2,16,1),(21,'2015-07-28','15:17:04','1','-',2,14,1),(22,'2015-07-28','15:17:19','4','-',2,17,1),(23,'2015-07-28','15:17:31','-','66',1,18,1),(24,'2015-07-28','15:17:34','-','7',1,19,1),(25,'2015-07-28','15:17:37','-','8',1,20,1),(26,'2015-07-28','15:17:40','-','9',1,21,1),(27,'2015-07-28','15:17:43','-','0',1,22,1),(28,'2015-07-28','15:17:46','-','11',1,23,1),(29,'2015-07-28','15:17:57','0','-',2,22,1),(30,'2015-07-28','15:18:03','66','-',2,18,1),(31,'2015-07-28','15:18:21','7','-',2,19,1),(32,'2015-07-28','15:18:23','edit','-',2,13,1),(33,'2015-07-28','15:18:35','7','-',2,19,1),(34,'2015-07-28','15:18:48','8','-',2,20,1),(35,'2015-07-28','15:18:51','9','-',2,21,1),(36,'2015-07-28','15:18:53','9','-',2,21,1),(37,'2015-07-28','15:18:57','11','-',2,23,1),(38,'2015-07-28','15:19:20','-','r',1,24,1),(39,'2015-07-28','15:19:22','-','t',1,25,1),(40,'2015-07-28','15:19:24','-','y',1,26,1),(41,'2015-07-28','15:19:28','-','u',1,27,1),(42,'2015-07-28','15:19:31','-','i',1,28,1),(43,'2015-07-28','15:19:42','-','3',1,29,1),(44,'2015-07-28','15:19:45','-','sd',1,30,1),(45,'2015-07-28','16:27:43','r','-',2,24,1),(46,'2015-07-28','16:27:46','y','-',2,26,1),(47,'2015-07-28','16:27:49','t','-',2,25,1),(48,'2015-07-28','16:27:53','t','-',2,25,1),(49,'2015-07-28','16:28:10','u','-',2,27,1),(50,'2015-07-28','16:28:13','i','-',2,28,1),(51,'2015-07-28','16:28:15','i','-',2,28,1),(52,'2015-07-28','16:28:18','i','-',2,28,1),(53,'2015-07-28','16:28:33','3','-',2,29,1),(54,'2015-07-28','16:28:35','sd','-',2,30,1),(55,'2015-08-12','17:41:43','-','Salamandra',1,31,1),(56,'2015-08-24','19:14:14','e','eee',3,12,1),(57,'2015-08-24','19:14:28','-','ggg',1,32,1),(58,'2015-08-24','19:14:39','ggg','ggg3',3,32,1),(59,'2015-08-24','19:15:10','ggg3','-',2,32,1);

/*Table structure for table `log_libros` */

DROP TABLE IF EXISTS `log_libros`;

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

/*Data for the table `log_libros` */

insert  into `log_libros`(`id_log_libro`,`fecha_log_libro`,`hora_log_libro`,`id_accion_log_libro`,`id_libro_log_libro`,`id_usuario_log_libro`) values (14,'2015-07-19','01:14:10',1,9,1),(15,'2015-07-19','01:29:18',1,10,1),(16,'2015-07-19','01:33:01',1,11,1),(17,'2015-07-19','23:43:53',1,12,1),(18,'2015-07-19','23:45:34',1,13,1),(19,'2015-07-27','19:03:39',3,12,1),(20,'2015-07-27','19:17:16',3,13,1),(21,'2015-07-28','00:06:51',1,14,1),(22,'2015-07-28','00:08:17',1,15,1),(23,'2015-07-28','00:09:59',1,16,1),(24,'2015-07-28','00:14:01',1,17,1);

/*Table structure for table `tipos_usuario` */

DROP TABLE IF EXISTS `tipos_usuario`;

CREATE TABLE `tipos_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nivel_acceso` int(2) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipos_usuario` */

insert  into `tipos_usuario`(`id_tipo_usuario`,`descripcion_usuario`,`nivel_acceso`) values (1,'administrador',50),(2,'super-administrador',99);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `clave_usuario` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_usuario` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta_usuario` date NOT NULL,
  `fecha_baja_usuario` date DEFAULT NULL,
  `id_tipo_tipo_usuario` int(11) NOT NULL,
  `definirPass` tinyint(1) NOT NULL DEFAULT '0',
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  KEY `id_tipo_tipo_usuario` (`id_tipo_tipo_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id_usuario`,`clave_usuario`,`nombre_usuario`,`fecha_alta_usuario`,`fecha_baja_usuario`,`id_tipo_tipo_usuario`,`definirPass`,`borrado`) values (1,'25d55ad283aa400af464c76d713c07ad','David','2015-06-14',NULL,2,0,0),(2,'25d55ad283aa400af464c76d713c07ad','Admin','2015-06-21',NULL,1,0,0),(3,'25d55ad283aa400af464c76d713c07ad','Emma','2015-06-21','2015-06-21',1,0,1),(4,'25d55ad283aa400af464c76d713c07ad','eee','2015-08-25','2015-08-25',1,0,1),(5,'25d55ad283aa400af464c76d713c07ad','eeee','2015-08-25','2015-08-25',1,0,1),(6,'25d55ad283aa400af464c76d713c07ad','eeeee','2015-08-25','2015-08-25',1,0,1),(7,'25d55ad283aa400af464c76d713c07ad','eeeees','2015-08-25','2015-08-25',1,0,1),(8,'25d55ad283aa400af464c76d713c07ad','eeeeesswwqqtt','2015-08-25','2015-08-25',1,0,1),(9,'25d55ad283aa400af464c76d713c07ad','eeeeessr','2015-08-25','2015-08-25',1,0,1),(10,'25d55ad283aa400af464c76d713c07ad','eeeeessrr','2015-08-25','2015-08-25',1,0,1),(11,'25d55ad283aa400af464c76d713c07ad','zz','2015-08-25',NULL,1,1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
