-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2024 a las 20:17:52
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
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `ID_Carrito` int(10) UNSIGNED NOT NULL,
  `Cliente` varchar(20) NOT NULL,
  `Producto` int(10) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `ID_Pedido` int(10) UNSIGNED NOT NULL,
  `Fecha` date NOT NULL,
  `Cliente` varchar(20) NOT NULL,
  `Importe` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pedidos` (`ID_Pedido`, `Fecha`, `Cliente`, `Importe`) VALUES
(1, '2024-04-09', 8, 299.99),
(2, '2024-04-10', 9, 299.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Producto` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Precio` decimal(6,2) NOT NULL,
  `Imagen` varchar(255) NOT NULL,
  `Visible` boolean NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Nombre`, `Descripcion`, `Precio`, `Imagen`) VALUES
(1, 'Guitarra Acústica', 'Instrumento musical de alta calidad, con cuerdas de acero y un sonido resonante y claro. Ideal para músicos de todos los niveles. Cuerpo de madera pulida para una estética elegante. Esta guitarra acús', 299.99, '/img/imagenesBD/Guitarra.jpg'),
(2, 'Tambor', 'Instrumento de percusión de sonido profundo y resonante. Cuerpo de madera con parches de piel ajustables. Perfecto para ritmos enérgicos y actuaciones en vivo.', 99.99, '/img/imagenesBD/Tambor.jpg'),
(3, 'Arpa', 'Instrumento musical elegante con cuerdas tensadas que se tocan con los dedos. Produce sonidos melodiosos y suaves. Ideal para música clásica y celta. Cuerpo de madera de alta calidad para una resonanc', 629.99, '/img/imagenesBD/Arpa.jpg'),
(4, 'Armónica', 'diseñada para practicantes, principiantes e intermedios. Gran sistema de armónica adecuado para blues, folk, música clásica pop, jazz, country y rock & roll', 68.20, '/img/imagenesBD/armonica.jpg'),
(5, 'Pink Floyd Vinilo', 'Vinilo de la banda Pink Floyd, con su álbum más famoso, The Dark Side of the Moon. Un clásico de la música rock que no puede faltar en tu colección.', 35.99, '/img/imagenesBD/PinkFloydVinile.png'),
(6, 'PumpUpTheJam Vinilo', 'Vinilo de la banda Technotronic, con su álbum más famoso, Pump Up The Jam. Un clásico de la música electrónica que conquistó las pistas de baile en los años 90.', 35.99, '/img/imagenesBD/PumpUpTheJam.png'),
(7, 'Camiseta Los Ramones', 'Camiseta de la banda Ramones, con su icónico logo en la parte delantera. Fabricada en algodón 100% para una mayor comodidad y durabilidad. Disponible unicamente en talla L. (Más tallas próximamente)', 12.99, '/img/imagenesBD/Ramones.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedidos`
--

CREATE TABLE `productos_pedidos` (
  `ID_Pedido` int(10) UNSIGNED NOT NULL,
  `ID_Producto` int(10) UNSIGNED NOT NULL,
  `Cantidad` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `productos_pedidos` (`ID_Pedido`, `ID_Producto`, `Cantidad`) VALUES
(1, 1, 1),
(2, 1, 1);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Apellido` text NOT NULL,
  `Nombre` text NOT NULL,
  `User` varchar(20) NOT NULL,
  `Idusuario` int(20) UNSIGNED NOT NULL,
  `Pass` varchar(60) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Apellido`, `Nombre`, `User`, `Idusuario`, `Pass`, `Email`, `rol`) VALUES
('Sanabria', 'Yago', 'yagosana', 8, '$2y$10$9qG31gaUs54HT/3GBlnJyuIBUQ.ZGczvK8Sfm9o5VNbmnRGS.cw4e', 'yagosana@ucm.es', 'admin'),
('Felix', 'Alvaro', 'alfelix', 9, '$2y$10$54u/0lMeJCzcHgi0bZgGcOYYagUBVP6jIgNjiqQ6EZqIvRTUjI9vy', 'alfelix@ucm.es', 'admin'),
('Reyes', 'Laura', 'laureyes', 10, '$2y$10$zEvqxkmtmILL0EI3JpPTEut1lTGooL0ruYChDrPXWTh79V9vC.Wo6', 'laurreye@ucm.es', 'admin'),
('El Farissi', 'Mohamed', 'melfaris', 11, '$2y$10$.VmxpNm4gNvaao99INOetOtXLIOAzhPLOkTfXC7wGaOCXMnT7RKBi', 'melfaris@ucm.es', 'admin'),
('Cliente', 'Cliente', 'cliente', 12, '$2y$10$fHDX7YGU4ukGN4sF2wwGWOGnLyrSimmhIyVKZ/X2ct/QDORq.Px.u', 'cliente@ucm.es', 'cliente'),
('Empleado', 'Empleado', 'empleado', 13, '$2y$10$IQsUNhK3fI8fMHL/tRZUzeDCtHNHYQsdMI3vRh65uWhq1nTnq6jk6', 'empleado@ucm.es', 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `ID_Valoracion` int(10) UNSIGNED NOT NULL,
  `Idusuario` int(20) UNSIGNED NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL,
  `Valoracion` int(11) NOT NULL,
  `Comentario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`ID_Valoracion`, `Idusuario`, `ID`, `Valoracion`, `Comentario`) VALUES
(1, 8, 1, 5, 'Excelente guitarra. El sonido es claro y resonante, y el cuerpo de madera pulida es absolutamente hermoso.'),
(2, 9, 2, 4, 'Buena guitarra para su precio. Las cuerdas de acero producen un sonido brillante y la guitarra en sí es bastante duradera.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`ID_Carrito`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `Cliente` (`Cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Producto`),
  ADD KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD PRIMARY KEY (`ID_Pedido`,`ID_Producto`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Idusuario`),
  ADD KEY `User` (`User`),
  ADD KEY `Apellido` (`Nombre`(768));

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`ID_Valoracion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `ID_Carrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `ID_Pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Idusuario` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `ID_Valoracion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos_pedidos`
--
ALTER TABLE `productos_pedidos`
  ADD CONSTRAINT `productos_pedidos_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`),
  ADD CONSTRAINT `productos_pedidos_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
