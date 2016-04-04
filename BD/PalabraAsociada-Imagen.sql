
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-03-2016 a las 21:58:24
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
-- Estructura de tabla para la tabla `PalabraAsociada-Imagen`
--

CREATE TABLE IF NOT EXISTS `PalabraAsociada-Imagen` (
  `idPalabraAsocImg` int(11) NOT NULL AUTO_INCREMENT,
  `idImagen` int(11) NOT NULL,
  `idPalabraAsociada` int(11) NOT NULL,
  PRIMARY KEY (`idPalabraAsocImg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=77 ;

--
-- RELACIONES PARA LA TABLA `PalabraAsociada-Imagen`:
--   `idImagen`
--       `Imagen` -> `imagen_id`
--   `idPalabraAsociada`
--       `PalabraAsociada` -> `idPalabraAsociada`
--

--
-- Volcado de datos para la tabla `PalabraAsociada-Imagen`
--

INSERT INTO `PalabraAsociada-Imagen` (`idPalabraAsocImg`, `idImagen`, `idPalabraAsociada`) VALUES
(26, 107, 24),
(25, 106, 25),
(24, 105, 24),
(23, 104, 23),
(22, 103, 22),
(27, 108, 26),
(28, 109, 27),
(29, 110, 28),
(30, 111, 29),
(31, 112, 30),
(32, 113, 30),
(33, 114, 31),
(34, 115, 33),
(40, 121, 36),
(36, 117, 32),
(37, 118, 33),
(38, 119, 34),
(39, 120, 35),
(41, 122, 36),
(42, 123, 37),
(43, 124, 38),
(44, 125, 39),
(45, 126, 40),
(46, 127, 41),
(47, 128, 42),
(48, 129, 43),
(49, 130, 44),
(50, 131, 45),
(51, 132, 46),
(52, 133, 47),
(53, 134, 48),
(54, 135, 49),
(55, 136, 50),
(56, 137, 51),
(57, 138, 52),
(58, 139, 53),
(59, 140, 54),
(60, 141, 54),
(61, 142, 55),
(66, 146, 61),
(65, 146, 58),
(67, 146, 59),
(68, 146, 60),
(69, 146, 57);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
