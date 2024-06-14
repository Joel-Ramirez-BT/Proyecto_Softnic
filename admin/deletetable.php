<?php
require("../config.php");

// Establecer la conexión con la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


// Ejecutar la consulta de actualización
$sql = "DELETE FROM tbl_table  WHERE id ='{$_GET["id"]}' ";

if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado correctamente.";
    header("Location: tables.php");

    
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>