-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2025 a las 20:07:33
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `IDcliente` int(11) NOT NULL,
  `nombreCli` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nit` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefonoCli` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `emailCli` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IDcliente`, `nombreCli`, `nit`, `telefonoCli`, `emailCli`, `update_at`) VALUES
(1, 'Yumbo', '85421512', '111112222', 'yumbo@email.com', '2025-06-08 03:19:55'),
(3, 'Canal2', '845124', '333333', 'canal2@email.com', '2025-06-08 13:41:07'),
(4, 'Indumil', '456132', '5555555', 'indumil@email.com', '2025-06-08 14:18:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivo`
--

CREATE TABLE `dispositivo` (
  `IDdispositivo` int(11) NOT NULL,
  `serial` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `marca` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `modelo` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estadoDis` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `IDusuario` int(11) DEFAULT NULL,
  `IDcliente` int(11) DEFAULT NULL,
  `ubicacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `dispositivo`
--

INSERT INTO `dispositivo` (`IDdispositivo`, `serial`, `marca`, `modelo`, `estadoDis`, `IDusuario`, `IDcliente`, `ubicacion`, `update_at`) VALUES
(1, '45146PHH3100L', 'Lexmark', 'MS610dn', 'Operativa', 1, 1, 'Compras', '2025-06-08 12:59:55'),
(2, 'FGH4512S', 'SAMSUNG', 'M4020', 'Reparar', 24, 3, 'Ventas', '2025-06-08 13:49:33'),
(5, '84512', 'HP', 'E408', 'Inactiva', 1, 4, 'Direccion', '2025-06-08 17:35:55'),
(7, '451224', 'EPSON', 'E20015', 'Reparar', 25, 4, 'Ventas', '2025-06-08 15:14:35'),
(8, 'DFCD4512', 'ZEBRA', 'GK420t', 'Operativa', 1, 1, 'Almacen', '2025-06-08 15:22:09'),
(9, 'YHFFF523', 'KYOCERA', 'W4512', 'Operativa', 24, 4, 'Bodega', '2025-06-08 17:37:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IDusuario` int(11) NOT NULL,
  `nombreUsu` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `documentoUsu` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `emailUsu` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `clave` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rol` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estadoUsu` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fotoUsu` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IDusuario`, `nombreUsu`, `documentoUsu`, `emailUsu`, `clave`, `rol`, `estadoUsu`, `fotoUsu`, `update_at`) VALUES
(1, 'Eiman Males', '12345', 'asd@hotmail.com', '$2y$12$b99q1y6qYpw2kauLWHkLwu16PAaVFXlKNJyy0LbXrdHFdCl9tDOJe', 'Administrador', 'Activo', 'avatar.png', '2025-06-08 00:05:36'),
(24, 'Pepe', '1111', 'pepe@email.com', '$2y$12$pSvzSwP.DIO8OWNrjw5Km.5Hi8bKRH38r1an1xPYbm26uBfvhAi7O', 'Tecnico', 'Activo', 'photo3.jpg', '2025-06-08 18:04:08'),
(25, 'Maria', '2222', 'maria@email.com', '$2y$12$pBo7hTgFhVh5w/O9h7oTeOcUwIG7VKer.aLLAy2CbYo1gH88cTOO.', 'Coordinador', 'Activo', 'avatar2.png', '2025-06-08 18:05:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IDcliente`);

--
-- Indices de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`IDdispositivo`),
  ADD KEY `IDusuario` (`IDusuario`),
  ADD KEY `IDcliente` (`IDcliente`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IDusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `IDcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `IDdispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IDusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD CONSTRAINT `dispositivo_ibfk_1` FOREIGN KEY (`IDusuario`) REFERENCES `usuario` (`IDusuario`),
  ADD CONSTRAINT `dispositivo_ibfk_2` FOREIGN KEY (`IDcliente`) REFERENCES `cliente` (`IDcliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
