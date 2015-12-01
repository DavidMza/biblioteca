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
  PRIMARY KEY (`id_autor`),
  UNIQUE KEY `Nombre` (`nombre_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `autores` */

insert  into `autores`(`id_autor`,`nombre_autor`) values (14,'Antologia Romanticas'),(10,'Blake Crouch'),(15,'Cielo Latini'),(8,'Coelho, Paulo'),(9,'Heinlein, Robert A.'),(16,'John Green'),(12,'Paula Hawkins'),(11,'Tolkien J. R. R.');

/*Table structure for table `caracteristicas` */

DROP TABLE IF EXISTS `caracteristicas`;

CREATE TABLE `caracteristicas` (
  `id_caracteristicas` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion_caracteristica` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_caracteristicas`),
  UNIQUE KEY `Nombre` (`denominacion_caracteristica`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `caracteristicas` */

insert  into `caracteristicas`(`id_caracteristicas`,`denominacion_caracteristica`) values (11,'Lenguaje Adulto'),(10,'Violencia');

/*Table structure for table `clasificaciones` */

DROP TABLE IF EXISTS `clasificaciones`;

CREATE TABLE `clasificaciones` (
  `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion_clasificacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_clasificacion_padre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_clasificacion`),
  UNIQUE KEY `nombre` (`denominacion_clasificacion`),
  KEY `id_clasificacion_padre` (`id_clasificacion_padre`),
  CONSTRAINT `clasificaciones_ibfk_1` FOREIGN KEY (`id_clasificacion_padre`) REFERENCES `clasificaciones` (`id_clasificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `clasificaciones` */

insert  into `clasificaciones`(`id_clasificacion`,`denominacion_clasificacion`,`id_clasificacion_padre`) values (1,'Genero',NULL),(11,'Terror',1),(12,'Drama',1),(13,'Ciencia Ficcion',1),(15,'Biografias',1),(16,'Fantasia',13),(24,'asd',1);

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

insert  into `consultas`(`id_consultas`,`nombre`,`email`,`mensaje`,`fecha`,`borrado`) values (1,'DAvid','david@mail.com','Queria hacer una consulta.\r\nGRacias.','2015-07-27 21:40:41',1),(2,'DAvid','david@mail.com','Consulta hecha desde el Portal Web.','2015-07-27 22:44:47',0),(3,'Emma','ema@Ema','Soy Emma','2015-07-28 16:20:36',1),(4,'leo','leo@dfg','xfgxdgd','2015-08-12 17:40:11',1);

/*Table structure for table `editoriales` */

DROP TABLE IF EXISTS `editoriales`;

CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_editorial` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_editorial`),
  UNIQUE KEY `Nombre_Editorial` (`nombre_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `editoriales` */

insert  into `editoriales`(`id_editorial`,`nombre_editorial`) values (7,'Ballantine Books'),(9,'MINOTAURO'),(11,'Nube de Tinta'),(6,'Planeta'),(10,'Plaza & Janes'),(31,'Salamandra'),(8,'Thomas &amp; Mercer');

/*Table structure for table `fotos` */

DROP TABLE IF EXISTS `fotos`;

CREATE TABLE `fotos` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `rutaArchivo_foto` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `id_libro_foto` int(11) NOT NULL,
  PRIMARY KEY (`id_foto`),
  KEY `id_libro_foto` (`id_libro_foto`),
  CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`id_libro_foto`) REFERENCES `libro` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `fotos` */

insert  into `fotos`(`id_foto`,`rutaArchivo_foto`,`id_libro_foto`) values (9,'recursos/imagenes/libros/1437279250.png',9),(10,'recursos/imagenes/libros/1448332063.png',10),(11,'recursos/imagenes/libros/1437280381.png',11),(12,'recursos/imagenes/libros/1438034618.png',12),(13,'recursos/imagenes/libros/1438035436.png',13),(14,'recursos/imagenes/libros/1438052811.png',14),(15,'recursos/imagenes/libros/1438052896.png',15),(16,'recursos/imagenes/libros/1438052999.png',16),(17,'recursos/imagenes/libros/1438053241.png',17);

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
  PRIMARY KEY (`id_libro`),
  KEY `id_autor_libro` (`id_autor_libro`),
  KEY `id_editorial_libro` (`id_editorial_libro`),
  KEY `idioma_libro` (`idioma_libro`),
  CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`id_autor_libro`) REFERENCES `autores` (`id_autor`),
  CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`id_editorial_libro`) REFERENCES `editoriales` (`id_editorial`),
  CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`idioma_libro`) REFERENCES `idioma` (`id_idioma`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `libro` */

insert  into `libro`(`id_libro`,`titulo_libro`,`ISBN_libro`,`paginas_libro`,`idioma_libro`,`publicacion_libro`,`disponibilidad_libro`,`destacado_libro`,`id_autor_libro`,`id_editorial_libro`) values (9,'El Alquimista','9788408033431',354,1,2001,1,1,8,6),(10,'Between planets','9780345260703',289,1,2009,1,1,9,7),(11,'Pines','9781612183954',320,2,2014,1,1,10,8),(12,'La Comunidad del Anillo - SeÃ±or de los Anillos I','9789505471140',514,2,2003,1,1,11,9),(13,'Las Dos Torres - SeÃ±or de los Anillos II','9789505471157',522,2,2004,1,1,11,9),(14,'La Chica del Tren','9789504946403',496,1,2015,1,1,12,6),(15,'Ay, Amor','9789506443436',368,3,2015,1,1,14,10),(16,'Abzurdah','9789504915317',296,2,2015,1,1,15,6),(17,'Ciudades de Papel','9789871997039',368,1,2015,1,1,16,11);

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

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_log` date NOT NULL,
  `hora_log` time NOT NULL,
  `id_accion_log` int(11) NOT NULL,
  `id_entidad_log` int(11) NOT NULL,
  `id_usuario_log` int(11) NOT NULL,
  `nombre_objeto` varchar(150) NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_accion_log` (`id_accion_log`),
  KEY `id_usuario_log` (`id_usuario_log`),
  CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_accion_log`) REFERENCES `acciones` (`id_accion`),
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`id_usuario_log`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;

