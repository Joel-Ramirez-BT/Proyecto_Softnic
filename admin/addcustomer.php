<?php
  require("../config.php");
  
  $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar si se enviaron los datos por POST
        if (isset($_POST["agregar"])) {
            // Obtener los datos de la mesa desde el formulario
         $nombre = $_POST['nombre_cliente'];
         $direccion = $_POST['direccion'];
         $telefono = $_POST['telefono'];
         $fecha_creacion = $_POST['fecha_creacion'];

            // Consulta SQL para insertar la mesa en la base de datos
            $sql = "INSERT INTO tbl_customer (id,nombre,direccion,telefono,fecha_creacion) VALUES ('','$nombre','$direccion','$telefono', CURDATE())";
        
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
        