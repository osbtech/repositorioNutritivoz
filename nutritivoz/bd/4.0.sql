/*
SQLyog Community v8.71 
MySQL - 5.7.12-log : Database - nutrutivozosb
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`nutrutivozosb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `nutrutivozosb`;

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_clientes` */

insert  into `nut_clientes`(`idCliente`,`correo`,`nombre`,`celular`) values (1,'pselectronico@gmail.com','Juan Pablo Salazar','095464952'),(2,'pflores2@gmail.com','Pablo Flores','098642046'),(3,'pflores2@gmail.com-pselectronico.gmail.com','Pablo Flores','98642046'),(4,'laluji@vera.com.uy','Luján Ameneiros','099342282'),(5,'imazulch@hotmail.com','Imazul Chiarelli','094741913'),(6,'irisleoni2009@gmail.com','Iris Leoni de Jesús','099128802'),(7,'virgimendez@hotmail.com','Virginia Méndez','095525200'),(8,'titicui@hotmail.com','Tin el Toro','099122245.'),(9,'pauneus1970@yahoo.com','Paula Villafañe','092 367090'),(10,'m.zinogarcia@gmail.com','María Zino','099460551'),(11,'mlsastre@hotmail.com','María Laura Sastre','099 17 46 26'),(12,'veroverde81@hotmail.com','Veronica Verde','091431249'),(13,'amalilagos@gmail.com','Amalia Lagos','099470127'),(14,'ignaciocasal@gmail.com','Juan Ignacio Casal','099206865'),(15,'riley@sinergiacowork.com','Riley Maguire','121212'),(16,'anatru@gmail.com','Ana Trujillo2','INDICAR2'),(17,'mireloc_3@hotmail.com','Mirel Oudri Cáceres','INDICAR'),(18,'romerzoc@hotmail.com','Rosario Zoccola','099555024'),(19,'cremiro@gmail.com','Claudio','099765640'),(20,'angiesuy@gmail.com','Andrea P','099005276');

/*Table structure for table `nut_marcas` */

DROP TABLE IF EXISTS `nut_marcas`;

