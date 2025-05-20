<?php
require('./fpdf184/fpdf.php');
include ('../../dbconnection.php');

ob_start(); // Iniciar buffer de salida

$conexion = $sqlconnection;

// Consulta para obtener detalles
$consulta = "SELECT o.orderID, m.menuName, OD.itemID, MI.menuItemName, OD.quantity, O.status, mi.price, o.order_date 
            FROM tbl_order O 
            LEFT JOIN tbl_orderdetail OD ON O.orderID = OD.orderID 
            LEFT JOIN tbl_menuitem MI ON OD.itemID = MI.itemID 
            LEFT JOIN tbl_menu M ON MI.menuID = M.menuID 
            WHERE o.orderID='{$_GET["id"]}'";

$resultado = mysqli_query($conexion, $consulta);
$totalRows = mysqli_num_rows($resultado); // Número de productos

// Calcular altura dinámica (estimado: 5 mm por línea de producto + base)
$altoBase = 110; // Altura base para logo, cliente, totales, etc.
$altoExtra = $totalRows * 6; // 6 mm por línea (ajustable según tamaño de fuente)
$altoTotal = $altoBase + $altoExtra;

// Crear PDF con altura dinámica
$pdf = new FPDF('P', 'mm', array(80, $altoTotal));
$pdf->AddPage();

// CABECERA
$pdf->Image('../../image/logo.png', 25, 2, 30);
$pdf->Ln(5);
$pdf->SetFont('Helvetica', '', 8);
$pdf->Cell(0, 4, 'Donde fue la texaco Guadalupe 1c 1/2 abajo', 0, 1, 'C');
$pdf->Cell(0, 4, 'RUC: 00J3124005863', 0, 1, 'C');
$pdf->Cell(0, 4, 'Telf: 8577-2990 / 8611-3188', 0, 1, 'C');

// Datos del cliente
$consulta_cliente = "SELECT nombre, forma_pago, direccion, servicio FROM tbl_order WHERE orderID='{$_GET["id"]}'";
$cliente = mysqli_fetch_array(mysqli_query($conexion, $consulta_cliente));

$consulta_id = "SELECT orderID FROM tbl_order WHERE orderID='{$_GET["id"]}'";
$row_id = mysqli_fetch_array(mysqli_query($conexion, $consulta_id));

$consulta_fecha = "SELECT order_date FROM tbl_order WHERE orderID='{$_GET["id"]}'";
$row_fecha = mysqli_fetch_array(mysqli_query($conexion, $consulta_fecha));

$pdf->Ln(1);
$pdf->Cell(60, 2, 'Servicio: '. substr($cliente['servicio'], 0, 8), 0, 1, 'C');
$pdf->Ln(2);
$pdf->Cell(60, 3, 'Factura numero: 00'.$row_id['orderID'], 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(60, 2, 'Forma de pago: '.$cliente['forma_pago'], 0, 1, '');
$pdf->Ln(1);
$pdf->Cell(60, 3, 'Fecha: '.$row_fecha['order_date'], 0, 1, '');
$pdf->Ln(1);
$pdf->Multicell(60, 3, utf8_decode('Cliente: '.$cliente['nombre']), 0, 1, '');
$pdf->Ln(1);
$pdf->MultiCell(55, 3, utf8_decode('Direccion: '.$cliente['direccion']), 0, 1, '');

// Columnas
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 4, utf8_decode('Descripción'), 0, 0, 'C');
$pdf->Cell(15, 4, 'Cantidad', 0, 0, 'C');
$pdf->Cell(18, 4, 'Precio x ud', 0, 1, 'C');

// Detalles de productos
$pdf->SetFont('Arial', '', 8);
mysqli_data_seek($resultado, 0); // Reiniciar puntero de resultado
while ($row = mysqli_fetch_array($resultado)) {
    $item = substr($row['menuItemName'], 0, 19);
    $pdf->Cell(26, 4, "*".utf8_decode($item), 0, 0, 'C');
    $pdf->Cell(15, 4, $row['quantity'], 0, 0, 'C');
    $pdf->Cell(18, 4, number_format($row['price'], 2), 0, 1, 'C');
}

// Totales
$subtotal = mysqli_fetch_array(mysqli_query($conexion, "SELECT total FROM tbl_order WHERE orderID='{$_GET["id"]}'"))['total'];
$costo = mysqli_fetch_array(mysqli_query($conexion, "SELECT costo FROM tbl_order WHERE orderID='{$_GET["id"]}'"))['costo'];
$total = $subtotal + $costo;

$pdf->Ln(2);
$pdf->Cell(60, 4, 'Subtotal =  C$ '.$subtotal, 0, 1, '');
$pdf->Ln(1);
$pdf->Cell(60, 2, 'Delivery =  C$ '.$costo, 0, 1, '');
$pdf->Ln(1);
$pdf->SetFont('Helvetica', '', 9);
$pdf->Cell(60, 4, 'Total a pagar =  C$ '.$total, 0, 1, '');

// Footer
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(60, 2, 'GRACIAS POR SU COMPRA ', 0, 1, 'C');
$pdf->Ln(3);
$pdf->Cell(60, 0, 'LES ESPERAMOS NUEVAMENTE', 0, 1, 'C');

// Limpiar salida antes de enviar PDF
ob_end_clean();

// Mostrar en pantalla
$pdf->Output('Factura_#'.$row_id['orderID'].'.pdf', 'I');

// Guardar en servidor
$pdf->Output('./Facturas/Factura_#'.$row_id['orderID'].'.pdf', 'F');
?>
