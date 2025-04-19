<?php
// Incluye la conexión a la base de datos
require_once 'conexion.php';  // Asegúrate de que la conexión esté correctamente configurada

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura los datos del formulario
    $categoriaID = $_POST['categoria'];
    $productoID = $_POST['producto'];
    $fechaVencimiento = $_POST['fecha_vencimiento'];
    $cantidad = $_POST['cantidad'];

    // Valida que los datos sean correctos (puedes hacer validaciones adicionales si es necesario)
    if (empty($categoriaID) || empty($productoID) || empty($cantidad)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Inserta los datos en la base de datos
    $query = "INSERT INTO tbl_inventory (menuID, itemID, expirationDate, quantity) 
              VALUES (?, ?, ?, ?)";

    if ($stmt = $sqlconnection->prepare($query)) {
        // Vincula los parámetros
        $stmt->bind_param("isis", $categoriaID, $productoID, $fechaVencimiento, $cantidad);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "Datos ingresados correctamente.";
        } else {
            echo "Error al ingresar los datos: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $sqlconnection->error;
    }

    // Cierra la conexión
    $sqlconnection->close();
}
?>
