-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2025 a las 04:57:02
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebabodega`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion`) VALUES
(1, 'cemento', 'cemento '),
(2, 'varillas ', 'tipos de varillas'),
(3, 'tejas ', 'tejas de barro ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 1, 1, 20000.00),
(2, 1, 3, 2, 18000.00),
(3, 2, 2, 1, 23000.00),
(4, 5, 3, 1, 18000.00),
(5, 6, 2, 2, 23000.00),
(6, 6, 3, 3, 18000.00),
(7, 7, 6, 1, 0.00),
(8, 8, 6, 1, 0.00),
(9, 9, 1, 1, 0.00),
(10, 10, 6, 1, 0.00),
(11, 11, 6, 1, 0.00),
(12, 12, 6, 2, 0.00),
(13, 12, 5, 2, 0.00),
(14, 13, 2, 1, 0.00),
(15, 13, 4, 3, 0.00),
(16, 14, 3, 9, 18000.00),
(17, 14, 1, 7, 20000.00),
(18, 15, 6, 2, 0.00),
(19, 15, 4, 2, 0.00),
(20, 16, 4, 1, 0.00),
(21, 17, 2, 1, 23000.00),
(22, 17, 1, 1, 20000.00),
(23, 18, 2, 1, 23000.00),
(24, 19, 6, 69, 0.00),
(25, 20, 1, 1, 20000.00),
(26, 21, 1, 2, 20000.00),
(27, 22, 1, 50, 20000.00),
(28, 23, 1, 1, 20000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `direccion` varchar(66) NOT NULL,
  `codigo_postal` varchar(20) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `id_pedido`, `id_usuario`, `nombre`, `ciudad`, `direccion`, `codigo_postal`, `fecha_registro`) VALUES
(1, 2, 1, 'Manuel Palacios Mosquera', 'QUIBDO', '', '20', '2024-11-22 13:49:14'),
(2, 5, 1, 'Manuel Palacios Mosquera', 'cabi', 'cabo', '20323', '2024-11-22 14:02:16'),
(3, 6, 1, 'Manuel Palacios Mosquera', 'QUIBDO', 'CRA 9 # 24 - 98', '20323', '2024-11-22 18:52:43'),
(4, 14, 1, 'Manuel Palacios Mosquera', 'armenia', 'CRA 9 # 24 - 98', '322243', '2024-11-24 01:04:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefes_obra_proyectos`
--

CREATE TABLE `jefes_obra_proyectos` (
  `id_relacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jefes_obra_proyectos`
--

INSERT INTO `jefes_obra_proyectos` (`id_relacion`, `id_usuario`, `id_proyecto`) VALUES
(1, 3, 2),
(2, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mejores_constructoras`
--

CREATE TABLE `mejores_constructoras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `calificacion` decimal(3,2) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `proyectos_destacados` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mejores_constructoras`
--

INSERT INTO `mejores_constructoras` (`id`, `nombre`, `calificacion`, `ciudad`, `proyectos_destacados`) VALUES
(1, 'Constructora A', 4.90, 'Bogotá', 'Torre Central, Plaza Norte'),
(2, 'Constructora B', 4.80, 'Medellín', 'Residencial Andes, Parque del Río'),
(3, 'Constructora C', 4.70, 'Cali', 'Ciudad Jardín, Mall Valle'),
(4, 'Constructora D', 4.60, 'Barranquilla', 'Centro Empresarial Caribe, Plaza del Sol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id_movimiento` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `tipo` enum('Entrada','Salida') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_movimiento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `codigo_proyecto` int(11) NOT NULL,
  `estado` varchar(60) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `fecha_pedido`, `codigo_proyecto`, `estado`, `total`) VALUES
(1, 1, '2024-11-22 13:17:41', 0, 'pendiente', 56000.00),
(2, 1, '2024-11-22 13:49:14', 0, 'pendiente', 23000.00),
(3, 1, '2024-11-22 14:01:26', 0, 'pendiente', 18000.00),
(4, 1, '2024-11-22 14:01:52', 0, 'pendiente', 18000.00),
(5, 1, '2024-11-22 14:02:16', 0, 'pendiente', 18000.00),
(6, 1, '2024-11-22 18:52:43', 0, 'pagado', 100000.00),
(7, 3, '2024-11-23 17:49:06', 0, 'cancelado', 0.00),
(8, 3, '2024-11-23 17:58:18', 0, 'cancelado', 0.00),
(9, 3, '2024-11-23 17:58:58', 0, 'pagado', 0.00),
(10, 3, '2024-11-23 18:04:54', 0, 'cancelado', 0.00),
(11, 3, '2024-11-23 18:05:08', 0, 'cancelado', 0.00),
(12, 3, '2024-11-23 22:00:28', 0, 'cancelado', 0.00),
(13, 3, '2024-11-23 22:09:26', 0, 'cancelado', 0.00),
(14, 1, '2024-11-24 01:04:33', 0, 'cancelado', 302000.00),
(15, 3, '2024-11-24 02:20:57', 0, 'pendiente', 0.00),
(16, 3, '2024-11-24 02:21:08', 0, 'pendiente', 0.00),
(17, 5, '2024-11-25 05:01:12', 0, 'pendiente', 43000.00),
(18, 5, '2024-11-25 05:02:03', 0, 'pagado', 23000.00),
(19, 4, '2024-11-25 18:58:26', 0, 'cancelado', 0.00),
(20, 5, '2024-12-11 19:25:28', 0, 'pendiente', 20000.00),
(21, 5, '2025-01-05 01:15:55', 0, 'pendiente', 40000.00),
(22, 5, '2025-01-05 01:26:12', 0, 'cancelado', 1000000.00),
(23, 5, '2025-01-05 01:44:39', 0, 'pendiente', 20000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `stock`, `imagen_url`, `fecha_creacion`, `id_categoria`) VALUES
(1, 'Cemento Portland', 'El más utilizado en la construcción', 20000.00, 55, '../assets/img/Cemento Portland.jpeg', '2024-11-21 22:35:25', 1),
(2, 'Cemento blanco', 'Cemento blanco', 23000.00, 84, '../assets/img/Cemento blanco.jpeg', '2024-11-22 01:55:05', 1),
(3, 'Cemento de albañilería', 'Cemento de albañilería', 18000.00, 79, '../assets/img/Cemento de albañilería.png', '2024-11-22 01:58:28', 1),
(4, 'Microcemento', 'Microcemento', 25000.00, 63, '../assets/img/Microcemento.jpeg', '2024-11-22 01:59:48', 1),
(5, 'Varillas corrugadas', 'Se utilizan para el armado de losas, dalas, cerramientos, castillos, trabes de concreto, entre otros elementos.', 20000.00, 252, '../assets/img/Varilla-Hierro-Corrugada-.jpg', '2024-11-22 20:32:31', 2),
(6, 'Varillas de alambre recocido', 'Varillas de alambre recocido', 20500.00, 129, '../assets/img/Varillas de alambre recocido.jpg', '2024-11-23 09:45:14', 2),
(7, 'Teja cerámica', 'Teja cerámica', 23000.00, 120, '../assets/img/Teja cerámica.jpg', '2024-11-24 08:59:34', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `nombre`, `descripcion`) VALUES
(1, 'utch', 'utch'),
(2, 'fucla', 'fucla'),
(3, 'casa finca los olivos', 'asadas los olivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `descripcion`) VALUES
(1, 'admin'),
(2, 'usuarios '),
(3, 'jefe de proyecto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_proyectos`
--

CREATE TABLE `stock_proyectos` (
  `id_stock` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `stock_proyectos`
--

INSERT INTO `stock_proyectos` (`id_stock`, `id_proyecto`, `id_producto`, `cantidad`) VALUES
(1, 2, 2, 19),
(2, 2, 3, 14),
(3, 2, 4, 24),
(4, 1, 1, 6),
(5, 1, 2, 50),
(6, 2, 1, 3),
(7, 1, 4, 20),
(8, 1, 3, 42),
(9, 1, 5, 80),
(10, 2, 5, 18),
(11, 2, 6, 12),
(12, 3, 6, 19),
(13, 3, 7, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contrasena`, `id_rol`, `telefono`, `fecha_registro`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Yz/1tp6Ujb1OmfLe534agO7yTH0bYbzFSLpwDAM1flkFI5MnGxHhi', 1, '3234163627', '2024-11-21 20:19:14'),
(3, 'ferly', 'ferly9@gmail.com', '$2y$10$jxiEi6aBwNkyYZ20reo3x.CF9kedq2OpIzzgbjNLkMMgInt3D4DHC', 3, '3234163627', '2024-11-23 09:48:56'),
(4, 'dannyubely', 'dannyubely@hotmail.com', '$2y$10$otK8GYztSDg6kfd0Uyu3DOiDr.efZMO.AvGv8FVs3Zf0lj.55RCFO', 3, '3113754703', '2024-11-24 02:26:49'),
(5, 'ferly sSAS', 'prueba@gmail.com', '$2y$10$HnHKskFjv8iApAxDLmMNEuMmeudaskOEYIjfMO9Lvrz0jqEuploea', 2, '3246173924', '2024-11-25 04:04:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `jefes_obra_proyectos`
--
ALTER TABLE `jefes_obra_proyectos`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `mejores_constructoras`
--
ALTER TABLE `mejores_constructoras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_movimiento`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `stock_proyectos`
--
ALTER TABLE `stock_proyectos`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `jefes_obra_proyectos`
--
ALTER TABLE `jefes_obra_proyectos`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mejores_constructoras`
--
ALTER TABLE `mejores_constructoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `stock_proyectos`
--
ALTER TABLE `stock_proyectos`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `detalles_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalles_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `direcciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jefes_obra_proyectos`
--
ALTER TABLE `jefes_obra_proyectos`
  ADD CONSTRAINT `jefes_obra_proyectos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `jefes_obra_proyectos_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `stock_proyectos`
--
ALTER TABLE `stock_proyectos`
  ADD CONSTRAINT `stock_proyectos_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`),
  ADD CONSTRAINT `stock_proyectos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
