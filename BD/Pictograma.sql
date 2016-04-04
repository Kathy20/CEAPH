
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-03-2016 a las 21:58:41
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
-- Estructura de tabla para la tabla `Pictograma`
--

CREATE TABLE IF NOT EXISTS `Pictograma` (
  `pictograma_id` int(10) NOT NULL AUTO_INCREMENT,
  `oracion` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `largo` int(2) NOT NULL,
  PRIMARY KEY (`pictograma_id`),
  KEY `pictograma_id` (`pictograma_id`),
  KEY `pictograma_id_2` (`pictograma_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Pictograma`
--

INSERT INTO `Pictograma` (`pictograma_id`, `oracion`, `largo`) VALUES
(2, '', 0),
(4, '', 0),
(5, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
