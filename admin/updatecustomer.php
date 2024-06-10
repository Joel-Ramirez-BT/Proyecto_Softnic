<?php
require("../config.php");
  
  $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar si se enviaron los datos por POST
        if (isset($_POST["agregar"])) {
            // Obtener los datos de la mesa desde el formulario
          $id_customer = $_POST['id'];  
         $nombre = $_POST['nombre'];
         $direccion = $_POST['direccion'];
         $telefono = $_POST['telefono'];
         $fecha_creacion = $_POST['fecha_creacion'];

            // Consulta SQL para insertar la mesa en la base de datos
            $sql = "UPDATE tbl_customer SET nombre = '$nombre', direccion='$direccion', telefono = '$telefono', fecha_creacion='$fecha_creacion' WHERE id = $id_customer";
        
            if ($conn->query($sql) === TRUE) {
                echo "Cliente insertado correctamente.";
                
                header("Location: customer.php");
				exit();

            } else {

                
                header("Location: facturar.php");
                echo "Error al insertar el cliente: ".$conn->error;
            }
        }
        
        // Cerrar la conexión
        $conn->close();
        ?>
        