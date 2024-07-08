-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-06-2024 a las 23:37:04
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fosdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ID` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID`, `username`, `password`) VALUES
(0, 'admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `fecha_creacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `nombre`, `direccion`, `telefono`, `fecha_creacion`) VALUES
(15, 'Joel Ramirez', 'Donde fue la planta electrica 50 vrs al oeste', '86764398', '2023-11-17'),
(16, 'Melvin Lezama', 'Dónde fue la Texaco Guadalupe', '87236953', '2023-11-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_menu`
--

INSERT INTO `tbl_menu` (`menuID`, `menuName`) VALUES
(16, 'Desayunos'),
(17, 'Almuerzos'),
(18, 'Bebidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_menuitem`
--

CREATE TABLE `tbl_menuitem` (
  `itemID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_menuitem`
--

INSERT INTO `tbl_menuitem` (`itemID`, `menuID`, `menuItemName`, `price`) VALUES
(55, 16, 'Gallo pinto', 70.00),
(56, 16, 'Maduros con queso', 60.00),
(57, 17, 'Jalapeño', 120.00),
(58, 17, 'Pollo frito', 120.00),
(59, 18, 'Gaseosa', 20.00),
(60, 18, 'Jugo de naranga', 30.00),
(61, 17, 'sopa de mondongo', 150.00),
(62, 17, 'sopa de res', 120.00),
(63, 17, 'pollo en salsa', 200.00),
(64, 17, 'amburguesas', 170.00),
(65, 17, 'Churrasco de cerdo', 150.00),
(66, 17, 'pollo a la plancha con adobado de res', 200.00),
(67, 17, 'chilaquiles mexicanos', 130.00),
(68, 17, 'Hamburguesa mar y tierra con papas', 130.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderID` int(11) NOT NULL,
  `status` text NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `order_date` date NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `forma_pago` varchar(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `servicio` varchar(20) DEFAULT NULL,
  `costo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_order`
--

INSERT INTO `tbl_order` (`orderID`, `status`, `total`, `order_date`, `nombre`, `forma_pago`, `direccion`, `servicio`, `costo`) VALUES
(1, 'finish', 90.00, '2024-06-06', 'Melvin Lezama', 'Contado', 'Dónde fue la Texaco Guadalupe', 'Delivery', 50),
(2, 'preparando', 150.00, '2024-06-06', 'Melvin Lezama', 'Contado', 'Dónde fue la Texaco Guadalupe', 'Mesa 1', 0),
(4, 'esperando', 200.00, '2024-06-10', 'Melvin Lezama', 'Contado', 'Dónde fue la Texaco Guadalupe', 'Delivery', 80),
(5, 'esperando', 30.00, '2024-06-10', 'Joel Ramirez', 'Contado', 'Donde fue la planta electrica 50 vrs al oeste', 'Delivery', 90),
(6, 'esperando', 260.00, '2024-06-10', 'Joel Ramirez', 'Contado', 'Donde fue la planta electrica 50 vrs al oeste', 'Mesa 1', 0),
(7, 'esperando', 130.00, '2024-06-10', 'Melvin Lezama', 'Credito', 'Dónde fue la Texaco Guadalupe', 'Mesa 1', 0),
(8, 'esperando', 60.00, '2024-06-11', '', 'Contado', '', 'Mesa 2', 0),
(9, 'esperando', 150.00, '2024-06-12', 'Melvin Lezama', 'Credito', 'Dónde fue la Texaco Guadalupe', 'Mesa 1', 0),
(10, 'esperando', 300.00, '2024-06-12', 'Melvin Lezama', 'Contado', 'Dónde fue la Texaco Guadalupe', 'Delivery', 50),
(11, 'esperando', 350.00, '2024-06-12', 'Melvin Lezama', 'Contado', 'Dónde fue la Texaco Guadalupe', 'Delivery', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_orderdetail`
--

CREATE TABLE `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_orderdetail`
--

INSERT INTO `tbl_orderdetail` (`orderID`, `orderDetailID`, `itemID`, `quantity`) VALUES
(1, 361, 60, 1),
(2, 362, 65, 1),
(1, 363, 56, 1),
(4, 364, 66, 1),
(5, 365, 60, 1),
(6, 366, 65, 1),
(6, 367, 59, 1),
(6, 368, 60, 1),
(6, 369, 56, 1),
(7, 370, 67, 1),
(8, 371, 56, 1),
(9, 372, 60, 1),
(9, 373, 58, 1),
(10, 374, 56, 5),
(11, 375, 55, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_role`
--

INSERT INTO `tbl_role` (`role`) VALUES
('chef'),
('Mesero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staffID` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tbl_staff`
--

INSERT INTO `tbl_staff` (`staffID`, `username`, `password`, `status`, `role`) VALUES
(19, 'Joel', '1234', 'Offline', 'chef'),
(20, 'Lismarling ', '12345', 'Offline', 'Mesero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_table`
--

CREATE TABLE `tbl_table` (
  `id` int(20) NOT NULL,
  `nombre_table` varchar(20) NOT NULL,
  `capacidad` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_table`
--

INSERT INTO `tbl_table` (`id`, `nombre_table`, `capacidad`) VALUES
(1, 'Mesa 1', 0),
(2, 'Mesa 2', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indices de la tabla `tbl_menuitem`
--
ALTER TABLE `tbl_menuitem`
  ADD PRIMARY KEY (`itemID`),
  ADD KEY `menuID` (`menuID`);

--
-- Indices de la tabla `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indices de la tabla `tbl_orderdetail`
--
ALTER TABLE `tbl_orderdetail`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD KEY `itemID` (`itemID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indices de la tabla `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staffID`);

--
-- Indices de la tabla `tbl_table`
--
ALTER TABLE `tbl_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tbl_menuitem`
--
ALTER TABLE `tbl_menuitem`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `tbl_orderdetail`
--
ALTER TABLE `tbl_orderdetail`
  MODIFY `orderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT de la tabla `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staffID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_table`
--
ALTER TABLE `tbl_table`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
