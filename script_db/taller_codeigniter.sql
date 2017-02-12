﻿# Host: localhost  (Version 5.5.5-10.1.16-MariaDB)
# Date: 2017-02-11 21:28:39
# Generator: MySQL-Front 6.0  (Build 1.21)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "productos"
#

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

#
# Data for table "productos"
#

INSERT INTO `productos` VALUES (1,'Mesa de computador',120000,6,'2017-02-10'),(2,'Ampolleta electrónica',14563,50,'2017-02-10'),(3,'Producto ñandú',1548,20,'2017-02-09'),(4,'Célula electrica',100000,5,'2016-11-08'),(5,'Bolso',109383,12,'2017-02-12');

#
# Structure for table "productos_fotos"
#

DROP TABLE IF EXISTS `productos_fotos`;
CREATE TABLE `productos_fotos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

#
# Data for table "productos_fotos"
#

INSERT INTO `productos_fotos` VALUES (1,1,'50a0fdf58e71f68c3ec3ed245558ac64.JPG'),(2,4,'0334e790909c8819fa3e3a175824aa9f.jpg'),(3,3,'eff598d593beaa1538031a84e97ff55d.JPG'),(5,4,'ec1536bcac715bcba92fc093a806192f.png'),(6,5,'b757559d200c93a9454698f96bd4e35d.png');
