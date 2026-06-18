-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2026 a las 04:24:04
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
-- Base de datos: `mycars`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `idAlquiler` int(11) NOT NULL,
  `idClienteAlquiler` int(11) NOT NULL,
  `idVehiculoAlquiler` int(11) NOT NULL,
  `fechaDesdeAlquiler` date NOT NULL,
  `cantDiasAlquiler` int(11) NOT NULL,
  `fechaHastaAlquiler` date NOT NULL,
  `estadoAlquiler` enum('activo','finalizado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `emailUsuario` varchar(100) NOT NULL DEFAULT '',
  `passwordUsuario` varchar(5000) NOT NULL,
  `rolUsuario` enum('admin','cliente') NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `fechaAltaUsuario` date NOT NULL,
  `telefonoUsuario` varchar(20) NOT NULL,
  `direccionUsuario` varchar(100) NOT NULL,
  `activoUsuario` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `idVehiculo` int(11) NOT NULL,
  `marcaVehiculo` varchar(100) NOT NULL,
  `modeloVehiculo` varchar(100) NOT NULL,
  `anioVehiculo` int(11) NOT NULL,
  `nroPlazasVehiculo` int(11) NOT NULL,
  `motorVehiculo` varchar(50) NOT NULL,
  `kilometrajeVehiculo` float NOT NULL,
  `precioAlqVehiculo` float NOT NULL,
  `imagenVehiculo` varchar(200) NOT NULL,
  `disponibleVehiculo` tinyint(1) NOT NULL,
  `activoVehiculo` tinyint(1) NOT NULL,
  `categoriaVehiculo` varchar(50) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`idAlquiler`),
  ADD KEY `fk_idClienteAlquiler` (`idClienteAlquiler`),
  ADD KEY `fk_idVehiculoAlquiler` (`idVehiculoAlquiler`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `emailUsuario` (`emailUsuario`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`idVehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `idAlquiler` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `fk_idClienteAlquiler` FOREIGN KEY (`idClienteAlquiler`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `fk_idVehiculoAlquiler` FOREIGN KEY (`idVehiculoAlquiler`) REFERENCES `vehiculo` (`idVehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
