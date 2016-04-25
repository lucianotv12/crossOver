-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2016 a las 23:02:46
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marlboro_cross_over`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desafio_codigos`
--

CREATE TABLE `desafio_codigos` (
  `id` int(11) NOT NULL,
  `cantidad_codigos` varchar(45) DEFAULT NULL,
  `pdvs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desafio_volumen`
--

CREATE TABLE `desafio_volumen` (
  `id` int(11) NOT NULL,
  `cantidad_abril` decimal(10,0) DEFAULT NULL,
  `ventas_abril` decimal(10,0) DEFAULT NULL,
  `cantidad_mayo` decimal(10,0) DEFAULT NULL,
  `ventas_mayo` decimal(10,0) DEFAULT NULL,
  `pdvs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desafio_web`
--

CREATE TABLE `desafio_web` (
  `id` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `pdvs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `merchandisers`
--

CREATE TABLE `merchandisers` (
  `id` int(11) NOT NULL,
  `nombre` varchar(145) NOT NULL,
  `jefe_id` int(11) NOT NULL,
  `gerente_id` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `merchandisers`
--

INSERT INTO `merchandisers` (`id`, `nombre`, `jefe_id`, `gerente_id`, `activo`, `dni`, `clave`, `tipo`) VALUES
(1, 'Aguirre, Manuel', 1, 1, 1, '30527766', '112233', 3),
(2, 'Allegranza, Gustavo Javier', 1, 1, 1, '', '', 3),
(3, 'Barello, Franco', 1, 1, 1, '', '', 3),
(4, 'Castro, Gastón Ezequiel', 1, 1, 1, '', '', 3),
(5, 'Garcia Ledesma, Daniel  Efrain', 1, 1, 1, '', '', 3),
(6, 'Gutierrez, Hernan Osvaldo', 1, 1, 1, '', '', 3),
(7, 'Haran, José Raul', 1, 1, 1, '', '', 3),
(8, 'Lestrange, Augusto', 1, 1, 1, '', '', 3),
(9, 'Marino, Juan Ignacio', 1, 1, 1, '', '', 3),
(10, 'Nazer, Martín Antonio', 1, 1, 1, '', '', 3),
(11, 'Paludi, Juan Alberto', 1, 1, 1, '', '', 3),
(12, 'Pierazzoli, Mateo', 1, 1, 1, '', '', 3),
(13, 'Repetto, Emilio', 1, 1, 1, '', '', 3),
(14, 'Torres Mayorga, Joaquin', 1, 1, 1, '', '', 3),
(15, 'Trabucco, Paula Gabriela', 1, 1, 1, '', '', 3),
(16, 'Vai, Daniel Horacio', 1, 1, 1, '', '', 3),
(17, 'Villa, Ignacio Javier', 1, 1, 1, '', '', 3),
(18, 'Aladro, Guadalupe', 1, 1, 1, '001122', '001122', 4),
(19, 'Morano, Javier', 1, 1, 1, '0000', '0000', 4),
(20, 'Herrera, Fernando', 1, 1, 1, '1111', '1111', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdvs`
--

CREATE TABLE `pdvs` (
  `id` int(11) NOT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `cantidad_vendedores` decimal(10,0) DEFAULT NULL,
  `km` decimal(10,0) DEFAULT NULL,
  `razon_social` varchar(145) NOT NULL,
  `calle` varchar(200) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `localidad` varchar(200) DEFAULT NULL,
  `categoria_vol` varchar(100) DEFAULT NULL,
  `tipo_cigarrera` varchar(100) DEFAULT NULL,
  `merchandiser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pdvs`
--

INSERT INTO `pdvs` (`id`, `clave`, `tipo`, `cantidad_vendedores`, `km`, `razon_social`, `calle`, `numero`, `localidad`, `categoria_vol`, `tipo_cigarrera`, `merchandiser_id`) VALUES
(1610, '1610', '1', '2', '1200', 'TOMAS', NULL, NULL, NULL, NULL, NULL, 0),
(4040, '4040', '1', '0', '1600', 'LORENZO', NULL, NULL, NULL, NULL, NULL, 0),
(112233, '112233', '1', '3', '500', 'VERNI', NULL, NULL, NULL, NULL, NULL, 0),
(123456, '123456', '1', '1', '300', 'LUCIANO', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(85) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `pdvs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `nombre`, `celular`, `email`, `foto`, `pdvs_id`) VALUES
(38, '', '1564231654', 'kdslf@fdsfsd.c', '', 123456),
(46, '', '1560996835', 'lucianotv12@gmail.com', '', 112233),
(47, '', '1534283718', 'estef@gmail.com', '', 112233),
(50, '', '3213123213', 'lucianotv12@gmail.com', '', 1610),
(51, '', '3123213', 'lucianotv12@gmail.com', '', 1610);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `desafio_codigos`
--
ALTER TABLE `desafio_codigos`
  ADD PRIMARY KEY (`id`,`pdvs_id`),
  ADD KEY `fk_desafio_codigos_pdvs_idx` (`pdvs_id`);

--
-- Indices de la tabla `desafio_volumen`
--
ALTER TABLE `desafio_volumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_desafio_volumen_pdvs1_idx` (`pdvs_id`);

--
-- Indices de la tabla `desafio_web`
--
ALTER TABLE `desafio_web`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_desafio_web_pdvs1_idx` (`pdvs_id`);

--
-- Indices de la tabla `merchandisers`
--
ALTER TABLE `merchandisers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdvs`
--
ALTER TABLE `pdvs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vendedores_pdvs1_idx` (`pdvs_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `desafio_codigos`
--
ALTER TABLE `desafio_codigos`
  ADD CONSTRAINT `fk_desafio_codigos_pdvs` FOREIGN KEY (`pdvs_id`) REFERENCES `pdvs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `desafio_volumen`
--
ALTER TABLE `desafio_volumen`
  ADD CONSTRAINT `fk_desafio_volumen_pdvs1` FOREIGN KEY (`pdvs_id`) REFERENCES `pdvs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `desafio_web`
--
ALTER TABLE `desafio_web`
  ADD CONSTRAINT `fk_desafio_web_pdvs1` FOREIGN KEY (`pdvs_id`) REFERENCES `pdvs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD CONSTRAINT `fk_vendedores_pdvs1` FOREIGN KEY (`pdvs_id`) REFERENCES `pdvs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
