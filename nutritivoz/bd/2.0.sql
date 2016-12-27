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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`NutritivozOSBTest` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `NutritivozOSBTest`;

/*Table structure for table `nut_categorias` */

DROP TABLE IF EXISTS `nut_categorias`;

CREATE TABLE `nut_categorias` (
  `idCategoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_categorias` */

insert  into `nut_categorias`(`idCategoria`,`nombre`,`descripcion`,`orden`) values (1,'Verduras orgánicas','Verduras frescas, recién cosechadas para maximizar su valor alimenticio',1),(2,'Frutas orgánicas','Frutas libres de pesticidas',2),(3,'Canastas orgánicas','Canastas de frutas y verduras preparadas, te resuelven el surtido de la semana',3),(4,'Almacén','Todo para una alacena saludable',4),(5,'Semillas, granos y frutos seco',NULL,5),(6,'Especias','Sazones y especias',6);

/*Table structure for table `nut_clientes` */

DROP TABLE IF EXISTS `nut_clientes`;

CREATE TABLE `nut_clientes` (
  `idCliente` bigint(20) NOT NULL AUTO_INCREMENT,
  `correo` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `celular` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_clientes` */

insert  into `nut_clientes`(`idCliente`,`correo`,`nombre`,`celular`) values (1,'pselectronico@gmail.com','Juan Pablo Salazar','95464952'),(2,'pflores2@gmail.com','Pablo Flores','98642046');

/*Table structure for table `nut_marcas` */

DROP TABLE IF EXISTS `nut_marcas`;

CREATE TABLE `nut_marcas` (
  `idMarca` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `idProveedor` bigint(20) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_marcas` */

insert  into `nut_marcas`(`idMarca`,`nombre`,`idProveedor`) values (1,'34 Sur',1),(2,'Importadas',1),(3,'Campo Claro',2),(4,'Pequeña Granja',2),(5,'Valle del Sol',2),(6,'Graneco',3),(7,'Prana',4),(8,'La Trinidad',5);

/*Table structure for table `nut_pedidos` */

DROP TABLE IF EXISTS `nut_pedidos`;

CREATE TABLE `nut_pedidos` (
  `idPedido` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_realizacion` datetime NOT NULL,
  `fecha_entrega_estimada` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `idCliente` bigint(20) NOT NULL,
  `zona` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `direccion_aclaracion` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `horario` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nota_cliente` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `nota_postventa` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `costo_envio` decimal(5,2) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('INICIADO','CONFIRMADO','ENTREGADO','CANCELADO') COLLATE latin1_spanish_ci DEFAULT 'INICIADO',
  `hash` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_pedidos` */

/*Table structure for table `nut_pedidos_detalle` */

DROP TABLE IF EXISTS `nut_pedidos_detalle`;

CREATE TABLE `nut_pedidos_detalle` (
  `idPedidoDetalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPedido` bigint(20) NOT NULL,
  `idProducto` bigint(20) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `cantidad_entregada` int(5) NOT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idPedidoDetalle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_pedidos_detalle` */

/*Table structure for table `nut_productos` */

DROP TABLE IF EXISTS `nut_productos`;

CREATE TABLE `nut_productos` (
  `idProducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(10000) CHARACTER SET latin1 DEFAULT NULL,
  `idCategoria` bigint(20) NOT NULL,
  `idMarca` bigint(20) NOT NULL,
  `unidad` varchar(50) CHARACTER SET latin1 NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `costo` decimal(10,0) DEFAULT NULL,
  `iva` int(2) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  `stock` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProducto`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_productos` */

insert  into `nut_productos`(`idProducto`,`nombre`,`descripcion`,`idCategoria`,`idMarca`,`unidad`,`precio`,`costo`,`iva`,`activo`,`stock`) values (1,'Acelga Verde',NULL,1,1,'atado','35',NULL,0,'',15),(2,'Acelga Tallo Amarillo',NULL,1,1,'atado','35',NULL,0,'',15),(3,'Apio de hoja',NULL,1,1,'atado','35',NULL,0,'',15),(4,'Arvejas',NULL,1,1,'Kg','120',NULL,0,'',15),(5,'Boniato Criollo',NULL,1,1,'Kg','50',NULL,0,'',15),(6,'Boniato zanahoria ',NULL,1,1,'Kg','50',NULL,0,'',15),(7,'Brócoli',NULL,1,1,'unidad','60',NULL,0,'',15),(8,'Cebolla',NULL,1,1,'Kg','60',NULL,0,'',15),(9,'Ciboullette',NULL,1,1,'atado','35',NULL,0,'',15),(10,'Cilantro',NULL,1,1,'atado','35',NULL,0,'',15),(11,'Cobe ',NULL,1,1,'atado','35',NULL,0,'',15),(12,'Coliflor',NULL,1,1,'unidad','60',NULL,0,'',15),(13,'Espinaca ',NULL,1,1,'atado','40',NULL,0,'',15),(14,'Habas',NULL,1,1,'Kg','70',NULL,0,'',15),(15,'Kale',NULL,1,1,'atado','35',NULL,0,'',15),(16,'Lechuga crespa verde ',NULL,1,1,'unidad','25',NULL,0,'',15),(17,'Lechuga mantecosa morada',NULL,1,1,'unidad','25',NULL,0,'',15),(18,'Lechuga hoja de roble verde',NULL,1,1,'unidad','25',NULL,0,'',15),(19,'Misuna verde ',NULL,1,1,'atado','35',NULL,0,'',15),(20,'Misuna roja ',NULL,1,1,'atado','35',NULL,0,'',15),(21,'Mix de verdes',NULL,1,1,'atado','40',NULL,0,'',15),(22,'Mostaza ',NULL,1,1,'atado','35',NULL,0,'',15),(23,'Nabos ',NULL,1,1,'unidad','13',NULL,0,'',15),(24,'Papas ',NULL,1,1,'Kg','60',NULL,0,'',15),(25,'Perejil común ',NULL,1,1,'atado','35',NULL,0,'',15),(26,'Remolacha',NULL,1,1,'atado','60',NULL,0,'',15),(27,'Repollo',NULL,1,1,'unidad','60',NULL,0,'',15),(28,'Rúcula ',NULL,1,1,'atado','35',NULL,0,'',15),(29,'Zanahoria',NULL,1,1,'Kg','60',NULL,0,'',15),(30,'Zapallo Kabutia',NULL,1,1,'Kg','50',NULL,0,'',15),(31,'Banana',NULL,2,2,'Kg','95',NULL,0,'',15),(32,'Frutilla',NULL,2,1,'Kg','120',NULL,0,'',15),(33,'Canasta pequeña',NULL,3,1,'canasta','500',NULL,0,'',15),(34,'Canasta mediana',NULL,3,1,'canasta','500',NULL,0,'',15),(35,'Canasta grande',NULL,3,1,'canasta','750',NULL,0,'',15),(36,'Aceite de Almendras',NULL,4,8,'50 ml','145',NULL,0,'',15),(37,'Aceite de Coco ',NULL,4,8,'350 gr','320',NULL,0,'',15),(38,'Aceite de Coco Orgánico',NULL,4,7,'500 ml','401',NULL,0,'',15),(39,'Aceite de Coco Orgánico',NULL,4,7,'4 l','2645',NULL,0,'',15),(40,'Aceite de Oliva Extra Virgen Orgánico',NULL,4,3,'250 ml','185',NULL,0,'',15),(41,'Aceite de Oliva Extra Virgen Orgánico',NULL,4,3,'500 ml','271',NULL,0,'',15),(42,'Aceite de Oliva Orgánico',NULL,4,5,'5 lt','2087',NULL,0,'',15),(43,'Aceite de Sésamo Extra Virgen',NULL,4,8,'500 ml','397',NULL,0,'',15),(44,'Agave Orgánico',NULL,4,7,'330 ml','162',NULL,0,'',15),(45,'Agave Wild',NULL,4,7,'5,6 kg','1978',NULL,0,'',15),(46,'Arroz Integral Orgánico',NULL,4,3,'1 Kg','86',NULL,0,'',15),(47,'Arroz Orgánico',NULL,4,3,'1 Kg','86',NULL,0,'',15),(48,'Azúcar de Coco Orgánico',NULL,4,7,'450 gr','290',NULL,0,'',15),(49,'Azúcar Orgánica',NULL,4,3,'900 gr','128',NULL,0,'',15),(50,'Boniatos en Conserva',NULL,4,4,'700 gr','137',NULL,0,'',15),(51,'Café Orgánico Instantáneo',NULL,4,3,'90 gr','152',NULL,0,'',15),(52,'Ciruelas en Conserva',NULL,4,4,'700 gr','155',NULL,0,'',15),(53,'Crema de Coco Orgánica',NULL,4,7,'4 lt','2791',NULL,0,'',15),(54,'Harina de Arroz',NULL,4,8,'Kg','55',NULL,0,'',15),(55,'Harina de Chía',NULL,4,8,'Kg','274',NULL,0,'',15),(56,'Harina de Coco Orgánica',NULL,4,7,'450 gr','132',NULL,0,'',15),(57,'Harina Integral Orgánica',NULL,4,6,'1 Kg','78',NULL,0,'',15),(58,'Harina Integral Orgánica ',NULL,4,3,'1 Kg','118',NULL,0,'',15),(59,'Harina Orgánica  000',NULL,4,3,'1 Kg','92',NULL,0,'',15),(60,'Higos en Conserva',NULL,4,4,'700 gr','141',NULL,0,'',15),(61,'Ketchup Orgánica',NULL,4,3,'300 gr','134',NULL,0,'',15),(62,'Maca Peruana Orgánica',NULL,4,7,'100 gr','146',NULL,0,'',15),(63,'Maca Peruana Orgánica',NULL,4,7,'180 gr','222',NULL,0,'',15),(64,'Membrillos en Conserva',NULL,4,4,'700 gr','116',NULL,0,'',15),(65,'Mermelada De Durazno Orgánica ',NULL,4,3,'310 gr','135',NULL,0,'',15),(66,'Mermelada De Frutilla Orgánica ',NULL,4,3,'310 gr','116',NULL,0,'',15),(67,'Mermelada De Zapallo Orgánica ',NULL,4,3,'310 gr','108',NULL,0,'',15),(68,'Miel Orgánica Frasco Vidrio',NULL,4,3,'300 gr','144',NULL,0,'',15),(69,'Moñas En Bolsa',NULL,4,3,'500 gr','68',NULL,0,'',15),(70,'Néctar de coco Orgánico',NULL,4,7,'375 ml','400',NULL,0,'',15),(71,'Néctar de coco Orgánico',NULL,4,7,'3 l','2401',NULL,0,'',15),(72,'Peras Al Vino Tinto',NULL,4,4,'700 gr','172',NULL,0,'',15),(73,'Peras en Conserva',NULL,4,4,'700 gr','129',NULL,0,'',15),(74,'Polenta (harina de maíz) Orgánica',NULL,4,3,'500 gr','71',NULL,0,'',15),(75,'Polenta (harina de maíz) Orgánica',NULL,4,6,'500 gr','72',NULL,0,'',15),(76,'Pulpa De Tomate Concentrada Orgánica',NULL,4,3,'570 gr','134',NULL,0,'',15),(77,'Salsa Mediterranea Orgánica',NULL,4,3,'570 gr','210',NULL,0,'',15),(78,'Salsa Toscana Orgánica',NULL,4,3,'570 gr','167',NULL,0,'',15),(79,'Tallarines  En Bolsa',NULL,4,3,'500 gr','69',NULL,0,'',15),(80,'Trigo Sarraceno Orgánico',NULL,4,7,'400 gr','68',NULL,0,'',15),(81,'Vinagre de manzana Orgánico',NULL,4,7,'250 ml','167',NULL,0,'',15),(82,'Yerba Orgánica',NULL,4,3,'500 gr','104',NULL,0,'',15),(83,'Zapallos en Conserva',NULL,4,4,'700 gr','128',NULL,0,'',15),(84,'Bayas de Goji Orgánicas',NULL,5,7,'150 gr','253',NULL,0,'',15),(85,'Bayas de Goji Orgánicas',NULL,5,7,'400 gr','633',NULL,0,'',15),(86,'Chía',NULL,5,7,'200 gr','62',NULL,0,'',15),(87,'Chía',NULL,5,8,'Kg','235',NULL,0,'',15),(88,'Chia Orgánico ',NULL,5,3,'200 grs','86',NULL,0,'',15),(89,'Chia Orgánico ',NULL,5,3,'400 grs','149',NULL,0,'',15),(90,'Lino Semillas ',NULL,5,8,'50 grs','31',NULL,0,'',15),(91,'Pasas De Uva Tipo Sultanas',NULL,5,8,'50 grs','41',NULL,0,'',15),(92,'Quinoa ',NULL,5,8,'Kg','211',NULL,0,'',15),(93,'Quinoa Orgánica',NULL,5,3,'400 grs','190',NULL,0,'',15),(94,'Quinoa Roja Orgánica',NULL,5,8,'Kg','504',NULL,0,'',15),(95,'Semillas de Calabaza Orgánicas',NULL,5,7,'180 gr','119',NULL,0,'',15),(96,'Semillas de Calabaza Orgánicas',NULL,5,7,'450 gr','296',NULL,0,'',15),(97,'Sésamo Blanco',NULL,5,8,'100 grs','68',NULL,0,'',15),(98,'Sésamo Blanco',NULL,5,8,'Kg','211',NULL,0,'',15),(99,'Sésamo Integral ',NULL,5,8,'100 grs','52',NULL,0,'',15),(100,'Sésamo Integral ',NULL,5,8,'Kg','162',NULL,0,'',15),(101,'Sésamo Negro ',NULL,5,8,'100 grs','65',NULL,0,'',15),(102,'Sésamo Negro ',NULL,5,8,'Kg','240',NULL,0,'',15),(103,'Sésamo Orgánico ',NULL,4,3,'150 grs','59',NULL,0,'',15),(104,'Adobo',NULL,6,8,'50 grs','47',NULL,0,'',15),(105,'Ají Molido Orgánico',NULL,6,3,'25 grs','38',NULL,0,'',15),(106,'Ají Picante',NULL,6,8,'50 grs','45',NULL,0,'',15),(107,'Ajo Y Perejil Orgánico',NULL,6,3,'10 grs','44',NULL,0,'',15),(108,'Albahaca Seca Orgánica',NULL,6,3,'8 grs','38',NULL,0,'',15),(109,'Anís Semillas Tradicional',NULL,6,8,'50 grs','45',NULL,0,'',15),(110,'Azafrán Del País Orgánico',NULL,6,3,'5 grs','43',NULL,0,'',15),(111,'Canela En Rama',NULL,6,8,'50 grs','53',NULL,0,'',15),(112,'Canela Molida Pura',NULL,6,8,'50 grs','44',NULL,0,'',15),(113,'Cardamomo En Vainas',NULL,6,8,'50 grs','142',NULL,0,'',15),(114,'Ciboulette Ajo Orgánica',NULL,6,3,'10 grs','38',NULL,0,'',15),(115,'Ciboulette Orgánica',NULL,6,3,'10 grs','38',NULL,0,'',15),(116,'Cilantro Orgánico',NULL,6,3,'8 grs','38',NULL,0,'',15),(117,'Clavo De Olor En Grano',NULL,6,8,'50 grs','92',NULL,0,'',15),(118,'Comino En Grano',NULL,6,8,'50 grs','43',NULL,0,'',15),(119,'Cúrcuma Molida Pura',NULL,6,8,'50 grs','46',NULL,0,'',15),(120,'Cúrcuma Orgánica',NULL,6,7,'120 gr','146',NULL,0,'',15),(121,'Curry Picante',NULL,6,8,'50 grs','68',NULL,0,'',15),(122,'Curry Suave',NULL,6,8,'50 grs','62',NULL,0,'',15),(123,'Eneldo Orgánico',NULL,6,3,'10 grs','38',NULL,0,'',15),(124,'Estragón',NULL,6,8,'50 grs','195',NULL,0,'',15),(125,'Estragón Francés Orgánico',NULL,6,3,'10 grs','38',NULL,0,'',15),(126,'Estragón Orgánico',NULL,6,3,'10 grs','38',NULL,0,'',15),(127,'Hierbas Para Carnes Rojas Orgánicas',NULL,6,3,'10 grs','41',NULL,0,'',15),(128,'Hierbas Para Pescados Orgánicas',NULL,6,3,'10 grs','41',NULL,0,'',15),(129,'Hierbas Para Pizzas Orgánicas',NULL,6,3,'10 grs','41',NULL,0,'',15),(130,'Hierbas Para Pollos Orgánicas',NULL,6,3,'10 grs','41',NULL,0,'',15),(131,'Hierbas Para Quesos Y Salsas Orgánicas',NULL,6,3,'10 grs','41',NULL,0,'',15),(132,'Hinojo En Grano',NULL,6,8,'50 grs','39',NULL,0,'',15),(133,'Laurel Orgánico',NULL,6,3,'8 grs','33',NULL,0,'',15),(134,'Mejorana Orgánica',NULL,6,3,'10 grs','38',NULL,0,'',15),(135,'Menta Orgánica',NULL,6,3,'8 grs','38',NULL,0,'',15),(136,'Mostaza Negra En Grano ',NULL,6,8,'50 grs','34',NULL,0,'',15),(137,'Nuez Moscada Enteras',NULL,6,8,'50 grs','136',NULL,0,'',15),(138,'Orégano Limpio ',NULL,6,8,'50 grs','37',NULL,0,'',15),(139,'Orégano Orgánico',NULL,6,3,'15 grs','38',NULL,0,'',15),(140,'Pimentón Ahumado',NULL,6,8,'50 grs','51',NULL,0,'',15),(141,'Pimentón Molido Puro',NULL,6,8,'50 grs','46',NULL,0,'',15),(142,'Pimienta Blanca Molida Pura',NULL,6,8,'50 grs','126',NULL,0,'',15),(143,'Pimienta Negra En Grano Clasificada',NULL,6,8,'50 grs','84',NULL,0,'',15),(144,'Popurrí De Pimientas',NULL,6,8,'50 grs','128',NULL,0,'',15),(145,'Romero',NULL,6,8,'50 grs','42',NULL,0,'',15),(146,'Romero Orgánico',NULL,6,3,'10 grs','38',NULL,0,'',15),(147,'Sal De Ajo',NULL,6,8,'50 grs','37',NULL,0,'',15),(148,'Sal De Apio',NULL,6,8,'50 grs','35',NULL,0,'',15),(149,'Sal Rosada De Himalaya Fina',NULL,6,8,'100 grs','44',NULL,0,'',15),(150,'Sal Rosada De Himalaya Gruesa',NULL,6,8,'100 grs','46',NULL,0,'',15),(151,'Salvia Orgánico',NULL,6,3,'10 grs','38',NULL,0,'',15),(152,'Tomillo Orgánico',NULL,6,3,'10 grs','38',NULL,0,'',15);

/*Table structure for table `nut_proveedores` */

DROP TABLE IF EXISTS `nut_proveedores`;

CREATE TABLE `nut_proveedores` (
  `idProveedor` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_proveedores` */

insert  into `nut_proveedores`(`idProveedor`,`nombre`) values (1,'34 Sur'),(2,'Feral'),(3,'Graneco'),(4,'Prana');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
