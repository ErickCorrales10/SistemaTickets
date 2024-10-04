-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2024 a las 07:39:14
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
-- Base de datos: `sistema_tickets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones_seguimiento`
--

CREATE TABLE `asignaciones_seguimiento` (
  `id_asignacion` int(11) NOT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  `asignado_a` varchar(100) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `fecha_asignacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaciones_seguimiento`
--

INSERT INTO `asignaciones_seguimiento` (`id_asignacion`, `id_ticket`, `asignado_a`, `departamento`, `fecha_asignacion`) VALUES
(3, 3, 'Erick Corrales', 'Mantenimiento', '2024-10-02 02:10:05'),
(4, 4, 'Erick Corrales', 'Mantenimiento', '2024-10-02 02:11:16'),
(5, 5, 'Erick Corrales', 'Mantenimiento', '2024-10-02 02:12:28'),
(6, 6, 'Erick Corrales', 'Mantenimiento', '2024-10-03 19:33:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `email`, `telefono`) VALUES
(4, 'Lionel Messi', 'erickcorriales88@gmail.com', '6648527514'),
(5, 'Lionel Messi', 'lionel@messi.com', '1234567891'),
(6, 'Erick Roberto', 'erick@gmail.com', '6648527514'),
(7, 'Ma Long', 'm@long.com', '124523568');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_nota`, `id_ticket`, `comentario`) VALUES
(3, 3, 'dasdasdas'),
(4, 4, 'fdsfsdfsd'),
(5, 5, 'fdfdsf'),
(6, 6, 'dsdsds');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `prioridad` varchar(100) NOT NULL,
  `estado` enum('Abierto','Cerrado','En Progreso') DEFAULT 'Abierto',
  `fecha_creacion` date DEFAULT NULL,
  `fecha_resolucion` date DEFAULT (curdate() + interval 7 day),
  `id_cliente` int(11) DEFAULT NULL,
  `resuelto` varchar(10) DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `asunto`, `descripcion`, `categoria`, `prioridad`, `estado`, `fecha_creacion`, `fecha_resolucion`, `id_cliente`, `resuelto`) VALUES
(3, 'Problema de conexión', 'vvsdvvsd', 'conectividad', 'alta', 'Abierto', '2024-10-01', '2024-10-07', 4, 'NO'),
(4, 'Problema de conexión', 'ffsdfddfsdf', 'hardware', 'alta', 'Cerrado', '2024-10-01', '2024-10-07', 5, 'NO'),
(5, 'Problema de conexión', 'fdsfsdfdsf', 'configuracion', 'media', 'En Progreso', '2024-10-01', '2024-10-10', 6, 'NO'),
(6, 'Problema de conexión', 'fdfdfdsf', 'conectividad', 'media', 'Abierto', '2024-10-03', '2024-10-10', 7, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contrasena`, `fecha_creacion`) VALUES
(1, 'Erick Corrales', 'erickcorrales@tectijuana.edu.mx', '23211004', '2024-10-01 18:39:55'),
(2, 'Luis Aldama', 'luisaldama@tectijuana.edu.mx', '22210001', '2024-10-01 18:39:55'),
(3, 'Oscar Sención', 'oscarsencion@tectijuana.edu.mx', '20212430', '2024-10-01 18:39:55'),
(4, 'David Garcia', 'davidgarcia@tectijuana.edu.mx', '20211781', '2024-10-01 18:39:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones_seguimiento`
--
ALTER TABLE `asignaciones_seguimiento`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_ticket` (`id_ticket`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `fk_cliente` (`id_cliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones_seguimiento`
--
ALTER TABLE `asignaciones_seguimiento`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones_seguimiento`
--
ALTER TABLE `asignaciones_seguimiento`
  ADD CONSTRAINT `asignaciones_seguimiento_ibfk_1` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id_ticket`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_ticket`) REFERENCES `tickets` (`id_ticket`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
