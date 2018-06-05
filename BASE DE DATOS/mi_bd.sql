-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2018 a las 02:53:23
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
(3, 'Componentes', 'Componentes arcade para crear tus propios proyectos arcade.');

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
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `id_imagenes` int(10) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_corta` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `id_imagenes`, `nombre`, `descripcion_corta`, `descripcion`, `precio`, `imagen`, `fecha`) VALUES
(2, 1, 1, 'Mando Arcade 2', 'Mando Arcade 2 bla bla bla', 'Mando Arcade 2 bla bla bla bla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla bla', '300.00', 'imagenes/productos/mando_1.jpg', '2018-05-31 00:17:19'),
(3, 1, 2, 'Mando Arcade 3', 'Mando Arcade 3 bla bla bla', 'Mando Arcade 1 bla bla bla bla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla blabla bla bla', '345.00', 'imagenes/productos/mando_2.jpg', '2018-05-31 00:17:18'),
(4, 2, 0, 'Bartop Arcade', 'bartop arcade mega guay que puedes jugar a toh', 'Supermega bartop donde poder jugar a millones de juegos hasta que te sangren los muñones.', '650.00', 'imagenes/productos/bartop_1.jpg', '2018-06-03 22:16:25');

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
  `rol` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `apellidos`, `email`, `pass`, `fecha`, `rol`) VALUES
(1, 'pepe2', 'Pepe', 'Sancho', 'pepe@pepe.com', '123456', '2018-05-21 21:59:27', 'user'),
(2, 'paco2', 'Paco', 'Gutierrez', 'paco1@paco.com', '12345697783', '2018-05-21 21:59:27', 'user'),
(3, 'maria', 'Maria', 'de Villota', 'maria@maria.com', '1234', '2018-05-21 21:59:27', 'user'),
(4, 'jaime', 'Jaime', 'Urrutia', 'jaime@jaime.com', '2365478', '2018-05-21 21:59:27', 'user'),
(5, 'laia', 'Laia', 'Palau', 'laia@laia.com', '14587965', '2018-05-21 21:59:27', 'user'),
(6, 'bob303', 'Juan Esteban', 'Sanchez de la Torre', 'gdf000@hotmail.com', '2501303', '2018-05-29 21:46:35', 'admin'),
(8, 'neo303', 'Juanes', 'Sanchez', 'informasterjuan@gmail.com', '1234', '2018-05-29 23:30:25', 'user');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
