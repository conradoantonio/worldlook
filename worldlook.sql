/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.1.21-MariaDB : Database - world_look
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`world_look` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `world_look`;

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`categoria`,`foto`,`created_at`,`updated_at`) values (1,'Cortes','img/default.jpg','2018-01-03 15:45:04','2017-09-29 20:16:21'),(2,'Maquillaje','img/default.jpg','2018-01-03 15:45:09','2017-09-29 20:16:36'),(3,'Depilación','img/default.jpg','2018-01-03 15:45:09','2017-09-29 20:16:44');

/*Table structure for table `cupones` */

DROP TABLE IF EXISTS `cupones`;

CREATE TABLE `cupones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) DEFAULT NULL,
  `tipo_cupon` varchar(30) DEFAULT NULL,
  `cantidad_servicios` int(11) DEFAULT '0',
  `cantidad_productos` int(11) DEFAULT '0',
  `porcentaje_descuento` int(11) DEFAULT '0',
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `cupones` */

insert  into `cupones`(`id`,`codigo`,`tipo_cupon`,`cantidad_servicios`,`cantidad_productos`,`porcentaje_descuento`,`usuario_id`,`fecha_inicio`,`fecha_fin`,`descripcion`,`created_at`,`updated_at`) values (1,'NAD1DAT9','general',0,0,20,NULL,'2017-09-26','2017-10-03','20% de descuento en tu próxima compra.','2017-09-26 16:10:48','2017-09-26 16:10:48');

/*Table structure for table `cupones_historial` */

DROP TABLE IF EXISTS `cupones_historial`;

CREATE TABLE `cupones_historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cupon_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `cupones_historial` */

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

/*Table structure for table `estilistas` */

DROP TABLE IF EXISTS `estilistas`;

CREATE TABLE `estilistas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `apellido` varchar(150) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `estilistas` */

insert  into `estilistas`(`id`,`usuario_id`,`nombre`,`apellido`,`descripcion`,`imagen`,`status`,`created_at`,`updated_at`) values (1,4,'Laura Daniela','Herrera Reyes','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','img/estilistas/1506442480.png',1,'2018-01-03 15:48:48','2018-01-03 21:48:48'),(2,5,'Rosa','Lizárraga Castro','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','img/estilistas/1514921341.jpg',1,'2018-01-02 13:29:01','2018-01-02 19:29:01');

/*Table structure for table `estilistas_categorias` */

DROP TABLE IF EXISTS `estilistas_categorias`;

CREATE TABLE `estilistas_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estilista_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `estilistas_categorias` */

/*Table structure for table `estilistas_subcategorias` */

DROP TABLE IF EXISTS `estilistas_subcategorias`;

