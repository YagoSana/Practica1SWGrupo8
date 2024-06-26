-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2024 a las 12:32:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_final`
--

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`ID_Carrito`, `Cliente`, `Producto`, `Cantidad`) VALUES
(11, '13', 9, 1),
(12, '13', 4, 1);

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`ID_Pedido`, `Fecha`, `Cliente`, `Importe`) VALUES
(1, '2024-05-02', '8', 0),
(2, '2024-05-02', '9', 0),
(3, '2024-05-10', '11', 898.17),
(4, '2024-05-10', '10', 120.96);

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Producto`, `Nombre`, `Descripcion`, `Precio`, `Imagen`, `Stock`, `Visible`, `Tipo`, `ID_Venta`) VALUES
(1, 'Guitarra Acústica', 'Instrumento musical de alta calidad, con cuerdas de acero y un sonido resonante y claro. Ideal para músicos de todos los niveles. Cuerpo de madera pulida para una estética elegante. Esta guitarra acús', 299.99, '/img/imagenesBD/Guitarra.jpg', 7, 1, 'Cuerda', 0),
(2, 'Tambor', 'Instrumento de percusión de sonido profundo y resonante. Cuerpo de madera con parches de piel ajustables. Perfecto para ritmos enérgicos y actuaciones en vivo.', 99.99, '/img/imagenesBD/Tambor.jpg', 8, 1, 'Percusion', 0),
(3, 'Arpa', 'Instrumento musical elegante con cuerdas tensadas que se tocan con los dedos. Produce sonidos melodiosos y suaves. Ideal para música clásica y celta. Cuerpo de madera de alta calidad para una resonanc', 629.99, '/img/imagenesBD/Arpa.jpg', 9, 1, 'Cuerda', 0),
(4, 'Armónica', 'diseñada para practicantes, principiantes e intermedios. Gran sistema de armónica adecuado para blues, folk, música clásica pop, jazz, country y rock & roll', 68.20, '/img/imagenesBD/armonica.jpg', 9, 1, 'Viento', 0),
(5, 'Pink Floyd Vinilo', 'Vinilo de la banda Pink Floyd, con su álbum más famoso, The Dark Side of the Moon. Un clásico de la música rock que no puede faltar en tu colección.', 35.99, '/img/imagenesBD/PinkFloydVinile.png', 9, 1, 'Articulos', 0),
(6, 'PumpUpTheJam Vinilo', 'Vinilo de la banda Technotronic, con su álbum más famoso, Pump Up The Jam. Un clásico de la música electrónica que conquistó las pistas de baile en los años 90.', 35.99, '/img/imagenesBD/PumpUpTheJam.png', 8, 1, 'Articulos', 0),
(7, 'Camiseta Los Ramones', 'Camiseta de la banda Ramones, con su icónico logo en la parte delantera. Fabricada en algodón 100% para una mayor comodidad y durabilidad. Disponible unicamente en talla L. (Más tallas próximamente)', 12.99, '/img/imagenesBD/Ramones.png', 9, 1, 'Articulos', 0),
(8, 'Piano Eléctrico', 'Vendo un piano eléctrico poco usado, queria tener una obcion barata de música clasica en mi sótano pero ya no lo uso. Ha pillado algo de polvo pero no ha perdido valor alguino.', 85.00, '/img/imagenesBD/pianoElectrico.jpg', 1, 1, 'cuerda', 12),
(9, 'Flauta Travesera', 'Flauta travesera metálica para diestros, de tallaje M. Perfecta para empezar en el hobby o incluso para músicos más avanzados.', 165.00, '/img/imagenesBD/flautaTravesera.jpg', 10, 1, 'Viento', 0);

--
-- Volcado de datos para la tabla `productos_pedidos`
--

