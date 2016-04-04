
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-03-2016 a las 21:56:29
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
-- Estructura de tabla para la tabla `ImagenPictograma`
--

CREATE TABLE IF NOT EXISTS `ImagenPictograma` (
  `imagenPict_id` int(10) NOT NULL,
  `imagen_id` int(5) NOT NULL,
  `pictograma_id` int(10) NOT NULL,
  UNIQUE KEY `imagen_id_2` (`imagen_id`),
  KEY `imagen_id` (`imagen_id`),
  KEY `imagen_id_3` (`imagen_id`),
  KEY `pictograma_id` (`pictograma_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `ImagenPictograma`:
--   `imagen_id`
--       `Imagen` -> `imagen_id`
--   `pictograma_id`
--       `Pictograma` -> `pictograma_id`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
