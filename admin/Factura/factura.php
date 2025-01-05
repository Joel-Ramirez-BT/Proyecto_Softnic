<?php
require('./fpdf184/fpdf.php');
include ('../../dbconnection.php');

$conexion= $sqlconnection;
$consulta= "SELECT o.orderID, m.menuName, OD.itemID, MI.menuItemName, OD.quantity, O.status, mi.price, o.order_date 
            FROM tbl_order O 
            LEFT JOIN tbl_orderdetail OD ON O.orderID = OD.orderID 
            LEFT JOIN tbl_menuitem MI ON OD.itemID = MI.itemID 
            LEFT JOIN tbl_menu M ON MI.menuID = M.menuID 
            WHERE o.orderID='{$_GET["id"]}'";

// Resultado de la tabla 
$resultado = mysqli_query($conexion, $consulta);

// Consulta para mostrar el Id de la orden
$consulta_id = "SELECT orderID FROM tbl_order WHERE orderID='{$_GET["id"]}'";
$resultado_id = mysqli_query($conexion, $consulta_id);
$row_id = mysqli_fetch_array($resultado_id);

// Consulta para insertar la fecha
$consulta_fecha = "SELECT order_date FROM tbl_order WHERE orderID='{$_GET["id"]}'";
$resultado_fecha = mysqli_query($conexion, $consulta_fecha);
$row_fecha = mysqli_fetch_array($resultado_fecha);

$pdf = new FPDF('P', 'mm', array(80, 150));
$pdf->AddPage();

// CABECERA
$pdf->Image('../../image/logo.png', 25, 2, 30); // Ajusta la posición X e Y según necesites
$pdf->Ln(5); // Añadir espacio después de la imagen

// Información de la empresa
$pdf->SetFont('Helvetica', '', 12);
$pdf->SetFont('Helvetica', '', 8);
$pdf->Cell(0, 4, 'Donde fue la texaco Guadalupe 1c 1/2 abajo', 0, 1, 'C');
$pdf->Cell(0, 4, 'RUC: 281-240603-1002B', 0, 1, 'C');
$pdf->Cell(0, 4, 'Telf: 8577-2990 / 8611-3188', 0, 1, 'C');

// Consulta para los datos del cliente
$consulta_cliente = "SELECT nombre, forma_pago, direccion, servicio FROM tbl_order WHERE orderID='{$_GET["id"]}'";
$resultado_cliente = mysqli_query($conexion, $consulta_cliente);
$row_cliente = mysqli_fetch_array($resultado_cliente);

// DATOS FACTURA
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(60, 2, 'Servicio: '. substr($row_cliente['servicio'], 0, 8), 0, 1, 'C');
$pdf->Ln(2);
$pdf->Cell(60, 3, 'Factura numero: 00'.$row_id['orderID'], 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(60, 2, 'Forma de pago: '.$row_cliente['forma_pago'], 0, 1, '');
$pdf->Ln(1);
$pdf->Cell(60, 3, 'Fecha: '.$row_fecha['order_date'], 0, 1, '');
$pdf->Ln(1);
$pdf->Multicell(60, 3, utf8_decode('Cliente: '.$row_cliente['nombre']), 0, 1, '');
$pdf->Ln(1);
$pdf->MultiCell(55, 3, utf8_decode('Direccion: '.$row_cliente['direccion']), 0, 1, '');

// COLUMNAS
$pdf->Ln(3);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 4, utf8_decode('Descripción'), 0, 0, 'C', 1);
$pdf->Cell(15, 4, 'Cantidad', 0, 0, 'C', 1);
$pdf->Cell(18, 4, 'Precio x ud', 0, 1, 'C', 1);
$consulta_total = "SELECT total FROM tbl_order WHERE orderID ='{$_GET["id"]}'";
$resultado_total = mysqli_query($conexion, $consulta_total);
$row2 = mysqli_fetch_array($resultado_total);
$subtotal = $row2['total'];

// FILAS - Usando bucle for en lugar de while
$totalRows = mysqli_num_rows($resultado); // Número total de filas

$pdf->SetFont('Arial', '', 8);
// Bucle for para recorrer cada fila
for ($i = 0; $i < $totalRows; $i++) {
    $row = mysqli_fetch_array($resultado); // Obtiene la fila actual

    // Verificamos que no sea nula
    if ($row) {
        $originalString = $row['menuItemName'];
        $newString = substr($originalString, 0, 19); // Cortamos el texto para que no sea muy largo

        // Añadir los datos al PDF
        $pdf->Cell(26, 4, "*".utf8_decode($newString), 0, 0, 'C', 1);
        $pdf->Cell(15, 4, $row['quantity'], 0, 0, 'C', 1);

        // Obtener el precio del producto de la columna 'price' en la consulta
        $precio_unitario = $row['price'];  // Aquí usamos directamente el precio del producto

        // Mostrar el precio unitario formateado a 2 decimales
        $pdf->Cell(18, 4, number_format($precio_unitario, 2), 0, 1, 'C', 1);
    }
}
$consulta_costo = "SELECT costo FROM tbl_order WHERE orderID ='{$_GET["id"]}'";
$resultado_costo = mysqli_query($conexion, $consulta_costo);
$row3 = mysqli_fetch_array($resultado_costo);
$costo = $row3['costo'];

// Cálculo del total a pagar
$total = $subtotal + $costo;

// MOSTRAR TOTALES
$pdf->Ln(2);
$pdf->SetFont('Helvetica', '', 8);
$pdf->Cell(60, 4, '', 0, 1, '');
$pdf->Cell(60, 4, 'Subtotal =  C$ '.$subtotal, 0, 1, '');
$pdf->Ln(1);
$pdf->Cell(60, 2, 'Delivery =  C$ '.$costo, 0, 1, '');
$pdf->Ln(1);
$pdf->SetFont('Helvetica', '', 9);
$pdf->Cell(60, 4, 'Total a pagar =  C$ '.$total, 0, 1, '');
$pdf->Cell(60, 4, '', 0, 1, '');

// PIE DE PÁGINA
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(60, 2, 'GRACIAS POR SU COMPRA ', 0, 1, 'C');
$pdf->Ln(3);
$pdf->Cell(60, 0, 'LES ESPERAMOS NUEVAMENTE', 0, 1, 'C');

// Generar el PDF
$pdf->Output('Factura_#'.$row_id['orderID'].'.pdf', 'I'); // Muestra el PDF en el navegador
$file_path = './Facturas/Factura_#' . $row_id['orderID'] . '.pdf';

// Generar y guardar el PDF
$pdf->Output($file_path, 'F');
?>
