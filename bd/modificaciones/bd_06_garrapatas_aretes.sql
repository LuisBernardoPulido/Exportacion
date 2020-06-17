# ************************************************************
# Sequel Pro SQL dump
# Versi�n 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.9-MariaDB)
# Base de datos: sifope
# Tiempo de Generaci�n: 2019-10-03 15:13:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=''NO_AUTO_VALUE_ON_ZERO'' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla r26_garrapatas_aretes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `r26_garrapatas_aretes`;

CREATE TABLE `r26_garrapatas_aretes` (
  `r26_id` int(11) NOT NULL AUTO_INCREMENT,
  `p03_gr` int(11) DEFAULT NULL,
  `r02_id` int(11) NOT NULL,
  `r26_ordenar` int(11) DEFAULT NULL,
  `r26_ordenar_comp` int(11) DEFAULT NULL,
  `r26_usuAlta` int(11) DEFAULT NULL,
  `r26_fecAlta` datetime DEFAULT NULL,
  `r26_usuMod` int(11) DEFAULT NULL,
  `r26_fecMod` datetime DEFAULT NULL,
  PRIMARY KEY (`r26_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
