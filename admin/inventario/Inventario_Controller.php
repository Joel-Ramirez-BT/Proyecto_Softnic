<?php
include ('../../dbconnection.php'); // Incluye el archivo de conexión
include("./addmodal.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campo = $_POST["campo"];
    
    
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
                   // Botones de acción
            $itemID = $fila['ID']; // Tomar el ID del elemento
            echo "<td class='text-center'>
                 <button class='btn btn-success' data-toggle='modal' data-target='#addModal' data-id='123'><i class='fas fa-plus'></i>
                 <button class='btn btn-warning' data-toggle='modal' data-target='#editModal' data-id='{$itemID}'><i class='fas fa-edit'></i></button>
                </td>";
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