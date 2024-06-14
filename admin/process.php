<?php 
    include("../functions.php");

        //checkiando usuario y contraseña
        if (isset($_POST['username']) && isset($_POST['password'])) {

            //prevenir una injeccion sql con caracteres especiales
            $username = $sqlconnection->real_escape_string($_POST['username']);
            $password = $sqlconnection->real_escape_string($_POST['password']);

            //consulta sql
            $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password = '$password'";

            if ($result = $sqlconnection->query($sql)) {

                if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    
                    $uid = $row['ID'];
                    $username = $row['username'];

                    $_SESSION['uid'] = $uid;
                    $_SESSION['username'] = $username;
                    $_SESSION['user_level'] = "admin";

                    echo "correcto";
                }

                else {
                    echo "Usuario o contraseña incorrecta";
                }

            }

        }
      
?>