INSERT INTO `productos_pedidos` (`ID_Pedido`, `ID_Producto`, `Cantidad`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(3, 3, 1),
(3, 4, 1),
(4, 5, 1),
(4, 6, 2),
(4, 7, 1);

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Apellido`, `Nombre`, `User`, `Idusuario`, `Pass`, `Email`, `Rol`, `Puntos`) VALUES
('Sanabria', 'Yago', 'yagosana', 8, '$2y$10$9qG31gaUs54HT/3GBlnJyuIBUQ.ZGczvK8Sfm9o5VNbmnRGS.cw4e', 'yagosana@ucm.es', 'admin', 0.00),
('Felix', 'Alvaro', 'alfelix', 9, '$2y$10$54u/0lMeJCzcHgi0bZgGcOYYagUBVP6jIgNjiqQ6EZqIvRTUjI9vy', 'alfelix@ucm.es', 'admin', 0.00),
('Reyes', 'Laura', 'laureyes', 10, '$2y$10$zEvqxkmtmILL0EI3JpPTEut1lTGooL0ruYChDrPXWTh79V9vC.Wo6', 'laurreye@ucm.es', 'admin', 6.05),
('El Farissi', 'Mohamed', 'melfaris', 11, '$2y$10$.VmxpNm4gNvaao99INOetOtXLIOAzhPLOkTfXC7wGaOCXMnT7RKBi', 'melfaris@ucm.es', 'admin', 44.91),
('Cliente', 'Cliente', 'cliente', 12, '$2y$10$fHDX7YGU4ukGN4sF2wwGWOGnLyrSimmhIyVKZ/X2ct/QDORq.Px.u', 'cliente@ucm.es', 'cliente', 8.50),
('Empleado', 'Empleado', 'empleado', 13, '$2y$10$IQsUNhK3fI8fMHL/tRZUzeDCtHNHYQsdMI3vRh65uWhq1nTnq6jk6', 'empleado@ucm.es', 'empleado', 0.00);

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`ID_Valoracion`, `Idusuario`, `ID_Producto`, `ID_Pedido`, `Valoracion`, `Comentario`) VALUES
(1, 8, 1, 1, 5, 'Excelente guitarra para adentrarse en el mundo de la música, la madera se siente de calidad y las cuerdas de metal son fantásticas.'),
(2, 9, 1, 2, 4, 'Son buenas las guitarras que se venden en esta tienda. He comprado 2, una para mi y otra para mi hermano para tocar juntos y disfrutamos mucho de la calidad del producto. Como aspecto negativo podría decir que pesan un poco de más.'),
(3, 11, 2, 3, 5, 'Buenos tambores, compré 2 unidades para un conjunto de baterías que los necesitaban y suenan muy bien. Resuena muy bien y es muy fácil de instalar'),
(4, 11, 3, 3, 4, 'Buen arpa de madera de roble para tocar en filarmónicas completas. Su único aspecto negativo es su peso para el transporte pero suena de maravilla.'),
(5, 10, 7, 4, 5, 'Me encanta esta camiseta, desde que la tengo no puedo dejar de llevarla puesta. Muy cómoda y de buenos materiales.');

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID_Venta`, `ID_Usuario`, `Nombre`, `Descripcion`, `Imagen`, `Precio`, `Categoria`, `Estado`) VALUES
(1, 12, 'Piano Eléctrico', 'Vendo un piano eléctrico poco usado, queria tener una opción barata de música clasica en mi sótano pero ya no lo uso. Ha pillado algo de polvo pero no ha perdido valor alguno.', 'pianoElectrico.jpg', 85.00, 'Cuerda', 'Aceptada'),
(2, 8, 'Cascos Bluetooth', 'Me he cansado de llevar cascos de diadema y los quiero vender. Suenan bien y la bateria dura mas de 6 horas seguidas.', 'cascos.jpg', 40.00, 'articulo', 'Pendiente'),
(3, 8, 'Guitarra Eléctrica', 'Guitarra eléctrica de mi padre, la usó de gira por el mundo en conciertos de rock como telonero. Funciona bien pero hay que cambiarle alguna cuerda, de ahí el precio reducido.', 'black.jpg', 80.50, 'cuerda', 'Pendiente'),
(4, 9, 'Vinilo Travis Scott', 'Disco de vinilo de Travis Scott del año 2015. Suena estupendamente ya que se ha reproducido pocas veces en tocadiscos y no está desgastado. Contiene 10 canciones de su último álbum. Viene con carátula', 'travisVinilo.jpg', 27.50, 'articulo', 'Pendiente');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
