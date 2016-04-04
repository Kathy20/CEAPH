
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-03-2016 a las 21:57:55
-- Versión del servidor: 10.0.20-MariaDB-log
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u772402380_ceaph`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PalabraAsociada`
--

CREATE TABLE IF NOT EXISTS `PalabraAsociada` (
  `idPalabraAsociada` int(11) NOT NULL AUTO_INCREMENT,
  `Palabra` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPalabraAsociada`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Volcado de datos para la tabla `PalabraAsociada`
--

INSERT INTO `PalabraAsociada` (`idPalabraAsociada`, `Palabra`) VALUES
(25, 'boca'),
(24, 'ojo'),
(23, 'lengua'),
(22, 'cerebro'),
(26, 'pie'),
(27, 'mano'),
(28, 'cabeza'),
(29, 'oido'),
(30, 'hilo-dental'),
(31, 'peinarse'),
(32, 'lavar-el-cabello'),
(33, 'lavar-las-manos'),
(36, 'ducha'),
(35, 'lavar-dientes'),
(37, 'corta-uñas'),
(38, 'inodoro'),
(39, 'isopo'),
(40, 'orinal'),
(41, 'pasta-de-dientes'),
(42, 'alcohol-en-gel'),
(43, 'cuarto'),
(44, 'cama'),
(45, 'pasillo'),
(46, 'parque'),
(47, 'paño'),
(48, 'papel-higienico'),
(49, 'escuela'),
(50, 'iglesia'),
(51, 'curita'),
(52, 'nebulizador'),
(53, 'pastilla'),
(54, 'hemograma'),
(55, 'radiografía'),
(56, 'hola'),
(57, 'inyección'),
(58, 'inyectar'),
(59, 'inyectarlo'),
(60, 'inyectarla'),
(61, 'inyectarse'),
(62, 'vista');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
