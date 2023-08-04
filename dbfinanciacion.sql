-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2023 a las 14:36:12
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbfinanciacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_lotes`
--

CREATE TABLE `estado_lotes` (
  `id_estado` int(11) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado_lotes`
--

INSERT INTO `estado_lotes` (`id_estado`, `descripcion`) VALUES
(1, 'Disponible'),
(2, 'Señado'),
(3, 'Vendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `financiacion`
--

CREATE TABLE `financiacion` (
  `id_fcion` int(11) NOT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `codigo_lote` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `id_estado` int(11) NOT NULL,
  `anticipo` decimal(19,2) DEFAULT NULL,
  `saldo_financiar` decimal(19,2) DEFAULT NULL,
  `cuotas` int(11) DEFAULT NULL,
  `x1` decimal(19,2) DEFAULT NULL,
  `x2` decimal(19,2) DEFAULT NULL,
  `monto_financiado` decimal(19,2) DEFAULT NULL,
  `valor_cuota` decimal(19,2) DEFAULT NULL,
  `total_operacion` decimal(19,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `financiacion`
--

INSERT INTO `financiacion` (`id_fcion`, `id_lote`, `codigo_lote`, `id_estado`, `anticipo`, `saldo_financiar`, `cuotas`, `x1`, `x2`, `monto_financiado`, `valor_cuota`, `total_operacion`, `id_usuario`) VALUES
(3, 26, 'AI0001', 2, '580000.00', '1212106.98', 4, '0.33', '218179.26', '1284833.40', '321208.35', '1864833.40', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_loteos`
--

CREATE TABLE `info_loteos` (
  `id` int(11) NOT NULL,
  `id_loteo` int(11) NOT NULL,
  `cabecera` varchar(255) DEFAULT NULL,
  `anticipo_minimo` varchar(255) DEFAULT NULL,
  `posesion` varchar(255) DEFAULT NULL,
  `anticipo_uno` varchar(255) DEFAULT NULL,
  `anticipo_dos` varchar(255) DEFAULT NULL,
  `servicios` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `info_loteos`
--

INSERT INTO `info_loteos` (`id`, `id_loteo`, `cabecera`, `anticipo_minimo`, `posesion`, `anticipo_uno`, `anticipo_dos`, `servicios`) VALUES
(1, 1, 'Situado en Autopista Circumbalacón Sureste entre Ruta\n26 (Camino a la Isla) y Ruta 21 (Camino a San Agustín).', 'ANTICIPO MINIMO: 20% del Precio de lista.', 'POSESION:\nINMEDIATA: De Contado o con Anticipo del 50% del\nPrecio de lista (Abonando las conexiones conrrespondientes).', 'Con ANTICIPO 20%.\n12 CUOTAS A LOS 3  MESES\n24 CUOTAS A LOS 6  MESES\n36 CUOTAS A LOS 9  MESES\n48 CUOTAS A LOS 12 MESES\n60 CUOTAS A LOS 15 MESES\n72 CUOTAS A LOS 18 MESES\n80 CUOTAS A LOS 20 MESES', 'Con ANTICIPO 30%.\n12 CUOTAS A LOS 6  MESES.\n24 CUOTAS A LOS 12 MESES.\n36 CUOTAS A LOS 18 MESES.\n48 CUOTAS A LOS 24 MESES.\n60 CUOTAS A LOS 30 MESES.\n72 CUOTAS A LOS 36 MESES.\n80 CUOTAS A LOS 42 MESES.', 'SERVICIOS:\nLuz.\nAgua.\nEnripiado.\nRed de Cloacas (en obra). Una vez habilitada la Red\nde Cloacas, deberá abonar el costo proporcional en\nconcepto de frentista.\nCordon Cuneta (en obra).'),
(2, 2, 'Situado en Autopista Circumbalacón Sureste entre Ruta\n26 (Camino a la Isla) y Ruta 21 (Camino a San Agustín).', 'ANTICIPO MINIMO: 20% del Precio de lista.', 'POSESION:\nINMEDIATA: De Contado o con Anticipo del 50% del\nPrecio de lista (Abonando las conexiones conrrespondientes).', 'Con ANTICIPO 20%.\n12 CUOTAS A LOS 3  MESES.\n24 CUOTAS A LOS 6  MESES.\n36 CUOTAS A LOS 9  MESES.\n48 CUOTAS A LOS 12 MESES.\n60 CUOTAS A LOS 15 MESES.\n72 CUOTAS A LOS 18 MESES.\n80 CUOTAS A LOS 20 MESES.', 'Con ANTICIPO 30%.\n12 CUOTAS A LOS 6  MESES.\n24 CUOTAS A LOS 12 MESES.\n36 CUOTAS A LOS 18 MESES.\n48 CUOTAS A LOS 24 MESES.\n60 CUOTAS A LOS 30 MESES.\n72 CUOTAS A LOS 36 MESES.\n80 CUOTAS A LOS 42 MESES.', 'SERVICIOS:\nLuz.\nAgua.\nEnripiado.\nRed de Cloacas (en obra). Una vez habilitada la Red\nde Cloacas, deberá abonar el costo proporcional en\nconcepto de frentista.\nCordon Cuneta (en obra).\nTecho de lona.'),
(3, 3, 'Situado al Norte de la provincia a 500 mtrs. de la Ruta Nacional N° 8', 'ANTICIPO MINIMO: 20% del Precio de lista.', 'POSESION:\nINMEDIATA: De Contado o con Anticipo del 50% del\nPrecio de lista (Abonando las conexiones conrrespondientes).', 'Con ANTICIPO 20%.\n12 CUOTAS A LOS 3  MESES.\n24 CUOTAS A LOS 6  MESES.\n36 CUOTAS A LOS 9  MESES.\n48 CUOTAS A LOS 12 MESES.\n60 CUOTAS A LOS 15 MESES.\n72 CUOTAS A LOS 18 MESES.\n80 CUOTAS A LOS 20 MESES.', 'Con ANTICIPO 30%.\n12 CUOTAS A LOS 6  MESES.\n24 CUOTAS A LOS 12 MESES.\n36 CUOTAS A LOS 18 MESES.\n48 CUOTAS A LOS 24 MESES.\n60 CUOTAS A LOS 30 MESES.\n72 CUOTAS A LOS 36 MESES.\n80 CUOTAS A LOS 42 MESES.', 'SERVICIOS:\nLuz.\nAgua.\nEnripiado.\nRed de Cloacas (en obra). Una vez habilitada la Red\nde Cloacas, deberá abonar el costo proporcional en\nconcepto de frentista.\nCordon Cuneta (en obra).'),
(4, 4, 'Situado en Autopista Circumbalacón Sureste entre Ruta\n26 (Camino a la Isla) y Ruta 21 (Camino a San Agustín).', 'ANTICIPO MINIMO: 20% del Precio de lista.', 'POSESION:\nINMEDIATA: De Contado o con Anticipo del 50% del\nPrecio de lista (Abonando las conexiones conrrespondientes).', 'Con ANTICIPO 20%.\n12 CUOTAS A LOS 3  MESES.\n24 CUOTAS A LOS 6  MESES.\n36 CUOTAS A LOS 9  MESES.\n48 CUOTAS A LOS 12 MESES\n60 CUOTAS A LOS 15 MESES\n72 CUOTAS A LOS 18 MESES\n80 CUOTAS A LOS 20 MESES', 'Con ANTICIPO 30%.\n12 CUOTAS A LOS 6  MESES\n24 CUOTAS A LOS 12 MESES\n36 CUOTAS A LOS 18 MESES\n48 CUOTAS A LOS 24 MESES\n60 CUOTAS A LOS 30 MESES\n72 CUOTAS A LOS 36 MESES\n80 CUOTAS A LOS 42 MESES', 'SERVICIOS:\nLuz.\nAgua.\nEnripiado.\nRed de Cloacas (en obra). Una vez habilitada la Red\nde Cloacas, deberá abonar el costo proporcional en\nconcepto de frentista.\nCordon Cuneta (en obra).'),
(5, 5, 'Situado en Autopista Circumbalacón Sureste entre Ruta\n26 (Camino a la Isla) y Ruta 21 (Camino a San Agustín).', 'ANTICIPO MINIMO: 20% del Precio de lista.', 'POSESION:\nINMEDIATA: De Contado o con Anticipo del 50% del\nPrecio de lista (Abonando las conexiones conrrespondientes).', 'Con ANTICIPO 20%.\n12 CUOTAS A LOS 3  MESES.\n24 CUOTAS A LOS 6  MESES.\n36 CUOTAS A LOS 9  MESES.\n48 CUOTAS A LOS 12 MESES.\n60 CUOTAS A LOS 15 MESES.\n72 CUOTAS A LOS 18 MESES.\n80 CUOTAS A LOS 20 MESES.', 'Con ANTICIPO 30%.\n12 CUOTAS A LOS 6  MESES.\n24 CUOTAS A LOS 12 MESES.\n36 CUOTAS A LOS 18 MESES.\n48 CUOTAS A LOS 24 MESES.\n60 CUOTAS A LOS 30 MESES.\n72 CUOTAS A LOS 36 MESES.\n80 CUOTAS A LOS 42 MESES.', 'SERVICIOS:\nLuz.\nAgua.\nEnripiado.\nRed de Cloacas (en obra). Una vez habilitada la Red\nde Cloacas, deberá abonar el costo proporcional en\nconcepto de frentista.\nCordon Cuneta (en obra).');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loteos`
--

CREATE TABLE `loteos` (
  `id_loteo` int(11) NOT NULL,
  `loteo` varchar(100) NOT NULL,
  `codigo_loteo` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `loteos`
--

INSERT INTO `loteos` (`id_loteo`, `loteo`, `codigo_loteo`) VALUES
(1, 'Airampo', 'AI'),
(2, 'Buen Clima', 'BC'),
(3, 'Libertad', 'LI'),
(4, 'Palo Marcado', 'PM'),
(5, 'Terranova', 'TE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id_lote` int(11) NOT NULL,
  `id_loteo` int(11) DEFAULT NULL,
  `loteo` varchar(100) NOT NULL,
  `codigo_lote` varchar(6) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `frente` decimal(19,2) DEFAULT NULL,
  `esquina` varchar(10) NOT NULL,
  `superficie` decimal(19,2) DEFAULT NULL,
  `preciom2` decimal(19,2) DEFAULT NULL,
  `preciolista` decimal(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `id_loteo`, `loteo`, `codigo_lote`, `id_estado`, `frente`, `esquina`, `superficie`, `preciom2`, `preciolista`) VALUES
(1, 4, 'Palo Marcado', 'PM0043', 1, '10.00', 'NO', '233.10', '21592.16', '5033132.50'),
(2, 4, 'Palo Marcado', 'PM0030', 1, '10.00', 'NO', '305.46', '20959.20', '6402197.23'),
(3, 2, 'Buen Clima', 'BC0003', 1, '15.00', 'NO', '356.56', '28955.50', '10324373.08'),
(4, 2, 'Buen Clima', 'BC0455', 1, '15.00', 'NO', '356.56', '28955.50', '10324373.08'),
(5, 1, 'Airampo', 'AI0455', 1, '10.00', 'NO', '288.06', '40804.00', '11754000.24'),
(6, 1, 'Airampo', 'AI0087', 1, '10.00', 'NO', '210.48', '15200.00', '3199296.00'),
(7, 1, 'Airampo', 'AI0080', 1, '10.00', 'NO', '125.21', '15200.00', '1903192.00'),
(8, 1, 'Airampo', 'AI0090', 1, '10.00', 'NO', '125.21', '15505.52', '1941446.16'),
(9, 2, 'Buen Clima', 'BC0036', 1, '11.00', 'NO', '250.20', '356.06', '89086.21'),
(10, 1, 'Airampo', 'AI0045', 1, '11.00', 'NO', '201.05', '12241.20', '2461093.26'),
(12, 5, 'Terranova', 'TE2131', 1, '10.00', 'SI', '400.00', '10000.00', '4000000.00'),
(13, 3, 'Libertad', 'LI0028', 1, '10.00', 'NO', '208.00', '10000.00', '2080000.00'),
(14, 4, 'Palo Marcado', 'PM0009', 1, '11.00', 'NO', '110.00', '15453.00', '1699830.00'),
(15, 2, 'Buen Clima', 'BC0090', 1, '10.00', 'NO', '122.00', '25000.00', '3050000.00'),
(16, 4, 'Palo Marcado', 'PM0062', 1, '10.00', 'NO', '205.46', '16483.20', '3386638.27'),
(17, 1, 'Airampo', 'AI0021', 1, '10.00', 'NO', '201.30', '15321.90', '3084298.47'),
(18, 1, 'Airampo', 'AI0023', 1, '12.00', 'NO', '201.30', '15505.52', '3121261.18'),
(19, 1, 'Airampo', 'AI0039', 1, '10.00', 'NO', '102.20', '16372.61', '1673280.74'),
(20, 3, 'Libertad', 'LI0012', 1, '10.00', 'NO', '102.22', '15000.00', '1533300.00'),
(21, 1, 'Airampo', 'AI0012', 1, '10.00', 'NO', '102.02', '15505.52', '1581873.15'),
(22, 1, 'Airampo', 'AI0120', 1, '102.20', 'NO', '305.22', '15506.04', '4732753.53'),
(23, 1, 'Airampo', 'AI0466', 1, '11.00', 'NO', '125.50', '20945.71', '2628686.61'),
(24, 3, 'Libertad', 'LI0121', 1, '1222.00', 'NO', '203.22', '10500.00', '2133810.00'),
(25, 1, 'Airampo', 'AI0081', 1, '105.05', 'NO', '305.05', '15000.00', '4575750.00'),
(26, 1, 'Airampo', 'AI0001', 2, '10.50', 'NO', '105.60', '16970.71', '1792106.98'),
(27, 5, 'Terranova', 'TE2132', 1, '10.00', 'NO', '420.00', '12000.00', '5040000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_asignados`
--

CREATE TABLE `permisos_asignados` (
  `id_pa` int(11) NOT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Vendedor'),
(3, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pass` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_rol`, `nombre`, `usuario`, `pass`) VALUES
(1, 1, 'Luis Lavayén', 'Luis', '213156'),
(2, 3, 'Rocio Gancedo', 'rgancedo', '123'),
(3, 2, 'Romina Mamaní', 'rmamani', 'rm123'),
(4, 3, 'Damian Casares', 'damian', 'dc2023'),
(5, 2, 'Ivana Nadal', 'inadal', 'ivi123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado_lotes`
--
ALTER TABLE `estado_lotes`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `financiacion`
--
ALTER TABLE `financiacion`
  ADD PRIMARY KEY (`id_fcion`,`codigo_lote`);

--
-- Indices de la tabla `info_loteos`
--
ALTER TABLE `info_loteos`
  ADD PRIMARY KEY (`id`,`id_loteo`),
  ADD KEY `id_loteo` (`id_loteo`);

--
-- Indices de la tabla `loteos`
--
ALTER TABLE `loteos`
  ADD PRIMARY KEY (`id_loteo`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`,`descripcion`);

--
-- Indices de la tabla `permisos_asignados`
--
ALTER TABLE `permisos_asignados`
  ADD PRIMARY KEY (`id_pa`,`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado_lotes`
--
ALTER TABLE `estado_lotes`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `financiacion`
--
ALTER TABLE `financiacion`
  MODIFY `id_fcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `info_loteos`
--
ALTER TABLE `info_loteos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `loteos`
--
ALTER TABLE `loteos`
  MODIFY `id_loteo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos_asignados`
--
ALTER TABLE `permisos_asignados`
  MODIFY `id_pa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `info_loteos`
--
ALTER TABLE `info_loteos`
  ADD CONSTRAINT `info_loteos_ibfk_1` FOREIGN KEY (`id_loteo`) REFERENCES `loteos` (`id_loteo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
