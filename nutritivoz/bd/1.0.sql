/*
SQLyog Community v8.71 
MySQL - 5.5.49-cll-lve : Database - nutritivozOSB
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nutritivozOSB` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `nutritivozOSB`;

/*Table structure for table `nut_categorias` */

DROP TABLE IF EXISTS `nut_categorias`;

CREATE TABLE `nut_categorias` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_categorias` */

insert  into `nut_categorias`(`id`,`nombre`,`descripcion`,`orden`) values (1,'Verduras orgánicas','Verduras frescas, recién cosechadas para maximizar su valor alimenticio',1),(2,'Frutas orgánicas','Frutas libres de pesticidas',2);

/*Table structure for table `nut_clientes` */

DROP TABLE IF EXISTS `nut_clientes`;

CREATE TABLE `nut_clientes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `correo` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `celular` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_clientes` */

/*Table structure for table `NUT_ESTADOSPEDIDO` */

DROP TABLE IF EXISTS `NUT_ESTADOSPEDIDO`;

CREATE TABLE `NUT_ESTADOSPEDIDO` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `NUT_ESTADOSPEDIDO` */

/*Table structure for table `nut_marcas` */

DROP TABLE IF EXISTS `nut_marcas`;

CREATE TABLE `nut_marcas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `proveedor_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_marcas` */

/*Table structure for table `nut_pedidos` */

DROP TABLE IF EXISTS `nut_pedidos`;

CREATE TABLE `nut_pedidos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_realizacion` datetime NOT NULL,
  `fecha_entrega_estimada` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `cliente_id` bigint(20) NOT NULL,
  `zona` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `direccion_aclaracion` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `horario` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nota_cliente` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `nota_postventa` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `estado_id` bigint(20) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `costo_envio` decimal(5,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_pedidos` */

/*Table structure for table `nut_pedidos_detalle` */

DROP TABLE IF EXISTS `nut_pedidos_detalle`;

CREATE TABLE `nut_pedidos_detalle` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pedido_id` bigint(20) NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `cantidad_entregada` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_pedidos_detalle` */

/*Table structure for table `nut_productos` */

DROP TABLE IF EXISTS `nut_productos`;

CREATE TABLE `nut_productos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `categoria_id` bigint(20) NOT NULL,
  `marca_id` bigint(20) NOT NULL,
  `unidad` varchar(50) CHARACTER SET latin1 NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `iva` int(2) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  `stock` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_productos` */

/*Table structure for table `nut_proveedores` */

DROP TABLE IF EXISTS `nut_proveedores`;

CREATE TABLE `nut_proveedores` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_proveedores` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
