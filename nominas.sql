/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.1.21-MariaDB : Database - nominas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nominas` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `nominas`;

/*Table structure for table `asistencias` */

DROP TABLE IF EXISTS `asistencias`;

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_pago_id` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `asistencias` */

insert  into `asistencias`(`id`,`usuario_pago_id`,`dia`,`status`,`created_at`,`updated_at`) values (33,1,13,'F','2017-12-14 16:40:33','2017-12-14 16:40:33'),(34,1,14,'F','2017-12-14 16:40:33','2017-12-14 16:40:33'),(35,1,15,'','2017-12-14 16:40:33','2017-12-14 16:40:33'),(36,1,16,'','2017-12-14 16:40:33','2017-12-14 16:40:33'),(37,1,17,'','2017-12-14 16:40:33','2017-12-14 16:40:33'),(38,1,18,'','2017-12-14 16:40:33','2017-12-14 16:40:33'),(39,1,19,'','2017-12-14 16:40:33','2017-12-14 16:40:33'),(40,1,20,'','2017-12-14 16:40:33','2017-12-14 16:40:33');

/*Table structure for table `documentacion` */

DROP TABLE IF EXISTS `documentacion`;

CREATE TABLE `documentacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `comprobante_domicilio` tinyint(4) DEFAULT NULL,
  `identificacion` tinyint(4) DEFAULT NULL,
  `curp` tinyint(4) DEFAULT NULL,
  `rfc` tinyint(4) DEFAULT NULL,
  `hoja_imss` tinyint(4) DEFAULT NULL,
  `carta_no_antecedentes_penales` tinyint(4) DEFAULT NULL,
  `acta_nacimiento` tinyint(4) DEFAULT NULL,
  `comprobante_estudios` tinyint(4) DEFAULT NULL,
  `resultado_psicometrias` tinyint(4) DEFAULT NULL,
  `examen_socieconomico` tinyint(4) DEFAULT NULL,
  `examen_toxicologico` tinyint(4) DEFAULT NULL,
  `solicitud_frente_vuelta` tinyint(4) DEFAULT NULL,
  `deposito_uniforme` tinyint(4) DEFAULT NULL,
  `constancia_recepcion_uniforme` tinyint(4) DEFAULT NULL,
  `comprobante_recepcion_reglamento_interno_trabajo` tinyint(4) DEFAULT NULL,
  `autorizacion_pago_tarjeta` tinyint(4) DEFAULT NULL,
  `carta_aceptacion_cambio_lugar` tinyint(4) DEFAULT NULL,
  `finiquito` tinyint(4) DEFAULT NULL,
  `calendario` tinyint(4) DEFAULT NULL,
  `formato_datos_personales` tinyint(4) DEFAULT NULL,
  `solicitud_autorizacion_consulta` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `documentacion` */

insert  into `documentacion`(`id`,`empleado_id`,`comprobante_domicilio`,`identificacion`,`curp`,`rfc`,`hoja_imss`,`carta_no_antecedentes_penales`,`acta_nacimiento`,`comprobante_estudios`,`resultado_psicometrias`,`examen_socieconomico`,`examen_toxicologico`,`solicitud_frente_vuelta`,`deposito_uniforme`,`constancia_recepcion_uniforme`,`comprobante_recepcion_reglamento_interno_trabajo`,`autorizacion_pago_tarjeta`,`carta_aceptacion_cambio_lugar`,`finiquito`,`calendario`,`formato_datos_personales`,`solicitud_autorizacion_consulta`,`created_at`,`updated_at`) values (1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,'2017-11-21 23:28:19','2017-11-21 23:28:19'),(2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,'2017-11-21 23:30:09','2017-11-22 00:03:18');

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `num_empleado` varchar(20) DEFAULT NULL,
  `num_cuenta` varchar(10) DEFAULT NULL,
  `domicilio` text,
  `ciudad` varchar(40) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `curp` varchar(20) DEFAULT NULL,
  `nss` varchar(30) DEFAULT NULL,
  `telefono_emergencia` varchar(30) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `empleados` */

insert  into `empleados`(`id`,`nombre`,`apellido`,`num_empleado`,`num_cuenta`,`domicilio`,`ciudad`,`telefono`,`rfc`,`curp`,`nss`,`telefono_emergencia`,`status`,`created_at`,`updated_at`) values (1,'CONRADO ANTONIO','CARRILLO ROSALES','001','0016415225','Hector Hernández #5712 A Colonia Paseos del Sol','Zapopan','9801010','SARL600830L21','BEML920313HMCLNS09','45136684587745','6699854621',1,'2017-12-14 13:54:04','2017-12-14 19:54:04'),(2,'DANIELA','GONZALES CASTRO','002','0025621598','Cuautitlán 211 Colonia Chapalita','Zapopan','9801010','SARL600830L21','BEML920313HMCLNS09','986562147','6699875632',1,'2017-12-14 13:54:20','2017-12-14 19:54:20');

/*Table structure for table `empresa_servicio` */

DROP TABLE IF EXISTS `empresa_servicio`;

CREATE TABLE `empresa_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) DEFAULT NULL,
  `servicio` varchar(200) DEFAULT NULL,
  `horario` varchar(200) DEFAULT NULL,
  `sueldo` decimal(10,0) DEFAULT NULL,
  `sueldo_diario_guardia` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `empresa_servicio` */

