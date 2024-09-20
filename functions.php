<?php
	//Establecer conexion con la BBDD
	require("dbconnection.php");
	session_start();
	
	//insert user defined function here
	// TODO - dynamic query
	function getNumRowsQuery($query) {
		global $sqlconnection;
		if ($result = $sqlconnection->query($query))
			return $result->num_rows;
		else
			echo "Something wrong the query!";
	}

	function getFetchAssocQuery($query) {
		global $sqlconnection;
		if ($result = $sqlconnection->query($query)) {
			
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        		echo "\n", $row["itemID"], $row["menuID"], $row["menuItemName"], $row["price"];
    		}

    		//print_r($result);
			
			return ($result);
		}
		else
			echo "Something wrong the query!";
			echo $sqlconnection->error;
	}

	function getLastID($id,$table) {
		global $sqlconnection;

		$query = "SELECT MAX({$id}) AS {$id} from {$table} ";

		if ($result = $sqlconnection->query($query)) {
			
			$res = $result->fetch_array();

			//if currently no id in table
			if ($res[$id] == NULL)
				return 0;

			return $res[$id];
		}
		else {
			echo $sqlconnection->error;
			return null;
		}
	}

	function getCountID($idnum,$id,$table) {
		global $sqlconnection;

		$query = "SELECT COUNT({$id}) AS {$id} from {$table} WHERE {$id}={$idnum}";

		if ($result = $sqlconnection->query($query)) {
			
			$res = $result->fetch_array();

			//if currently no id in table
			if ($res[$id] == NULL)
				return 0;

			return $res[$id];
		}
		else {
			echo $sqlconnection->error;
			return null;
		}
	}

	function getSalesTotal($orderID) {
		global $sqlconnection;
		$total = null;

		$query = "SELECT total FROM tbl_order WHERE orderID = ".$orderID;

		if ($result = $sqlconnection->query($query)) {
		
			if ($res = $result->fetch_array()) {
				$total = $res[0];
				return $total;
			}

			return $total;
		}

		else {

			echo $sqlconnection->error;
			return null;

		}
	}

	function getSalesGrandTotal($duration) {
		global $sqlconnection;
		$total = 0;

		if ($duration == "ALLTIME") {
			$query = "
					SELECT SUM(total) as grandtotal
					FROM tbl_order
					";
		}

		else if ($duration == ("DAY" || "MONTH" || "WEEK")) {

			$query = "
					SELECT SUM(total) as grandtotal
					FROM tbl_order

					WHERE order_date > DATE_SUB(NOW(), INTERVAL 1 ".$duration.")
					";
		}

		else 
			return null;

		if ($result = $sqlconnection->query($query)) {
		
			while ($res = $result->fetch_array(MYSQLI_ASSOC)) {
				$total+=$res['grandtotal'];
			}

			return $total;
		}

		else {

			echo $sqlconnection->error;
			return null;

		}
	}

	function updateTotal($orderID) {
		global $sqlconnection;
	
		// Construir la consulta SQL
		$query = "
			UPDATE tbl_order o
			INNER JOIN (
				SELECT SUM(OD.quantity * MI.price) AS total
				FROM tbl_order O1
				LEFT JOIN tbl_orderdetail OD ON O1.orderID = OD.orderID
				LEFT JOIN tbl_menuitem MI ON OD.itemID = MI.itemID
				WHERE O1.orderID = $orderID
			) x ON o.orderID = $orderID
			SET o.total = x.total
			WHERE o.orderID = $orderID
		";
	
		// Ejecutar la consulta
		if ($sqlconnection->query($query) === TRUE) {
			echo "Actualizado correctamente.";
		} else {
			// Manejar error
			echo "Ha ocurrido un error: " . $sqlconnection->error;
		}
	}
	

  function addstaff($username,$pwd,$role){

	global $sqlconnection;

	$query = "INSERT INTO `tbl_staff` (`staffID`, `username`, `password`, `status`, `role`) VALUES (NULL, '$username', '$pwd', 'Online', '$role');";
			

		if ($sqlconnection->query($query) === TRUE) {
				echo "Empleado agregado sastifactoriamente ";
			} 

		else {
				//handle
				echo "A ocurrido un error cerca de la linea 89";
				echo $sqlconnection->error;

  }

  }

  function update_inventario($itemID, $quantity) {     
    global $sqlconnection;

    // Verificar que los valores no sean NULL o no válidos
    if ($itemID == NULL || $quantity == NULL) {
        echo "<script>alert('Error: itemID o quantity no pueden ser nulos.');</script>";
        return;
    }

    // Verificar si la cantidad disponible es mayor o igual a la cantidad solicitada
    $checkQuery = "SELECT cantidad_disponible FROM tbl_menuitem WHERE itemID = $itemID";
    $result = $sqlconnection->query($checkQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cantidad_disponible = $row['cantidad_disponible'];

        if ($cantidad_disponible > $quantity) {
            // Construir la consulta SQL para actualizar el inventario
            $query = "UPDATE tbl_menuitem SET cantidad_disponible = cantidad_disponible - $quantity WHERE itemID = $itemID";
            
            // Ejecutar la consulta
            if ($sqlconnection->query($query) === TRUE) {
                echo "Se ha actualizado el inventario correctamente";
            } else {
                // Si ocurre un error, mostrar el mensaje detallado
                echo "Ha ocurrido un error al actualizar el inventario";
            }
        } else {
            
            echo "producto insuficiente";
        }
    } else {
        echo "Error: No se encontró el artículo con el ID proporcionado";
    }
}


?>