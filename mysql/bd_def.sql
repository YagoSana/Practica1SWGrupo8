-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2024 a las 15:38:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_def`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_Pedido` int(10) UNSIGNED NOT NULL,
  `Fecha` date NOT NULL,
  `Cliente` varchar(20) NOT NULL,
  `Producto` int(10) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `productos`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Precio` decimal(6,2) NOT NULL,
  `Imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `Nombre`, `Descripcion`, `Precio`, `Imagen`) VALUES
(1, 'Guitarra Acústica', 'Instrumento musical de alta calidad, con cuerdas de acero y un sonido resonante y claro. Ideal para músicos de todos los niveles. Cuerpo de madera pulida para una estética elegante.', 299.99, '../imagenes/Guitarra.jpg'),
(2, 'Tambor', 'Instrumento de percusión de sonido profundo y resonante. Cuerpo de madera con parches de piel ajustables. Perfecto para ritmos enérgicos y actuaciones en vivo.', 99.99, '../imagenes/Tambor.jpg'),
(3, 'Arpa', 'Instrumento musical elegante con cuerdas tensadas que se tocan con los dedos. Produce sonidos melodiosos y suaves. Ideal para música clásica y celta. Cuerpo de madera de alta calidad para una resonanc', 629.99, '../imagenes/Arpa.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Apellido` text NOT NULL,
  `Nombre` text NOT NULL,
  `User` varchar(20) NOT NULL,
  `Pass` varchar(9) NOT NULL,
  `Email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Apellido`, `Nombre`, `User`, `Pass`, `Email`) VALUES
('A', 'Administrador', 'admin', 'adminpass', 'admin@ucm.es'),
('Félix', 'Álvaro', 'alfelix', 'alf', 'alfelix@ucm.es'),
('Reyes', 'Laura', 'laurreye', 'lau', 'laurreye@ucm.es'),
('El Farissi', 'Mohamed', 'melfaris', 'mel', 'melfaris@ucm.es'),
('Sanabria', 'Yago', 'yagosana', 'yag', 'yagosana@ucm.es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `Cliente` (`Cliente`),
  ADD KEY `Producto` (`Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`User`),
  ADD KEY `Apellido` (`Nombre`(1024));

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
