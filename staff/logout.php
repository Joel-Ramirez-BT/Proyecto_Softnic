<?php 
	include("../functions.php");

        if((isset($_SESSION['uid']) && isset($_SESSION['username']) && isset($_SESSION['user_level'])) )  {
            if($_SESSION['user_level'] == "staff" )
             {
                session_destroy();
                 header("Location: ../index.php");
            }
            else
                header("Location: login.php");
        }
    
        else
            header("Location: login.php");

?>