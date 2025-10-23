-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2025 a las 09:38:55
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
-- Base de datos: `game`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `AlmacenId` int(11) NOT NULL,
  `TiendaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copiasvideojuegos`
--

CREATE TABLE `copiasvideojuegos` (
  `CopiaVideojuegoId` int(11) NOT NULL,
  `PrecioNuevo` decimal(8,2) DEFAULT NULL,
  `PrecioSeminuevo` decimal(8,2) DEFAULT NULL,
  `PrecioCompraGame` decimal(8,2) DEFAULT NULL,
  `Unidades` int(11) DEFAULT 0,
  `VideojuegoId` int(11) NOT NULL,
  `AlmacenId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificaciones`
--

CREATE TABLE `modificaciones` (
  `ModificacionId` int(11) NOT NULL,
  `TipoMovimiento` varchar(50) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `TrabajadorId` int(11) NOT NULL,
  `CopiaVideojuegoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiendas`
--

CREATE TABLE `tiendas` (
  `TiendaId` int(11) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Pais` enum('España','Portugal') NOT NULL DEFAULT 'España'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `TrabajadorId` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Dni` varchar(9) NOT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Email` varchar(75) DEFAULT NULL,
  `Usuario` varchar(40) NOT NULL,
  `Contrasena` varchar(225) NOT NULL,
  `TiendaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videojuegos`
--

CREATE TABLE `videojuegos` (
  `VideojuegoId` int(11) NOT NULL,
  `Titulo` varchar(75) NOT NULL,
  `AnioPublicacion` int(11) DEFAULT NULL,
  `EstudioDesarrollo` varchar(50) DEFAULT NULL,
  `Plataforma` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`AlmacenId`),
  ADD KEY `TiendaId` (`TiendaId`);

--
-- Indices de la tabla `copiasvideojuegos`
--
ALTER TABLE `copiasvideojuegos`
  ADD PRIMARY KEY (`CopiaVideojuegoId`),
  ADD KEY `VideojuegoId` (`VideojuegoId`),
  ADD KEY `AlmacenId` (`AlmacenId`);

--
-- Indices de la tabla `modificaciones`
--
ALTER TABLE `modificaciones`
  ADD PRIMARY KEY (`ModificacionId`),
  ADD KEY `TrabajadorId` (`TrabajadorId`),
  ADD KEY `CopiaVideojuegoId` (`CopiaVideojuegoId`);

--
-- Indices de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  ADD PRIMARY KEY (`TiendaId`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`TrabajadorId`),
  ADD UNIQUE KEY `Dni` (`Dni`),
  ADD UNIQUE KEY `Usuario` (`Usuario`),
  ADD KEY `TiendaId` (`TiendaId`);

--
-- Indices de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  ADD PRIMARY KEY (`VideojuegoId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `AlmacenId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `copiasvideojuegos`
--
ALTER TABLE `copiasvideojuegos`
  MODIFY `CopiaVideojuegoId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modificaciones`
--
ALTER TABLE `modificaciones`
  MODIFY `ModificacionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiendas`
--
ALTER TABLE `tiendas`
  MODIFY `TiendaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `TrabajadorId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `videojuegos`
--
ALTER TABLE `videojuegos`
  MODIFY `VideojuegoId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD CONSTRAINT `almacenes_ibfk_1` FOREIGN KEY (`TiendaId`) REFERENCES `tiendas` (`TiendaId`);

--
-- Filtros para la tabla `copiasvideojuegos`
--
ALTER TABLE `copiasvideojuegos`
  ADD CONSTRAINT `copiasvideojuegos_ibfk_1` FOREIGN KEY (`VideojuegoId`) REFERENCES `videojuegos` (`VideojuegoId`),
  ADD CONSTRAINT `copiasvideojuegos_ibfk_2` FOREIGN KEY (`AlmacenId`) REFERENCES `almacenes` (`AlmacenId`);

--
-- Filtros para la tabla `modificaciones`
--
ALTER TABLE `modificaciones`
  ADD CONSTRAINT `modificaciones_ibfk_1` FOREIGN KEY (`TrabajadorId`) REFERENCES `trabajadores` (`TrabajadorId`),
  ADD CONSTRAINT `modificaciones_ibfk_2` FOREIGN KEY (`CopiaVideojuegoId`) REFERENCES `copiasvideojuegos` (`CopiaVideojuegoId`);

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `trabajadores_ibfk_1` FOREIGN KEY (`TiendaId`) REFERENCES `tiendas` (`TiendaId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
