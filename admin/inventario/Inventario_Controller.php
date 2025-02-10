<?php
include ('../../dbconnection.php'); // Incluye el archivo de conexión


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campo = isset($_POST["campo"]) ? $_POST["campo"] : "";


    // Número de elementos por página
    $elementosPorPagina = 10;

    // Obtener el número de la página actual desde la URL (si existe)
    if (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) {
        $paginaActual = $_GET['pagina'];
    } else {
        $paginaActual = 1; // Página por defecto es la 1
    }

    // Calcular el inicio de los resultados para la consulta SQL
    $inicio = ($paginaActual - 1) * $elementosPorPagina;

    // Contar el número total de filas
    $consultaTotal = "SELECT COUNT(*) AS total FROM tbl_menuitem";
    $resultadoTotal = $sqlconnection->query($consultaTotal);
    $filaTotal = $resultadoTotal->fetch_assoc();
    $totalFilas = $filaTotal['total'];

    // Calcular el número total de páginas
    $totalPaginas = ceil($totalFilas / $elementosPorPagina);

    // Construir la consulta SQL con LIMIT para la paginación
    $consulta = "SELECT itemID as 'ID', menuItemName as 'Menu', cantidad_disponible as 'Cantidad Disponible'
    FROM tbl_menuitem $campo
    LIMIT $inicio, $elementosPorPagina;";

    // Ejecutar la consulta
    $resultado = $sqlconnection->query($consulta);

    // Mostrar resultados en HTML
    if ($resultado) {
        if ($resultado->num_rows > 0) {
            echo "<br><h2>Resultados:</h2>";
            echo "<table border='1' class='table table-responsive table-bordered text-center'>";
            
            // Mostrar encabezados
            echo "<tr>";
            $encabezados = $resultado->fetch_fields();
            foreach ($encabezados as $encabezado) {
                echo "<th>{$encabezado->name}</th>"; // Encabezado
            }
            //echo "<th>Opciones</th>";
            echo "</tr>";

            // Mostrar datos
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                foreach ($fila as $valor) {
                    echo "<td class='text-center'>{$valor}</td>";
                }

                // Botones de acción
                $itemID = $fila['ID']; // Tomar el ID del elemento
                /* echo "<td class='text-center'>
                        <button class='btn btn-success' data-toggle='modal' data-target='#addModal' data-id='{$itemID}'><i class='fas fa-plus'></i></button>
                        <button class='btn btn-warning' data-toggle='modal' data-target='#editModal' data-id='{$itemID}'><i class='fas fa-edit'></i></button>
                      </td>";
                echo "</tr>"; */
            }
            echo "</table>";

            // Navegación de paginación
            echo "<div class='pagination'>";
            if ($paginaActual > 1) {
                echo "<a href='?pagina=" . ($paginaActual - 1) . "'> Anterior </a>";
            }

            for ($i = 1; $i <= $totalPaginas; $i++) {
                echo "<a href='?pagina=$i'>$i</a>";
            }

            if ($paginaActual < $totalPaginas) {
                echo "<a href='?pagina=" . ($paginaActual + 1) . "'> Siguiente</a>";
            }
            echo "</div>";

        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
    } else {
        echo "<p>Error en la consulta: " . $sqlconnection->error . "</p>";
    }
}

$sqlconnection->close(); // Cierra la conexión
?>
