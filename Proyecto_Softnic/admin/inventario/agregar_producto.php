<?php
include('../../dbconnection.php'); // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $menuItemName = mysqli_real_escape_string($sqlconnection, $_POST['menuItemName']);
    $cantidad_disponible = mysqli_real_escape_string($sqlconnection, $_POST['cantidad_disponible']);
    $menuID = mysqli_real_escape_string($sqlconnection, $_POST['menuID']);

    // Consulta SQL para insertar el nuevo producto
    $query = "INSERT INTO tbl_menuitem (menuItemName, cantidad_disponible, menuID) 
              VALUES ('$menuItemName', '$cantidad_disponible', '$menuID')";

    // Ejecutar la consulta
    if ($sqlconnection->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $sqlconnection->error]);
    }
}

$sqlconnection->close(); // Cerrar la conexión
?>
