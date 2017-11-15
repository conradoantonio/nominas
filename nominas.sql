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

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` text,
  `telefono` varchar(18) DEFAULT NULL,
  `numero_ext` varchar(20) DEFAULT NULL,
  `numero_int` varchar(20) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `empresas` */

insert  into `empresas`(`id`,`nombre`,`direccion`,`telefono`,`numero_ext`,`numero_int`,`codigo_postal`,`logo`,`status`,`created_at`,`updated_at`) values (1,'Bridge Studio','Colonia Chapalita, Cuautitlan','33658974','211','','44500','img/logo_empresa/1509138857.png',1,'2017-10-27 16:14:17','2017-10-27 16:14:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`user`,`password`,`email`,`foto_usuario`,`remember_token`,`status`,`created_at`,`updated_at`) values (1,'conrado.carrillo','$2y$10$hPxSH9GAcKTrI1zqP.beROrfWbsYCoFH7bODs5nZ5XYvL6dX5yTQW','anton_con@hotmail.com','img/user_perfil/default.jpg','zNJHa1o6nOLfOnmtC8RdxGFpOEWYEihR2simXAsp7NFd8tYg7gXYNQ0UeP0x',1,'2017-03-23 11:30:45','2017-07-12 18:18:23'),(5,'admin.cocoinbox','$2y$10$WKY9J1RDcn9/5Va9C9QDWOHCbfWSdXYTAf6akZgQFhJEBfmVh8eL6','admin@cocoinbox.coom','img/user_perfil/default.jpg',NULL,1,'2017-10-24 18:23:27','2017-10-24 18:23:27');

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

insert  into `usuario`(`id`,`password`,`nombre`,`apellido`,`correo`,`foto_perfil`,`celular`,`customer_id_conekta`,`tipo`,`status`,`created_at`,`updated_at`) values (1,'a83f0f76c2afad4f5d7260824430b798','Conrado Antonios','Carrillo Rosales','anton_con@hotmail.com','img/usuario_app/default.jpg','9801010',NULL,1,1,'2017-10-24 22:40:39','2017-10-25 16:16:05'),(2,'a83f0f76c2afad4f5d7260824430b798','Manuel','Rosales','many@hotmail.com','img/usuario_app/default.jpg','6699333627',NULL,2,1,'2017-10-25 13:12:13','0000-00-00 00:00:00'),(11,'a83f0f76c2afad4f5d7260824430b798','sdasdasd','asdasdsda','admin@topali.com','img/usuario_app/default.jpg','213123',NULL,2,1,'2017-10-25 18:35:34','2017-10-25 18:35:34');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
