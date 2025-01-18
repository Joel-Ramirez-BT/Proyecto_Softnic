<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia esto según tu configuración
$username = "root"; // Cambia esto según tu configuración
$password = "1234"; // Cambia esto según tu configuración
$dbname = "fosdb"; // Cambia esto según tu configuración

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$id_restaurante = $_POST['id_restaurante'];

// Preparar y ejecutar la consulta
$sql = "UPDATE tbl_configuracion SET nombre_pymes = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nombre, $id_restaurante);

if ($stmt->execute()) {
    echo "Nombre del restaurante actualizado correctamente.";
    header("Location: configuration.php");
} else {
    echo "Error al actualizar el nombre: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>