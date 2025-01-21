<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "1234", "fosdb");

// Marcar todas las notificaciones como leídas
$sql = "UPDATE tbl_notificaciones SET leido = 1 WHERE leido = 0";
$conexion->query($sql);

echo json_encode(['success' => true]);
?>
