<?php
	include("../functions.php");

	if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
		header("Location: login.php");

	if($_SESSION['user_level'] != "staff")
		header("Location: login.php");

	if (isset($_POST['sentorder'])) {
		if (isset($_POST['itemID']) && isset($_POST['itemqty'])) {

			$arrItemID = $_POST['itemID'];
			$arrItemQty = $_POST['itemqty'];
            
             
			
			//comprobar que el par de la matriz tenga el mismo número de elemento
			if (count($arrItemID) == count($arrItemQty)) {				
				$arrlength = count($arrItemID);

				//añadir nuevo id
                $currentOrderID = $_POST['id'];

				//$currentOrderID = getLastID("orderID","tbl_order") + 1;

				//llamada a la funcion de insertar la orden
				//insertOrderQuery($currentOrderID);

				for ($i=0; $i < $arrlength; $i++) { 
					insertOrderDetailQuery($currentOrderID,$arrItemID[$i] ,$arrItemQty[$i], $nombre,$direccion,$servicio,$costo);
					update_inventario($arrItemID[$i], $arrItemQty[$i]);
				}

				updateTotal($currentOrderID);

				//completed insert current order
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
				echo "inserted.";
			} 

		else {
				//handle
				echo "someting wong";
				echo $sqlconnection->error;

		}
	}


	function insertOrderQuery($orderID) {
		global $sqlconnection;
		$addOrderQuery = "INSERT INTO tbl_order (orderID ,status ,order_date) VALUES ('{$orderID}' ,'waiting' ,CURDATE() )";

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
