<?php
// Incluye la conexión a la base de datos
require_once '../../dbconnection.php';  // Asegúrate de que la conexión esté correctamente configurada

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoriaID = $_POST['categoria'];
    $productoID = $_POST['producto'];
    $fechaVencimiento = $_POST['fecha_vencimiento'];
    $cantidad = $_POST['cantidad'];

    if (empty($categoriaID) || empty($productoID) || empty($cantidad)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $query = "UPDATE tbl_menuItem 
              SET cantidad_disponible = cantidad_disponible + $cantidad, 
                  fecha_vencimiento = '$fechaVencimiento' 
              WHERE menuItemname = '$productoID'";

    if ($sqlconnection->query($query)) {
        echo "Datos ingresados correctamente.";
    } else {
        echo "Error al ingresar los datos: " . $sqlconnection->error;
    }

    $sqlconnection->close();
}
?>
