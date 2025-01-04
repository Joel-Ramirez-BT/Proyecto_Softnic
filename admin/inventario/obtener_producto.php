<?php
include('../../dbconnection.php'); // Incluye la conexión a la base de datos

if (isset($_GET['itemID'])) {
    $itemID = $_GET['itemID'];

    // Consulta SQL para obtener los detalles del producto
    $query = "SELECT * FROM tbl_menuitem WHERE itemID = '$itemID'";
    $result = $sqlconnection->query($query);

    if ($result->num_rows > 0) {
        // Obtener los datos del producto
        $producto = $result->fetch_assoc();
        echo json_encode($producto); // Devuelve los datos en formato JSON
    } else {
        echo json_encode(null); // Si no se encuentra el producto
    }
}

$sqlconnection->close(); // Cierra la conexión
?>
