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


USE `db654555219`;

/*Table structure for table `NUT_CATEGORIAS` */

DROP TABLE IF EXISTS `NUT_CATEGORIAS`;

CREATE TABLE `NUT_CATEGORIAS` (
  `idCategoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `NUT_CATEGORIAS` */

insert  into `NUT_CATEGORIAS`(`idCategoria`,`nombre`,`descripcion`,`orden`) values (1,'Verduras orgánicas','Verduras frescas, recién cosechadas para maximizar su valor alimenticio',1),(2,'Frutas orgánicas','Frutas libres de pesticidas',2),(3,'Canastas orgánicas','Canastas de frutas y verduras preparadas, te resuelven el surtido de la semana',3),(4,'Almacén','Todo para una alacena saludable',4),(5,'Semillas, granos y frutos seco',NULL,5),(6,'Especias','Sazones y especias',6);

/*Table structure for table `NUT_CLIENTES` */

DROP TABLE IF EXISTS `NUT_CLIENTES`;

CREATE TABLE `NUT_CLIENTES` (
  `idCliente` bigint(20) NOT NULL AUTO_INCREMENT,
  `correo` varchar(200) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `celular` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `NUT_CLIENTES` */

insert  into `NUT_CLIENTES`(`idCliente`,`correo`,`nombre`,`celular`) values (1,'pselectronico@gmail.com','Juan Pablo Salazar','95464952'),(2,'pflores2@gmail.com','Pablo Flores','98642046');

/*Table structure for table `NUT_MARCAS` */

DROP TABLE IF EXISTS `NUT_MARCAS`;

CREATE TABLE `NUT_MARCAS` (
  `idMarca` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `idProveedor` bigint(20) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `NUT_MARCAS` */

insert  into `NUT_MARCAS`(`idMarca`,`nombre`,`idProveedor`) values (1,'34 Sur',1),(2,'Importadas',1),(3,'Campo Claro',2),(4,'Pequeña Granja',2),(5,'Valle del Sol',2),(6,'Graneco',3),(7,'Prana',4),(8,'La Trinidad',5);

/*Table structure for table `NUT_PEDIDOS` */

DROP TABLE IF EXISTS `NUT_PEDIDOS`;

CREATE TABLE `NUT_PEDIDOS` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `NUT_PEDIDOS` */

insert  into `NUT_PEDIDOS`(`idPedido`,`fecha_realizacion`,`fecha_entrega_estimada`,`fecha_entrega`,`idCliente`,`zona`,`direccion`,`direccion_aclaracion`,`horario`,`nota_cliente`,`nota_postventa`,`subtotal`,`costo_envio`,`total`,`estado`,`hash`) values (1,'2016-10-26 16:34:15','0000-00-00',NULL,2,'Malvín','Rivera 4430bis','esq. Colombes','','',NULL,'928.00','50.00','978.00','CONFIRMADO','1cc3633c579a90cfdd895e64021e2163'),(2,'2016-10-26 18:01:35','0000-00-00',NULL,2,'Malvín',' AMBROSIO VELAZCO 1471 AP 001.','ENTRE RIVERA Y ASAMBLEA.','','EN HORAS DE LA MAÑANA.',NULL,'1095.00','0.00','1095.00','CONFIRMADO','db2b4182156b2f1f817860ac9f409ad7'),(3,'2016-10-31 15:43:10','0000-00-00',NULL,2,'Punta Gorda','Caramurú 5733','Caramurú 5733','','',NULL,'13025.00','0.00','13025.00','INICIADO','9953a9514b2a810825f17416e1e32f7d'),(4,'2016-10-31 17:45:58','0000-00-00',NULL,2,'Buceo','Caramurú 5733','Caramurú 5733','','',NULL,'1257.00','0.00','1257.00','INICIADO','68a83eeb494a308fe5295da69428a507');

/*Table structure for table `NUT_PEDIDOS_DETALLE` */

DROP TABLE IF EXISTS `NUT_PEDIDOS_DETALLE`;

CREATE TABLE `NUT_PEDIDOS_DETALLE` (
  `idPedidoDetalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPedido` bigint(20) NOT NULL,
  `idProducto` bigint(20) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `cantidad_entregada` int(5) NOT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idPedidoDetalle`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `NUT_PEDIDOS_DETALLE` */

insert  into `NUT_PEDIDOS_DETALLE`(`idPedidoDetalle`,`idPedido`,`idProducto`,`cantidad`,`cantidad_entregada`,`precio`) values (1,1,6,1,0,'50'),(2,1,7,1,0,'60'),(3,1,8,1,0,'30'),(4,1,13,2,0,'80'),(5,1,16,1,0,'25'),(6,1,21,1,0,'40'),(7,1,23,2,0,'26'),(8,1,24,1,0,'60'),(9,1,26,1,0,'60'),(10,1,25,1,0,'35'),(11,1,28,1,0,'35'),(12,1,29,1,0,'60'),(13,1,30,1,0,'50'),(14,1,31,1,0,'95'),(15,1,32,1,0,'60'),(16,1,64,1,0,'116'),(17,1,119,1,0,'46'),(18,2,4,1,0,'120'),(19,2,6,1,0,'50'),(20,2,8,1,0,'60'),(21,2,9,1,0,'35'),(22,2,21,1,0,'40'),(23,2,24,3,0,'180'),(24,2,25,1,0,'35'),(25,2,26,1,0,'60'),(26,2,29,1,0,'60'),(27,2,30,1,0,'50'),(28,2,31,1,0,'95'),(29,2,32,1,0,'60'),(30,2,76,1,0,'134'),(31,2,64,1,0,'116'),(32,3,1,1,0,'35'),(33,3,2,1,0,'35'),(34,3,3,1,0,'35'),(35,3,4,1,0,'120'),(36,3,5,1,0,'50'),(37,3,6,1,0,'50'),(38,3,7,1,0,'60'),(39,3,8,1,0,'60'),(40,3,9,1,0,'35'),(41,3,10,1,0,'35'),(42,3,16,1,0,'25'),(43,3,11,1,0,'35'),(44,3,12,1,0,'60'),(45,3,13,1,0,'40'),(46,3,14,1,0,'70'),(47,3,15,1,0,'35'),(48,3,17,1,0,'25'),(49,3,18,1,0,'25'),(50,3,19,1,0,'35'),(51,3,20,1,0,'35'),(52,3,21,1,0,'40'),(53,3,22,1,0,'35'),(54,3,23,1,0,'13'),(55,3,24,1,0,'60'),(56,3,25,1,0,'35'),(57,3,26,1,0,'60'),(58,3,27,1,0,'60'),(59,3,28,1,0,'35'),(60,3,29,1,0,'60'),(61,3,30,1,0,'50'),(62,3,31,1,0,'95'),(63,3,32,1,0,'120'),(64,3,33,1,0,'300'),(65,3,34,1,0,'500'),(66,3,35,1,0,'750'),(67,3,36,1,0,'145'),(68,3,37,1,0,'320'),(69,3,38,1,0,'401'),(70,3,39,1,0,'2645'),(71,3,40,1,0,'185'),(72,3,41,1,0,'271'),(73,3,42,1,0,'2087'),(74,3,43,1,0,'397'),(75,3,44,1,0,'162'),(76,3,45,1,0,'1978'),(77,3,46,1,0,'86'),(78,3,58,1,0,'118'),(79,3,59,1,0,'92'),(80,3,60,1,0,'141'),(81,3,65,1,0,'135'),(82,3,76,1,0,'134'),(83,3,95,1,0,'119'),(84,3,102,1,0,'240'),(85,3,104,1,0,'47'),(86,3,105,1,0,'38'),(87,3,131,1,0,'41'),(88,3,143,1,0,'84'),(89,3,150,1,0,'46'),(90,4,24,3,0,'180'),(91,4,12,1,0,'60'),(92,4,7,1,0,'60'),(93,4,1,1,0,'35'),(94,4,13,2,0,'80'),(95,4,30,1,0,'50'),(96,4,25,1,0,'35'),(97,4,31,1,0,'95'),(98,4,32,1,0,'120'),(99,4,41,2,0,'542');

/*Table structure for table `NUT_PRODUCTOS` */

DROP TABLE IF EXISTS `NUT_PRODUCTOS`;

CREATE TABLE `NUT_PRODUCTOS` (
  `idProducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(10000) CHARACTER SET latin1 DEFAULT NULL,
  `idCategoria` bigint(20) NOT NULL,
  `idMarca` bigint(20) NOT NULL,
  `unidad` varchar(50) CHARACTER SET latin1 NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `iva` int(2) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  `stock` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProducto`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `NUT_PRODUCTOS` */

insert  into `NUT_PRODUCTOS`(`idProducto`,`nombre`,`descripcion`,`idCategoria`,`idMarca`,`unidad`,`precio`,`costo`,`iva`,`activo`,`stock`) values (1,'Acelga Verde',NULL,1,1,'atado','35','28.00',0,'',15),(2,'Acelga Tallo Amarillo',NULL,1,1,'atado','35','28.00',0,'',15),(3,'Apio de hoja',NULL,1,1,'atado','35','28.00',0,'',15),(4,'Arvejas',NULL,1,1,'Kg','120','96.00',0,'',15),(5,'Boniato Criollo',NULL,1,1,'Kg','50','40.00',0,'',15),(6,'Boniato zanahoria ',NULL,1,1,'Kg','50','40.00',0,'',15),(7,'Brócoli',NULL,1,1,'unidad','60','48.00',0,'',15),(8,'Cebolla',NULL,1,1,'Kg','60','48.00',0,'',15),(9,'Ciboullette',NULL,1,1,'atado','35','28.00',0,'',15),(10,'Cilantro',NULL,1,1,'atado','35','28.00',0,'',15),(11,'Cobe ',NULL,1,1,'atado','35','28.00',0,'',15),(12,'Coliflor',NULL,1,1,'unidad','60','48.00',0,'',15),(13,'Espinaca ',NULL,1,1,'atado','40','32.00',0,'',15),(14,'Habas',NULL,1,1,'Kg','70','56.00',0,'',15),(15,'Kale',NULL,1,1,'atado','35','28.00',0,'',15),(16,'Lechuga crespa verde ',NULL,1,1,'unidad','25','20.00',0,'',15),(17,'Lechuga mantecosa morada',NULL,1,1,'unidad','25','20.00',0,'',15),(18,'Lechuga hoja de roble verde',NULL,1,1,'unidad','25','20.00',0,'',15),(19,'Misuna verde ',NULL,1,1,'atado','35','28.00',0,'',15),(20,'Misuna roja ',NULL,1,1,'atado','35','28.00',0,'',15),(21,'Mix de verdes',NULL,1,1,'atado','40','32.00',0,'',15),(22,'Mostaza ',NULL,1,1,'atado','35','28.00',0,'',15),(23,'Nabos ',NULL,1,1,'unidad','13','10.40',0,'',15),(24,'Papas ',NULL,1,1,'Kg','60','48.00',0,'',15),(25,'Perejil común ',NULL,1,1,'atado','35','28.00',0,'',15),(26,'Remolacha',NULL,1,1,'atado','60','48.00',0,'',15),(27,'Repollo',NULL,1,1,'unidad','60','48.00',0,'',15),(28,'Rúcula ',NULL,1,1,'atado','35','28.00',0,'',15),(29,'Zanahoria',NULL,1,1,'Kg','60','48.00',0,'',15),(30,'Zapallo Kabutia',NULL,1,1,'Kg','50','40.00',0,'',15),(31,'Banana',NULL,2,2,'Kg','95','76.00',0,'',15),(32,'Frutilla',NULL,2,1,'Kg','120','96.00',0,'',15),(33,'Canasta pequeña',NULL,3,1,'canasta','300','240.00',0,'',15),(34,'Canasta mediana',NULL,3,1,'canasta','500','400.00',0,'',15),(35,'Canasta grande',NULL,3,1,'canasta','750','600.00',0,'',15),(36,'Aceite de Almendras',NULL,4,8,'50 ml','145','111.51',0,'',15),(37,'Aceite de Coco ',NULL,4,8,'350 gr','320','256.20',0,'',15),(38,'Aceite de Coco Orgánico',NULL,4,7,'500 ml','401','2204.58',0,'',15),(39,'Aceite de Coco Orgánico',NULL,4,7,'4 l','2645','2204.58',0,'',15),(40,'Aceite de Oliva Extra Virgen Orgánico',NULL,4,3,'250 ml','185','208.40',0,'',15),(41,'Aceite de Oliva Extra Virgen Orgánico',NULL,4,3,'500 ml','271','208.40',0,'',15),(42,'Aceite de Oliva Orgánico',NULL,4,5,'5 lt','2087','1605.30',0,'',15),(43,'Aceite de Sésamo Extra Virgen',NULL,4,8,'500 ml','397','305.00',0,'',15),(44,'Agave Orgánico',NULL,4,7,'330 ml','162','129.63',0,'',15),(45,'Agave Wild',NULL,4,7,'5,6 kg','1978','1648.00',0,'',15),(46,'Arroz Integral Orgánico',NULL,4,3,'1 Kg','86','66.50',0,'',15),(47,'Arroz Orgánico',NULL,4,3,'1 Kg','86','66.50',0,'',15),(48,'Azúcar de Coco Orgánico',NULL,4,7,'450 gr','290','223.42',0,'',15),(49,'Azúcar Orgánica',NULL,4,3,'900 gr','128','98.70',0,'',15),(50,'Boniatos en Conserva',NULL,4,4,'700 gr','137','105.00',0,'',15),(51,'Café Orgánico Instantáneo',NULL,4,3,'90 gr','152','117.00',0,'',15),(52,'Ciruelas en Conserva',NULL,4,4,'700 gr','155','118.90',0,'',15),(53,'Crema de Coco Orgánica',NULL,4,7,'4 lt','2791','2326.17',0,'',15),(54,'Harina de Arroz',NULL,4,8,'Kg','55','39.60',0,'',15),(55,'Harina de Chía',NULL,4,8,'Kg','274','211.06',0,'',15),(56,'Harina de Coco Orgánica',NULL,4,7,'450 gr','132','94.54',0,'',15),(57,'Harina Integral Orgánica',NULL,4,6,'1 Kg','78','90.40',0,'',15),(58,'Harina Integral Orgánica ',NULL,4,3,'1 Kg','118','90.40',0,'',15),(59,'Harina Orgánica  000',NULL,4,3,'1 Kg','92','70.40',0,'',15),(60,'Higos en Conserva',NULL,4,4,'700 gr','141','108.80',0,'',15),(61,'Ketchup Orgánica',NULL,4,3,'300 gr','134','103.00',0,'',15),(62,'Maca Peruana Orgánica',NULL,4,7,'100 gr','146','170.46',0,'',15),(63,'Maca Peruana Orgánica',NULL,4,7,'180 gr','222','170.46',0,'',15),(64,'Membrillos en Conserva',NULL,4,4,'700 gr','116','89.40',0,'',15),(65,'Mermelada De Durazno Orgánica ',NULL,4,3,'310 gr','135','103.50',0,'',15),(66,'Mermelada De Frutilla Orgánica ',NULL,4,3,'310 gr','116','89.40',0,'',15),(67,'Mermelada De Zapallo Orgánica ',NULL,4,3,'310 gr','108','83.00',0,'',15),(68,'Miel Orgánica Frasco Vidrio',NULL,4,3,'300 gr','144','110.50',0,'',15),(69,'Moñas En Bolsa',NULL,4,3,'500 gr','68','52.50',0,'',15),(70,'Néctar de coco Orgánico',NULL,4,7,'375 ml','400','2000.80',0,'',15),(71,'Néctar de coco Orgánico',NULL,4,7,'3 l','2401','2000.80',0,'',15),(72,'Peras Al Vino Tinto',NULL,4,4,'700 gr','172','132.30',0,'',15),(73,'Peras en Conserva',NULL,4,4,'700 gr','129','99.30',0,'',15),(74,'Polenta (harina de maíz) Orgánica',NULL,4,3,'500 gr','71','50.00',0,'',15),(75,'Polenta (harina de maíz) Orgánica',NULL,4,6,'500 gr','72','50.00',0,'',15),(76,'Pulpa De Tomate Concentrada Orgánica',NULL,4,3,'570 gr','134','103.40',0,'',15),(77,'Salsa Mediterranea Orgánica',NULL,4,3,'570 gr','210','161.80',0,'',15),(78,'Salsa Toscana Orgánica',NULL,4,3,'570 gr','167','128.60',0,'',15),(79,'Tallarines  En Bolsa',NULL,4,3,'500 gr','69','52.90',0,'',15),(80,'Trigo Sarraceno Orgánico',NULL,4,7,'400 gr','68','52.01',0,'',15),(81,'Vinagre de manzana Orgánico',NULL,4,7,'250 ml','167','128.10',0,'',15),(82,'Yerba Orgánica',NULL,4,3,'500 gr','104','86.40',0,'',15),(83,'Zapallos en Conserva',NULL,4,4,'700 gr','128','98.70',0,'',15),(84,'Bayas de Goji Orgánicas',NULL,5,7,'150 gr','253','486.78',0,'',15),(85,'Bayas de Goji Orgánicas',NULL,5,7,'400 gr','633','486.78',0,'',15),(86,'Chía',NULL,5,7,'200 gr','62','147.00',0,'',15),(87,'Chía',NULL,5,8,'Kg','235','147.00',0,'',15),(88,'Chia Orgánico ',NULL,5,3,'200 grs','86','114.90',0,'',15),(89,'Chia Orgánico ',NULL,5,3,'400 grs','149','114.90',0,'',15),(90,'Lino Semillas ',NULL,5,8,'50 grs','31','23.60',0,'',15),(91,'Pasas De Uva Tipo Sultanas',NULL,5,8,'50 grs','41','31.70',0,'',15),(92,'Quinoa ',NULL,5,8,'Kg','211','132.00',0,'',15),(93,'Quinoa Orgánica',NULL,5,3,'400 grs','190','146.20',0,'',15),(94,'Quinoa Roja Orgánica',NULL,5,8,'Kg','504','315.00',0,'',15),(95,'Semillas de Calabaza Orgánicas',NULL,5,7,'180 gr','119','227.77',0,'',15),(96,'Semillas de Calabaza Orgánicas',NULL,5,7,'450 gr','296','227.77',0,'',15),(97,'Sésamo Blanco',NULL,5,8,'100 grs','68','131.76',0,'',15),(98,'Sésamo Blanco',NULL,5,8,'Kg','211','131.76',0,'',15),(99,'Sésamo Integral ',NULL,5,8,'100 grs','52','101.00',0,'',15),(100,'Sésamo Integral ',NULL,5,8,'Kg','162','101.00',0,'',15),(101,'Sésamo Negro ',NULL,5,8,'100 grs','65','149.80',0,'',15),(102,'Sésamo Negro ',NULL,5,8,'Kg','240','149.80',0,'',15),(103,'Sésamo Orgánico ',NULL,4,3,'150 grs','59','45.00',0,'',15),(104,'Adobo',NULL,6,8,'50 grs','47','36.10',0,'',15),(105,'Ají Molido Orgánico',NULL,6,3,'25 grs','38','29.60',0,'',15),(106,'Ají Picante',NULL,6,8,'50 grs','45','34.80',0,'',15),(107,'Ajo Y Perejil Orgánico',NULL,6,3,'10 grs','44','34.20',0,'',15),(108,'Albahaca Seca Orgánica',NULL,6,3,'8 grs','38','29.10',0,'',15),(109,'Anís Semillas Tradicional',NULL,6,8,'50 grs','45','34.60',0,'',15),(110,'Azafrán Del País Orgánico',NULL,6,3,'5 grs','43','33.10',0,'',15),(111,'Canela En Rama',NULL,6,8,'50 grs','53','41.00',0,'',15),(112,'Canela Molida Pura',NULL,6,8,'50 grs','44','34.00',0,'',15),(113,'Cardamomo En Vainas',NULL,6,8,'50 grs','142','109.40',0,'',15),(114,'Ciboulette Ajo Orgánica',NULL,6,3,'10 grs','38','29.10',0,'',15),(115,'Ciboulette Orgánica',NULL,6,3,'10 grs','38','29.10',0,'',15),(116,'Cilantro Orgánico',NULL,6,3,'8 grs','38','29.10',0,'',15),(117,'Clavo De Olor En Grano',NULL,6,8,'50 grs','92','71.10',0,'',15),(118,'Comino En Grano',NULL,6,8,'50 grs','43','32.90',0,'',15),(119,'Cúrcuma Molida Pura',NULL,6,8,'50 grs','46','35.30',0,'',15),(120,'Cúrcuma Orgánica',NULL,6,7,'120 gr','146','112.47',0,'',15),(121,'Curry Picante',NULL,6,8,'50 grs','68','52.00',0,'',15),(122,'Curry Suave',NULL,6,8,'50 grs','62','47.50',0,'',15),(123,'Eneldo Orgánico',NULL,6,3,'10 grs','38','29.10',0,'',15),(124,'Estragón',NULL,6,8,'50 grs','195','149.80',0,'',15),(125,'Estragón Francés Orgánico',NULL,6,3,'10 grs','38','29.10',0,'',15),(126,'Estragón Orgánico',NULL,6,3,'10 grs','38','29.10',0,'',15),(127,'Hierbas Para Carnes Rojas Orgánicas',NULL,6,3,'10 grs','41','31.90',0,'',15),(128,'Hierbas Para Pescados Orgánicas',NULL,6,3,'10 grs','41','31.90',0,'',15),(129,'Hierbas Para Pizzas Orgánicas',NULL,6,3,'10 grs','41','31.90',0,'',15),(130,'Hierbas Para Pollos Orgánicas',NULL,6,3,'10 grs','41','31.90',0,'',15),(131,'Hierbas Para Quesos Y Salsas Orgánicas',NULL,6,3,'10 grs','41','31.90',0,'',15),(132,'Hinojo En Grano',NULL,6,8,'50 grs','39','30.00',0,'',15),(133,'Laurel Orgánico',NULL,6,3,'8 grs','33','25.20',0,'',15),(134,'Mejorana Orgánica',NULL,6,3,'10 grs','38','29.10',0,'',15),(135,'Menta Orgánica',NULL,6,3,'8 grs','38','29.10',0,'',15),(136,'Mostaza Negra En Grano ',NULL,6,8,'50 grs','34','25.90',0,'',15),(137,'Nuez Moscada Enteras',NULL,6,8,'50 grs','136','104.80',0,'',15),(138,'Orégano Limpio ',NULL,6,8,'50 grs','37','28.30',0,'',15),(139,'Orégano Orgánico',NULL,6,3,'15 grs','38','29.10',0,'',15),(140,'Pimentón Ahumado',NULL,6,8,'50 grs','51','39.50',0,'',15),(141,'Pimentón Molido Puro',NULL,6,8,'50 grs','46','35.10',0,'',15),(142,'Pimienta Blanca Molida Pura',NULL,6,8,'50 grs','126','97.10',0,'',15),(143,'Pimienta Negra En Grano Clasificada',NULL,6,8,'50 grs','84','64.30',0,'',15),(144,'Popurrí De Pimientas',NULL,6,8,'50 grs','128','98.20',0,'',15),(145,'Romero',NULL,6,8,'50 grs','42','32.10',0,'',15),(146,'Romero Orgánico',NULL,6,3,'10 grs','38','29.10',0,'',15),(147,'Sal De Ajo',NULL,6,8,'50 grs','37','28.20',0,'',15),(148,'Sal De Apio',NULL,6,8,'50 grs','35','27.20',0,'',15),(149,'Sal Rosada De Himalaya Fina',NULL,6,8,'100 grs','44','33.70',0,'',15),(150,'Sal Rosada De Himalaya Gruesa',NULL,6,8,'100 grs','46','35.10',0,'',15),(151,'Salvia Orgánico',NULL,6,3,'10 grs','38','29.10',0,'',15),(152,'Tomillo Orgánico',NULL,6,3,'10 grs','38','29.10',0,'',15);

/*Table structure for table `NUT_PROVEEDORES` */

DROP TABLE IF EXISTS `NUT_PROVEEDORES`;

CREATE TABLE `NUT_PROVEEDORES` (
  `idProveedor` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `NUT_PROVEEDORES` */

insert  into `NUT_PROVEEDORES`(`idProveedor`,`nombre`) values (1,'34 Sur'),(2,'Feral'),(3,'Graneco'),(4,'Prana');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
