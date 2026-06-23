-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2026 a las 01:42:51
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
  `estadoAlquiler` enum('pendiente','activo','finalizado','cancelado') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `nombreConductor` varchar(100) NOT NULL,
  `formaPago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`idAlquiler`, `idClienteAlquiler`, `idVehiculoAlquiler`, `fechaDesdeAlquiler`, `cantDiasAlquiler`, `fechaHastaAlquiler`, `estadoAlquiler`, `created_at`, `updated_at`, `nombreConductor`, `formaPago`) VALUES
(6, 5, 7, '2026-06-24', 5, '2026-06-29', 'cancelado', NULL, NULL, 'Ricky Martin', 'Tarjeta de débito'),
(7, 5, 40, '2026-07-05', 10, '2026-07-15', 'finalizado', NULL, NULL, 'Luis Miguel', 'Efectivo'),
(8, 6, 31, '2026-07-12', 20, '2026-08-01', 'activo', NULL, NULL, 'Lionel Messi', 'Transferencia'),
(9, 6, 20, '2026-08-04', 12, '2026-08-16', 'activo', NULL, NULL, 'Antonella', 'Tarjeta de crédito'),
(10, 5, 32, '2026-06-24', 6, '2026-06-30', 'activo', NULL, NULL, 'Ricky Martin', 'Transferencia'),
(11, 6, 40, '2026-07-03', 6, '2026-07-09', 'pendiente', NULL, NULL, 'Lionel Messi', 'Transferencia');

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
  `activoUsuario` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `emailUsuario`, `passwordUsuario`, `rolUsuario`, `nombreUsuario`, `fechaAltaUsuario`, `telefonoUsuario`, `direccionUsuario`, `activoUsuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'chayanne@gmail.com', '$2y$10$NyA6N1IoGFVe8SAVBbjsVuQ9hAs0KdbSLiP71xOQl7.IWPY6VcgXS', 'admin', 'Chayanne', '2026-06-23', '3527589', 'Argentina 123', 1, NULL, NULL, NULL),
