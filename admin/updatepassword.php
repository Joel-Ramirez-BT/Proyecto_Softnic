<?php
// Establecer la conexión con la base de datos
require_once("../config.php");

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$id = $_POST['id'];
$username = $_POST['username'];
$password= $_POST['password'];

// Ejecutar la consulta de actualización
$sql = "UPDATE tbl_admin SET username='$username', password='$password' WHERE id = 0";

if ($conn->query($sql) === TRUE) 
{
 
    $mensaje = "Se cerrara la session";

    // Generar el código JavaScript que mostrará el alert
    $script = "<script type='text/javascript'>alert('$mensaje');</script>";

    // Imprimir el código JavaScript en el navegador
    echo $script;

    header("Location: logout.php");
    
    
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
