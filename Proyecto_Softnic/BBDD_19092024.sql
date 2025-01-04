-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.68-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para fosdb
CREATE DATABASE IF NOT EXISTS `fosdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fosdb`;

-- Volcando estructura para tabla fosdb.tbl_admin
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `ID` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fosdb.tbl_admin: ~1 rows (aproximadamente)
DELETE FROM `tbl_admin`;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` (`ID`, `username`, `password`) VALUES
	(0, 'Melvin', '1234');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;

-- Volcando estructura para tabla fosdb.tbl_customer
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `fecha_creacion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla fosdb.tbl_customer: ~3 rows (aproximadamente)
DELETE FROM `tbl_customer`;
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;
INSERT INTO `tbl_customer` (`id`, `nombre`, `direccion`, `telefono`, `fecha_creacion`) VALUES
	(16, 'Lismarling', 'Mina el limon', '86764398', '2024-08-24'),
	(17, 'Maykeliyn', 'Santa pancha', '', '2024-09-16'),
	(18, 'Joel', 'Donde fue la planta electrica 50 vrs al oeste', '', '2024-09-16');
/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;

-- Volcando estructura para tabla fosdb.tbl_menu
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(25) NOT NULL,
  `menu_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fosdb.tbl_menu: ~3 rows (aproximadamente)
DELETE FROM `tbl_menu`;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` (`menuID`, `menuName`, `menu_imagen`) VALUES
	(28, 'Almuerzos ', '121fa95c8937feb7dc43a62ae3c38559.jpg'),
	(29, 'Bebidas', 'ea30418469c806cd97eab217d8dd2d5c.jpg'),
	(30, 'Sopas', 'cfd6b90525f61016c251ee1c78560fba.jpg');
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;

-- Volcando estructura para tabla fosdb.tbl_menuitem
CREATE TABLE IF NOT EXISTS `tbl_menuitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `cantidad_disponible` double DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `menuitem_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`itemID`),
  KEY `menuID` (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fosdb.tbl_menuitem: ~3 rows (aproximadamente)
DELETE FROM `tbl_menuitem`;
/*!40000 ALTER TABLE `tbl_menuitem` DISABLE KEYS */;
INSERT INTO `tbl_menuitem` (`itemID`, `menuID`, `menuItemName`, `cantidad_disponible`, `price`, `menuitem_imagen`) VALUES
	(76, 28, 'Pollo al vino', 9, 120.00, NULL),
	(77, 29, 'Coca Cola 355 ml', 1, 15.00, NULL),
	(78, 29, 'Jugo de naranga', 0, 20.00, NULL);
/*!40000 ALTER TABLE `tbl_menuitem` ENABLE KEYS */;

-- Volcando estructura para tabla fosdb.tbl_order
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `orderID` int(11) NOT NULL,
  `status` text NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` date NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `forma_pago` varchar(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `servicio` varchar(20) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fosdb.tbl_order: ~6 rows (aproximadamente)
DELETE FROM `tbl_order`;
/*!40000 ALTER TABLE `tbl_order` DISABLE KEYS */;
INSERT INTO `tbl_order` (`orderID`, `status`, `total`, `order_date`, `nombre`, `forma_pago`, `direccion`, `servicio`, `costo`) VALUES
	(2, 'esperando', 120.00, '2024-09-19', '', 'Credito', '', 'Mesa 1', 0.00),
	(3, 'esperando', 20.00, '2024-09-19', 'Maykeliyn', 'Contado', 'Mina el limon', 'Delivery3', 0.00),
	(4, 'esperando', 120.00, '2024-09-19', '', 'Contado', '', 'Mesa 1', 0.00),
	(5, 'esperando', 260.00, '2024-09-19', '', 'Contado', '', 'Mesa 2', 0.00),
	(6, 'esperando', 120.00, '2024-09-19', '', 'Contado', '', 'Mesa 1', 0.00),
	(7, 'esperando', 120.00, '2024-09-19', '', 'Contado', '', 'Mesa 1', 0.00);
/*!40000 ALTER TABLE `tbl_order` ENABLE KEYS */;

-- Volcando estructura para tabla fosdb.tbl_orderdetail
CREATE TABLE IF NOT EXISTS `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`orderDetailID`),
  KEY `itemID` (`itemID`),
  KEY `orderID` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=425 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fosdb.tbl_orderdetail: ~8 rows (aproximadamente)
DELETE FROM `tbl_orderdetail`;
/*!40000 ALTER TABLE `tbl_orderdetail` DISABLE KEYS */;
INSERT INTO `tbl_orderdetail` (`orderID`, `orderDetailID`, `itemID`, `quantity`) VALUES
	(2, 415, 76, 1),
	(3, 416, 78, 1),
	(4, 417, 76, 1),
	(5, 418, 76, 1),
	(5, 419, 76, 1),
	(5, 420, 78, 1),
	(6, 421, 76, 1),
	(7, 422, 76, 1);
/*!40000 ALTER TABLE `tbl_orderdetail` ENABLE KEYS */;

-- Volcando estructura para tabla fosdb.tbl_role
CREATE TABLE IF NOT EXISTS `tbl_role` (
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fosdb.tbl_role: ~2 rows (aproximadamente)
DELETE FROM `tbl_role`;
/*!40000 ALTER TABLE `tbl_role` DISABLE KEYS */;
INSERT INTO `tbl_role` (`role`) VALUES
	('chef'),
	('Mesero');
/*!40000 ALTER TABLE `tbl_role` ENABLE KEYS */;

-- Volcando estructura para tabla fosdb.tbl_staff
CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `staffID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fosdb.tbl_staff: ~2 rows (aproximadamente)
DELETE FROM `tbl_staff`;
/*!40000 ALTER TABLE `tbl_staff` DISABLE KEYS */;
INSERT INTO `tbl_staff` (`staffID`, `username`, `password`, `status`, `role`) VALUES
	(23, 'Joel', '1234', 'Online', 'Mesero'),
	(24, 'lismarling ', '1234', 'Offline', 'Mesero');
/*!40000 ALTER TABLE `tbl_staff` ENABLE KEYS */;

-- Volcando estructura para tabla fosdb.tbl_table
CREATE TABLE IF NOT EXISTS `tbl_table` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre_table` varchar(20) NOT NULL,
  `capacidad` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla fosdb.tbl_table: ~10 rows (aproximadamente)
DELETE FROM `tbl_table`;
/*!40000 ALTER TABLE `tbl_table` DISABLE KEYS */;
INSERT INTO `tbl_table` (`id`, `nombre_table`, `capacidad`) VALUES
	(1, 'Mesa 1', 5),
	(2, 'Mesa 2', 0),
	(3, 'Mesa 3', 0),
	(4, 'Mesa 4', 0),
	(5, 'Mesa 5', 0),
	(6, 'Mesa 6', 0),
	(7, 'Mesa 7', 0),
	(8, 'Mesa 8', 0),
	(9, 'Mesa 9', 0),
	(10, 'Mesa 10', 0);
/*!40000 ALTER TABLE `tbl_table` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
