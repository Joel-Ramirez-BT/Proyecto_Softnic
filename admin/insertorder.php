<?php
	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && !isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

		if ($_SESSION['user_level'] != "admin")
		 {
			header("Location: login.php");
			 // Es buena práctica usar exit() después de header() para detener la ejecución del script.
		}
		
	if (isset($_POST['sentorder'])) {
		
		if (isset($_POST['itemID']) && isset($_POST['itemqty'])) {

            //recibe los datos del formulario
			$arrItemID = $_POST['itemID'];
			$arrItemQty = $_POST['itemqty'];

         //asigna los datos del formularios a las correspondientes variables   
		    $nombre = ($_POST['nombrec']);
		    $pago =($_POST['forma_pago']);
		    $direccion =($_POST['direccion']); 
		    $servicio =($_POST['servicio']); 
		    $costo =($_POST['costo']); 
		
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
                    update_inventario($arrItemID[$i], $arrItemQty[$i]);
                    

				}

				updateTotal($currentOrderID); //funcion actualizar el total
			

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

// Crear conexión y enviar la consulta de la orden
$addOrderQuery = "INSERT INTO tbl_orderdetail (orderID ,itemID ,quantity) VALUES ('{$orderID}', '{$itemID}' , '{$quantity}')";
mysqli_query($sqlconnection,$addOrderQuery);

	}

	function insertOrderQuery($orderID,$nombre,$direccion,$servicio,$costo) {
		global $sqlconnection;
		
		//Nos aseguramos de agregar un identificador al id
		if ($servicio == 'Delivery') {
			$servicio = $servicio . $orderID;
		}
//Nos aseguramos que se asigne un valor en costo
		if (empty($costo)) {
			$costo = 0;
		}
		
		
		//global $sqlconnection;
		$addOrderQuery = "INSERT INTO tbl_order (orderID ,status ,order_date, nombre,forma_pago,direccion, servicio, costo) VALUES ('{$orderID}' ,'esperando' ,CURDATE(),'$nombre','$pago', '$direccion', '$servicio','$costo' )";

       mysqli_query($sqlconnection,$addOrderQuery);
		}
	

		
?>
