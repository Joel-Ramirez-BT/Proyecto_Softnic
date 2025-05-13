SET FOREIGN_KEY_CHECKS=0;



CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_admin` VALUES('3', 'admin', '$2y$10$hVelxAY.hBIWgi52H2axde/pn/oHi5ezO6C4vVTYoX6LqvVDXZnr6', 'admin@example.com', '2025-05-11 08:36:29');




CREATE TABLE IF NOT EXISTS `tbl_configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_negocio` varchar(50) DEFAULT NULL,
  `nombre_pymes` varchar(50) DEFAULT NULL,
  `horario_apertura` time DEFAULT NULL,
  `horario_cierre` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_configuracion` VALUES('1', 'restaurante', 'EL DORADO S.A', '08:00:00', '22:00:00');




CREATE TABLE IF NOT EXISTS `tbl_cuentas` (
  `id_cuenta` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `monto_deuda` decimal(10,2) NOT NULL,
  `saldo_pendiente` decimal(10,2) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `estado` enum('pendiente','pagado','atrasado') DEFAULT 'pendiente',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_ultimo_pago` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cuenta`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `tbl_cuentas_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_cuentas` VALUES('5', '1', 'Compra de repuestos', '600.00', '500.00', '2025-03-10', 'pendiente', '2025-05-11 08:36:29', '');
REPLACE INTO `tbl_cuentas` VALUES('6', '2', 'Reparación de equipo', '1200.00', '1200.00', '2025-02-25', 'pendiente', '2025-05-11 08:36:29', '');
REPLACE INTO `tbl_cuentas` VALUES('12', '1', 'Cuenta inicial', '0.00', '0.00', '2025-04-19', 'pendiente', '2025-04-19 22:39:07', '');
REPLACE INTO `tbl_cuentas` VALUES('13', '2', 'Cuenta inicial', '0.00', '0.00', '2025-04-19', 'pendiente', '2025-04-19 22:39:07', '');
REPLACE INTO `tbl_cuentas` VALUES('14', '3', 'Cuenta inicial', '0.00', '0.00', '2025-04-19', 'pendiente', '2025-04-19 22:39:07', '');
REPLACE INTO `tbl_cuentas` VALUES('15', '4', 'Cuenta inicial', '0.00', '0.00', '2025-04-19', 'pendiente', '2025-04-19 22:39:07', '');
REPLACE INTO `tbl_cuentas` VALUES('16', '5', 'Cuenta inicial', '0.00', '0.00', '2025-04-19', 'pendiente', '2025-04-19 22:39:07', '');
REPLACE INTO `tbl_cuentas` VALUES('17', '1', 'Cuenta inicial', '0.00', '0.00', '2025-05-11', 'pendiente', '2025-05-11 08:36:29', '');
REPLACE INTO `tbl_cuentas` VALUES('18', '2', 'Cuenta inicial', '0.00', '0.00', '2025-05-11', 'pendiente', '2025-05-11 08:36:29', '');
REPLACE INTO `tbl_cuentas` VALUES('19', '6', 'Cuenta inicial', '1000.00', '1000.00', '2025-05-12', 'pendiente', '2025-05-12 18:57:26', '');




CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_customer` VALUES('1', 'Joel Ramirez', 'Mina el Limón', '86764398', 'joel@example.com', '2025-05-11 08:36:29');
REPLACE INTO `tbl_customer` VALUES('2', 'Jaxira', 'San Jacinto', '87523946', 'jaxira@example.com', '2025-05-11 08:36:29');
REPLACE INTO `tbl_customer` VALUES('3', 'Rosa Martinez', 'Mina el limon', '86764398', '', '2025-03-23 00:00:00');
REPLACE INTO `tbl_customer` VALUES('4', 'Joel Ramirez', 'Mina el Limón', '87155404', '', '2025-03-23 00:00:00');
REPLACE INTO `tbl_customer` VALUES('5', 'Porfirio Ramirez', 'Mina santa pancha', '86764398', '', '2025-03-23 00:00:00');
REPLACE INTO `tbl_customer` VALUES('6', 'Severo Martinez', 'El dorado', '86764398', '', '2025-05-12 00:00:00');




CREATE TABLE IF NOT EXISTS `tbl_inventory` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `menuID` int(10) NOT NULL,
  `itemID` int(10) NOT NULL,
  `expirationDate` varchar(10) DEFAULT NULL,
  `quantity` int(10) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menuID` (`menuID`),
  KEY `itemID` (`itemID`),
  CONSTRAINT `tbl_inventory_ibfk_1` FOREIGN KEY (`menuID`) REFERENCES `tbl_menu` (`menuID`),
  CONSTRAINT `tbl_inventory_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `tbl_menuitem` (`itemID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_inventory` VALUES('1', '43', '106', '2025', '0000000050');
REPLACE INTO `tbl_inventory` VALUES('2', '43', '106', '2025', '0000000050');
REPLACE INTO `tbl_inventory` VALUES('3', '43', '106', '0', '0000000050');
REPLACE INTO `tbl_inventory` VALUES('4', '43', '106', '2025', '0000000050');




CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(25) NOT NULL,
  `menu_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_menu` VALUES('43', 'Productos de agua', '315f62b1a2208881e3d05abd514e58e8.jpg');
REPLACE INTO `tbl_menu` VALUES('44', 'Comisariato', '8603be7d3dacaa3a56c1e162fe19dfd6.jpg');




CREATE TABLE IF NOT EXISTS `tbl_menuitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `cantidad_disponible` double unsigned NOT NULL DEFAULT 0,
  `price` decimal(15,2) NOT NULL,
  `menuitem_imagen` varchar(600) DEFAULT NULL,
  `fecha_vencimiento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`itemID`),
  KEY `menuID` (`menuID`),
  CONSTRAINT `tbl_menuitem_ibfk_1` FOREIGN KEY (`menuID`) REFERENCES `tbl_menu` (`menuID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_menuitem` VALUES('106', '43', 'Garrafon 5 Gl', '5', '60.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('107', '43', 'Agua de 1 LT', '0', '20.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('108', '43', 'Agua de 600 ML', '0', '15.00', '', '');




CREATE TABLE IF NOT EXISTS `tbl_notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(255) NOT NULL,
  `leido` tinyint(1) DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tbl_notificaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_admin` (`ID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_notificaciones` VALUES('1', 'Producto vencido', '1', '2025-05-11 08:36:29', '1');




CREATE TABLE IF NOT EXISTS `tbl_order` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `nombre` varchar(20) DEFAULT NULL,
  `forma_pago` varchar(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `servicio` varchar(20) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`orderID`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_admin` (`ID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_order` VALUES('2', 'esperando', '2700.00', '2025-05-12 00:00:00', '', 'Contado', '', 'Mesa 1', '0.00', '');
REPLACE INTO `tbl_order` VALUES('3', 'esperando', '200.00', '2025-05-12 00:00:00', '6 Severo Martinez', 'Contado', '', 'Delivery3', '50.00', '');
REPLACE INTO `tbl_order` VALUES('4', 'esperando', '300.00', '2025-05-12 00:00:00', '6 Severo Martinez', 'Credito', '', 'Delivery4', '50.00', '');




CREATE TABLE IF NOT EXISTS `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`orderDetailID`),
  KEY `itemID` (`itemID`),
  KEY `orderID` (`orderID`),
  CONSTRAINT `tbl_orderdetail_ibfk_1` FOREIGN KEY (`itemID`) REFERENCES `tbl_menuitem` (`itemID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_orderdetail_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `tbl_order` (`orderID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=472 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_orderdetail` VALUES('2', '469', '106', '45');
REPLACE INTO `tbl_orderdetail` VALUES('3', '470', '107', '10');
REPLACE INTO `tbl_orderdetail` VALUES('4', '471', '106', '5');




CREATE TABLE IF NOT EXISTS `tbl_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `monto_pago` decimal(10,2) NOT NULL,
  `fecha_pago` datetime NOT NULL DEFAULT current_timestamp(),
  `metodo_pago` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `tbl_pagos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `tbl_role` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`roleID`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_role` VALUES('1', 'chef');
REPLACE INTO `tbl_role` VALUES('2', 'Mesero');




CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `staffID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `roleID` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_contratacion` date DEFAULT NULL,
  PRIMARY KEY (`staffID`),
  KEY `roleID` (`roleID`),
  CONSTRAINT `tbl_staff_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `tbl_role` (`roleID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_staff` VALUES('23', 'Joel', '1234', 'Online', '2', 'joel@example.com', '2025-01-01');
REPLACE INTO `tbl_staff` VALUES('28', 'Jaxira', '1234', 'Offline', '1', 'jaxira@example.com', '2025-01-01');




CREATE TABLE IF NOT EXISTS `tbl_table` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre_table` varchar(20) NOT NULL,
  `capacidad` int(10) DEFAULT NULL,
  `estado` enum('libre','ocupada') DEFAULT 'libre',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_table` VALUES('1', 'Mesa 1', '5', 'libre');
REPLACE INTO `tbl_table` VALUES('2', 'Mesa 2', '0', 'libre');


SET FOREIGN_KEY_CHECKS=1;

