<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "1234", "fosdb");

// Obtener el número de notificaciones no leídas
$sql = "SELECT COUNT(*) as total_no_leidas FROM tbl_notificaciones WHERE leido = 0";
$resultado = $conexion->query($sql);
$total_no_leidas = $resultado->fetch_assoc()['total_no_leidas'];

echo json_encode(['total_no_leidas' => $total_no_leidas]);
?>