CREATE TABLE `estilistas_subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estilista_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `estilistas_subcategorias` */

/*Table structure for table `genero` */

DROP TABLE IF EXISTS `genero`;

CREATE TABLE `genero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreGenero` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `genero` */

insert  into `genero`(`id`,`nombreGenero`,`status`,`created_at`,`updated_at`) values (1,'Femenino',1,'2017-01-23 17:13:32','2017-01-23 17:13:30'),(2,'Masculino',1,'2017-01-23 17:13:35','2017-01-23 17:13:33');

/*Table structure for table `noticias` */

DROP TABLE IF EXISTS `noticias`;

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `mensaje` text,
  `foto` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `noticias` */

insert  into `noticias`(`id`,`titulo`,`mensaje`,`foto`,`created_at`,`updated_at`) values (1,'Oferta en cortes de cabello','Por sólo este fin de semana, podrás disfrutar de un 20% de descuento en todos los cortes de cabello.','img/default.jpg','2017-12-14 18:04:46','2017-10-12 17:26:15'),(2,'Oferta número 2',' Obtén un corte de cabello gratis al pedir 3','img/default.jpg','2018-01-02 13:31:12','2018-01-02 19:31:12');

/*Table structure for table `preguntas_frecuentes` */

DROP TABLE IF EXISTS `preguntas_frecuentes`;

CREATE TABLE `preguntas_frecuentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ayuda_menu_id` int(11) DEFAULT NULL,
  `pregunta` text NOT NULL,
  `respuesta` text NOT NULL,
  `imagen` varchar(100) DEFAULT 'img/preguntas/default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `preguntas_frecuentes` */

insert  into `preguntas_frecuentes`(`id`,`ayuda_menu_id`,`pregunta`,`respuesta`,`imagen`) values (1,1,'¿La aplicación está disponible para android y ios?','Claro, la aplicación está disponible para ser instalada en cualquiera de las dos plataformas.','img/preguntas/1497635032.jpg'),(2,1,'¿Cuánto tiempo tardan en aprobar mi usuario para usar la aplicación?','Nos tardamos hasta 48 horas máximo en revisar tu solicitud y aprobar tu usuario en la aplicación.','img/preguntas/1497635045.jpg'),(3,2,'¿Que pasa si me tarjeta no cuenta con el saldo suficiente?','Si tu tarjeta no cuenta con el saldo suficiente para realizar la compra, se lanzara un mensaje con la leyenda de: el crédito de esta cuenta ha sido alcanzado.','img/preguntas/1503076050.jpg'),(4,3,'¿Que hacer cuando tu tarjeta no ha podido ser verificada?','Cuando tu tarjeta no puede ser verificada aparece un mensaje que dice: ¡Cuidado! Datos del cliente incorrectos: El token no existe.\r\n\r\nEste problema se puede presentar cuando nuestra conexión a internet no es tan buena, ya sea por medio de wifi o datos.\r\n\r\nPara corregir esto es muy importante corroborar que estemos con una buena conexión a internet y posterior a esto hay que pulsar nuevamente en la tarjeta con la cual vamos a realizar la compra y dar comprar.\r\n','img/preguntas/1499364173.jpg'),(5,4,'¿Cuando saber si se realizo mi cobro? ','Cuando tu compra se realizo correctamente deberá aparecer un mensaje que diga: ¡Gracias por tu pago! En la opción de pedidos, puede visualizarse sus compras. \r\n\r\n','img/preguntas/1499364127.jpg');

/*Table structure for table `registro_logs` */

DROP TABLE IF EXISTS `registro_logs`;

CREATE TABLE `registro_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `fechaLogin` date DEFAULT NULL,
  `realTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `registro_logs` */

insert  into `registro_logs`(`id`,`user_id`,`fechaLogin`,`realTime`) values (1,2,'2017-09-20',NULL),(2,2,'2017-09-20','2017-09-20 12:49:48'),(3,2,'2017-09-21','2017-09-21 16:21:45'),(4,2,'2017-09-21','2017-09-21 16:44:27'),(5,3,'2017-09-21',NULL),(6,2,'2017-09-21','2017-09-21 16:57:53'),(7,2,'2017-09-24','2017-09-24 14:28:00'),(8,2,'2017-09-25','2017-09-25 10:17:12'),(9,2,'2017-09-25','2017-09-25 10:36:02'),(10,1,'2017-09-25','2017-09-25 10:50:26'),(11,2,'2017-09-25','2017-09-25 15:30:48'),(12,2,'2017-09-25','2017-09-25 15:43:12'),(13,2,'2017-09-26','2017-09-26 10:35:55'),(14,2,'2017-09-26','2017-09-26 12:26:54'),(15,2,'2017-09-26','2017-09-26 17:38:38'),(16,2,'2017-09-27','2017-09-27 11:43:05'),(17,2,'2017-09-27','2017-09-27 16:25:49'),(18,2,'2017-09-27','2017-09-27 16:43:07'),(19,2,'2017-09-27','2017-09-27 17:49:37'),(20,2,'2017-09-27','2017-09-27 18:16:37'),(21,2,'2017-09-27','2017-09-27 22:29:12'),(22,4,'2017-09-28','2017-09-28 10:32:23'),(23,2,'2017-09-28','2017-09-28 11:11:39'),(24,4,'2017-09-28','2017-09-28 11:12:37');

/*Table structure for table `servicio_detalles` */

DROP TABLE IF EXISTS `servicio_detalles`;

CREATE TABLE `servicio_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio_id` int(11) DEFAULT NULL,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `foto_producto` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `servicio_detalles` */

insert  into `servicio_detalles`(`id`,`servicio_id`,`nombre_producto`,`foto_producto`,`precio`,`cantidad`,`tipo`,`created_at`,`updated_at`) values (1,1,'Lorem ipsum dolor sit amet','img/productos/Layer 1.png','4000.00',2,'producto','2017-09-26 12:13:12','2017-09-26 12:13:12'),(2,1,'Lorem ipsum dolor','img/productos/Layer 13.png','9000.00',3,'producto','2017-09-26 12:13:12','2017-09-26 12:13:12'),(3,2,'Corte pelo niño.',NULL,'10000.00',1,'servicio','2017-09-27 16:51:14','2017-09-27 16:51:14'),(4,2,'Peinado de trenzas',NULL,'20000.00',1,'servicio','2017-09-27 16:51:14','2017-09-27 16:51:14'),(5,3,'Lorem ipsum','img/productos/Layer 8.png','8900.00',5,'producto','2017-09-27 16:57:01','2017-09-27 16:57:01'),(6,3,'Lorem ipsum dolor','img/productos/Layer 13.png','9000.00',5,'producto','2017-09-27 16:57:01','2017-09-27 16:57:01'),(7,3,'Corte para niño (honguito)',NULL,'6000.00',1,'servicio','2017-09-27 16:57:01','2017-09-27 16:57:01'),(8,4,'Corte pelo niño.',NULL,'10000.00',3,'servicio','2017-09-27 17:11:55','2017-09-27 17:11:55'),(9,4,'Peinado de trenzas',NULL,'20000.00',1,'servicio','2017-09-27 17:11:55','2017-09-27 17:11:55'),(10,4,'Lorem ipsum','img/productos/Layer 8.png','8900.00',1,'producto','2017-09-27 17:11:55','2017-09-27 17:11:55'),(11,4,'Lorem ipsum dolor','img/productos/Layer 13.png','9000.00',1,'producto','2017-09-27 17:11:55','2017-09-27 17:11:55'),(12,5,'Corte pelo niño.',NULL,'10000.00',1,'servicio','2017-09-27 17:38:17','2017-09-27 17:38:17'),(13,5,'Lorem ipsum dolor sit amet','img/productos/Layer 1.png','4000.00',1,'producto','2017-09-27 17:38:17','2017-09-27 17:38:17');

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `correo_cliente` varchar(100) DEFAULT NULL,
  `conekta_order_id` varchar(255) DEFAULT NULL,
  `customer_id_conekta` varchar(255) DEFAULT NULL,
  `costo_total` double DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `recibidor` varchar(255) DEFAULT NULL,
  `calle` text,
  `entre` text,
  `num_ext` varchar(10) DEFAULT NULL,
  `num_int` varchar(10) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `pais` varchar(5) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `comentarios` text,
  `datetime_formated` varchar(200) DEFAULT NULL,
  `start_datetime` timestamp NULL DEFAULT NULL,
  `end_datetime` timestamp NULL DEFAULT NULL,
  `estilista_id` int(11) DEFAULT '0',
  `status` varchar(10) DEFAULT NULL,
  `is_finished` tinyint(4) DEFAULT '0',
  `puntuacion_estilista` int(11) DEFAULT NULL,
  `puntuacion_usuario` int(11) DEFAULT NULL,
  `comentario_estilista` text,
  `comentario_usuario` text,
  `last_digits` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `servicios` */

insert  into `servicios`(`id`,`nombre_cliente`,`correo_cliente`,`conekta_order_id`,`customer_id_conekta`,`costo_total`,`telefono`,`recibidor`,`calle`,`entre`,`num_ext`,`num_int`,`ciudad`,`estado`,`pais`,`codigo_postal`,`comentarios`,`datetime_formated`,`start_datetime`,`end_datetime`,`estilista_id`,`status`,`is_finished`,`puntuacion_estilista`,`puntuacion_usuario`,`comentario_estilista`,`comentario_usuario`,`last_digits`,`created_at`,`updated_at`) values (1,'Roberto','roberto_gb23@hotmail.com','ord_2hH5xunjngTeVf1zC','cus_2hFTzmN79uJiCwYYS',35000,'6691626966','Roberto Garcia Barboza','Av. Lopez Mateos','Av. Lazaro Cardenas','202','250','Zapopan','Jalisco','MX','44009',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',0,'paid',1,NULL,NULL,NULL,NULL,NULL,'2017-09-26 12:13:12','2017-09-28 22:21:53'),(2,'Roberto','roberto_gb23@hotmail.com','ord_2hHUazeDZgZ4FHSX4','cus_2hFTzmN79uJiCwYYS',30000,'6691626966','Roberto Garcia Barboza','Av. Lopez Mateos','Av. Lazaro Cardenas','202','250','Zapopan','Jalisco','MX','44009',NULL,NULL,'2017-09-20 11:30:00','2017-09-20 15:30:00',0,'paid',1,NULL,NULL,NULL,NULL,NULL,'2017-09-27 16:51:14','2017-09-27 16:51:14'),(3,'Conrado','anton_con@hotmail.com','ord_2hHUfQpXErtA38ouK','cus_2hDXW2ChyEarhD2zg',95500,'6699333627','Conrado Antonio Carrillo Rosales','Salvador Madariaga Colonia Jardines de universidad ','Naciones unidas y Rafael Sanzio','5125','16','Zapopan','Jalisco','MX','45110','Lorem ipsum dolor et amet',NULL,'2017-09-10 11:30:00','2017-09-10 13:30:00',0,'paid',0,NULL,NULL,NULL,NULL,NULL,'2017-09-27 16:57:01','2017-09-27 16:57:01'),(4,'Roberto','roberto_gb23@hotmail.com','ord_2hHUrnpzj686iLFxH','cus_2hFTzmN79uJiCwYYS',67900,'6691626966','Roberto Garcia Barboza','Av. Lopez Mateos','Av. Lazaro Cardenas','202','250','Zapopan','Jalisco','MX','44009',NULL,NULL,'2017-09-20 00:00:00','2017-09-20 03:05:00',0,'paid',0,NULL,NULL,NULL,NULL,NULL,'2017-09-27 17:11:55','2017-09-27 17:11:55'),(5,'Roberto','roberto_gb23@hotmail.com','ord_2hHVCvvDjkoMhDbib','cus_2hFTzmN79uJiCwYYS',14000,'6691626966','Roberto Garcia Barboza','Av. Lopez Mateos','Av. Lazaro Cardenas','202','250','Zapopan','Jalisco','MX','44009','Agregando un comentario.',NULL,'2017-09-22 00:00:00','2017-09-22 00:45:00',1,'paid',0,5,5,'Muy buen estilista','Todo salió correctamente',NULL,'2017-09-27 17:38:17','2017-09-27 22:41:22');

/*Table structure for table `subcategorias` */

DROP TABLE IF EXISTS `subcategorias`;

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `subcategoria` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `subcategorias` */

insert  into `subcategorias`(`id`,`categoria_id`,`subcategoria`,`foto`,`descripcion`,`created_at`,`updated_at`) values (1,1,'Honguito','img/default.jpg','peinado de shostin viver','2018-01-03 15:46:14',NULL),(2,1,'Benito juarez','img/default.jpg','corte de librito','2018-01-03 15:46:40',NULL),(3,2,'Rostro','img/default.jpg','Hace un maquillaje basico de rostro','2018-01-03 15:47:09',NULL),(4,2,'Ojos','img/default.jpg','Maquillaje que incluye delineado en los ojos','2018-01-03 15:47:26',NULL),(5,3,'Brasileño','img/default.jpg','Duele mucho','2018-01-03 15:47:49',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`user`,`password`,`email`,`foto_usuario`,`remember_token`,`status`,`created_at`,`updated_at`) values (1,'conrado.carrillo','$2y$10$MJJRyjM7Ubmtf2Au/VzWC.BL1YBxF9moTcJda0cdXg9bOw/FMOM5y','anton_con@hotmail.com','img/user_perfil/default.jpg','ox8kmJBROTICTAqVmcmYzHEYX9KYbiQU02UfO99bpyZUcUknWgnbuR7sP0lx',1,'2017-03-23 11:30:45','2017-12-14 22:56:07'),(2,'admin','$2y$10$f5qOMC5k2fFgKY2tp3tTe.RrB8MqZBfV4BP32NAdidqLJP2Q/K3FK','admin@kidscut.com','img/user_perfil/default.jpg','UQf3D1ahENAZxpxhwbzJFpBqBwkBjTlvrvNomI3ZRcRghuVIXxIM9VyeKles',1,'2017-08-17 17:34:22','2017-08-17 23:14:55');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `foto_perfil` varchar(100) DEFAULT 'http://adminworldlook.bsmx.tech/public/img/user_perfil/default.jpg',
  `celular` varchar(18) DEFAULT NULL,
  `customer_id_conekta` varchar(255) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT '1',
  `red_social` tinyint(4) DEFAULT NULL,
  `player_id` varchar(155) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`password`,`nombre`,`apellido`,`correo`,`foto_perfil`,`celular`,`customer_id_conekta`,`tipo`,`red_social`,`player_id`,`status`,`created_at`,`updated_at`) values (1,'a83f0f76c2afad4f5d7260824430b798','Conrado Antonio','Carrillo Rosales','anton_con@hotmail.com','img/usuario_app/default.jpg','6699333627','cus_2hDXW2ChyEarhD2zg',1,NULL,NULL,1,'2017-09-08 17:05:42','2017-09-28 17:22:10'),(2,'684c851af59965b680086b7b4896ff98','Roberto','García','roberto_gb23@hotmail.com','img/usuario_app/default.jpg','6691626966','cus_2hFTzmN79uJiCwYYS',1,NULL,NULL,1,'2017-09-20 16:09:24','2017-09-20 16:09:24'),(3,'202cb962ac59075b964b07152d234b70','Omar ','Mendozs ','mcflay5@gmail.com','img/usuario_app/default.jpg','3316056031','cus_2hFWtKfZa1Qv1rqRw',1,NULL,NULL,1,'2017-09-21 21:44:46','2017-09-21 21:44:46'),(4,'a83f0f76c2afad4f5d7260824430b798','Laura Daniela','Herrera Reyes','laudany@hotmail.com','img/default.jpg',NULL,NULL,2,NULL,NULL,1,'2017-09-26 11:14:40','2017-12-14 23:10:27'),(5,'a83f0f76c2afad4f5d7260824430b798','Rosa','Lizárraga Castro','rosa_lizarraga@hotmail.com','img/default.jpg',NULL,NULL,2,NULL,NULL,1,'2017-09-26 11:16:47','2017-12-14 23:09:03');

/*Table structure for table `usuario_direcciones` */

DROP TABLE IF EXISTS `usuario_direcciones`;

CREATE TABLE `usuario_direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `recibidor` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `entre` text,
  `num_ext` varchar(10) DEFAULT NULL,
  `num_int` varchar(10) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `pais` varchar(10) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `residencial` tinyint(4) DEFAULT NULL,
  `is_main` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `usuario_direcciones` */

