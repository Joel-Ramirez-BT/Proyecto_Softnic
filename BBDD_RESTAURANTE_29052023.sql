-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2023 a las 22:07:55
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID`, `username`, `password`) VALUES
(0, 'admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_menuitem`
--

INSERT INTO `tbl_menuitem` (`itemID`, `menuID`, `menuItemName`, `price`) VALUES
(55, 16, 'Gallo pinto', '60.00'),
(56, 16, 'Maduros con queso', '60.00'),
(57, 17, 'Jalapeño', '120.00'),
(58, 17, 'Pollo frito', '120.00'),
(59, 18, 'Gaseosa', '20.00'),
(60, 18, 'Jugo de naranga', '30.00'),
(61, 17, 'sopa de mondongo', '150.00'),
(62, 17, 'sopa de res', '120.00'),
(63, 17, 'pollo en salsa', '200.00'),
(64, 17, 'amburguesas', '170.00'),
(65, 17, 'Churrasco de cerdo', '150.00'),
(66, 17, 'pollo a la plancha con adobado de res', '200.00'),
(67, 17, 'chilaquiles mexicanos', '130.00'),
(68, 17, 'Hamburguesa mar y tierra con papas', '130.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderID` int(11) NOT NULL,
  `status` text NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_order`
--

INSERT INTO `tbl_order` (`orderID`, `status`, `total`, `order_date`) VALUES
(1, 'waiting', '350.00', '2023-05-28'),
(2, 'waiting', '20.00', '2023-05-28'),
(3, 'waiting', '30.00', '2023-05-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_orderdetail`
--

CREATE TABLE `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `nombrec` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `servicio` varchar(20) DEFAULT NULL,
  `costo` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_orderdetail`
--

INSERT INTO `tbl_orderdetail` (`orderID`, `orderDetailID`, `itemID`, `quantity`, `nombrec`, `direccion`, `servicio`, `costo`) VALUES
(1, 136, 66, 1, '', '', 'Mesa #4', '0'),
(1, 137, 65, 1, '', '', 'Mesa #4', '0'),
(2, 140, 59, 1, '', '', 'Delivery', '0'),
(2, 141, 60, 1, NULL, NULL, NULL, NULL),
(3, 142, 60, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_staff`
--

INSERT INTO `tbl_staff` (`staffID`, `username`, `password`, `status`, `role`) VALUES
(1, 'Juan', '1234abcd..', 'Online', 'chef'),
(4, 'admin', '1234', 'Online', 'Mesero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_table`
--

CREATE TABLE `tbl_table` (
  `id` int(20) NOT NULL,
  `Nombre_table` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_table`
--

INSERT INTO `tbl_table` (`id`, `Nombre_table`) VALUES
(2, 'Mesa 1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `orderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT de la tabla `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staffID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_table`
--
ALTER TABLE `tbl_table`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
