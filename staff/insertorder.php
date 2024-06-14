<?php
	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && !isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

		if ($_SESSION['user_level'] != "staff")
		 {
			header("Location: login.php");
			exit(); // Es buena práctica usar exit() después de header() para detener la ejecución del script.
		}
		

	if (isset($_POST['sentorder'])) {
		

		if (isset($_POST['itemID']) && isset($_POST['itemqty'])) {

			$arrItemID = $_POST['itemID'];
			$arrItemQty = $_POST['itemqty'];

             

			
			//comprobar que el par de la matriz tenga el mismo número de elemento
			if (count($arrItemID) == count($arrItemQty)) {				
				$arrlength = count($arrItemID);

				//añadir nuevo id
				$currentOrderID = getLastID("orderID","tbl_order") + 1;
           
				//llamada a la funcion insertar order
				insertOrderQuery($currentOrderID,$nombre,$direccion,$servicio,$costo);

				for ($i=0; $i < $arrlength; $i++) { 

					//llamada a la funcion insertorderdetail
					insertOrderDetailQuery($currentOrderID,$arrItemID[$i] ,$arrItemQty[$i]);
				}

				updateTotal($currentOrderID);

				//Al completar la orden situar en: 
				header("Location: facturar.php");
				exit();
			}

			else {
				echo "xD";
			}
		}	
	}

	function insertOrderDetailQuery($orderID,$itemID,$quantity) {


         
		   



		global $sqlconnection;
		$addOrderQuery = "INSERT INTO tbl_orderdetail (orderID ,itemID ,quantity) VALUES ('{$orderID}', '{$itemID}' , '{$quantity}')";


		if ($sqlconnection->query($addOrderQuery) === TRUE) {
				echo "Insertado correctamente.";
			} 

		else {
				//handle
				echo "A ocurrido un error";
				echo $sqlconnection->error;

		}
	}

	function insertOrderQuery($orderID,$nombre,$direccion,$servicio,$costo) {



		$nombre = ($_POST['nombrec']);
		$pago =($_POST['forma_pago']);
		$direccion =($_POST['direccion']); 
		$servicio =($_POST['servicio']); 
		$costo =($_POST['costo']); 
		
		$conexion= mysqli_connect('localhost','root','','fosdb');


		global $sqlconnection;
		$addOrderQuery = "INSERT INTO tbl_order (orderID ,status ,order_date, nombre,forma_pago,direccion, servicio, costo) VALUES ('{$orderID}' ,'esperando' ,CURDATE(),'$nombre','$pago', '$direccion', '$servicio','$costo' )";

		if ($sqlconnection->query($addOrderQuery) === TRUE) {
				echo "inserted.";
			} 

		else {
				//handle
				echo "someting wong";
				echo $sqlconnection->error;

		}
	}

?>
