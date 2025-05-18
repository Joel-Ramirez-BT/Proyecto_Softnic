<?php 
	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "admin")
		header("Location: login.php");

	if (isset($_POST['addstaff'])) {
		if (!empty($_POST['staffname']) && !empty($_POST['staffrole'])) {
			$staffname = $sqlconnection->real_escape_string($_POST['staffname']);
			$staffpwd = $sqlconnection->real_escape_string($_POST['staffpwd']);
			$staffRole = $sqlconnection->real_escape_string($_POST['staffrole']);
            

			$addStaffQuery = "INSERT INTO tbl_staff (username,password ,status ,role) VALUES ('{$staffname}' ,'{$staffpwd}' ,'Offline' ,'1') ";

			if ($sqlconnection->query($addStaffQuery) === TRUE) {
					echo "se añadio correctamente";
					header("Location: staff.php"); 
					

				} 

				else {
					//handle
					echo "A ocurrido un error";
					echo $sqlconnection->error;
				}
		}
	}
?>