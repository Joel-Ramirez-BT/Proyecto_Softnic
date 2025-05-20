<?php
include('../config.php');

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha subido un archivo
if (isset($_FILES["backup_file"]) && $_FILES["backup_file"]["error"] == 0) {
    $file_tmp = $_FILES["backup_file"]["tmp_name"];
    $file_name = $_FILES["backup_file"]["name"];

    // Leer el contenido del archivo SQL
    $sql = file_get_contents($file_tmp);

    // Dividir las consultas por punto y coma para ejecutarlas una por una
    $queries = explode(";", $sql);

    $success = true;
    foreach ($queries as $query) {
        $query = trim($query);

        if (!empty($query)) {
            // Reemplazar valores vacíos '' por NULL para enteros y fechas
            // Esto es muy general. Puedes ajustarlo si deseas solo afectar ciertos campos
            $query = preg_replace("/''/", "NULL", $query);

            if (!$conn->query($query)) {
                echo "Error en la consulta:<br><code>$query</code><br><strong>" . $conn->error . "</strong><br>";
                $success = false;
                break;
            }
        }
    }

    if ($success) {
        echo "<center><br><h1 style='color:green;'>Backup restaurado con éxito.</h1></center>";
    } else {
        echo "<h3 style='color:red;'>Hubo un error al restaurar el backup.</h3>";
    }
} else {
    echo "<h3 style='color:red;'>No se ha subido ningún archivo.</h3>";
}

// Cerrar conexión
$conn->close();
?>
