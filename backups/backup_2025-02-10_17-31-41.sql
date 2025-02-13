SET FOREIGN_KEY_CHECKS=0;



CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `ID` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_admin` VALUES('0', 'admin', '$2y$10$hVelxAY.hBIWgi52H2axde/pn/oHi5ezO6C4vVTYoX6LqvVDXZnr6');




CREATE TABLE IF NOT EXISTS `tbl_configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_negocio` varchar(50) DEFAULT NULL,
  `nombre_pymes` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_configuracion` VALUES('1', 'restaurante', 'Softnic');




CREATE TABLE IF NOT EXISTS `tbl_cuentas` (
  `id_cuenta` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `monto_deuda` decimal(10,2) NOT NULL,
  `saldo_pendiente` decimal(10,2) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `estado` enum('pendiente','pagado','atrasado') DEFAULT 'pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_cuenta`) USING BTREE,
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `tbl_cuentas_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_cuentas` VALUES('5', '1', 'Compra de repuestos', '600.00', '500.00', '2025-03-10', 'pendiente', '2025-02-09 21:51:22');
REPLACE INTO `tbl_cuentas` VALUES('6', '2', 'Reparación de equipo', '1200.00', '1200.00', '2025-02-25', 'pendiente', '2025-02-09 21:51:22');




CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `fecha_creacion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_customer` VALUES('1', 'Joel Ramirez', 'Mina el Limón', '86764398', '2025-02-09');
REPLACE INTO `tbl_customer` VALUES('2', 'Jaxira', 'San Jacinto', '87523946', '2025-02-09');




CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(25) NOT NULL,
  `menu_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_menu` VALUES('35', 'Granos Basicos', '59b74b8cc795b3d505a674a1506f3946.jpg');
REPLACE INTO `tbl_menu` VALUES('37', 'Refrescos', '9e2af2f39ea1c9427e86a70e5aa8e19c.jpg');




CREATE TABLE IF NOT EXISTS `tbl_menuitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `cantidad_disponible` double DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `menuitem_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`itemID`),
  KEY `menuID` (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_menuitem` VALUES('101', '35', 'gaseosa', '', '20.00', '');




CREATE TABLE IF NOT EXISTS `tbl_notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(255) NOT NULL,
  `leido` tinyint(1) DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_notificaciones` VALUES('1', 'Producto vencido', '1', '2025-01-19 07:43:29');




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

REPLACE INTO `tbl_order` VALUES('1', 'esperando', '20.00', '2025-02-10', 'Joel Ramirez', 'Credito', '', 'Delivery1', '50.00');




CREATE TABLE IF NOT EXISTS `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`orderDetailID`),
  KEY `itemID` (`itemID`),
  KEY `orderID` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=454 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_orderdetail` VALUES('1', '453', '101', '1');




CREATE TABLE IF NOT EXISTS `tbl_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `monto_pago` decimal(10,2) NOT NULL,
  `fecha_pago` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `tbl_pagos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `tbl_customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `tbl_role` (
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `staffID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_staff` VALUES('23', 'Joel', '1234', 'Online', 'Mesero');
REPLACE INTO `tbl_staff` VALUES('28', 'Jaxira', '1234', 'Offline', 'chef');




CREATE TABLE IF NOT EXISTS `tbl_table` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre_table` varchar(20) NOT NULL,
  `capacidad` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_table` VALUES('1', 'Mesa 1', '5');
REPLACE INTO `tbl_table` VALUES('2', 'Mesa 2', '0');
REPLACE INTO `tbl_table` VALUES('3', 'Mesa 3', '0');
REPLACE INTO `tbl_table` VALUES('4', 'Mesa 4', '0');
REPLACE INTO `tbl_table` VALUES('5', 'Mesa 5', '0');
REPLACE INTO `tbl_table` VALUES('6', 'Mesa 6', '0');
REPLACE INTO `tbl_table` VALUES('7', 'Mesa 7', '0');
REPLACE INTO `tbl_table` VALUES('8', 'Mesa 8', '0');
REPLACE INTO `tbl_table` VALUES('9', 'Mesa 9', '0');
REPLACE INTO `tbl_table` VALUES('10', 'Mesa 10', '0');


SET FOREIGN_KEY_CHECKS=1;

