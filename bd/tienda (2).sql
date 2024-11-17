-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2024 a las 07:45:37
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
-- Base de datos: `tienda`
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
(1, 'canastas', 'canastas artesanales '),
(2, 'joyeria ', 'colgante echo de cuentas'),
(4, 'bolsos', 'wew');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 3, 1, 1, 2000.00),
(2, 3, 2, 1, 20000.00),
(3, 4, 3, 2, 12000.00),
(4, 4, 2, 1, 20000.00),
(5, 4, 1, 1, 2000.00),
(6, 5, 1, 1, 2000.00),
(7, 6, 1, 2, 2000.00),
(8, 6, 2, 2, 20000.00),
(9, 6, 3, 2, 12000.00),
(10, 11, 1, 1, 2000.00),
(11, 12, 4, 23, 12000.00),
(12, 13, 3, 6, 12000.00),
(13, 14, 2, 12, 20000.00),
(14, 15, 2, 1, 20000.00),
(15, 16, 3, 1, 12000.00),
(16, 17, 2, 1, 20000.00),
(17, 18, 4, 1, 12000.00),
(18, 19, 4, 1, 12000.00),
(19, 20, 2, 1, 20000.00),
(20, 21, 4, 1, 12000.00),
(21, 22, 2, 1, 20000.00),
(22, 23, 4, 1, 12000.00),
(23, 24, 4, 5, 12000.00),
(24, 25, 4, 1, 12000.00),
(25, 26, 4, 1, 12000.00),
(26, 27, 4, 1, 12000.00),
(27, 28, 3, 1, 12000.00),
(28, 29, 4, 1, 12000.00),
(29, 30, 4, 1, 12000.00),
(30, 31, 4, 1, 12000.00),
(31, 32, 3, 1, 12000.00),
(32, 33, 1, 8, 2000.00),
(33, 34, 2, 4, 20000.00),
(34, 35, 4, 3, 12000.00),
(35, 36, 2, 2, 20000.00),
(36, 37, 2, 3, 20000.00),
(37, 38, 2, 2, 20000.00),
(38, 40, 1, 1, 2000.00),
(39, 48, 2, 1, 20000.00),
(40, 49, 3, 2, 12000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id_direccion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `codigo_postal` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `id_usuario`, `direccion`, `ciudad`, `codigo_postal`) VALUES
(1, 2, 'cabi', 'Quibdó', '2023232');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  `estado` enum('carrito','pendiente','pagado','enviado','entregado','cancelado') DEFAULT 'carrito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `fecha_pedido`, `total`, `estado`) VALUES
(1, NULL, '2024-11-11 14:51:21', 0.00, 'cancelado'),
(2, 1, '2024-11-11 16:06:05', 0.00, 'cancelado'),
(3, 2, '2024-11-11 21:30:32', 22000.00, 'cancelado'),
(4, 2, '2024-11-11 21:35:01', 46000.00, 'cancelado'),
(5, 2, '2024-11-11 21:40:54', 2000.00, 'pendiente'),
(6, 2, '2024-11-11 21:46:16', 68000.00, 'pagado'),
(11, 2, '2024-11-12 02:14:10', 2000.00, 'pendiente'),
(12, 2, '2024-11-12 02:17:18', 276000.00, 'pendiente'),
(13, 2, '2024-11-12 02:25:02', 72000.00, 'pendiente'),
(14, 2, '2024-11-12 02:40:38', 240000.00, 'pendiente'),
(15, 2, '2024-11-12 02:44:37', 20000.00, 'pendiente'),
(16, 2, '2024-11-12 02:44:43', 12000.00, 'pendiente'),
(17, 2, '2024-11-12 02:45:00', 20000.00, 'pendiente'),
(18, 2, '2024-11-12 02:46:04', 12000.00, 'pendiente'),
(19, 2, '2024-11-12 02:46:28', 12000.00, 'pendiente'),
(20, 2, '2024-11-12 02:47:43', 20000.00, 'pendiente'),
(21, 2, '2024-11-12 02:50:00', 12000.00, 'pendiente'),
(22, 2, '2024-11-12 09:09:01', 20000.00, 'pendiente'),
(23, 2, '2024-11-12 09:09:12', 12000.00, 'pendiente'),
(24, 2, '2024-11-12 09:11:34', 60000.00, 'pendiente'),
(25, 2, '2024-11-12 09:11:39', 12000.00, 'pendiente'),
(26, 2, '2024-11-12 09:11:50', 12000.00, 'pendiente'),
(27, 2, '2024-11-12 09:11:54', 12000.00, 'pendiente'),
(28, 2, '2024-11-12 09:15:16', 12000.00, 'pendiente'),
(29, 2, '2024-11-12 09:15:22', 12000.00, 'pendiente'),
(30, 2, '2024-11-12 09:15:26', 12000.00, 'pendiente'),
(31, 2, '2024-11-12 09:17:51', 12000.00, 'pendiente'),
(32, 2, '2024-11-12 09:17:55', 12000.00, 'pendiente'),
(33, 2, '2024-11-12 09:18:36', 16000.00, 'pendiente'),
(34, 2, '2024-11-12 09:19:11', 80000.00, 'pendiente'),
(35, 2, '2024-11-13 21:19:46', 36000.00, 'cancelado'),
(36, 2, '2024-11-13 21:20:55', 40000.00, 'cancelado'),
(37, 2, '2024-11-14 06:56:07', 60000.00, 'pagado'),
(38, 2, '2024-11-14 07:06:07', 40000.00, 'pagado'),
(39, 2, '2024-11-16 21:57:24', 2000.00, 'carrito'),
(40, 2, '2024-11-16 22:54:13', 2000.00, 'pendiente'),
(41, 2, '2024-11-17 00:45:25', 0.00, 'pendiente'),
(42, 2, '2024-11-17 00:47:05', 0.00, 'pendiente'),
(43, 2, '2024-11-17 00:49:02', 0.00, 'pendiente'),
(44, 2, '2024-11-17 00:50:27', 0.00, 'pendiente'),
(45, 2, '2024-11-17 05:42:08', 0.00, 'pendiente'),
(46, 2, '2024-11-17 05:42:25', 0.00, 'pendiente'),
(47, 2, '2024-11-17 06:01:47', 0.00, 'pendiente'),
(48, 2, '2024-11-17 06:05:47', 20000.00, 'cancelado'),
(49, 2, '2024-11-17 06:19:49', 24000.00, 'cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `precio`, `stock`, `imagen_url`, `fecha_creacion`, `id_categoria`) VALUES
(1, 'ferly sSAS', 'canasta', 2000.00, 11, '../assets/img/tienda/productos_3.jpeg', '2024-11-11 07:06:34', 1),
(2, 'ferly', 'cascasas', 20000.00, 12, '../assets/img/tienda/productos_4.png', '2024-11-11 07:07:08', 1),
(3, 'joyeria ', 'cuentas ', 12000.00, 2, '../assets/img/tienda/productos_1.jpg', '2024-11-11 21:34:25', 2),
(4, 'ferlA', 'SDDS', 12000.00, 84, '../assets/img/tienda/productos_1.jpg', '2024-11-12 02:13:15', 2),
(5, 'esencias choco', 'logo de choco', 100000.00, 23, '../assets/img/tienda/image.png', '2024-11-15 11:36:26', 1);

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
(1, 'Cliente'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contrasena`, `id_rol`, `telefono`, `fecha_registro`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$7msj3lbb4jVebEBENc7gz.hh78/iOLp4XfztzWpfwJuuwUH3kMA.i', 2, '3234163627', '2024-11-11 15:03:20'),
(2, 'Manuel Palacios Mosquera e', 'manuel@gmail.com', '$2y$10$lSwtAH1NQ2P7kJG9TWKuBOZi4Kgnc8tXuKqVTrjAYDoiHLwA/dXIC', 1, NULL, '2024-11-11 20:57:05'),
(3, 'prueba mosquera', 'prueba@gmail.com', '$2y$10$.RGfW0M1N06G34hRzShDfObFl/VMSOzAw5cPBij50VqlLtoFZFUny', 1, '3246173924', '2024-11-16 17:53:35');

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
  ADD KEY `id_usuario` (`id_usuario`);

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
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

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
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