/*Data for the table `log` */

insert  into `log`(`id_log`,`fecha_log`,`hora_log`,`id_accion_log`,`id_entidad_log`,`id_usuario_log`,`nombre_objeto`) values (1,'2015-11-22','20:39:46',2,2,1,'0'),(2,'2015-11-22','21:11:56',1,2,1,'0'),(3,'2015-11-22','21:12:09',2,2,1,'0'),(4,'2015-11-22','21:12:11',2,2,1,'1'),(5,'2015-11-22','21:12:12',2,2,1,'11'),(6,'2015-11-22','21:12:12',2,2,1,'2'),(7,'2015-11-22','21:12:13',2,2,1,'3'),(8,'2015-11-22','21:12:13',2,2,1,'4'),(9,'2015-11-22','21:12:14',2,2,1,'66'),(10,'2015-11-22','21:12:15',2,2,1,'7'),(11,'2015-11-22','21:12:15',2,2,1,'8'),(12,'2015-11-22','21:12:16',2,2,1,'9'),(13,'2015-11-22','21:12:19',2,2,1,'edit'),(14,'2015-11-22','21:12:20',2,2,1,'eee'),(15,'2015-11-22','21:12:20',2,2,1,'ggg3'),(16,'2015-11-22','21:12:21',2,2,1,'i'),(17,'2015-11-22','21:12:23',2,2,1,'r'),(18,'2015-11-22','21:12:26',2,2,1,'sd'),(19,'2015-11-22','21:12:27',2,2,1,'t'),(20,'2015-11-22','21:12:28',2,2,1,'u'),(21,'2015-11-22','21:12:29',2,2,1,'y'),(22,'2015-11-22','21:12:30',2,2,1,'z'),(23,'2015-11-22','22:30:27',1,2,1,'z'),(24,'2015-11-22','22:30:42',2,2,1,'z'),(25,'2015-11-23','22:46:10',2,1,1,'Paula Hawkins'),(26,'2015-11-23','22:46:14',2,1,1,'John Green'),(27,'2015-11-23','22:46:15',2,1,1,'Borges'),(28,'2015-11-23','22:46:28',2,1,1,'Garcia MArquez'),(29,'2015-11-23','22:46:30',2,1,1,'a'),(30,'2015-11-23','22:46:31',2,1,1,'a'),(31,'2015-11-23','22:46:31',2,1,1,'b'),(32,'2015-11-23','22:46:32',2,1,1,'c'),(33,'2015-11-23','22:46:32',2,1,1,'d'),(34,'2015-11-23','22:46:34',2,1,1,'Emma'),(35,'2015-11-23','22:46:34',2,1,1,'Emma'),(36,'2015-11-23','22:46:35',2,1,1,'l'),(37,'2015-11-23','22:46:35',2,1,1,'l'),(38,'2015-11-23','22:46:36',2,1,1,'k'),(39,'2015-11-23','22:46:37',2,1,1,'k'),(40,'2015-11-23','22:46:37',2,1,1,'z'),(41,'2015-11-23','22:46:40',2,1,1,'pala'),(42,'2015-11-23','22:46:41',2,1,1,'david'),(43,'2015-11-23','22:46:41',2,1,1,'una mas'),(44,'2015-11-23','22:46:42',2,1,1,'otro'),(45,'2015-11-23','22:46:43',2,1,1,'NUevo'),(46,'2015-11-23','22:46:43',2,1,1,'nuevo2'),(47,'2015-11-23','22:46:43',2,1,1,'nuevo3'),(48,'2015-11-23','22:46:44',2,1,1,'nuevo4'),(49,'2015-11-23','22:46:45',2,1,1,'1'),(50,'2015-11-23','22:46:45',2,1,1,'1'),(51,'2015-11-23','22:46:45',2,1,1,'2'),(52,'2015-11-23','22:46:46',2,1,1,'2'),(53,'2015-11-23','22:46:46',2,1,1,'3'),(54,'2015-11-23','22:46:47',2,1,1,'3'),(55,'2015-11-23','22:46:47',2,1,1,'4'),(56,'2015-11-23','22:46:47',2,1,1,'4'),(57,'2015-11-23','22:46:47',2,1,1,'5'),(58,'2015-11-23','22:46:48',2,1,1,'6'),(59,'2015-11-23','22:46:48',2,1,1,'Sin Autor'),(60,'2015-11-23','22:46:49',2,1,1,'h'),(61,'2015-11-23','22:46:50',2,1,1,'h'),(62,'2015-11-23','22:46:51',2,1,1,'l'),(63,'2015-11-23','22:46:51',2,1,1,'qwe'),(64,'2015-11-23','22:46:52',2,1,1,'qwe1'),(65,'2015-11-23','22:46:52',2,1,1,'qwe2'),(66,'2015-11-23','22:46:53',2,1,1,'qwe3s'),(67,'2015-11-23','22:46:53',2,1,1,'qwe4'),(68,'2015-11-23','22:46:54',2,1,1,'qwe55'),(69,'2015-11-23','22:46:54',2,1,1,'zxc123'),(70,'2015-11-23','22:46:55',2,1,1,'Coelho, Paulo'),(71,'2015-11-23','22:46:56',2,1,1,'Paula Hawkins'),(72,'2015-11-23','22:58:05',2,3,1,'c'),(73,'2015-11-23','22:58:06',2,3,1,'caracte'),(74,'2015-11-23','22:58:07',2,3,1,'eee3'),(75,'2015-11-23','22:58:07',2,3,1,'eeee'),(76,'2015-11-23','23:27:43',3,4,1,'Between planets'),(77,'2015-11-25','20:18:24',2,1,1,'Paula Hawkins'),(78,'2015-11-25','20:18:32',2,1,1,'John Green'),(79,'2015-11-25','20:18:34',2,1,1,'Borges'),(80,'2015-11-25','20:18:35',2,1,1,'Garcia MArquez'),(81,'2015-11-25','20:18:38',2,1,1,'a'),(82,'2015-11-25','20:18:39',2,1,1,'a'),(83,'2015-11-25','20:18:40',2,1,1,'b'),(84,'2015-11-25','20:18:41',2,1,1,'c'),(85,'2015-11-25','20:18:42',2,1,1,'d'),(86,'2015-11-25','20:18:42',2,1,1,'Emma'),(87,'2015-11-25','20:18:43',2,1,1,'Emma'),(88,'2015-11-25','20:18:44',2,1,1,'l'),(89,'2015-11-25','20:18:44',2,1,1,'l'),(90,'2015-11-25','20:18:45',2,1,1,'k'),(91,'2015-11-25','20:18:45',2,1,1,'k'),(92,'2015-11-25','20:18:46',2,1,1,'z'),(93,'2015-11-25','20:18:46',2,1,1,'pala'),(94,'2015-11-25','20:18:47',2,1,1,'david'),(95,'2015-11-25','20:18:47',2,1,1,'una mas'),(96,'2015-11-25','20:18:48',2,1,1,'otro'),(97,'2015-11-25','20:18:48',2,1,1,'NUevo'),(98,'2015-11-25','20:18:49',2,1,1,'nuevo2'),(99,'2015-11-25','20:18:49',2,1,1,'nuevo3'),(100,'2015-11-25','20:18:50',2,1,1,'nuevo4'),(101,'2015-11-25','20:18:50',2,1,1,'1'),(102,'2015-11-25','20:18:51',2,1,1,'1'),(103,'2015-11-25','20:18:51',2,1,1,'2'),(104,'2015-11-25','20:18:52',2,1,1,'2'),(105,'2015-11-25','20:18:52',2,1,1,'3'),(106,'2015-11-25','20:18:53',2,1,1,'3'),(107,'2015-11-25','20:18:53',2,1,1,'4'),(108,'2015-11-25','20:18:54',2,1,1,'4'),(109,'2015-11-25','20:18:54',2,1,1,'5'),(110,'2015-11-25','20:18:54',2,1,1,'6'),(111,'2015-11-25','20:18:55',2,1,1,'Sin Autor'),(112,'2015-11-25','20:18:55',2,1,1,'h'),(113,'2015-11-25','20:18:55',2,1,1,'h'),(114,'2015-11-25','20:18:56',2,1,1,'l'),(115,'2015-11-25','20:18:56',2,1,1,'qwe'),(116,'2015-11-25','20:18:57',2,1,1,'qwe1'),(117,'2015-11-25','20:18:57',2,1,1,'qwe2'),(118,'2015-11-25','20:18:58',2,1,1,'qwe3s'),(119,'2015-11-25','20:18:58',2,1,1,'qwe4'),(120,'2015-11-25','20:18:58',2,1,1,'qwe55'),(121,'2015-11-25','20:18:59',2,1,1,'zxc123'),(122,'2015-11-25','20:18:59',2,1,1,'Coelho, Paulo'),(123,'2015-11-25','20:19:01',2,1,1,'Paula Hawkins'),(124,'2015-11-25','20:19:04',2,1,1,'Garcia Marquez'),(125,'2015-11-25','20:19:07',2,1,1,'Borges'),(126,'2015-11-25','20:29:55',2,3,1,'c'),(127,'2015-11-25','20:29:57',2,3,1,'caracte'),(128,'2015-11-25','20:29:58',2,3,1,'eee3'),(129,'2015-11-25','20:29:59',2,3,1,'eeee'),(130,'2015-11-28','20:27:14',2,5,1,'+25'),(131,'2015-11-28','20:27:21',2,5,1,'+111'),(132,'2015-11-28','20:27:34',2,5,1,'132'),(133,'2015-11-28','20:34:46',2,5,1,'+15123456'),(134,'2015-11-28','20:34:53',2,5,1,'+13'),(135,'2015-11-28','20:35:04',2,5,1,'+10'),(136,'2015-11-28','20:35:57',2,5,1,'Infantil'),(137,'2015-11-28','20:43:15',1,5,1,'asd'),(138,'2015-11-28','21:00:06',1,5,1,'zxc'),(139,'2015-11-28','21:24:17',1,1,1,'asd'),(140,'2015-11-28','21:24:20',2,1,1,'asd'),(141,'2015-11-28','21:25:16',1,1,1,'asd'),(142,'2015-11-28','21:25:19',2,1,1,'asd'),(143,'2015-11-28','21:37:12',1,2,1,'asd'),(144,'2015-11-28','21:42:39',2,2,1,'asd'),(145,'2015-11-28','21:43:14',1,2,1,'asd'),(146,'2015-11-28','23:17:35',2,5,3,'zxc'),(147,'2015-11-29','17:22:30',1,1,1,'asd'),(148,'2015-11-29','17:22:34',1,1,1,'qwe'),(149,'2015-11-29','17:22:39',1,1,1,'zxc'),(150,'2015-11-29','17:22:44',2,1,1,'asd'),(151,'2015-11-29','17:22:45',2,1,1,'qwe'),(152,'2015-11-29','17:22:46',2,1,1,'zxc'),(153,'2015-11-29','17:22:53',2,2,1,'asd'),(154,'2015-11-29','17:22:58',1,2,1,'asd'),(155,'2015-11-29','17:23:03',1,2,1,'qe'),(156,'2015-11-29','17:23:06',1,2,1,'zxc'),(157,'2015-11-29','17:23:14',2,2,1,'asd'),(158,'2015-11-29','17:23:16',2,2,1,'qe'),(159,'2015-11-29','17:23:17',2,2,1,'zxc'),(160,'2015-11-29','17:23:23',1,3,1,'qwe'),(161,'2015-11-29','17:23:27',1,3,1,'asd'),(162,'2015-11-29','17:23:30',1,3,1,'zxc'),(163,'2015-11-29','17:23:32',2,3,1,'qwe'),(164,'2015-11-29','17:23:33',2,3,1,'asd'),(165,'2015-11-29','17:23:34',2,3,1,'zxc');

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
  UNIQUE KEY `Nombre` (`nombre_usuario`),
  KEY `id_tipo_tipo_usuario` (`id_tipo_tipo_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id_usuario`,`clave_usuario`,`nombre_usuario`,`fecha_alta_usuario`,`fecha_baja_usuario`,`id_tipo_tipo_usuario`,`definirPass`,`borrado`) values (1,'25d55ad283aa400af464c76d713c07ad','David','2015-06-14','2015-11-25',2,1,0),(2,'25d55ad283aa400af464c76d713c07ad','Admin','2015-06-21','2015-11-28',1,0,1),(3,'25d55ad283aa400af464c76d713c07ad','Emma','2015-06-21','2015-06-21',1,0,0),(11,'25d55ad283aa400af464c76d713c07ad','zz','2015-08-25',NULL,1,1,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
