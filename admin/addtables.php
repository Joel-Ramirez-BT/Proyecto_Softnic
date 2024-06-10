<?php
require("../config.php");
  
        
        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        
        // Verificar si se enviaron los datos por POST
        if (isset($_POST["nombre_table"])) {
            // Obtener los datos de la mesa desde el formulario
            $nombreMesa = $_POST["nombre_table"];
            $capacidad_mesa = $_POST["capacidad"];
        
            // Consulta SQL para insertar la mesa en la base de datos
            $sql = "INSERT INTO tbl_table (id,nombre_table,capacidad) VALUES ('','$nombreMesa','$capacidad_mesa')";
        
            if ($conn->query($sql) === TRUE) {
                echo "Mesa insertada correctamente.";
                
                header("Location: tables.php");
				exit();

            } else {

                
                header("Location: menu.php");
                echo "Error al insertar la mesa: " . $conn->error;
            }
        }
        
        // Cerrar la conexión
        $conn->close();
        ?>
        