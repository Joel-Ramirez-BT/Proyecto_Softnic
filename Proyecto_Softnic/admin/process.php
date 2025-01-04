<?php 
include("../functions.php");

// Checkeando usuario y contraseña
if (isset($_POST['username']) && isset($_POST['password'])) {

    // Prevenir una inyección SQL con caracteres especiales
    $username = $sqlconnection->real_escape_string($_POST['username']);
    $password = $sqlconnection->real_escape_string($_POST['password']);

    // Consulta SQL para obtener el registro del usuario
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username'";

    if ($result = $sqlconnection->query($sql)) {

        if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            // Obtener el hash de la contraseña almacenada en la base de datos
            $hashed_password = $row['password'];

            // Verificar la contraseña ingresada contra el hash almacenado
            if (password_verify($password, $hashed_password)) {
                // La contraseña es correcta
                $uid = $row['ID'];
                $_SESSION['uid'] = $uid;
                $_SESSION['username'] = $username;
                $_SESSION['user_level'] = "admin";

                echo "correcto";
            } else {
                echo "Usuario o contraseña incorrecta";
            }
        } else {
            echo "Usuario o contraseña incorrecta";
        }

    } else {
        echo "Error en la consulta: " . $sqlconnection->error;
    }
}
?>
