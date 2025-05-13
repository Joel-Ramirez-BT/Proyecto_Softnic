<?php
include('../../dbconnection.php'); // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y sanitizar datos del formulario
    $categoriaID = isset($_POST['categoria']) ? intval($_POST['categoria']) : 0;
    $productoID = isset($_POST['producto']) ? intval($_POST['producto']) : 0;
    $fechaVencimiento = isset($_POST['fecha_vencimiento']) ? $_POST['fecha_vencimiento'] : null;
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;

    if ($categoriaID > 0 && $productoID > 0 && $cantidad > 0) {
        // Preparar la consulta segura (evitando inyección SQL)
        $query = "UPDATE tbl_menuitem 
                  SET cantidad_disponible = cantidad_disponible + ?, 
                      fecha_vencimiento = ? 
                  WHERE itemID = ?";

        if ($stmt = $sqlconnection->prepare($query)) {
            $stmt->bind_param("isi", $cantidad, $fechaVencimiento, $productoID);

            if ($stmt->execute()) {
                // Redirigir con éxito
                header("Location: agregar_producto.php?success=1");
                exit();
            } else {
                // Error al ejecutar
                echo "Error al actualizar el producto: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $sqlconnection->error;
        }
    } else {
        echo "Datos inválidos. Verifica el formulario.";
    }
} else {
    echo "Método no permitido.";
}
?>
