<?php
include '../dbconnection.php'; // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campo = $_POST["campo"];
    $fecha_inicio = $_POST["startdate"];
    $fecha_fin = $_POST["enddate"];

    // Validar y escapar los datos para prevenir inyecciones SQL (ejemplo básico)
    //$condicion = mysqli_real_escape_string($conn, $condicion);
  
    // Construir la consulta SQL
    $consulta = "SELECT * FROM tbl_order WHERE forma_pago = 'Credito';";
   
    // Ejecutar la consulta
    $resultado = $sqlconnection->query($consulta);

    // Mostrar resultados en HTML
    if ($resultado) {
        if ($resultado->num_rows > 0) {
            echo "<br><h2>Resultados:</h2>";
            echo "<table border ='1'  class='table table-responsive table-bordered'>";
            // Mostrar encabezados
            echo "<tr>";
            $encabezados = $resultado->fetch_fields();
            foreach ($encabezados as $encabezado) {
                echo "<th>{$encabezado->name}</th>";
            }
            echo "</tr>";

            // Mostrar datos
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach ($fila as $valor) {
                    echo "<td class='text-center'>{$valor}</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
    } else {
        echo "<p>Error en la consulta: " . $sqlconnection->error . "</p>";
    }
}

$sqlconnection->close(); // Cierra la conexión
?>
