<?php
	
	require("config.php");

	// Create connection
	$sqlconnection = new mysqli($servername, $username, $password,$dbname);

	// Check connection
	if ($sqlconnection->connect_error) {
    	die("Conexion fallida: " . $sqlconnection->connect_error);
	}
	
?>