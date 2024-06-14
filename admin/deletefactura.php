<?php // Configurar la conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "fosdb";

$mysqli = new mysqli($host, $user, $password, $dbname);
// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Preparar la consulta SQL DELETE
$query = "DELETE FROM tbl_order where orderID='{$_GET["id"]}'";

// Ejecutar la consulta
if ($mysqli->query($query) === TRUE) 
{
    $query = "DELETE FROM tbl_orderdetail where orderID='{$_GET["id"]}'";

    if ($mysqli->query($query) === TRUE)
    {

    header("Location: facturar.php"); 
    exit();

    echo "Se eliminaron todas las filas de la tabla correctamente";
    }
} else {
    echo "Error al eliminar todas las filas de la tabla: " . $mysqli->error;
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>