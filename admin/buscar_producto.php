<?php
include("../dbconnection.php");

$busqueda = $_POST['busqueda'] ?? '';

$query = "SELECT * FROM tbl_menu WHERE menuName LIKE ? OR menuID = ?";
$stmt = $sqlconnection->prepare($query);
$like = '%' . $busqueda . '%';
$stmt->bind_param("ss", $like, $busqueda);
$stmt->execute();
$result = $stmt->get_result();

$counter = 0;
$html = "<tr>";
while ($menuRow = $result->fetch_assoc()) {
    if ($counter % 3 == 0 && $counter != 0) {
        $html .= "</tr><tr>";
    }

    $html .= "<td>
        <button class='_favorit' style='margin-bottom:4px; white-space: normal; background-color: #ffffff; color: #000;' onclick='displayItem(" . $menuRow['menuID'] . ")'>
            " . $menuRow['menuName'] . "
            <img src='../image/" . $menuRow['menu_imagen'] . "' alt='" . $menuRow['menu_imagen'] . "' style='width:100%; height:auto;'>
        </button>
      </td>";

    $counter++;
}
$html .= "</tr>";

echo $html;
$stmt->close();
