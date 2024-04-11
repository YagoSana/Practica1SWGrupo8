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


CREATE TABLE `pedidos` (
  `ID_Pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Cliente` varchar(20) NOT NULL,
  `Producto` int(10) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL,
  PRIMARY KEY (`ID_Pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `productos` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Precio` decimal(6,2) NOT NULL,
  `Imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `usuario` (
  `Apellido` text NOT NULL,
  `Nombre` text NOT NULL,
  `User` varchar(20) NOT NULL,
  `Idusuario`int(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Pass` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `rol`varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `carrito` (
  `ID_Carrito` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Cliente` varchar(20) NOT NULL,
  `Producto` int(10) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `valoraciones` (
  `ID_Valoracion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Idusuario` int(20) UNSIGNED NOT NULL,
  `ID` int(10) UNSIGNED NOT NULL,
  `Valoracion` int(11) NOT NULL,
  `Comentario` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Valoracion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `pedidos`
  ADD KEY `Cliente` (`Cliente`),
  ADD KEY `Producto` (`Producto`);

ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Nombre` (`Nombre`);

ALTER TABLE `usuario`
  ADD KEY `User` (`User`),
  ADD KEY `Apellido` (`Nombre`(1024));

ALTER TABLE `pedidos`
  MODIFY `ID_Pedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `productos`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;


INSERT INTO `usuario` (`Apellido`, `Nombre`, `User`, `Idusuario`, `Pass`, `Email`, `rol`) VALUES
('Empleado', 'Empleado', 'empleado', 1,'empleadopass', 'empleado@ucm.es', 'empleado'),
('Félix', 'Álvaro', 'alfelix', 2, 'alf', 'alfelix@ucm.es', 'admin'),
('Reyes', 'Laura', 'laurreye', 3, 'lau', 'laurreye@ucm.es', 'admin'),
('El Farissi', 'Mohamed', 'melfaris', 4, 'mel', 'melfaris@ucm.es', 'admin'),
('Sanabria', 'Yago', 'yagosana', 5,'yag', 'yagosana@ucm.es', 'admin'),
('clienteprueba', 'clienteprueba', 'cliente', 6, 'clientepass', 'cliente@ucm.es', 'cliente');


INSERT INTO `productos` (`ID`, `Nombre`, `Descripcion`, `Precio`, `Imagen`) VALUES
(1,
'Guitarra Acústica',
'Instrumento musical de alta calidad, con cuerdas de acero y un sonido resonante y claro. Ideal para músicos de todos los niveles. Cuerpo de madera pulida para una estética elegante. Esta guitarra acústica cuenta con un mástil de madera de arce, un diapasón de palisandro y un puente de madera de ébano. Con una longitud de escala de 650 mm y 20 trastes, es perfecta para una amplia gama de estilos musicales.',
299.99,
'/img/imagenesBD/Guitarra.jpg'),
(2,
'Tambor',
'Instrumento de percusión de sonido profundo y resonante. Cuerpo de madera con parches de piel ajustables. Perfecto para ritmos enérgicos y actuaciones en vivo.',
99.99,
'/img/imagenesBD/Tambor.jpg'),
(3,
'Arpa',
'Instrumento musical elegante con cuerdas tensadas que se tocan con los dedos. Produce sonidos melodiosos y suaves. Ideal para música clásica y celta. Cuerpo de madera de alta calidad para una resonanc',
629.99,
'/img/imagenesBD/Arpa.jpg'),
(4,
'Armónica',
'diseñada para practicantes, principiantes e intermedios. Gran sistema de armónica adecuado para blues, folk, música clásica pop, jazz, country y rock & roll',
68.20,
'/img/imagenesBD/armonica.jpg');
(5,
'Pink Floyd Vinilo',
'Vinilo de la banda Pink Floyd, con su álbum más famoso, The Dark Side of the Moon. Un clásico de la música rock que no puede faltar en tu colección.',
35.99,
'/img/imagenesBD/PinkFloydVinile.png');
(6,
'PumpUpTheJam Vinilo',
'Vinilo de la banda Technotronic, con su álbum más famoso, Pump Up The Jam. Un clásico de la música electrónica que conquistó las pistas de baile en los años 90.',
35.99,
'/img/imagenesBD/PumpUpTheJam.png');
(7,
'Camiseta Los Ramones',
'Camiseta de la banda Ramones, con su icónico logo en la parte delantera. Fabricada en algodón 100% para una mayor comodidad y durabilidad. Disponible unicamente en talla L. (Más tallas próximamente)',
12.99,
'/img/imagenesBD/Ramones.png');

INSERT INTO `valoraciones` (`Idusuario`, `ID`, `Valoracion`, `Comentario`) VALUES
(2, 1, 5, 'Excelente guitarra. El sonido es claro y resonante, y el cuerpo de madera pulida es absolutamente hermoso.'),
(3, 1, 4, 'Buena guitarra para su precio. Las cuerdas de acero producen un sonido brillante y la guitarra en sí es bastante duradera.');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;