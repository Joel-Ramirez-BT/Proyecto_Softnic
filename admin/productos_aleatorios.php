<?php
include('../dbconnection.php'); // Conexión a la base de datos

// Obtener todos los menuID válidos de tbl_menu
$menuIDs = [];
$result = $sqlconnection->query("SELECT menuID FROM tbl_menu");

while ($row = $result->fetch_assoc()) {
    $menuIDs[] = $row['menuID'];
}

if (empty($menuIDs)) {
    die("No hay categorías en tbl_menu. Debes crear categorías primero.");
}

// Función para generar nombres de productos aleatorios
function generarNombreProducto($indice) {
    $nombres = ["Coca-Cola", "Pepsi", "Sprite", "Fanta", "Jugo", "Agua", "Galletas", "Papas", "Chocolate", "Leche", "Café", "Té", "Pan", "Queso", "Yogurt", "Salsa", "Aceite", "Azúcar", "Sal", "Arroz"];
    $sufijo = rand(100, 999);
    return $nombres[array_rand($nombres)] . " #" . $sufijo . "-" . $indice;
}

// Insertar 100 productos aleatorios
for ($i = 1; $i <= 100; $i++) {
    $menuID = $menuIDs[array_rand($menuIDs)]; // Seleccionar un menuID válido
    $itemName = generarNombreProducto($i);
    $itemPrice = rand(10, 500);

    $query = "INSERT INTO tbl_menuitem (menuID, menuItemName, price) VALUES (?, ?, ?)";
    $stmt = $sqlconnection->prepare($query);

    if ($stmt) {
        $stmt->bind_param("isi", $menuID, $itemName, $itemPrice);
        if ($stmt->execute()) {
            echo "Producto #$i insertado correctamente: $itemName ($itemPrice)<br>";
        } else {
            echo "Error al insertar el producto #$i: " . $stmt->error . "<br>";
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $sqlconnection->error;
    }
}
?>
