# ************************************************************
# Sequel Pro SQL dump
# Versi�n 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.9-MariaDB)
# Base de datos: sifope
# Tiempo de Generaci�n: 2019-09-25 17:00:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla p03_gr
# ------------------------------------------------------------

DROP TABLE IF EXISTS `p03_gr`;

CREATE TABLE `p03_gr` (
  `p03_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Dictamen eliminado',
  `c01_id` int(11) NOT NULL COMMENT 'Id del productor',
  `p03_domicilio` varchar(200) DEFAULT NULL COMMENT 'Domicilio del productor',
  `r01_id` int(11) NOT NULL COMMENT 'ID de UPP',
  `r01_municipio` varchar(50) DEFAULT NULL COMMENT 'Municipio UPP',
  `r01_estado` varchar(50) NOT NULL COMMENT 'Estado UPP',
  `p03_cal_banado` int(11) NOT NULL COMMENT 'Calendario de bañado por dias',
  `p03_fec_ult_trata` datetime DEFAULT NULL COMMENT 'Fecha de ultimo tratamiento ',
  `c17_id` int(11) NOT NULL COMMENT 'ID Productos',
  `p03_destino` varchar(100) NOT NULL COMMENT 'Destino de la upp',
  `p03_municipio` varchar(50) NOT NULL COMMENT 'Munipio de destino',
  `p03_estado` varchar(50) NOT NULL COMMENT 'Estado de municipio',
  `p03_ruta1` varchar(100) NOT NULL COMMENT 'Ruta 1',
  `p03_ruta2` varchar(100) DEFAULT NULL COMMENT 'Ruta 2',
  `p03_ruta3` varchar(100) DEFAULT NULL COMMENT 'Ruta 3',
  `p03_transporte` varchar(50) NOT NULL COMMENT 'Tipo de transporte',
  `p03_marca` varchar(50) NOT NULL COMMENT 'Marca de transporte',
  `p03_placas` varchar(20) NOT NULL COMMENT 'Placas del transporte',
  `p03_capacidad` int(11) NOT NULL COMMENT 'Capacidad del transporte',
  `p03_flejado` enum('0','1') NOT NULL COMMENT '0 No , 1 Si',
  `p03_cant_bov` int(11) NOT NULL DEFAULT '0' COMMENT 'Cantidad de bovinos',
  `p03_cant_eq` int(11) NOT NULL DEFAULT '0' COMMENT 'Cantidad de equinos',
  `p03_cant_capr` int(11) NOT NULL DEFAULT '0' COMMENT 'Cantidad de caprinos',
  `p03_cant_ov` int(11) NOT NULL DEFAULT '0' COMMENT 'Cantidad de ovinos',
  `p03_cant_otros` int(11) NOT NULL DEFAULT '0' COMMENT 'Cantidad de otros',
  `c07_id` int(11) NOT NULL COMMENT 'Motivos de la prueba del dictamen',
  `p03_fec_exp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de expedición ',
  `p03_lugar_exp` varchar(150) NOT NULL DEFAULT '' COMMENT 'Lugar de expedición',
  `p03_fec_venc` datetime NOT NULL COMMENT 'Fecha de vencimiento del dictamen',
  `p03_exp_nombre` varchar(150) NOT NULL DEFAULT '' COMMENT 'Usuario que expidio el dictamen ',
  `p03_exp_rfc` varchar(14) DEFAULT NULL,
  `p03_exp_cargo` enum('OFICIAL','MVAR') DEFAULT NULL,
  `p03_avalado_nombre` varchar(100) NOT NULL DEFAULT '' COMMENT 'Medico que avala el dictamen',
  `p03_observaciones` varchar(150) DEFAULT NULL COMMENT 'Observaciones',
  PRIMARY KEY (`p03_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
