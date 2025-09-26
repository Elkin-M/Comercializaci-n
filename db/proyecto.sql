-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2025 a las 06:35:41
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
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campesinos`
--

CREATE TABLE `campesinos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `campesinos`
--

INSERT INTO `campesinos` (`id`, `nombre`, `apellidos`, `cedula`, `telefono`, `correo`, `direccion`, `departamento`, `municipio`, `nombre_usuario`, `contraseña`) VALUES
(1, 'john luis', 'buelvas rosario', '119353267', '3023893054', 'jhonbuar@hotmail.com', 'villa grande 1 mz g prima lote 9', 'bolivar', 'cartagena', 'john', '$2y$10$ZmI/gIGC3Z/Tu7YrjwnCpuKg9v5PNXGOlOtEnovFp37iChoZNwl5K'),
(2, 'samuel ', 'perez', '1193532648', '3023536985', 'samuel@hotmail.com', 'mz j lt8', 'bolivar', 'san juan', 'samuel', '$2y$10$o9PcjTG4dSxKuu8G.vUkOuB4Ll1E8x6qIum7iCCVQi2vO6x0SCY32'),
(3, 'juan', 'perez', '1193532648', '3023893054', 'juan@hotmail.com', 'SECTOR 2 MZG\"-9', 'bolivar', 'san juan', 'juan', '$2y$10$t6vT3ClEn7fMuSEyp16NQOd/Fjwo4kz.CFoR2cMMc9fpz.v3.dxH.'),
(4, 'luis', 'gomez', '73226485', '3023893054', 'luis@hotmail.com', 'mz j lt8', 'bolivar', 'san juan', 'luis', '$2y$10$CT3cTztPcswOzRrTqFQxie6gaF0mrq/ldzkCKCCQDOPGuoVcaXhey'),
(7, 'Francisco luis', 'pallares', '73226425', '3124745896', 'franciscoluis52@hotmail.com', 'mz j lt8', 'Bolívar', 'Santa Rosa', 'francisco', '$2y$10$htxKMiv.iFtAMYj22Tv2S.kEc0u1bGif.fMEjtwOgqG0zUCavqay.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cliente`, `cedula`, `correo`, `direccion`, `telefono`, `departamento`, `municipio`) VALUES
(2, 'john luis', '1193532648', 'juan@hotmail.com', 'Multicentro el amparo, tercer piso, oficina 3A2.', '3023893054', 'bolivar', 'cartagena'),
(3, 'john ', '73226485', 'jhonbuar@hotmail.com', 'mz j lt8', '3023536985', 'bolivar', 'cartagena'),
(4, 'john luis', '73226485', 'juan@hotmail.com', 'SECTOR 2 MZG\"-9', '3023893054', 'bolivar', 'cartagena'),
(5, 'john ', '10432945520', 'kbuelvas899@gmail.com', 'mz j lt8', '3023536985', 'bolivar', 'cartagena'),
(6, 'john ', '73226485', 'kbuelvas899@gmail.com', 'villa grande 1 mz g prima lote 9', '3023893054', 'bolivar', 'cartagena'),
(7, 'john ', '10432945520', 'juan@hotmail.com', 'villa grande de indias 1 mz g prima lote 9', '3023536985', 'bolivar', 'san juan'),
(8, 'juan perez', '73226485', 'juan@hotmail.com', 'villa grande de indias 1 mz g prima lote 9', '3023536985', 'bolivar', 'san juan'),
(9, 'john ', '73226485', 'juan@hotmail.com', 'villa grande 1 mz g prima lote 9', '3023893054', 'bolivar', 'cartagena'),
(10, 'john luis', '73226485', 'kbuelvas899@gmail.com', 'mz j lt8', '3023893054', 'bolivar', 'cartagena'),
(11, 'juan perez', '73226485', 'kbuelvas899@gmail.com', 'Multicentro el amparo, tercer piso, oficina 3A2.', '3023536985', 'bolivar', 'cartagena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_producto`, `id_cliente`) VALUES
(5, 13, 6),
(6, 13, 7),
(7, 14, 8),
(8, 14, 9),
(9, 14, 10),
(10, 14, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen_url` varchar(255) NOT NULL,
  `campesino_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `titulo`, `descripcion`, `precio`, `cantidad`, `imagen_url`, `campesino_id`) VALUES
(9, 'Mango', 'Mango maduro, listo para consumir', 5000.00, 3, 'uploads/670c921063004.jpg', 2),
(10, 'Yuca', 'Raíz comestible de la yuca', 2000.00, 5, 'uploads/670c95ccb6b75.jpg', 2),
(13, 'Papaya', 'Fruta tropical de pulpa dulce y jugosa, rica en vitaminas y minerales.', 4000.00, 3, 'uploads/670d55a1c311f.jpg', 4),
(14, 'Cilantro', 'Cilantro fresco, ideal para sazonar platos colombianos.', 8000.00, 1, 'uploads/67338c30ef6b4.jpg', 1),
(15, 'Mango Tommy Atkins', 'Mango de gran tamaño, pulpa firme y jugosa, sabor dulce y ligeramente ácido. Ideal para consumir fresco o en jugos.', 8000.00, 10, 'uploads/673bd40d6245a.jpg', 1),
(16, 'Guineo Verde', 'Guineos verdes frescos, cosechados en su punto óptimo de madurez para asegurar un sabor dulce y una textura firme.  Libres de golpes y magulladuras, ideales para consumo inmediato o para cocinar.', 2500.00, 150, 'uploads/673c1733bffc0.jpg', 3),
(17, 'Guayaba criolla', 'Guayabas criollas de excelente calidad, recién cosechadas.  Piel lisa y brillante, pulpa firme y de color rojo intenso, con un aroma y sabor dulce característico.  Producto fresco y sin tratamientos químicos.', 4500.00, 150, 'uploads/67db9944cfc63.jpg', 7),
(18, 'Habichuelas', 'Habichuelas frescas, de vaina verde intenso, carnosas y tiernas, recolectadas en su punto óptimo de maduración.  Libre de imperfecciones y con un aroma fresco y limpio,  indicativo de su máxima calidad.', 3500.00, 200, 'uploads/67db9c17298f5.jpg', 7),
(19, 'Ñame', 'Ñames frescos cosechados en el Caribe colombiano.  De tamaño grande y forma alargada, piel rugosa de color marrón oscuro y pulpa firme, blanca y jugosa.  Perfectos para preparar diferentes platos típicos.', 2500.00, 150, 'uploads/67db9cda59809.jpg', 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campesinos`
--
ALTER TABLE `campesinos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD KEY `pedido_ibfk_1` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campesino_id` (`campesino_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campesinos`
--
ALTER TABLE `campesinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`campesino_id`) REFERENCES `campesinos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
