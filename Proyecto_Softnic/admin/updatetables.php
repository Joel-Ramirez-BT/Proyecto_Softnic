<?php
require("../config.php");
  
$conn = new mysqli($servername, $username, $password, $dbname);


// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$idMesa = $_POST['table_id'];
$nuevoEstado = $_POST['nombre_table'];
$nueva_capacidad=$_POST['capacidad'];

// Ejecutar la consulta de actualización
$sql = "UPDATE tbl_table SET nombre_table = '$nuevoEstado', capacidad='$nueva_capacidad' WHERE id = $idMesa";

if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado correctamente.";
    header("Location: tables.php");

    
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