CREATE TABLE `nut_marcas` (
  `idMarca` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `idProveedor` bigint(20) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_marcas` */

insert  into `nut_marcas`(`idMarca`,`nombre`,`idProveedor`) values (1,'34 Sur',1),(2,'Importadas',1),(3,'Campo Claro',2),(4,'Pequeña Granja',2),(5,'Valle del Sol',2),(6,'Graneco',3),(7,'Prana',4),(8,'La Trinidad',5),(9,'Nutritívoz',6);

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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_pedidos` */

insert  into `nut_pedidos`(`idPedido`,`fecha_realizacion`,`fecha_entrega_estimada`,`fecha_entrega`,`idCliente`,`zona`,`direccion`,`direccion_aclaracion`,`horario`,`nota_cliente`,`nota_postventa`,`subtotal`,`costo_envio`,`total`,`estado`,`hash`) values (1,'2016-11-02 16:44:22','0000-00-00',NULL,4,'Centro','Paraguay 1547/106','Centro','','Después de las 11',NULL,'667.50','50.00','717.50','ENTREGADO','275fe72bd87a41922431c30a0c6beeab'),(2,'2016-11-02 17:43:01','0000-00-00',NULL,1,'Pocitos','Av brasil 2420','esq obligado','','',NULL,'460.00','50.00','510.00','ENTREGADO','9b70e8fe62e40c570a322f1b0b659098'),(3,'2016-11-02 22:54:04','0000-00-00',NULL,5,'Malvín','Rivera 4430bis','esq. Colombes','','',NULL,'1054.00','0.00','1054.00','ENTREGADO','8597a6cfa74defcbde3047c891d78f90'),(4,'2016-11-02 23:03:40','0000-00-00',NULL,6,'Punta Gorda','Caramurú 5733','Esq. Rocafuerte','','',NULL,'405.00','100.00','505.00','ENTREGADO','17d63b1625c816c22647a73e1482372b'),(5,'2016-11-02 23:13:04','0000-00-00',NULL,2,'Punta Gorda','Caramurú 5733','Esq. Rocafuerte','','',NULL,'497.00','50.00','547.00','ENTREGADO','3a0772443a0739141292a5429b952fe6'),(6,'2016-11-03 13:05:43','0000-00-00',NULL,7,'Solymar','Santa paula manzana 166 solar 14','Solymar. ','','',NULL,'524.00','50.00','574.00','ENTREGADO','ccc0aa1b81bf81e16c676ddb977c5881'),(7,'2016-11-03 13:19:55','0000-00-00',NULL,8,'Buceo','Anzani 2081 timbre 2','entre Av. Italia y Hugo Antuña','','Hasta las 12',NULL,'595.00','50.00','645.00','ENTREGADO','4daa3db355ef2b0e64b472968cb70f0d'),(8,'2016-11-03 13:55:57','0000-00-00',NULL,9,'Prado / Nueva Savona','Miguel Cane 3686 esquina Artega. ','','','',NULL,'821.00','50.00','871.00','ENTREGADO','024d7f84fff11dd7e8d9c510137a2381'),(14,'2016-11-03 15:21:01','0000-00-00',NULL,10,'Punta Carretas','Domingo Cullen 717 Ap.301.','Esq. Bvar Artigas','','',NULL,'1691.00','0.00','1691.00','ENTREGADO','7283518d47a05a09d33779a17adf1707'),(10,'2016-11-03 14:09:38','0000-00-00',NULL,11,'Punta Gorda','San Marino 1421','','','',NULL,'610.00','50.00','660.00','ENTREGADO','85fc37b18c57097425b52fc7afbb6969'),(11,'2016-11-03 14:25:37','0000-00-00',NULL,12,'Aguada','99','','','',NULL,'1488.00','0.00','1488.00','ENTREGADO','96a93ba89a5b5c6c226e49b88973f46e'),(12,'2016-11-03 14:31:04','0000-00-00',NULL,13,'Cordón','Chaná 2236/11','entre paullier y requena','','',NULL,'815.00','50.00','865.00','ENTREGADO','0a113ef6b61820daa5611c870ed8d5ee'),(13,'2016-11-03 14:41:17','0000-00-00',NULL,14,'Pocitos','Avenida Brasil 2594 / 701','','','Se entrega pimentón ahumado de gentileza.',NULL,'608.00','50.00','658.00','ENTREGADO','c804afd77fea1afcdd9644f57bc2bf14'),(15,'2016-11-07 15:29:22','0000-00-00',NULL,15,'Carrasco Norte','calle 234','esq nrr','','ggggg',NULL,'155.00','100.00','255.00','INICIADO','2b8a61594b1f4c4db0902a8a395ced93'),(16,'2016-11-08 19:08:34','0000-00-00',NULL,16,'Aires Puros','INDICAR2','2','','2',NULL,'772.00','50.00','822.00','INICIADO','192fc044e74dffea144f9ac5dc9f3395'),(17,'2016-11-08 19:19:18','0000-00-00',NULL,12,'La Teja','Ruperto Perez Martinez 438 ','esq Gobernador del Pino','','',NULL,'1480.00','0.00','1480.00','INICIADO','e655c7716a4b3ea67f48c6322fc42ed6'),(18,'2016-11-09 13:15:21','0000-00-00',NULL,7,'Aguada','Santa paula manzana 166 solar 14','','','Solimar',NULL,'362.00','100.00','462.00','INICIADO','0c74b7f78409a4022a2c4c5a5ca3ee19'),(19,'2016-11-10 09:48:52','0000-00-00',NULL,17,'Aguada','INDICAR','','','',NULL,'1029.00','0.00','1029.00','INICIADO','1579779b98ce9edb98dd85606f2c119d'),(20,'2016-11-10 10:02:11','0000-00-00',NULL,9,'Prado / Nueva Savona','Miguel Cane 3686 esquina Artega. ','','','',NULL,'793.00','50.00','843.00','INICIADO','1141938ba2c2b13f5505d7c424ebae5f'),(21,'2016-11-10 10:45:17','0000-00-00',NULL,1,'Pocitos','Av brasil 2420','esquina obligado','','',NULL,'536.00','50.00','586.00','INICIADO','5ea1649a31336092c05438df996a3e59'),(22,'2016-11-10 10:45:31','0000-00-00',NULL,18,'Prado / Nueva Savona','Agraciada 3610 (esq. Buschental). ','','','Desde las 14hs',NULL,'1425.00','0.00','1425.00','INICIADO','8fb5f8be2aa9d6c64a04e3ab9f63feee'),(23,'2016-11-10 11:15:11','0000-00-00',NULL,19,'La Blanqueada','Susviela guarch 2982 401','Jaime cibils y centenario','','',NULL,'550.00','50.00','600.00','INICIADO','8b16ebc056e613024c057be590b542eb'),(24,'2016-11-10 11:25:56','0000-00-00',NULL,20,'Cordón','Constituyente 1736 apto 502 esq. Magallanes. ','','','De 10 a 12',NULL,'799.00','50.00','849.00','INICIADO','3b5dca501ee1e6d8cd7b905f4e1bf723'),(25,'2016-11-10 11:30:20','0000-00-00',NULL,14,'Pocitos','Avenida Brasil 2594 / 701','','','',NULL,'565.00','50.00','615.00','INICIADO','258be18e31c8188555c2ff05b4d542c3'),(26,'2016-11-10 11:34:07','0000-00-00',NULL,11,'Punta Gorda','San Marino 1421 ','','','',NULL,'702.00','50.00','752.00','INICIADO','07c5807d0d927dcd0980f86024e5208b');

/*Table structure for table `nut_pedidos_detalle` */

DROP TABLE IF EXISTS `nut_pedidos_detalle`;

CREATE TABLE `nut_pedidos_detalle` (
  `idPedidoDetalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `idPedido` bigint(20) NOT NULL,
  `idProducto` bigint(20) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `cantidad_entregada` decimal(10,2) NOT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idPedidoDetalle`)
) ENGINE=MyISAM AUTO_INCREMENT=411 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_pedidos_detalle` */

insert  into `nut_pedidos_detalle`(`idPedidoDetalle`,`idPedido`,`idProducto`,`cantidad`,`cantidad_entregada`,`precio`) values (1,1,12,'2.00','2.00','120'),(2,1,15,'1.00','1.00','35'),(3,1,21,'2.00','2.00','80'),(4,1,19,'1.00','1.00','35'),(5,1,26,'1.00','1.00','60'),(6,1,31,'0.50','0.50','48'),(7,1,109,'1.00','1.00','45'),(8,1,50,'1.00','0.00','137'),(9,1,67,'1.00','1.00','108'),(10,2,31,'1.00','1.00','95'),(11,2,107,'2.00','2.00','88'),(12,2,136,'1.00','1.00','34'),(13,2,3,'1.00','1.00','35'),(14,2,12,'1.00','1.00','60'),(15,2,7,'1.00','1.00','60'),(16,2,21,'1.00','1.00','40'),(17,2,10,'1.00','1.00','35'),(18,3,30,'1.00','1.00','50'),(19,3,13,'2.00','2.00','80'),(20,3,21,'1.00','1.00','40'),(21,3,16,'1.00','1.00','25'),(22,3,153,'1.00','1.00','35'),(23,3,155,'0.50','0.50','45'),(24,3,8,'0.50','0.50','30'),(25,3,12,'1.00','1.00','60'),(26,3,26,'1.00','1.00','60'),(27,3,31,'1.00','1.00','95'),(28,3,32,'0.50','0.00','60'),(29,3,83,'2.00','2.00','256'),(30,3,64,'2.00','2.00','232'),(31,3,119,'1.00','1.00','46'),(32,4,13,'2.00','2.00','80'),(33,4,16,'1.00','1.00','25'),(34,4,24,'2.00','2.00','120'),(35,4,6,'1.00','1.00','50'),(36,4,9,'1.00','1.00','35'),(37,4,31,'1.00','1.00','95'),(38,5,7,'1.00','1.00','60'),(39,5,10,'2.00','2.00','70'),(40,5,21,'3.00','3.00','120'),(41,5,153,'1.00','1.00','35'),(42,5,154,'1.00','1.00','35'),(43,5,155,'0.50','0.50','45'),(44,5,32,'0.50','0.00','60'),(45,5,46,'1.00','1.00','86'),(46,5,150,'1.00','1.00','46'),(49,2,23,'1.00','1.00','13'),(48,2,111,'1.00','0.00','41'),(50,6,18,'1.00','1.00','25'),(51,6,23,'1.00','1.00','13'),(52,6,28,'2.00','2.00','70'),(53,6,30,'1.00','1.00','50'),(54,6,32,'1.00','0.00','120'),(55,6,41,'1.00','0.00','271'),(56,6,63,'1.00','1.00','222'),(57,6,68,'1.00','1.00','144'),(58,7,24,'3.00','3.00','180'),(59,7,12,'1.00','1.00','60'),(60,7,7,'1.00','1.00','60'),(61,7,1,'1.00','1.00','35'),(62,7,30,'1.00','1.00','50'),(63,7,13,'2.00','2.00','80'),(64,7,25,'1.00','1.00','35'),(65,7,31,'1.00','1.00','95'),(66,7,32,'1.00','0.00','120'),(67,7,41,'1.00','0.00','271'),(68,8,34,'1.00','1.00','500'),(69,8,3,'1.00','1.00','35'),(70,8,7,'1.00','1.00','60'),(71,8,15,'1.00','1.00','35'),(72,8,29,'0.50','0.50','30'),(73,8,155,'0.50','0.50','45'),(74,8,21,'1.00','1.00','40'),(75,8,153,'1.00','1.00','35'),(76,8,91,'1.00','1.00','41'),(77,8,24,'1.00','1.00','60'),(149,14,26,'2.00','2.00','120'),(148,14,25,'1.00','1.00','35'),(147,14,23,'6.00','6.00','78'),(146,14,21,'2.00','2.00','80'),(145,14,19,'1.00','1.00','35'),(144,14,18,'1.00','1.00','25'),(143,14,14,'1.00','1.00','70'),(142,14,153,'2.00','2.00','70'),(141,14,4,'0.50','0.50','60'),(140,14,10,'2.00','2.00','70'),(139,14,9,'1.00','1.00','35'),(138,14,7,'1.00','1.00','60'),(137,14,1,'1.00','1.00','35'),(136,14,34,'1.00','1.00','500'),(92,10,153,'1.00','1.00','35'),(93,10,3,'1.00','1.00','35'),(94,10,6,'0.50','0.50','25'),(95,10,8,'1.00','1.00','60'),(96,10,13,'3.00','3.00','120'),(97,10,18,'1.00','1.00','25'),(98,10,24,'3.00','3.00','180'),(99,10,28,'1.00','1.00','35'),(100,10,31,'1.00','1.00','95'),(101,11,153,'1.00','1.00','35'),(102,11,3,'1.00','1.00','35'),(103,11,7,'1.00','1.00','60'),(104,11,12,'1.00','1.00','60'),(105,11,13,'1.00','1.00','40'),(106,11,16,'1.00','1.00','25'),(107,11,18,'1.00','1.00','25'),(108,11,20,'1.00','1.00','35'),(109,11,22,'1.00','1.00','35'),(110,11,155,'1.50','1.50','135'),(111,11,154,'1.00','1.00','35'),(112,11,67,'1.00','1.00','108'),(113,11,68,'1.00','1.00','144'),(114,11,80,'1.00','1.00','68'),(115,11,93,'1.00','0.00','190'),(116,11,104,'1.00','1.00','47'),(117,11,105,'1.00','0.00','38'),(118,11,106,'1.00','1.00','45'),(119,11,123,'1.00','0.00','38'),(120,11,124,'1.00','1.00','195'),(121,11,133,'1.00','1.00','33'),(122,11,139,'1.00','1.00','38'),(123,11,144,'1.00','1.00','128'),(124,11,135,'1.00','1.00','38'),(125,11,145,'1.00','1.00','42'),(126,11,149,'1.00','1.00','44'),(127,11,152,'1.00','1.00','38'),(128,12,35,'1.00','1.00','750'),(129,12,155,'1.00','1.00','90'),(130,12,154,'1.00','1.00','35'),(131,13,34,'1.00','1.00','500'),(132,13,29,'1.00','1.00','60'),(133,13,12,'1.00','1.00','60'),(134,13,31,'0.50','0.50','48'),(135,13,140,'1.00','1.00','0'),(150,14,27,'1.00','1.00','60'),(151,14,28,'2.00','2.00','70'),(152,14,155,'3.00','3.00','270'),(153,14,57,'1.00','1.00','78'),(163,13,156,'1.00','1.00','-60'),(164,12,156,'1.00','1.00','-60'),(165,8,156,'1.00','1.00','-60'),(166,14,156,'1.00','1.00','-60'),(410,16,8,'2.00','0.00','120'),(409,16,131,'1.00','0.00','35'),(408,16,93,'1.00','0.00','162'),(407,16,68,'1.00','0.00','122'),(406,16,47,'1.00','0.00','73'),(405,16,13,'1.00','0.00','40'),(404,16,155,'1.00','0.00','90'),(403,16,26,'1.00','0.00','60'),(402,16,22,'1.00','0.00','35'),(401,16,1,'1.00','0.00','35'),(185,17,153,'1.00','0.00','35'),(186,17,3,'1.00','0.00','35'),(187,17,7,'1.00','0.00','60'),(188,17,12,'1.00','0.00','60'),(189,17,13,'2.00','0.00','80'),(190,17,16,'2.00','0.00','50'),(191,17,20,'1.00','0.00','35'),(192,17,22,'1.00','0.00','35'),(193,17,155,'1.50','0.00','135'),(194,17,154,'1.00','0.00','35'),(195,17,67,'1.00','0.00','92'),(196,17,68,'1.00','0.00','122'),(197,17,80,'1.00','0.00','68'),(198,17,93,'1.00','0.00','162'),(199,17,104,'1.00','0.00','40'),(200,17,105,'1.00','0.00','32'),(201,17,106,'1.00','0.00','38'),(202,17,123,'1.00','0.00','32'),(203,17,126,'1.00','0.00','32'),(204,17,133,'1.00','0.00','28'),(205,17,139,'1.00','0.00','32'),(206,17,144,'1.00','0.00','109'),(207,17,135,'1.00','0.00','32'),(208,17,146,'1.00','0.00','32'),(209,17,149,'1.00','0.00','37'),(210,17,152,'1.00','0.00','32'),(211,18,13,'1.00','0.00','40'),(212,18,16,'2.00','0.00','50'),(213,18,155,'1.00','0.00','90'),(214,18,65,'1.00','0.00','115'),(215,18,146,'1.00','0.00','32'),(216,18,28,'1.00','0.00','35'),(217,19,35,'1.00','0.00','750'),(218,19,68,'1.00','0.00','122'),(219,19,40,'1.00','0.00','157'),(220,20,34,'1.00','0.00','500'),(221,20,1,'1.00','0.00','35'),(222,20,15,'1.00','0.00','35'),(223,20,21,'1.00','0.00','40'),(224,20,49,'1.00','0.00','109'),(225,20,107,'1.00','0.00','37'),(226,20,149,'1.00','0.00','37'),(227,21,7,'1.00','0.00','60'),(228,21,12,'1.00','0.00','60'),(229,21,24,'1.00','0.00','60'),(230,21,31,'1.00','0.00','95'),(231,21,21,'1.00','0.00','40'),(232,21,68,'1.00','0.00','122'),(233,21,23,'2.00','0.00','26'),(234,21,47,'1.00','0.00','73'),(235,22,1,'3.00','0.00','105'),(236,22,5,'3.00','0.00','210'),(237,22,8,'2.00','0.00','120'),(238,22,12,'2.00','0.00','120'),(239,22,16,'5.00','0.00','125'),(240,22,24,'3.00','0.00','180'),(241,22,154,'2.00','0.00','70'),(242,22,26,'2.00','0.00','120'),(243,22,27,'1.00','0.00','60'),(244,22,28,'1.00','0.00','35'),(245,22,30,'2.00','0.00','100'),(246,22,32,'1.50','0.00','180'),(247,23,6,'1.00','0.00','70'),(248,23,15,'1.00','0.00','35'),(249,23,13,'2.00','0.00','80'),(250,23,16,'1.00','0.00','25'),(251,23,21,'1.00','0.00','40'),(252,23,24,'1.00','0.00','60'),(253,23,30,'1.00','0.00','50'),(254,23,8,'1.00','0.00','60'),(255,23,31,'1.00','0.00','95'),(256,23,25,'1.00','0.00','35'),(257,24,153,'1.00','0.00','35'),(258,24,3,'1.00','0.00','35'),(259,24,8,'1.00','0.00','60'),(260,24,15,'1.00','0.00','35'),(261,24,25,'1.00','0.00','35'),(262,24,26,'1.00','0.00','60'),(263,24,16,'2.00','0.00','50'),(264,24,13,'3.00','0.00','120'),(265,24,28,'1.00','0.00','35'),(266,24,29,'1.00','0.00','60'),(267,24,30,'1.00','0.00','50'),(268,24,155,'0.50','0.00','45'),(269,24,92,'1.00','0.00','179'),(270,25,6,'1.00','0.00','70'),(271,25,13,'4.00','0.00','160'),(272,25,15,'2.00','0.00','70'),(273,25,25,'1.00','0.00','35'),(274,25,31,'2.00','0.00','190'),(275,25,21,'1.00','0.00','40'),(276,26,153,'1.00','0.00','35'),(277,26,13,'3.00','0.00','120'),(278,26,16,'1.00','0.00','25'),(279,26,21,'1.00','0.00','40'),(280,26,24,'3.00','0.00','180'),(281,26,28,'1.00','0.00','35'),(282,26,31,'1.00','0.00','95'),(283,26,107,'1.00','0.00','37'),(284,26,145,'1.00','0.00','36'),(285,26,66,'1.00','0.00','99'),(383,15,32,'1.00','0.00','120'),(382,15,153,'1.00','0.00','35');

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
  `costo` decimal(10,2) DEFAULT NULL,
  `iva` int(2) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  `stock` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProducto`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_productos` */

insert  into `nut_productos`(`idProducto`,`nombre`,`descripcion`,`idCategoria`,`idMarca`,`unidad`,`precio`,`costo`,`iva`,`activo`,`stock`) values (1,'Acelga Verde',NULL,1,1,'atado','35','28.00',0,'',15),(2,'Acelga Tallo Amarillo',NULL,1,1,'atado','35','28.00',0,'',15),(3,'Apio de hoja',NULL,1,1,'atado','35','28.00',0,'',15),(4,'Arvejas',NULL,1,1,'Kg','120','96.00',0,'',15),(5,'Boniato Criollo',NULL,1,1,'Kg','70','40.00',0,'',15),(6,'Boniato zanahoria ',NULL,1,1,'Kg','70','40.00',0,'',15),(7,'Brócoli',NULL,1,1,'unidad','60','48.00',0,'',15),(8,'Cebolla',NULL,1,1,'Kg','60','48.00',0,'',15),(9,'Ciboullette',NULL,1,1,'atado','35','28.00',0,'',15),(10,'Cilantro',NULL,1,1,'atado','35','28.00',0,'',15),(11,'Cobe ',NULL,1,1,'atado','35','28.00',0,'',15),(12,'Coliflor',NULL,1,1,'unidad','60','48.00',0,'',15),(13,'Espinaca ',NULL,1,1,'atado','40','32.00',0,'',15),(14,'Habas',NULL,1,1,'Kg','70','56.00',0,'',15),(15,'Kale',NULL,1,1,'atado','35','28.00',0,'',15),(16,'Lechuga crespa verde ',NULL,1,1,'unidad','25','20.00',0,'',15),(17,'Lechuga mantecosa morada',NULL,1,1,'unidad','25','20.00',0,'\0',15),(18,'Lechuga hoja de roble morada',NULL,1,1,'unidad','25','20.00',0,'\0',15),(19,'Misuna verde ',NULL,1,1,'atado','35','28.00',0,'',15),(20,'Misuna roja ',NULL,1,1,'atado','35','28.00',0,'',15),(21,'Mix de verdes',NULL,1,1,'atado','40','32.00',0,'',15),(22,'Mostaza ',NULL,1,1,'atado','35','28.00',0,'',15),(23,'Nabos ',NULL,1,1,'unidad','13','10.40',0,'',15),(24,'Papas ',NULL,1,1,'Kg','60','48.00',0,'',15),(25,'Perejil común ',NULL,1,1,'atado','35','28.00',0,'',15),(26,'Remolacha',NULL,1,1,'atado','60','48.00',0,'',15),(27,'Repollo',NULL,1,1,'unidad','60','48.00',0,'',15),(28,'Rúcula ',NULL,1,1,'atado','35','28.00',0,'',15),(29,'Zanahoria',NULL,1,1,'Kg','60','48.00',0,'',15),(30,'Zapallo Kabutia',NULL,1,1,'Kg','50','40.00',0,'',15),(31,'Banana',NULL,2,2,'Kg','95','76.00',0,'',15),(32,'Frutilla',NULL,2,1,'Kg','120','96.00',0,'',15),(33,'Canasta pequeña',NULL,3,1,'canasta','300','240.00',0,'',15),(34,'Canasta mediana',NULL,3,1,'canasta','500','400.00',0,'',15),(35,'Canasta grande',NULL,3,1,'canasta','750','600.00',0,'',15),(36,'Aceite de Almendras',NULL,4,8,'50 ml','123','111.51',0,'',15),(37,'Aceite de Coco ',NULL,4,8,'350 gr','272','256.20',0,'',15),(38,'Aceite de Coco Orgánico',NULL,4,7,'500 ml','401','2204.58',0,'',15),(39,'Aceite de Coco Orgánico',NULL,4,7,'4 l','2645','2204.58',0,'',15),(40,'Aceite de Oliva Extra Virgen Orgánico',NULL,4,3,'250 ml','157','208.40',0,'',15),(41,'Aceite de Oliva Extra Virgen Orgánico',NULL,4,3,'500 ml','230','208.40',0,'',15),(42,'Aceite de Oliva Orgánico',NULL,4,5,'5 lt','2087','1605.30',0,'',15),(43,'Aceite de Sésamo Extra Virgen',NULL,4,8,'500 ml','337','305.00',0,'',15),(44,'Agave Orgánico',NULL,4,7,'330 ml','162','129.63',0,'',15),(45,'Agave Wild',NULL,4,7,'5,6 kg','1978','1648.00',0,'',15),(46,'Arroz Integral Orgánico',NULL,4,3,'1 Kg','73','66.50',0,'',15),(47,'Arroz Orgánico',NULL,4,3,'1 Kg','73','66.50',0,'',15),(48,'Azúcar de Coco Orgánico',NULL,4,7,'450 gr','290','223.42',0,'',15),(49,'Azúcar Orgánica',NULL,4,3,'900 gr','109','98.70',0,'',15),(50,'Boniatos en Conserva',NULL,4,4,'700 gr','137','105.00',0,'\0',15),(51,'Café Orgánico Instantáneo',NULL,4,3,'90 gr','129','117.00',0,'',15),(52,'Ciruelas en Conserva',NULL,4,4,'700 gr','155','118.90',0,'',15),(53,'Crema de Coco Orgánica',NULL,4,7,'4 lt','2791','2326.17',0,'',15),(54,'Harina de Arroz',NULL,4,8,'Kg','47','39.60',0,'',15),(55,'Harina de Chía',NULL,4,8,'Kg','233','211.06',0,'',15),(56,'Harina de Coco Orgánica',NULL,4,7,'450 gr','132','94.54',0,'',15),(57,'Harina Integral Orgánica',NULL,4,6,'1 Kg','78','90.40',0,'',15),(58,'Harina Integral Orgánica ',NULL,4,3,'1 Kg','100','90.40',0,'',15),(59,'Harina Orgánica  000',NULL,4,3,'1 Kg','78','70.40',0,'',15),(60,'Higos en Conserva',NULL,4,4,'700 gr','141','108.80',0,'',15),(61,'Ketchup Orgánica',NULL,4,3,'300 gr','114','103.00',0,'',15),(62,'Maca Peruana Orgánica',NULL,4,7,'100 gr','146','170.46',0,'',15),(63,'Maca Peruana Orgánica',NULL,4,7,'180 gr','222','170.46',0,'',15),(64,'Membrillos en Conserva',NULL,4,4,'700 gr','116','89.40',0,'',15),(65,'Mermelada De Durazno Orgánica ',NULL,4,3,'310 gr','115','103.50',0,'',15),(66,'Mermelada De Frutilla Orgánica ',NULL,4,3,'310 gr','99','89.40',0,'',15),(67,'Mermelada De Zapallo Orgánica ',NULL,4,3,'310 gr','92','83.00',0,'',15),(68,'Miel Orgánica Frasco Vidrio',NULL,4,3,'300 gr','122','110.50',0,'',15),(69,'Moñas En Bolsa',NULL,4,3,'500 gr','58','52.50',0,'',15),(70,'Néctar de coco Orgánico',NULL,4,7,'375 ml','400','2000.80',0,'',15),(71,'Néctar de coco Orgánico',NULL,4,7,'3 l','2401','2000.80',0,'',15),(72,'Peras Al Vino Tinto',NULL,4,4,'700 gr','172','132.30',0,'',15),(73,'Peras en Conserva',NULL,4,4,'700 gr','129','99.30',0,'',15),(74,'Polenta (harina de maíz) Orgánica',NULL,4,3,'500 gr','60','50.00',0,'',15),(75,'Polenta (harina de maíz) Orgánica',NULL,4,6,'500 gr','72','50.00',0,'',15),(76,'Pulpa De Tomate Concentrada Orgánica',NULL,4,3,'570 gr','114','103.40',0,'',15),(77,'Salsa Mediterranea Orgánica',NULL,4,3,'570 gr','179','161.80',0,'',15),(78,'Salsa Toscana Orgánica',NULL,4,3,'570 gr','142','128.60',0,'',15),(79,'Tallarines  En Bolsa',NULL,4,3,'500 gr','59','52.90',0,'',15),(80,'Trigo Sarraceno Orgánico',NULL,4,7,'400 gr','68','52.01',0,'',15),(81,'Vinagre de manzana Orgánico',NULL,4,7,'250 ml','167','128.10',0,'',15),(82,'Yerba Orgánica',NULL,4,3,'500 gr','88','86.40',0,'',15),(83,'Zapallos en Conserva',NULL,4,4,'700 gr','128','98.70',0,'',15),(84,'Bayas de Goji Orgánicas',NULL,5,7,'150 gr','253','486.78',0,'',15),(85,'Bayas de Goji Orgánicas',NULL,5,7,'400 gr','633','486.78',0,'',15),(86,'Chía',NULL,5,7,'200 gr','62','147.00',0,'',15),(87,'Chía',NULL,5,8,'Kg','200','147.00',0,'',15),(88,'Chia Orgánico ',NULL,5,3,'200 grs','73','114.90',0,'',15),(89,'Chia Orgánico ',NULL,5,3,'400 grs','127','114.90',0,'',15),(90,'Lino Semillas ',NULL,5,8,'50 grs','26','23.60',0,'',15),(91,'Pasas De Uva Tipo Sultanas',NULL,5,8,'50 grs','35','31.70',0,'',15),(92,'Quinoa ',NULL,5,8,'Kg','179','132.00',0,'',15),(93,'Quinoa Orgánica',NULL,5,3,'400 grs','162','146.20',0,'',15),(94,'Quinoa Roja Orgánica',NULL,5,8,'Kg','428','315.00',0,'',15),(95,'Semillas de Calabaza Orgánicas',NULL,5,7,'180 gr','119','227.77',0,'',15),(96,'Semillas de Calabaza Orgánicas',NULL,5,7,'450 gr','296','227.77',0,'',15),(97,'Sésamo Blanco',NULL,5,8,'100 grs','58','131.76',0,'',15),(98,'Sésamo Blanco',NULL,5,8,'Kg','179','131.76',0,'',15),(99,'Sésamo Integral ',NULL,5,8,'100 grs','44','101.00',0,'',15),(100,'Sésamo Integral ',NULL,5,8,'Kg','138','101.00',0,'',15),(101,'Sésamo Negro ',NULL,5,8,'100 grs','55','149.80',0,'',15),(102,'Sésamo Negro ',NULL,5,8,'Kg','204','149.80',0,'',15),(103,'Sésamo Orgánico ',NULL,4,3,'150 grs','50','45.00',0,'',15),(104,'Adobo',NULL,6,8,'50 grs','40','36.10',0,'',15),(105,'Ají Molido Orgánico',NULL,6,3,'25 grs','32','29.60',0,'',15),(106,'Ají Picante',NULL,6,8,'50 grs','38','34.80',0,'',15),(107,'Ajo Y Perejil Orgánico',NULL,6,3,'10 grs','37','34.20',0,'',15),(108,'Albahaca Seca Orgánica',NULL,6,3,'8 grs','32','29.10',0,'',15),(109,'Anís Semillas Tradicional',NULL,6,8,'50 grs','38','34.60',0,'',15),(110,'Azafrán Del País Orgánico',NULL,6,3,'5 grs','37','33.10',0,'',15),(111,'Canela En Rama',NULL,6,8,'50 grs','45','41.00',0,'',15),(112,'Canela Molida Pura',NULL,6,8,'50 grs','37','34.00',0,'',15),(113,'Cardamomo En Vainas',NULL,6,8,'50 grs','121','109.40',0,'',15),(114,'Ciboulette Ajo Orgánica',NULL,6,3,'10 grs','32','29.10',0,'',15),(115,'Ciboulette Orgánica',NULL,6,3,'10 grs','32','29.10',0,'',15),(116,'Cilantro Orgánico',NULL,6,3,'8 grs','32','29.10',0,'',15),(117,'Clavo De Olor En Grano',NULL,6,8,'50 grs','78','71.10',0,'',15),(118,'Comino En Grano',NULL,6,8,'50 grs','37','32.90',0,'',15),(119,'Cúrcuma Molida Pura',NULL,6,8,'50 grs','39','35.30',0,'',15),(120,'Cúrcuma Orgánica',NULL,6,7,'120 gr','146','112.47',0,'',15),(121,'Curry Picante',NULL,6,8,'50 grs','58','52.00',0,'',15),(122,'Curry Suave',NULL,6,8,'50 grs','53','47.50',0,'',15),(123,'Eneldo Orgánico',NULL,6,3,'10 grs','32','29.10',0,'',15),(124,'Estragón',NULL,6,8,'50 grs','166','149.80',0,'',15),(125,'Estragón Francés Orgánico',NULL,6,3,'10 grs','32','29.10',0,'',15),(126,'Estragón Orgánico',NULL,6,3,'10 grs','32','29.10',0,'',15),(127,'Hierbas Para Carnes Rojas Orgánicas',NULL,6,3,'10 grs','35','31.90',0,'',15),(128,'Hierbas Para Pescados Orgánicas',NULL,6,3,'10 grs','35','31.90',0,'',15),(129,'Hierbas Para Pizzas Orgánicas',NULL,6,3,'10 grs','35','31.90',0,'',15),(130,'Hierbas Para Pollos Orgánicas',NULL,6,3,'10 grs','35','31.90',0,'',15),(131,'Hierbas Para Quesos Y Salsas Orgánicas',NULL,6,3,'10 grs','35','31.90',0,'',15),(132,'Hinojo En Grano',NULL,6,8,'50 grs','33','30.00',0,'',15),(133,'Laurel Orgánico',NULL,6,3,'8 grs','28','25.20',0,'',15),(134,'Mejorana Orgánica',NULL,6,3,'10 grs','32','29.10',0,'',15),(135,'Menta Orgánica',NULL,6,3,'8 grs','32','29.10',0,'',15),(136,'Mostaza Negra En Grano ',NULL,6,8,'50 grs','29','25.90',0,'',15),(137,'Nuez Moscada Enteras',NULL,6,8,'50 grs','116','104.80',0,'',15),(138,'Orégano Limpio ',NULL,6,8,'50 grs','31','28.30',0,'',15),(139,'Orégano Orgánico',NULL,6,3,'15 grs','32','29.10',0,'',15),(140,'Pimentón Ahumado',NULL,6,8,'50 grs','43','39.50',0,'',15),(141,'Pimentón Molido Puro',NULL,6,8,'50 grs','39','35.10',0,'',15),(142,'Pimienta Blanca Molida Pura',NULL,6,8,'50 grs','107','97.10',0,'',15),(143,'Pimienta Negra En Grano Clasificada',NULL,6,8,'50 grs','71','64.30',0,'',15),(144,'Popurrí De Pimientas',NULL,6,8,'50 grs','109','98.20',0,'',15),(145,'Romero',NULL,6,8,'50 grs','36','32.10',0,'',15),(146,'Romero Orgánico',NULL,6,3,'10 grs','32','29.10',0,'',15),(147,'Sal De Ajo',NULL,6,8,'50 grs','31','28.20',0,'',15),(148,'Sal De Apio',NULL,6,8,'50 grs','30','27.20',0,'',15),(149,'Sal Rosada De Himalaya Fina',NULL,6,8,'100 grs','37','33.70',0,'',15),(150,'Sal Rosada De Himalaya Gruesa',NULL,6,8,'100 grs','39','35.10',0,'',15),(151,'Salvia Orgánico',NULL,6,3,'10 grs','32','29.10',0,'',15),(152,'Tomillo Orgánico',NULL,6,3,'10 grs','32','29.10',0,'',15),(153,'Albahaca',NULL,1,1,'unidad','35','28.00',0,'',15),(154,'Rabanito',NULL,1,1,'atado','35','28.00',0,'',15),(155,'Zucchini',NULL,1,1,'Kg','90','72.00',0,'',15),(156,'Descuento frutillas en canasta',NULL,0,9,'','-60','-48.00',0,'\0',10);

/*Table structure for table `nut_proveedores` */

DROP TABLE IF EXISTS `nut_proveedores`;

CREATE TABLE `nut_proveedores` (
  `idProveedor` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `nut_proveedores` */

insert  into `nut_proveedores`(`idProveedor`,`nombre`) values (1,'34 Sur'),(2,'Feral'),(3,'Graneco'),(4,'Prana'),(5,'La Trinidad'),(6,'Nutritívoz');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
