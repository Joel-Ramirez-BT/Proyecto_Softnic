<?php

if (!file_exists("../functions.php")) {
    die("Error: No se encontró el archivo functions.php");
  }
  include("../functions.php");
  
  
  if (!isset($_SESSION['uid']) || !isset($_SESSION['username']) || !isset($_SESSION['user_level'])) {
      header("Location: login.php");
      exit();
  }
  
  if ($_SESSION['user_level'] != "admin") {
      header("Location: login.php");
      exit();
  }

include_once('../config.php');

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener las tablas de la base de datos
$tables = [];
$result = $conn->query("SHOW TABLES");
if ($result) {
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }
}

$backup_sql = "SET FOREIGN_KEY_CHECKS=0;\n\n"; // Desactivar claves foráneas para evitar problemas al restaurar

foreach ($tables as $table) {
    // Obtener estructura de la tabla con IF NOT EXISTS
    $result = $conn->query("SHOW CREATE TABLE `$table`");
    if ($result) {
        $row = $result->fetch_assoc();
        $create_table_sql = $row['Create Table'];
        $create_table_sql = preg_replace('/^CREATE TABLE/', 'CREATE TABLE IF NOT EXISTS', $create_table_sql);
        $backup_sql .= "\n\n" . $create_table_sql . ";\n\n";
    }

    // Obtener datos de la tabla
    $result = $conn->query("SELECT * FROM `$table`");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $values = array_map(function ($value) use ($conn) {
                return "'" . $conn->real_escape_string($value) . "'";
            }, array_values($row));
            $backup_sql .= "REPLACE INTO `$table` VALUES(" . implode(", ", $values) . ");\n";
        }
        $backup_sql .= "\n\n";
    }
}

$backup_sql .= "SET FOREIGN_KEY_CHECKS=1;\n\n"; // Reactivar claves foráneas

// Crear directorio de backups si no existe
$backup_dir = "../backups/";
if (!is_dir($backup_dir)) {
    mkdir($backup_dir, 0777, true);
}

// Guardar en un archivo
$file_name = $backup_dir . "backup_" . date("Y-m-d_H-i-s") . ".sql";
file_put_contents($file_name, $backup_sql);

// Descargar el archivo
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
readfile($file_name);

// Cerrar conexión y salir
$conn->close();
exit;
?>
