<?php
include_once('../config.php');

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener las tablas de la base de datos
$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

$backup_sql = "";
foreach ($tables as $table) {
    // Obtener estructura de la tabla
    $result = $conn->query("SHOW CREATE TABLE $table");
    $row = $result->fetch_assoc();
    $backup_sql .= "\n\n" . $row['IF NOT EXISTS Create Table'] . ";\n\n";

    // Obtener datos de la tabla
    $result = $conn->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $backup_sql .= "REPLACE INTO $table VALUES(";
        $values = [];
        foreach ($row as $value) {
            $values[] = "'" . $conn->real_escape_string($value) . "'";
        }
        $backup_sql .= implode(", ", $values) . ");\n";
    }
    $backup_sql .= "\n\n";
}
$folder_path = "./../backups/"; 

if (!file_exists($folder_path)) {
    mkdir($folder_path, 0777, true); // Crea la carpeta con permisos adecuados
}

$file_name = "backup_" . date("Y-m-d_H-i-s") . ".sql";

file_put_contents($file_name, $backup_sql);

// Descargar el archivo
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
readfile($file_name);

// Cerrar conexión
$conn->close();
exit;
?>