(5, 'ricky@gmail.com', '$2y$10$aqX9mDFZ554tn.dCdOW.OOuw/z8YZyr7QQlyMxWHWosLE.vzc3Lui', 'cliente', 'Ricky Martin', '2026-06-23', '175390621', 'Colombia 456', 1, NULL, NULL, NULL),
(6, 'messi@gmail.com', '$2y$10$YgTV78.fY21mcv72HS9n5Ob3OmP.ypkTXyg.uJL1/m4/o1aQLUfhi', 'cliente', 'Lionel Messi', '2026-06-23', '427942157', 'Argentina789', 1, NULL, NULL, NULL);

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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`idVehiculo`, `marcaVehiculo`, `modeloVehiculo`, `anioVehiculo`, `nroPlazasVehiculo`, `motorVehiculo`, `kilometrajeVehiculo`, `precioAlqVehiculo`, `imagenVehiculo`, `disponibleVehiculo`, `activoVehiculo`, `categoriaVehiculo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Toyota', 'Etios', 2022, 5, '1.5', 35000, 25000, '1782168887_4740d103fb333afb2b3c.jpg', 1, 1, 'compacto', NULL, '2026-06-22 22:54:47', NULL),
(2, 'Chevrolet', 'Onix', 2023, 5, '1.2', 12000, 28000, '1782169113_3d5c4a5437d4ff14fe71.jpg', 1, 1, 'compacto', NULL, '2026-06-22 22:58:33', NULL),
(3, 'Toyota', 'Corolla', 2023, 5, '2.0', 8000, 35000, 'toyotacorolla2023.webp', 1, 1, 'sedan', NULL, NULL, NULL),
(4, 'Volkswagen', 'Vento', 2022, 5, '1.4 TSI', 18000, 37000, '1782169476_3864d24fd5ce0e443823.webp', 1, 1, 'sedan', NULL, '2026-06-22 23:04:36', NULL),
(5, 'Jeep', 'Renegade', 2022, 5, '1.8', 25000, 45000, 'jeeprenegade2022.jpg', 1, 1, 'suv', NULL, NULL, NULL),
(6, 'Ford', 'Territory', 2024, 5, '1.5 Turbo', 5000, 50000, '1782168402_c2bdd72811bddf5a2681.jpg', 1, 1, 'suv', NULL, '2026-06-22 22:46:42', NULL),
(7, 'Chevrolet', 'Camaro', 2023, 4, '6.2 V8', 3000, 90000, 'chevroletcamaro2023.jpg', 1, 1, 'deportivo', NULL, NULL, NULL),
(8, 'Ford', 'Ka', 2020, 5, '1.5', 45000, 22000, 'fordka2020.jpeg', 1, 1, 'compacto', NULL, NULL, NULL),
(9, 'Volkswagen', 'Gol', 2019, 5, '1.6', 55000, 21000, '1782169584_794881d8f3b506e29bdd.jpeg', 1, 1, 'compacto', NULL, '2026-06-22 23:06:24', NULL),
(10, 'Renault', 'Sandero', 2021, 5, '1.6', 30000, 24000, 'renaultsandero2021.png', 1, 1, 'compacto', NULL, NULL, NULL),
(11, 'Peugeot', '208', 2023, 5, '1.6', 12000, 28000, 'peugeot2082023.jpg', 1, 1, 'compacto', NULL, NULL, NULL),
(12, 'Fiat', 'Argo', 2022, 5, '1.3', 18000, 26000, 'fiatargo2022.jpg', 1, 1, 'compacto', NULL, NULL, NULL),
(13, 'Toyota', 'Yaris', 2021, 5, '1.5', 25000, 27000, 'toyotayaris2021.webp', 1, 1, 'compacto', NULL, NULL, NULL),
(14, 'Hyundai', 'HB20', 2022, 5, '1.6', 15000, 26500, 'hyundaihb202022.webp', 1, 1, 'compacto', NULL, NULL, NULL),
(15, 'Kia', 'Rio', 2020, 5, '1.4', 35000, 25000, 'kiario2020.webp', 1, 1, 'compacto', NULL, NULL, NULL),
(16, 'Honda', 'Civic', 2021, 5, '2.0', 28000, 38000, 'hondacivic2021.jpg', 1, 1, 'sedan', NULL, NULL, NULL),
(17, 'Chevrolet', 'Cruze', 2023, 5, '1.4 Turbo', 12000, 42000, 'chevroletcruze2023.jpg', 1, 1, 'sedan', NULL, NULL, NULL),
(18, 'Nissan', 'Sentra', 2020, 5, '2.0', 35000, 36000, 'nissansentra2020.jpg', 1, 1, 'sedan', NULL, NULL, NULL),
(19, 'Ford', 'Focus', 2020, 5, '2.0', 42000, 34000, 'fordfocus2020.jpg', 1, 1, 'sedan', NULL, NULL, NULL),
(20, 'Hyundai', 'Elantra', 2021, 5, '2.0', 27000, 39000, 'hyundaielantra2021.jpg', 1, 0, 'sedan', NULL, '2026-06-23 23:33:44', NULL),
(21, 'Kia', 'Cerato', 2022, 5, '2.0', 18000, 40000, 'kiacerato2022.jpg', 1, 1, 'sedan', NULL, NULL, NULL),
(22, 'Mazda', '3 Sedan', 2021, 5, '2.0', 22000, 41000, 'mazda3sedan2021.jpg', 1, 1, 'sedan', NULL, NULL, NULL),
(23, 'Renault', 'Fluence', 2019, 5, '2.0', 50000, 32000, 'renaultfluence2019.jpg', 1, 1, 'sedan', NULL, NULL, NULL),
(24, 'Toyota', 'Corolla Cross', 2022, 5, '2.0', 22000, 52000, 'toyotacorollacross2022.webp', 1, 1, 'suv', NULL, NULL, NULL),
(25, 'Hyundai', 'Santa Fe', 2021, 7, '2.5', 30000, 58000, 'hyundaisantafe2021.jpg', 1, 1, 'suv', NULL, NULL, NULL),
(26, 'Chevrolet', 'Tracker', 2023, 5, '1.2 Turbo', 10000, 47000, 'chevrolettracker2023.jpeg', 1, 1, 'suv', NULL, NULL, NULL),
(27, 'Jeep', 'Compass', 2019, 5, '2.4', 48000, 45000, 'jeepcompass2019.jpg', 1, 1, 'suv', NULL, NULL, NULL),
(28, 'Volkswagen', 'Taos', 2023, 5, '1.4 Turbo', 12000, 49000, 'volkswagentaos2023.webp', 1, 1, 'suv', NULL, NULL, NULL),
(29, 'Kia', 'Sportage', 2021, 5, '2.0', 26000, 51000, 'kiasportage2021.webp', 1, 1, 'suv', NULL, NULL, NULL),
(30, 'Nissan', 'X-Trail', 2022, 7, '2.5', 18000, 56000, 'nissanxtrail2022.webp', 1, 1, 'suv', NULL, NULL, NULL),
(31, 'Honda', 'CR-V', 2023, 5, '1.5 Turbo', 9000, 60000, 'hondacrv2023.jpg', 1, 1, 'suv', NULL, NULL, NULL),
(32, 'Porsche', '911 Carrera', 2021, 4, '3.0 Turbo', 12000, 120000, 'porsche911carrera2021.jpg', 1, 1, 'deportivo', NULL, NULL, NULL),
(33, 'Nissan', '370Z', 2019, 2, '3.7 V6', 25000, 85000, 'nissan370z2019.jpg', 1, 1, 'deportivo', NULL, NULL, NULL),
(34, 'BMW', 'M4 Competition', 2022, 4, '3.0 Twin Turbo', 15000, 110000, 'bmwm4competition2022.jpg', 1, 1, 'deportivo', NULL, NULL, NULL),
(35, 'Ford', 'Mustang GT', 2022, 4, '5.0 V8', 18000, 95000, 'fordmustang2022.webp', 1, 1, 'deportivo', NULL, NULL, NULL),
(36, 'Toyota', 'GR Supra', 2021, 2, '3.0 Turbo', 14000, 100000, 'toyotagrsupra2021.jpg', 1, 1, 'deportivo', NULL, NULL, NULL),
(37, 'Audi', 'TT RS', 2020, 2, '2.5 Turbo', 22000, 92000, 'audittrs2020.webp', 1, 1, 'deportivo', NULL, NULL, NULL),
(38, 'Mercedes-Benz', 'AMG GT', 2022, 2, '4.0 V8 Biturbo', 10000, 130000, 'mercedesbenzamgt2022.jpg', 1, 1, 'deportivo', NULL, NULL, NULL),
(39, 'Jaguar', 'F-Type', 2021, 2, '5.0 V8', 16000, 115000, 'jaguarftype2021.jpg', 1, 1, 'deportivo', NULL, NULL, NULL),
(40, 'Chevrolet', 'Corvette Stingray', 2023, 2, '6.2 V8', 8000, 140000, 'chevroletcorvettestingray2023.jpg', 1, 1, 'deportivo', NULL, NULL, NULL),
(41, 'Toyota ', 'Corolla Cros', 2023, 5, '2.0', 18500, 85000, '1781997018_5f9845bb14ae4cbb036c.webp', 1, 1, 'SUV', '2026-06-20 23:10:18', '2026-06-20 23:10:18', NULL);

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
  MODIFY `idAlquiler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
