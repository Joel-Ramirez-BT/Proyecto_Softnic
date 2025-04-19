<?php
include '../../dbconnection.php'; // tu archivo de conexión

if (isset($_GET['menuID'])) {
    $menuID = $_GET['menuID'];
  
    $query = "SELECT itemID, menuItemName FROM tbl_menuitem WHERE menuID = ?";
    $stmt = $sqlconnection->prepare($query);
    $stmt->bind_param("i", $menuID);
    $stmt->execute();
    $result = $stmt->get_result();
  
    $productos = [];
    while ($row = $result->fetch_assoc()) {
      $productos[] = $row;
    }
  
    header('Content-Type: application/json');
    echo json_encode($productos);
  }
  ?>