insert  into `empresa_servicio`(`id`,`empresa_id`,`servicio`,`horario`,`sueldo`,`sueldo_diario_guardia`,`created_at`,`updated_at`) values (1,1,'01 de 24x24 hrs','1 servicio de lunes a viernes de 7:00 a 7:00','2600','300.50','2017-12-14 11:35:13','2017-12-13 17:22:52');

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `oficina_cargo` varchar(100) DEFAULT NULL,
  `direccion` text,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` varchar(18) DEFAULT NULL,
  `marcacion_corta` varchar(10) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `empresas` */

insert  into `empresas`(`id`,`nombre`,`oficina_cargo`,`direccion`,`contacto`,`telefono`,`marcacion_corta`,`status`,`created_at`,`updated_at`) values (1,'Bridge Studio','Guadalajara, Jal','Colonia Chapalita, Cuautitlan','Edgard','33658974','116',1,'2017-12-13 11:38:38','2017-12-13 11:38:38');

/*Table structure for table `estado` */

DROP TABLE IF EXISTS `estado`;

CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEstado` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `estado` */

insert  into `estado`(`id`,`nombreEstado`,`created_at`,`updated_at`) values (1,'Aguascalientes','2017-02-04 18:45:43','2017-02-04 18:49:42'),(2,'Baja California',NULL,'2017-02-02 10:49:34'),(3,'Baja California Sur',NULL,NULL),(4,'Campeche',NULL,'2017-01-25 23:32:12'),(5,'Chiapas',NULL,NULL),(6,'Chihuahua',NULL,NULL),(7,'Coahuila',NULL,NULL),(8,'Colima',NULL,NULL),(9,'Distrito Federal',NULL,NULL),(10,'Durango',NULL,NULL),(11,'Estado de México',NULL,NULL),(12,'Guanajuato',NULL,NULL),(13,'Guerrero',NULL,'2017-01-25 23:32:35'),(14,'Hidalgo',NULL,NULL),(15,'Jalisco',NULL,'2017-01-25 23:32:31'),(16,'Michoacán',NULL,NULL),(17,'Morelos',NULL,NULL),(18,'Nayarit',NULL,NULL),(19,'Nuevo León',NULL,NULL),(20,'Oaxaca',NULL,NULL),(21,'Puebla',NULL,NULL),(22,'Querétaro',NULL,NULL),(23,'Quintana Roo',NULL,NULL),(24,'San Luis Potosí',NULL,NULL),(25,'Sinaloa',NULL,'2017-01-25 23:33:35'),(26,'Sonora',NULL,NULL),(27,'Tabasco',NULL,NULL),(28,'Tamaulipas',NULL,'2017-01-25 23:32:56'),(29,'Tlaxcala',NULL,NULL),(30,'Veracruz',NULL,NULL),(31,'Yucatán',NULL,NULL),(32,'Zacatecas',NULL,'2017-01-25 23:32:45');

/*Table structure for table `pagos` */

DROP TABLE IF EXISTS `pagos`;

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pagos` */

insert  into `pagos`(`id`,`empresa_id`,`servicio_id`,`fecha_inicio`,`fecha_fin`,`status`,`created_at`,`updated_at`) values (1,1,1,'2017-12-13','2017-12-20',1,'2017-12-14 10:43:25',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_usuario` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`user`,`password`,`email`,`foto_usuario`,`remember_token`,`status`,`created_at`,`updated_at`) values (1,'conrado.carrillo','$2y$10$UpoeuWNzFK8yZ5D8ErdMl.u4Qu6n7qyQS7RvuWYIyvIYmWNN8gJJ2','anton_con@hotmail.com','img/user_perfil/default.jpg','zNJHa1o6nOLfOnmtC8RdxGFpOEWYEihR2simXAsp7NFd8tYg7gXYNQ0UeP0x',1,'2017-03-23 11:30:45','2017-12-14 13:27:34');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `celular` varchar(18) DEFAULT NULL,
  `customer_id_conekta` varchar(255) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`password`,`nombre`,`apellido`,`correo`,`foto_perfil`,`celular`,`customer_id_conekta`,`tipo`,`status`,`created_at`,`updated_at`) values (1,'a83f0f76c2afad4f5d7260824430b798','Conrado Antonio','Carrillo Rosales','anton_con@hotmail.com','img/usuario_app/default.jpg','9801010',NULL,1,1,'2017-10-24 22:40:39','2017-10-25 16:16:05'),(2,'a83f0f76c2afad4f5d7260824430b798','Manuel','Rosales','many@hotmail.com','img/usuario_app/default.jpg','6699333627',NULL,2,1,'2017-10-25 13:12:13','0000-00-00 00:00:00'),(11,'a83f0f76c2afad4f5d7260824430b798','sdasdasd','asdasdsda','admin@topali.com','img/usuario_app/default.jpg','213123',NULL,2,1,'2017-10-25 18:35:34','2017-10-25 18:35:34');

/*Table structure for table `usuario_pagos` */

DROP TABLE IF EXISTS `usuario_pagos`;

CREATE TABLE `usuario_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trabajador_id` int(11) NOT NULL,
  `pago_id` int(11) DEFAULT NULL,
  `notas` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `usuario_pagos` */

insert  into `usuario_pagos`(`id`,`trabajador_id`,`pago_id`,`notas`) values (1,1,1,'holi');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
