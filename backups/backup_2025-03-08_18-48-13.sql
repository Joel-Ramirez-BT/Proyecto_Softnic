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

REPLACE INTO `tbl_customer` VALUES('1', 'Joel Ramirez', 'Mina el Limón', '86764398', '2025-02-14');
REPLACE INTO `tbl_customer` VALUES('2', 'Jaxira', 'San Jacinto', '87523946', '2025-02-09');
REPLACE INTO `tbl_customer` VALUES('4', 'Porfirio Ramirez', 'Santa pancha', '', '2025-02-14');
REPLACE INTO `tbl_customer` VALUES('5', 'Carlos Mayorga', 'Leon', '', '2025-02-14');
REPLACE INTO `tbl_customer` VALUES('6', 'Luis alcantara', 'Malpaisillo', '', '2025-02-14');




CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(25) NOT NULL,
  `menu_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_menu` VALUES('40', 'Cena', 'c5b3f99e15f926fe3b5c1e1ba32d777e.jpg');
REPLACE INTO `tbl_menu` VALUES('41', 'Extras', '4d5498d597943624156b7b65e83d9753.jpg');




CREATE TABLE IF NOT EXISTS `tbl_menuitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `cantidad_disponible` double DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `menuitem_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`itemID`),
  KEY `menuID` (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_menuitem` VALUES('109', '40', 'Pollo al vino', '', '150.00', '');
REPLACE INTO `tbl_menuitem` VALUES('110', '40', 'Pollo en salsa', '', '150.00', '');
REPLACE INTO `tbl_menuitem` VALUES('111', '41', 'Papas fritas', '', '60.00', '');




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

REPLACE INTO `tbl_order` VALUES('3', 'esperando', '150.00', '2025-03-08', 'Joel Ramirez', 'Contado', 'Mina el Limon', 'Delivery3', '50.00');
REPLACE INTO `tbl_order` VALUES('4', 'esperando', '150.00', '2025-03-08', 'Joel Ramirez', 'Contado', 'Mina el Limon', 'Delivery4', '50.00');




CREATE TABLE IF NOT EXISTS `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`orderDetailID`),
  KEY `itemID` (`itemID`),
  KEY `orderID` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=466 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_orderdetail` VALUES('3', '464', '109', '1');
REPLACE INTO `tbl_orderdetail` VALUES('4', '465', '109', '1');




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

REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');
REPLACE INTO `tbl_role` VALUES('chef');
REPLACE INTO `tbl_role` VALUES('Mesero');




CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `staffID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`staffID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_staff` VALUES('23', 'Joel', '1234', 'Offline', 'Mesero');
REPLACE INTO `tbl_staff` VALUES('28', 'Jaxira', '1234', 'Offline', 'chef');




CREATE TABLE IF NOT EXISTS `tbl_table` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre_table` varchar(20) NOT NULL,
  `capacidad` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_table` VALUES('1', 'Mesa 1', '5');


SET FOREIGN_KEY_CHECKS=1;