insert  into `usuario_direcciones`(`id`,`usuario_id`,`recibidor`,`calle`,`entre`,`num_ext`,`num_int`,`estado`,`ciudad`,`pais`,`codigo_postal`,`residencial`,`is_main`,`created_at`,`updated_at`) values (1,1,'Conrado Antonio Carrillo Rosales','Salvador Madariaga Colonia Jardines de universidad ','Naciones unidas y Rafael Sanzio','5125','16','Jalisco','Zapopan','MX','45110',0,0,'2017-09-12 22:50:51','2017-09-26 16:05:10'),(2,2,'Roberto Garcia Barboza','Av. Lopez Mateos','Av. Lazaro Cardenas','202','250','Jalisco','Zapopan','MX','44009',1,0,'2017-09-26 15:37:33','2017-09-26 16:06:56'),(3,2,'Juan Hernandez','Av. Chapultepec','Col. Americana','203','202','Jalisco','Zapopan','MX','44009',0,0,'2017-09-26 16:41:44','2017-09-26 16:41:44'),(4,2,'Diana Hernandez','Av. Lázaro Cardenas','Av. López Mateos','190','222','Jalisco','Zapopan','MX','44004',1,0,'2017-09-26 16:55:16','2017-09-26 16:55:16'),(5,2,'asd','ASD','asd','21','12','Jalisco','12as','MX','12',1,0,'2017-09-26 17:08:21','2017-09-26 17:08:21'),(6,1,'Conrado Antonio Carrillo Rosales','Jardines de universidad Salvador Madariaga',NULL,'5125','16','Jalisco','Zapopan','MX','45110',1,0,'2017-10-11 23:09:50','2017-10-11 23:09:50'),(7,1,'Conrado Antonio Carrillo Rosales','Jardines de universidad Salvador Madariaga','Naciones unidas y Eqa do queiros','5125','16','Jalisco','Zapopan','MX','45110',1,0,'2017-10-11 23:12:02','2017-10-11 23:12:02'),(8,1,'Conrado Antonio Carrillo Rosales','Jardines de universidad Salvador Madariaga','Naciones unidas y Eqa do queiros','5125','16','Jalisco','Zapopan','MX','45110',1,0,'2017-10-11 23:12:41','2017-10-11 23:12:41');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
