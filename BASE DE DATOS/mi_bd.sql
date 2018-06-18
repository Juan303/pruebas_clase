-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2018 a las 23:20:19
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mi_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Mandos', 'Mandos arcade de todos los estilos. Para que puedas aporrearlos sin descanso'),
(2, 'Bartops', 'Bartops arcade donde podras recordar los viejos tiempos desde el salon de tu casa.'),
(3, 'Componentes', 'Componentes arcade para crear tus propios proyectos arcade.'),
(4, 'Arcades', 'Recreativas arcades completas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(10) NOT NULL,
  `link` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `alt` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `link`, `alt`) VALUES
(1, 'imagenes/1.jpg', 'mando 1'),
(2, 'imagenes/2.jpg', 'mando 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) NOT NULL,
  `id_cliente` int(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `pagado` enum('si','no') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cliente`, `fecha`, `total`, `pagado`) VALUES
(12, 16, '2018-06-17 23:27:28', '0.00', 'no'),
(13, 16, '2018-06-18 19:47:07', '1741.00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`) VALUES
(10, 12, 4),
(11, 12, 7),
(12, 12, 8),
(13, 13, 7),
(14, 13, 4),
(15, 13, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `id_imagenes` int(10) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_corta` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visibilidad` enum('si','no') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'si'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_imagenes`, `nombre`, `descripcion_corta`, `descripcion`, `precio`, `imagen`, `fecha`, `visibilidad`) VALUES
(4, 2, 0, 'Bartop Arcade', 'bartop arcade mega guay que puedes jugar a toh', 'Supermega bartop donde poder jugar a millones de juegos hasta que te sangren los muñones.', '651.00', 'imagenes/productos/bartop_1.jpg', '2018-06-03 22:16:25', 'si'),
(7, 3, 0, 'Conector USB pasamuros guay', 'Conector USB con rosca de 30 mm', 'Conector USB de buena calidad con la caracteristica de que se puede colocar sobre madera de distintos grosores', '15.00', 'imagenes/productos/mando_3.jpg', '2018-06-05 22:00:21', 'si'),
(8, 3, 0, 'Conector JAMMA', 'Conector Jamma para recreativas', 'Conector estandar Jamma de 120 pines', '20.00', 'imagenes/productos/mando_3.jpg', '2018-06-05 22:01:24', 'si'),
(9, 4, 0, 'Arcade Full God', 'Arcade completa', 'Arcade completa para ponerla en el salon y que tu mujer/marido te eche de casa al ver lo que te has gastado y lo fea que es.', '1075.00', 'imagenes/productos/mando_3.jpg', '2018-06-05 22:32:48', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(2) NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rol` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'user',
  `codigo_activacion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` enum('activada','desactivada') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'desactivada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `apellidos`, `email`, `pass`, `fecha`, `rol`, `codigo_activacion`, `estado`) VALUES
(1, 'pepe2', 'Pepe', 'Sancho', 'pepe@pepe.com', '123456', '2018-05-21 21:59:27', 'user', '0', 'desactivada'),
(2, 'paco2', 'Paco', 'Gutierrez', 'paco1@paco.com', '12345697783', '2018-05-21 21:59:27', 'user', '0', 'desactivada'),
(3, 'maria', 'Maria', 'de Villota', 'maria@maria.com', '1234', '2018-05-21 21:59:27', 'user', '0', 'desactivada'),
(4, 'jaime', 'Jaime', 'Urrutia', 'jaime@jaime.com', '2365478', '2018-05-21 21:59:27', 'user', '0', 'desactivada'),
(5, 'laia', 'Laia', 'Palau', 'laia@laia.com', '14587965', '2018-05-21 21:59:27', 'user', '0', 'desactivada'),
(8, 'neo303', 'Juanes', 'Sanchez', 'informasterjuan@gmail.com', '1234', '2018-05-29 23:30:25', 'user', '0', 'desactivada'),
(16, 'bob303', 'Juan', 'Sanchez de la Torre', 'gdf000@hotmail.com', 'rlBorjaxvSGK.', '2018-06-17 23:26:16', 'admin', 'rlu3frpPCYJSI', 'activada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos` (`id_pedido`),
  ADD KEY `productos` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `pedidos` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
