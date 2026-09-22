-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2026 a las 20:26:14
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
-- Base de datos: `arte_en_vivo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas_perfiles`
--

CREATE TABLE `artistas_perfiles` (
  `id_perfil` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `biografia` text DEFAULT NULL,
  `especialidad` enum('pintor','fotógrafo','escultor','ilustrador','otro') NOT NULL,
  `sitio_web` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_obra` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galerias`
--

CREATE TABLE `galerias` (
  `id_galeria` int(11) NOT NULL,
  `id_artista` int(11) NOT NULL,
  `nombre_galeria` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estilo_diseno` varchar(100) DEFAULT 'minimalista',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `descripcion`, `fecha_creacion`) VALUES
(1, 'Arte Digital', 'Obras creadas mediante herramientas y software informático.', '2026-09-03 19:42:56'),
(2, 'Pintura Tradicional', 'Obras en óleo, acrílico, acuarela y técnicas clásicas.', '2026-09-03 19:42:56'),
(4, 'subrealista', '', '2026-09-03 19:43:32'),
(5, 'paisajista', 'paisajista', '2026-09-03 19:46:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_emisor` int(11) NOT NULL,
  `id_receptor` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `obras`
--

INSERT INTO `obras` (`id`, `id_usuario`, `titulo`, `descripcion`, `precio`, `imagen`, `fecha_creacion`, `usuario_id`) VALUES
(1, 9, 'Atardecer Abstracto', 'Lienzo digital de tonos cálidos y texturas expresionistas.', 250.00, 'obra_1.jpg', '2026-08-27 21:18:01', NULL),
(2, 9, 'Geometría Urbana', 'Estudio conceptual de la arquitectura moderna en 2D.', 400.00, 'obra_2.jpg', '2026-08-27 21:18:01', NULL),
(3, 9, 'Retrato de Neón', 'Ilustración estilo cyberpunk con iluminación focalizada.', 180.00, 'obra_3.jpg', '2026-08-27 21:18:01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras_arte`
--

CREATE TABLE `obras_arte` (
  `id_obra` int(11) NOT NULL,
  `id_galeria` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `dimensiones` varchar(50) DEFAULT NULL,
  `url_imagen` varchar(255) NOT NULL,
  `estado` enum('disponible','vendido','reservado') DEFAULT 'disponible',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_comprador` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado_pago` enum('pendiente','completado','fallido','reembolsado') DEFAULT 'pendiente',
  `metodo_pago` varchar(50) NOT NULL,
  `codigo_transaccion_pasarela` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipo_usuario` enum('artista','comprador','administrador') NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_cuenta` varchar(20) DEFAULT 'comprador',
  `biografia` text DEFAULT NULL,
  `tipo` enum('administrador','artista','comprador') NOT NULL DEFAULT 'comprador',
  `rol` varchar(50) DEFAULT 'artista'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `password`, `contrasena`, `tipo_usuario`, `fecha_registro`, `tipo_cuenta`, `biografia`, `tipo`, `rol`) VALUES
(1, 'juan', '', 'juan@gmail', '$2y$10$q1Pyd6FE92NAB5ICUHJ4wOiJ3VEZpxuWAtQKEvcg8rZd4WfhaS6M2', '', 'artista', '2026-08-27 18:09:49', 'comprador', NULL, '', 'artista'),
(2, 'julian', '', 'julian@gmail', '$2y$10$N/WVqEWDDEx.u8mC6l/noutbkc9LwKOAcBn0YW2OToO2HU89MB5tW', '', 'artista', '2026-08-27 18:16:37', 'comprador', NULL, '', 'artista'),
(4, 'isa', '', 'isa@gmail', '$2y$10$5LB2CUG7TjNMqZmZWWSF.e5Ll.haFwp/gXcCUb8I5p8ypNuygvtwu', '', 'artista', '2026-08-27 18:40:17', 'comprador', NULL, '', 'artista'),
(5, 'maria', '', 'maria@gmail', '$2y$10$Ww7bJhOVh/Jn3UIwFCLOgeVs/Joo/5VkJgbKlkGohm7TdINFvmMdG', '', 'artista', '2026-08-27 18:43:45', 'comprador', NULL, '', 'artista'),
(6, 'linda', '', 'linda@gmail', '$2y$10$bzDx9ea9mp0WJfQ27fGRtedG5HDPhlizViAz63PwhwfYYpG2jaizC', '', 'artista', '2026-08-27 19:24:17', 'comprador', '', 'artista', 'artista'),
(7, 'flor', '', 'flor@gmail', '$2y$10$J/SxN53h3bz7e3qdAHfMBOTRz4uiltdVowD9qIpqe4cMW.RVMsPHa', '', 'artista', '2026-08-27 19:25:20', 'comprador', '', '', 'artista'),
(8, 'carlos', '', 'carlos@gmail', '$2y$10$hALg5zl7qtcgdQaOTY.UB.wOdCxDSa0Q/xlJna/psz/x0H1jMItrG', '', 'artista', '2026-08-27 19:27:01', 'comprador', '', '', 'artista'),
(9, 'Sofía Morales', '', 'sofia@artista.com', '$2y$10$e8O0d4L1mZ9J8QYy2w.1e.8g1KzJ6P2W1vX0Y9Z8A7B6C5D4E3F2G', '', 'artista', '2026-08-27 20:58:55', 'comprador', 'Escultora y pintora digital con 5 años de experiencia en arte conceptual 2D.', 'artista', 'artista'),
(10, 'Carlos Mendoza', '', 'carlos@comprador.com', '$2y$10$e8O0d4L1mZ9J8QYy2w.1e.8g1KzJ6P2W1vX0Y9Z8A7B6C5D4E3F2G', '', 'artista', '2026-08-27 20:58:55', 'comprador', NULL, '', 'artista'),
(11, 'felipe', '', 'felipe@gmail', '$2y$10$dkD7GJEQUE5DO3hG/gxtCuQLSH.mKoQGYber0SymVhvA7DzqH0Tai', '', 'artista', '2026-09-03 19:49:20', 'comprador', '', '', 'artista'),
(14, 'Administrador Principal', '', 'admin@arteenvivo.com', 'admin123', '', 'artista', '2026-09-03 20:02:30', 'comprador', 'Administrador del sistema ArteEnVivo', 'administrador', 'artista');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artistas_perfiles`
--
ALTER TABLE `artistas_perfiles`
  ADD PRIMARY KEY (`id_perfil`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id_detalle`),
  ADD UNIQUE KEY `id_obra` (`id_obra`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `galerias`
--
ALTER TABLE `galerias`
  ADD PRIMARY KEY (`id_galeria`),
  ADD KEY `idx_galerias_artista` (`id_artista`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_emisor` (`id_emisor`),
  ADD KEY `id_receptor` (`id_receptor`);

--
-- Indices de la tabla `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obras_arte`
--
ALTER TABLE `obras_arte`
  ADD PRIMARY KEY (`id_obra`),
  ADD KEY `id_galeria` (`id_galeria`),
  ADD KEY `idx_obras_estado` (`estado`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_comprador` (`id_comprador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artistas_perfiles`
--
ALTER TABLE `artistas_perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galerias`
--
ALTER TABLE `galerias`
  MODIFY `id_galeria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `obras_arte`
--
ALTER TABLE `obras_arte`
  MODIFY `id_obra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `artistas_perfiles`
--
ALTER TABLE `artistas_perfiles`
  ADD CONSTRAINT `artistas_perfiles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_pedidos_ibfk_2` FOREIGN KEY (`id_obra`) REFERENCES `obras_arte` (`id_obra`);

--
-- Filtros para la tabla `galerias`
--
ALTER TABLE `galerias`
  ADD CONSTRAINT `galerias_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_emisor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`id_receptor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `obras_arte`
--
ALTER TABLE `obras_arte`
  ADD CONSTRAINT `obras_arte_ibfk_1` FOREIGN KEY (`id_galeria`) REFERENCES `galerias` (`id_galeria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_comprador`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
