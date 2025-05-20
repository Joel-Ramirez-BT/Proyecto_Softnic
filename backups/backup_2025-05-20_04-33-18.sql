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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

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
REPLACE INTO `tbl_cuentas` VALUES('20', '7', 'Cuenta inicial', '0.00', '0.00', '2025-05-12', 'pendiente', '2025-05-12 19:11:49', '');




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
REPLACE INTO `tbl_customer` VALUES('7', 'Mercedes Reyes ', 'Mina el limon', '86764398', '', '2025-05-12 00:00:00');




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
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_menuitem` VALUES('106', '43', 'Garrafon 5 Gl', '1029', '60.00', '', '2025-05-17');
REPLACE INTO `tbl_menuitem` VALUES('107', '43', 'Agua de 1 LT', '50', '20.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('108', '43', 'Agua de 600 ML', '50', '20.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('110', '44', 'Azúcar #329-1', '0', '12.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('111', '44', 'Jugo #154-2', '0', '141.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('112', '44', 'Yogurt #650-3', '0', '319.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('113', '43', 'Fanta #286-4', '0', '265.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('114', '44', 'Leche #532-5', '0', '125.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('115', '43', 'Papas #543-6', '0', '497.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('116', '43', 'Galletas #114-7', '0', '206.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('117', '43', 'Salsa #673-8', '0', '150.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('118', '44', 'Pepsi #396-9', '0', '253.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('119', '44', 'Café #682-10', '0', '188.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('120', '44', 'Sal #852-11', '0', '382.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('121', '43', 'Queso #416-12', '0', '283.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('122', '43', 'Coca-Cola #329-13', '0', '247.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('123', '43', 'Yogurt #920-14', '0', '119.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('124', '43', 'Galletas #451-15', '0', '375.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('125', '44', 'Chocolate #975-16', '0', '197.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('126', '44', 'Fanta #324-17', '0', '96.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('127', '43', 'Fanta #980-18', '0', '445.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('128', '44', 'Papas #923-19', '0', '236.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('129', '43', 'Azúcar #311-20', '0', '273.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('130', '44', 'Coca-Cola #377-21', '0', '129.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('131', '43', 'Sprite #757-22', '0', '163.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('132', '43', 'Pepsi #299-23', '0', '291.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('133', '44', 'Leche #189-24', '0', '421.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('134', '43', 'Pepsi #373-25', '0', '417.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('135', '43', 'Fanta #468-26', '0', '185.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('136', '43', 'Fanta #780-27', '0', '221.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('137', '43', 'Yogurt #978-28', '0', '304.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('138', '44', 'Sprite #543-29', '0', '143.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('139', '44', 'Chocolate #724-30', '0', '425.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('140', '43', 'Jugo #592-31', '0', '361.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('141', '44', 'Leche #815-32', '0', '111.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('142', '44', 'Leche #560-33', '0', '245.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('143', '44', 'Azúcar #977-34', '0', '499.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('144', '44', 'Yogurt #800-35', '0', '406.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('145', '43', 'Azúcar #741-36', '0', '256.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('146', '44', 'Fanta #601-37', '0', '308.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('147', '44', 'Azúcar #973-38', '0', '116.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('148', '43', 'Coca-Cola #196-39', '0', '49.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('149', '44', 'Té #528-40', '0', '444.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('150', '44', 'Aceite #248-41', '0', '472.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('151', '43', 'Queso #945-42', '0', '268.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('152', '44', 'Pepsi #933-43', '0', '170.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('153', '44', 'Leche #678-44', '0', '221.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('154', '44', 'Leche #739-45', '0', '387.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('155', '43', 'Café #434-46', '0', '440.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('156', '43', 'Leche #517-47', '0', '438.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('157', '44', 'Jugo #163-48', '0', '372.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('158', '44', 'Pepsi #512-49', '0', '321.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('159', '43', 'Chocolate #922-50', '0', '194.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('160', '43', 'Arroz #961-51', '0', '242.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('161', '43', 'Pepsi #546-52', '0', '318.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('162', '44', 'Café #831-53', '0', '52.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('163', '44', 'Sprite #298-54', '0', '134.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('164', '43', 'Coca-Cola #292-55', '0', '69.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('165', '44', 'Sprite #753-56', '0', '63.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('166', '44', 'Café #806-57', '0', '105.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('167', '43', 'Jugo #931-58', '0', '36.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('168', '44', 'Sprite #148-59', '0', '492.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('169', '44', 'Jugo #496-60', '0', '279.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('170', '44', 'Té #483-61', '0', '202.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('171', '43', 'Galletas #889-62', '0', '264.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('172', '44', 'Sal #674-63', '0', '404.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('173', '44', 'Sprite #338-64', '0', '441.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('174', '44', 'Yogurt #679-65', '50', '318.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('175', '44', 'Jugo #788-66', '0', '207.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('176', '44', 'Jugo #174-67', '0', '186.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('177', '43', 'Jugo #295-68', '0', '496.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('178', '44', 'Fanta #895-69', '0', '441.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('179', '43', 'Sal #171-70', '0', '33.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('180', '44', 'Yogurt #989-71', '0', '458.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('181', '44', 'Chocolate #600-72', '0', '467.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('182', '43', 'Yogurt #578-73', '0', '395.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('183', '43', 'Chocolate #923-74', '0', '266.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('184', '43', 'Agua #827-75', '0', '356.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('185', '43', 'Té #933-76', '0', '75.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('186', '44', 'Queso #485-77', '0', '49.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('187', '44', 'Chocolate #793-78', '0', '301.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('188', '44', 'Té #522-79', '0', '63.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('189', '43', 'Pan #379-80', '0', '51.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('190', '44', 'Coca-Cola #316-81', '0', '377.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('191', '44', 'Café #367-82', '0', '478.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('192', '44', 'Pan #164-83', '0', '484.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('193', '44', 'Sprite #279-84', '0', '225.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('194', '44', 'Queso #360-85', '0', '266.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('195', '44', 'Café #401-86', '0', '212.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('196', '44', 'Papas #299-87', '0', '182.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('197', '44', 'Queso #949-88', '0', '439.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('198', '43', 'Queso #992-89', '0', '56.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('199', '44', 'Salsa #407-90', '0', '456.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('200', '43', 'Papas #162-91', '0', '215.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('201', '44', 'Salsa #140-92', '0', '385.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('202', '43', 'Agua #470-93', '0', '465.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('203', '43', 'Coca-Cola #516-94', '0', '487.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('204', '44', 'Salsa #867-95', '0', '75.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('205', '44', 'Chocolate #403-96', '0', '59.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('206', '43', 'Coca-Cola #241-97', '0', '371.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('207', '44', 'Aceite #599-98', '0', '408.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('208', '44', 'Papas #941-99', '0', '193.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('209', '43', 'Leche #478-100', '0', '347.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('210', '44', 'Café #779-1', '0', '375.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('211', '43', 'Té #992-2', '0', '301.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('212', '43', 'Leche #990-3', '0', '449.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('213', '44', 'Sal #878-4', '0', '447.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('214', '44', 'Fanta #365-5', '0', '200.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('215', '43', 'Chocolate #712-6', '0', '295.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('216', '44', 'Salsa #195-7', '0', '148.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('217', '43', 'Sal #393-8', '0', '303.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('218', '44', 'Salsa #616-9', '0', '376.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('219', '43', 'Sprite #816-10', '0', '358.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('220', '43', 'Coca-Cola #149-11', '0', '16.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('221', '43', 'Té #950-12', '0', '146.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('222', '44', 'Queso #443-13', '0', '244.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('223', '43', 'Pepsi #911-14', '0', '393.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('224', '44', 'Azúcar #531-15', '0', '250.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('225', '44', 'Sal #960-16', '0', '24.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('226', '43', 'Coca-Cola #524-17', '0', '156.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('227', '43', 'Agua #264-18', '0', '420.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('228', '43', 'Azúcar #165-19', '0', '320.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('229', '44', 'Fanta #130-20', '0', '146.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('230', '43', 'Papas #589-21', '0', '233.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('231', '43', 'Agua #610-22', '0', '436.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('232', '43', 'Queso #500-23', '0', '489.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('233', '44', 'Arroz #354-24', '0', '148.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('234', '43', 'Leche #908-25', '0', '143.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('235', '44', 'Arroz #319-26', '0', '83.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('236', '44', 'Té #592-27', '0', '130.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('237', '43', 'Salsa #351-28', '0', '123.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('238', '43', 'Arroz #267-29', '0', '452.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('239', '43', 'Coca-Cola #689-30', '0', '149.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('240', '43', 'Té #986-31', '0', '221.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('241', '43', 'Coca-Cola #130-32', '0', '342.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('242', '44', 'Papas #691-33', '0', '351.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('243', '43', 'Yogurt #609-34', '0', '38.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('244', '44', 'Azúcar #537-35', '0', '122.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('245', '43', 'Yogurt #209-36', '0', '131.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('246', '44', 'Sal #361-37', '0', '72.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('247', '44', 'Pepsi #184-38', '0', '23.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('248', '44', 'Sal #710-39', '0', '63.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('249', '43', 'Jugo #461-40', '0', '233.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('250', '44', 'Yogurt #635-41', '0', '176.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('251', '43', 'Pan #610-42', '0', '80.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('252', '43', 'Coca-Cola #750-43', '0', '157.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('253', '44', 'Galletas #127-44', '0', '330.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('254', '44', 'Sal #761-45', '0', '399.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('255', '43', 'Té #582-46', '0', '422.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('256', '43', 'Pepsi #695-47', '0', '247.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('257', '44', 'Yogurt #681-48', '0', '123.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('258', '44', 'Galletas #807-49', '0', '191.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('259', '44', 'Leche #425-50', '0', '486.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('260', '43', 'Queso #948-51', '0', '271.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('261', '44', 'Salsa #321-52', '0', '211.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('262', '44', 'Galletas #296-53', '0', '47.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('263', '43', 'Café #697-54', '0', '234.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('264', '43', 'Yogurt #799-55', '0', '241.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('265', '44', 'Queso #312-56', '0', '26.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('266', '44', 'Sprite #750-57', '0', '346.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('267', '43', 'Azúcar #693-58', '0', '138.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('268', '44', 'Sal #796-59', '0', '254.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('269', '44', 'Pepsi #497-60', '0', '256.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('270', '43', 'Galletas #175-61', '0', '121.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('271', '43', 'Coca-Cola #299-62', '0', '104.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('272', '43', 'Agua #607-63', '0', '498.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('273', '44', 'Pepsi #890-64', '0', '347.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('274', '44', 'Arroz #395-65', '0', '276.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('275', '43', 'Té #601-66', '0', '462.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('276', '44', 'Coca-Cola #901-67', '0', '31.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('277', '43', 'Galletas #289-68', '0', '204.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('278', '44', 'Queso #431-69', '0', '377.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('279', '43', 'Queso #137-70', '0', '286.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('280', '43', 'Salsa #847-71', '0', '176.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('281', '44', 'Té #876-72', '0', '319.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('282', '43', 'Pepsi #462-73', '0', '366.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('283', '44', 'Yogurt #132-74', '0', '31.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('284', '44', 'Chocolate #801-75', '0', '216.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('285', '43', 'Té #210-76', '0', '409.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('286', '44', 'Sal #555-77', '0', '194.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('287', '44', 'Salsa #232-78', '0', '177.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('288', '44', 'Jugo #580-79', '0', '308.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('289', '44', 'Galletas #116-80', '0', '297.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('290', '44', 'Azúcar #159-81', '0', '458.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('291', '44', 'Aceite #810-82', '0', '317.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('292', '44', 'Agua #822-83', '0', '140.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('293', '44', 'Coca-Cola #557-84', '0', '178.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('294', '44', 'Azúcar #259-85', '0', '237.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('295', '44', 'Azúcar #419-86', '0', '221.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('296', '43', 'Pepsi #963-87', '0', '212.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('297', '43', 'Queso #440-88', '0', '238.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('298', '43', 'Azúcar #500-89', '0', '40.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('299', '43', 'Sprite #545-90', '0', '422.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('300', '44', 'Azúcar #551-91', '0', '263.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('301', '44', 'Papas #218-92', '0', '108.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('302', '44', 'Arroz #229-93', '0', '297.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('303', '44', 'Arroz #576-94', '0', '89.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('304', '43', 'Jugo #500-95', '0', '231.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('305', '43', 'Sprite #958-96', '0', '113.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('306', '43', 'Leche #556-97', '0', '314.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('307', '43', 'Arroz #699-98', '0', '370.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('308', '43', 'Agua #200-99', '0', '392.00', '', '');
REPLACE INTO `tbl_menuitem` VALUES('309', '43', 'Yogurt #215-100', '0', '439.00', '', '');




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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_order` VALUES('2', 'esperando', '2700.00', '2025-05-12 00:00:00', '', 'Contado', '', 'Mesa 1', '0.00', '');
REPLACE INTO `tbl_order` VALUES('3', 'esperando', '200.00', '2025-05-12 00:00:00', '6 Severo Martinez', 'Contado', '', 'Delivery3', '50.00', '');
REPLACE INTO `tbl_order` VALUES('4', 'esperando', '615.00', '2025-05-12 00:00:00', '7 Mercedes Reyes ', 'Credito', '', 'Mesa 1', '0.00', '');
REPLACE INTO `tbl_order` VALUES('5', 'esperando', '1000.00', '2025-05-12 00:00:00', '1 Joel Ramirez', 'Contado', '', 'Delivery5', '50.00', '');
REPLACE INTO `tbl_order` VALUES('6', 'esperando', '2100.00', '2025-05-12 00:00:00', '3 Rosa Martinez', 'Contado', '', 'Mesa 1', '0.00', '');
REPLACE INTO `tbl_order` VALUES('7', 'esperando', '60.00', '2025-05-18 00:00:00', '', 'Contado', '', 'Mesa 1', '0.00', '');
REPLACE INTO `tbl_order` VALUES('8', 'esperando', '180.00', '2025-05-18 00:00:00', '7 Mercedes Reyes ', 'Contado', '', 'Caja 1', '0.00', '');
REPLACE INTO `tbl_order` VALUES('9', 'esperando', '120.00', '2025-05-18 00:00:00', '7 Mercedes Reyes ', 'Credito', 'Mina el limon', 'Caja 1', '0.00', '');
REPLACE INTO `tbl_order` VALUES('10', 'esperando', '472.00', '2025-05-18 00:00:00', '6 Severo Martinez', 'Contado', 'Mina el limon', 'Caja 1', '0.00', '');
REPLACE INTO `tbl_order` VALUES('11', 'esperando', '1455.00', '2025-05-18 00:00:00', '1 Joel Ramirez', 'Credito', '', 'Caja 1', '0.00', '');




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
) ENGINE=InnoDB AUTO_INCREMENT=506 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_orderdetail` VALUES('2', '469', '106', '45');
REPLACE INTO `tbl_orderdetail` VALUES('3', '470', '107', '10');
REPLACE INTO `tbl_orderdetail` VALUES('4', '472', '106', '9');
REPLACE INTO `tbl_orderdetail` VALUES('4', '473', '108', '1');
REPLACE INTO `tbl_orderdetail` VALUES('4', '474', '106', '1');
REPLACE INTO `tbl_orderdetail` VALUES('5', '475', '107', '50');
REPLACE INTO `tbl_orderdetail` VALUES('6', '476', '106', '35');
REPLACE INTO `tbl_orderdetail` VALUES('7', '477', '106', '1');
REPLACE INTO `tbl_orderdetail` VALUES('8', '478', '106', '3');
REPLACE INTO `tbl_orderdetail` VALUES('9', '479', '110', '10');
REPLACE INTO `tbl_orderdetail` VALUES('10', '480', '150', '1');
REPLACE INTO `tbl_orderdetail` VALUES('11', '481', '150', '1');
REPLACE INTO `tbl_orderdetail` VALUES('11', '484', '180', '1');
REPLACE INTO `tbl_orderdetail` VALUES('11', '504', '202', '1');
REPLACE INTO `tbl_orderdetail` VALUES('11', '505', '110', '5');




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





CREATE TABLE IF NOT EXISTS `tbl_table` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre_table` varchar(20) NOT NULL,
  `capacidad` int(10) DEFAULT NULL,
  `estado` enum('libre','ocupada') DEFAULT 'libre',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

REPLACE INTO `tbl_table` VALUES('1', 'Caja 1', '5', 'libre');
REPLACE INTO `tbl_table` VALUES('2', 'Caja 2', '0', 'libre');


SET FOREIGN_KEY_CHECKS=1;

