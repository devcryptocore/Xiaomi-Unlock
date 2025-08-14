-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20241206.16f3583c6d
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-08-2025 a las 21:34:51
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `xiaomi_unlock`
--
CREATE DATABASE IF NOT EXISTS `xiaomi_unlock` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `xiaomi_unlock`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `titulo` varchar(256) COLLATE latin1_spanish_ci NOT NULL,
  `marca` varchar(256) COLLATE latin1_spanish_ci NOT NULL,
  `estado` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `portada` varchar(256) COLLATE latin1_spanish_ci NOT NULL,
  `video` varchar(256) COLLATE latin1_spanish_ci NOT NULL,
  `videoportada` varchar(256) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `titulo`, `marca`, `estado`, `portada`, `video`, `videoportada`) VALUES
(1, 'FRP Samsung', 'samsung', 'activo', 'res/assets/images/principalbg/samsung_portada.webp', 'www.youtube.com/embed/aRKcoeQfwEo?si=vYZnJz2VKDxp4u6u', 'res/assets/images/thumbs/frpsamsung.jpg'),
(2, 'Xiaomi Account', 'xiaomi', 'activo', 'res/assets/images/principalbg/xiaomi_portada.webp', 'www.youtube.com/embed/JaUxUk_InDo?si=cZv4sdOFFfbPzOle', 'res/assets/images/thumbs/xiaomiaccount.webp'),
(3, 'FRP Honor', 'honor', 'activo', 'res/assets/images/principalbg/honor_portada.webp', 'www.youtube.com/embed/f09Omvw5C70?si=zIlEWcmB7rjkWLfO', 'res/assets/images/thumbs/frphonor.jpg'),
(4, 'FRP Hyper OS (Xiaomi)', 'hyperos', 'activo', 'res/assets/images/principalbg/honor_portada.webp', 'www.youtube.com/embed/DUZn-M10Iyk?si=I6YEJIm-cAWy8B40', 'res/assets/images/thumbs/frphonor.jpg'),
(5, 'ICloud', 'icloud', 'activo', 'res/assets/images/principalbg/honor_portada.webp', 'www.youtube.com/embed/ql4WEiERHJU?si=eYeWy8YFk0462hCg', 'res/assets/images/thumbs/frphonor.jpg'),
(6, 'Unlock Tool', 'unlocktool', 'activo', 'res/assets/images/principalbg/honor_portada.webp', 'www.youtube.com/embed/aRKcoeQfwEo?si=vYZnJz2VKDxp4u6u', 'res/assets/images/thumbs/frphonor.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `honor`
--

CREATE TABLE `honor` (
  `id` int NOT NULL,
  `pais` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `modelo` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `tarjeta` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` enum('activo','inactivo') CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hyperos`
--

CREATE TABLE `hyperos` (
  `id` int NOT NULL,
  `pais` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `modelo` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `tarjeta` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` enum('activo','inactivo') CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `id` int NOT NULL,
  `uname` varchar(256) COLLATE latin1_spanish_ci NOT NULL,
  `upassword` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `access` varchar(256) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`id`, `uname`, `upassword`, `access`) VALUES
(1, 'admin', '$2a$12$.pQnIKogkC02AawKQNmJNOX4fGy0Xaspoadb.BsBZkwqh2BfkYAZi', '20250807');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ios`
--

CREATE TABLE `ios` (
  `id` int NOT NULL,
  `pais` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `modelo` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `tarjeta` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` enum('activo','inactivo') CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `samsung`
--

CREATE TABLE `samsung` (
  `id` int NOT NULL,
  `serie` varchar(256) COLLATE latin1_spanish_ci DEFAULT NULL,
  `modelo` varchar(256) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tarjeta` varchar(256) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` enum('activo','inactivo') COLLATE latin1_spanish_ci DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unlocktool`
--

CREATE TABLE `unlocktool` (
  `id` int NOT NULL,
  `pais` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `modelo` varchar(256) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `tarjeta` varchar(500) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` enum('activo','inactivo') CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `xiaomi`
--

CREATE TABLE `xiaomi` (
  `id` int NOT NULL,
  `pais` varchar(256) COLLATE latin1_spanish_ci DEFAULT NULL,
  `modelo` varchar(256) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tarjeta` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` enum('activo','inactivo') COLLATE latin1_spanish_ci DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `honor`
--
ALTER TABLE `honor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hyperos`
--
ALTER TABLE `hyperos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ios`
--
ALTER TABLE `ios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unlocktool`
--
ALTER TABLE `unlocktool`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `xiaomi`
--
ALTER TABLE `xiaomi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `honor`
--
ALTER TABLE `honor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hyperos`
--
ALTER TABLE `hyperos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ios`
--
ALTER TABLE `ios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unlocktool`
--
ALTER TABLE `unlocktool`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `xiaomi`
--
ALTER TABLE `xiaomi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
