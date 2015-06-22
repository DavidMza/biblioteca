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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`biblioteca` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `autores` */

insert  into `autores`(`id_autor`,`nombre_autor`,`borrado`) values (1,'Sin Autor',0);

/*Table structure for table `caracteristicas` */

DROP TABLE IF EXISTS `caracteristicas`;

CREATE TABLE `caracteristicas` (
  `id_caracteristicas` int(11) NOT NULL AUTO_INCREMENT,
  `denominacion_caracteristica` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_caracteristicas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `caracteristicas` */

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `clasificaciones` */

insert  into `clasificaciones`(`id_clasificacion`,`denominacion_clasificacion`,`id_clasificacion_padre`,`borrado`) values (1,'Rubro',NULL,0),(2,'Accion',1,0),(3,'Terror',1,0),(4,'Romance',1,0),(5,'Infantil',1,0),(6,'Ciencia Ficcion',2,0);

/*Table structure for table `editoriales` */

DROP TABLE IF EXISTS `editoriales`;

CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_editorial` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_editorial`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `editoriales` */

insert  into `editoriales`(`id_editorial`,`nombre_editorial`,`borrado`) values (1,'Sin Editorial',0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `fotos` */

/*Table structure for table `libro` */

DROP TABLE IF EXISTS `libro`;

CREATE TABLE `libro` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_libro` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ISBN_libro` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `paginas_libro` int(4) NOT NULL,
  `idioma_libro` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `publicacion_libro` date NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `libro` */

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
  CONSTRAINT `log_autores_ibfk_3` FOREIGN KEY (`id_accion_log_autor`) REFERENCES `acciones` (`id_accion`),
  CONSTRAINT `log_autores_ibfk_1` FOREIGN KEY (`id_autor_log_autor`) REFERENCES `autores` (`id_autor`),
  CONSTRAINT `log_autores_ibfk_2` FOREIGN KEY (`id_usuario_log_autor`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `log_autores` */

insert  into `log_autores`(`id_log_autor`,`fecha_log_autor`,`hora_log_autor`,`id_accion_log_autor`,`id_autor_log_autor`,`id_usuario_log_autor`) values (1,'2015-06-21','18:26:41',1,1,1);

/*Table structure for table `log_caracteristicas` */

DROP TABLE IF EXISTS `log_caracteristicas`;

CREATE TABLE `log_caracteristicas` (
  `id_log_caracteristica` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_log_caracteristica` date NOT NULL,
  `hora_log_caracteristica` time NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `log_caracteristicas` */

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `log_clasificaciones` */

insert  into `log_clasificaciones`(`id_log_clasificacion`,`fecha_log_clasificacion`,`hora_log_clasificacion`,`id_accion_log_clasificacion`,`id_usuario_log_clasificacion`,`id_clasificacion_log_clasificacion`) values (1,'2015-06-22','00:33:21',1,1,2),(2,'2015-06-22','00:37:47',1,1,3),(3,'2015-06-22','00:38:24',1,1,4),(4,'2015-06-22','00:38:38',1,1,5),(5,'2015-06-22','00:39:27',1,1,6),(6,'2015-06-22','01:09:40',3,1,6);

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
  CONSTRAINT `log_editoriales_ibfk_3` FOREIGN KEY (`id_accion_log_editorial`) REFERENCES `acciones` (`id_accion`),
  CONSTRAINT `log_editoriales_ibfk_1` FOREIGN KEY (`id_editorial_log_editorial`) REFERENCES `editoriales` (`id_editorial`),
  CONSTRAINT `log_editoriales_ibfk_2` FOREIGN KEY (`id_usuario_log_editorial`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `log_editoriales` */

insert  into `log_editoriales`(`id_log_editorial`,`fecha_log_editorial`,`hora_log_editorial`,`editorial_nombre_anterior_log_editorial`,`editorial_nombre_nuevo_log_editorial`,`id_accion_log_editorial`,`id_editorial_log_editorial`,`id_usuario_log_editorial`) values (1,'2015-06-21','17:50:53','-','Sin Editorial',1,1,1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `log_libros` */

/*Table structure for table `tipos_usuario` */

DROP TABLE IF EXISTS `tipos_usuario`;

CREATE TABLE `tipos_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nivel_acceso` int(2) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  KEY `id_tipo_tipo_usuario` (`id_tipo_tipo_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id_usuario`,`clave_usuario`,`nombre_usuario`,`fecha_alta_usuario`,`fecha_baja_usuario`,`id_tipo_tipo_usuario`,`borrado`) values (1,'25d55ad283aa400af464c76d713c07ad','David','2015-06-14',NULL,2,0),(2,'25d55ad283aa400af464c76d713c07ad','Admin','2015-06-21',NULL,1,0),(3,'25d55ad283aa400af464c76d713c07ad','Emma','2015-06-21','2015-06-21',1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
