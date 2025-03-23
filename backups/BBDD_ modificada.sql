SET FOREIGN_KEY_CHECKS=0;

-- Tabla para administradores
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_admin` VALUES('0', 'admin', '$2y$10$hVelxAY.hBIWgi52H2axde/pn/oHi5ezO6C4vVTYoX6LqvVDXZnr6', 'admin@example.com', NOW());

-- Tabla para configuraciones del negocio
CREATE TABLE IF NOT EXISTS `tbl_configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_negocio` varchar(50) DEFAULT NULL,
  `nombre_pymes` varchar(50) DEFAULT NULL,
  `horario_apertura` time DEFAULT NULL,
  `horario_cierre` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_configuracion` VALUES('1', 'restaurante', 'Softnic', '08:00:00', '22:00:00');

-- Tabla para clientes
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_customer` VALUES('1', 'Joel Ramirez', 'Mina el Limón', '86764398', 'joel@example.com', NOW());
REPLACE INTO `tbl_customer` VALUES('2', 'Jaxira', 'San Jacinto', '87523946', 'jaxira@example.com', NOW());

-- Tabla para cuentas y deudas de clientes
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_cuentas` VALUES('5', '1', 'Compra de repuestos', '600.00', '500.00', '2025-03-10', 'pendiente', NOW(), NULL);
REPLACE INTO `tbl_cuentas` VALUES('6', '2', 'Reparación de equipo', '1200.00', '1200.00', '2025-02-25', 'pendiente', NOW(), NULL);

-- Tabla para menús
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(25) NOT NULL,
  `menu_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_menu` VALUES('28', 'Almuerzos ', '121fa95c8937feb7dc43a62ae3c38559.jpg');
REPLACE INTO `tbl_menu` VALUES('29', 'Bebidas', 'ea30418469c806cd97eab217d8dd2d5c.jpg');

-- Tabla para ítems del menú
CREATE TABLE IF NOT EXISTS `tbl_menuitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `cantidad_disponible` double DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `menuitem_imagen` varchar(600) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`itemID`),
  KEY `menuID` (`menuID`),
  CONSTRAINT `tbl_menuitem_ibfk_1` FOREIGN KEY (`menuID`) REFERENCES `tbl_menu` (`menuID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_menuitem` VALUES('76', '28', 'Pollo al vino', '19', '200.00', '', 'plato_principal');
REPLACE INTO `tbl_menuitem` VALUES('77', '29', 'Coca Cola 355 ml', '1', '40.00', '', 'bebida');

-- Tabla para notificaciones
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

REPLACE INTO `tbl_notificaciones` VALUES('1', 'Producto vencido', '1', NOW(), 1);

-- Tabla para pedidos
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` varchar(20) DEFAULT NULL,
  `forma_pago` varchar(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `servicio` varchar(20) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`orderID`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_admin` (`ID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_order` VALUES('1', 'esperando', '320.00', NOW(), 'Joel Ramirez', 'Contado', '', 'Delivery1', '50.00', 0);

-- Tabla para detalles de pedidos
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
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_orderdetail` VALUES('1', '457', '101', '1');
REPLACE INTO `tbl_orderdetail` VALUES('1', '458', '95', '1');

-- Tabla para pagos
CREATE TABLE IF NOT EXISTS `tbl_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `monto_pago` decimal(10,2) NOT NULL,
  `fecha_pago` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `metodo_pago` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `tbl_pagos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla para roles
CREATE TABLE IF NOT EXISTS `tbl_role` (
  `roleID` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`roleID`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_role` VALUES('1', 'chef');
REPLACE INTO `tbl_role` VALUES('2', 'Mesero');

-- Tabla para personal
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

REPLACE INTO `tbl_staff` VALUES('23', 'Joel', '1234', 'Online', 2, 'joel@example.com', '2025-01-01');
REPLACE INTO `tbl_staff` VALUES('28', 'Jaxira', '1234', 'Offline', 1, 'jaxira@example.com', '2025-01-01');

-- Tabla para mesas
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