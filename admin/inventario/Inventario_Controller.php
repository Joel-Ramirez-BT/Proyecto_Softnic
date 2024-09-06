<?php
include ('../../dbconnection.php'); // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campo = $_POST["campo"];
    
    // Validar y escapar los datos para prevenir inyecciones SQL (ejemplo básico)
    //$condicion = mysqli_real_escape_string($conn, $condicion);

    // Construir la consulta SQL
    $consulta = "SELECT itemID as 'ID', menuItemName as 'Menu', cantidad_disponible as 'Cantidad Disponible'
    FROM tbl_menuitem $campo;";

    // Ejecutar la consulta
    $resultado = $sqlconnection->query($consulta);

    // Mostrar resultados en HTML
    if ($resultado) {
        if ($resultado->num_rows > 0) {
            echo "<br><h2>Resultados:</h2>";
            echo "<table border ='1'  class='table table-responsive table-bordered text-center'>";
            // Mostrar encabezados
            echo "<tr>";
            $encabezados = $resultado->fetch_fields();
            foreach ($encabezados as $encabezado) {
                echo "<th>{$encabezado->name}</th>"; //encabezado
                
            }
             echo "<th>Opciones</th>";
            echo "</tr>";

            // Mostrar datos
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach ($fila as $valor) {
                    echo "<td class='text-center'>{$valor}</td>";
                }
                echo "<td rowspan='' class='text-center'>
                <a href='#' class='btn btn-success'><i class='fas fa-regular fa-plus' style=''></i></a>
                <a href='#' class='btn btn-warning'><i class='fas fa-regular fa-edit' style=''></i></a>
                <a href='#' class='btn btn-danger'><i class='fas fa-regular fa-trash' style=''></i></a>";
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
