# ************************************************************
# Sequel Pro SQL dump
# Versi�n 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.9-MariaDB)
# Base de datos: sifope
# Tiempo de Generaci�n: 2019-09-24 18:15:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla c18_rutas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `c18_rutas`;

CREATE TABLE `c18_rutas` (
  `c18_id` int(11) NOT NULL AUTO_INCREMENT,
  `c18_nombre` varchar(150) NOT NULL,
  `c18_clave` varchar(50) NOT NULL,
  `c18_municipio` varchar(50) NOT NULL,
  `c18_estado` varchar(50) NOT NULL,
  `c18_ruta1` varchar(150) NOT NULL,
  `c18_ruta2` varchar(150) DEFAULT NULL,
  `c18_ruta3` varchar(150) DEFAULT NULL,
  `c18_usuAlta` int(11) NOT NULL,
  `c18_fecAlta` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c18_usuMod` int(11) DEFAULT NULL,
  `c18_fecMod` datetime DEFAULT NULL,
  `c18_estatus` enum('0','1') NOT NULL,
  PRIMARY KEY (`c18_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
