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




CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `fecha_creacion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;





CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(25) NOT NULL,
  `menu_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_menu` VALUES('28', 'Almuerzos ', '121fa95c8937feb7dc43a62ae3c38559.jpg');
REPLACE INTO `tbl_menu` VALUES('29', 'Bebidas', 'ea30418469c806cd97eab217d8dd2d5c.jpg');
REPLACE INTO `tbl_menu` VALUES('31', 'Dsesayunos', '6881085449130f52514437f1bcd6d083.jpg');
REPLACE INTO `tbl_menu` VALUES('33', 'Granos Basicos', 'a3b833a5298f7412c93b8b9197b6ad7b.jpg');




CREATE TABLE IF NOT EXISTS `tbl_menuitem` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) NOT NULL,
  `menuItemName` text NOT NULL,
  `cantidad_disponible` double DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `menuitem_imagen` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`itemID`),
  KEY `menuID` (`menuID`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_menuitem` VALUES('76', '28', 'Pollo al vino', '20', '200.00', '');
REPLACE INTO `tbl_menuitem` VALUES('77', '29', 'Coca Cola 355 ml', '1', '40.00', '');
REPLACE INTO `tbl_menuitem` VALUES('78', '29', 'Jugo de naranga', '14', '20.00', '');
REPLACE INTO `tbl_menuitem` VALUES('80', '28', 'Pollo a la placha', '41', '130.00', '');
REPLACE INTO `tbl_menuitem` VALUES('81', '28', 'Deditos de pollo ', '8', '80.00', '');
REPLACE INTO `tbl_menuitem` VALUES('82', '28', 'Canelones ', '2', '150.00', '');
REPLACE INTO `tbl_menuitem` VALUES('83', '28', 'Pollo frito', '45', '80.00', '');
REPLACE INTO `tbl_menuitem` VALUES('84', '28', 'Salpicon ', '8', '85.00', '');
REPLACE INTO `tbl_menuitem` VALUES('85', '28', 'Carne desmenuzada ', '13', '100.00', '');
REPLACE INTO `tbl_menuitem` VALUES('86', '28', 'Asado de cerdo', '25', '180.00', '');
REPLACE INTO `tbl_menuitem` VALUES('87', '28', 'Asado de res', '56', '190.00', '');
REPLACE INTO `tbl_menuitem` VALUES('88', '28', 'Pollo con verduras ', '45', '95.00', '');
REPLACE INTO `tbl_menuitem` VALUES('90', '29', 'Fanta naranja ', '11', '40.00', '');
REPLACE INTO `tbl_menuitem` VALUES('91', '29', 'Rojita', '32', '40.00', '');
REPLACE INTO `tbl_menuitem` VALUES('93', '29', 'Ensalada de frutas', '52', '20.00', '');
REPLACE INTO `tbl_menuitem` VALUES('94', '31', 'Desayuno de campeón ', '53', '110.00', '');
REPLACE INTO `tbl_menuitem` VALUES('95', '31', 'Yogurt con granola ', '32', '100.00', '');
REPLACE INTO `tbl_menuitem` VALUES('96', '31', 'Huevos revueltos ', '32', '75.00', '');
REPLACE INTO `tbl_menuitem` VALUES('97', '31', 'Panini de pollo', '55', '200.00', '');
REPLACE INTO `tbl_menuitem` VALUES('98', '31', 'Pancakes', '12', '175.00', '');




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

REPLACE INTO `tbl_order` VALUES('1', 'listo', '220.00', '2025-02-07', 'Joel Ramirez', 'Contado', '', 'Delivery', '80.00');




CREATE TABLE IF NOT EXISTS `tbl_orderdetail` (
  `orderID` int(11) NOT NULL,
  `orderDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`orderDetailID`),
  KEY `itemID` (`itemID`),
  KEY `orderID` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=latin1;

REPLACE INTO `tbl_orderdetail` VALUES('1', '452', '94', '2');




CREATE TABLE IF NOT EXISTS `tbl_role` (
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

