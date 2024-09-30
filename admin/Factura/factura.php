<?php
require('./fpdf184/fpdf.php');
include ('../../dbconnection.php');

$conexion= $sqlconnection;
$consulta= "SELECT o.orderID, m.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,mi.price ,o.order_date FROM tbl_order O LEFT JOIN tbl_orderdetail OD ON O.orderID = OD.orderID LEFT JOIN tbl_menuitem MI ON OD.itemID = MI.itemID LEFT JOIN tbl_menu M ON MI.menuID = M.menuID where o.orderID='{$_GET["id"]}'";

//resultado de la tabla 
$resultado = mysqli_query($conexion,$consulta);

//consulta para mostrar el Id de la orden
$consulta_id= "SELECT orderID FROM tbl_order WHERE orderID='{$_GET["id"]}'";
$resultado_id= mysqli_query($conexion,$consulta_id);
$row_id=mysqli_fetch_array($resultado_id);

//Segunda consulta para insertar la fecha. Nota: en la misma marca datos erroneos
$consulta_fecha= "SELECT order_date FROM tbl_order WHERE orderID='{$_GET["id"]}'";
$resultado_fecha= mysqli_query($conexion,$consulta_fecha);
$row_fecha=mysqli_fetch_array($resultado_fecha);

//define('EURO',chr(128)); // Constante con el símbolo Euro.
$pdf = new FPDF('P','mm',array(80, 150));

$pdf->AddPage();
// CABECERA
$pdf->Image('../../image/logo.png', 25, -1, 30); // Ajusta la posición X e Y según necesites

// Añadir espacio después de la imagen
$pdf->Ln(15); // Aumenta el valor si es necesario para crear más espacio

// CABECERA
$pdf->SetFont('Helvetica','',12);
//$pdf->Cell(60,4,'Casa D Watta',0,1,'C'); // Si ya tienes el logo, no necesitas este texto
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(0,4,'Donde fue la texaco Guadalupe 1c 1/2 abajo',0,1,'C');
$pdf->Cell(0,4,'RUC: 281-190284-0002M',0,1,'C');
$pdf->Cell(0,4,'Telf: 8577-2990 / 8611-3188',0,1,'C'); 
 //Consulta para los datos del cliente
$consulta_cliente = "SELECT nombre,forma_pago, direccion, servicio from tbl_order where orderID='{$_GET["id"]}'";
$resultado_cliente = mysqli_query($conexion,$consulta_cliente);
$row_cliente=mysqli_fetch_array($resultado_cliente);

// DATOS FACTURA        
{
$pdf->Ln(1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(60,2,'Servicio: '. substr($row_cliente['servicio'],0,8),0,1,'C'); //cortamos el texto para que no aparezca el identificador
$pdf->Ln(2);
$pdf->Cell(60,3,'Factura numero: 00'.$row_id['orderID'],0,1,'C');
$pdf->Ln(1);
$pdf->Cell(60,2,'Forma de pago: '.$row_cliente['forma_pago'],0,1,'');
$pdf->Ln(1);
$pdf->Cell(60,3,'Fecha: '.$row_fecha['order_date'],0,1,'');
$pdf->Ln(1);
$pdf->Multicell(60,3,utf8_decode('Cliente: '.$row_cliente['nombre']),0,1,'');
$pdf->Ln(1);
$pdf->MultiCell(55,3,utf8_decode('Direccion: '.$row_cliente['direccion']),0,1,'');

} 
// COLUMNAS
$pdf->Ln(3);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(25,4,utf8_decode('Descripción'),0,0,'C',1);
$pdf->Cell(15,4,'Cantidad',0,0,'C',1);
$pdf->Cell(18,4,'Precio x ud',0,1,'C',1);

//Filas
$pdf->SetFont('Arial','',8);
while($row = mysqli_fetch_array($resultado))
{	 
    $originalString = $row['menuItemName'];
    $newString = substr($originalString, 0, 19); // "Cortar el texto "
    
$pdf->Cell(26,4,"*".utf8_decode($newString),0,0,'C',1);
$pdf->Cell(15,4,$row['quantity'],0,0,'C',1);
$pdf->Cell(18,4,$row['price'],0,1,'C',1);
}

//Consulta para el total
$consulta_total= "SELECT total FROM tbl_order WHERE orderID ='{$_GET["id"]}'";
$resultado_total= mysqli_query($conexion,$consulta_total);
$row2= mysqli_fetch_array($resultado_total);
$subtotal = $row2['total']; 

$consulta_costo ="SELECT costo FROM tbl_order WHERE orderID ='{$_GET["id"]}'";
$resultado_costo= mysqli_query($conexion,$consulta_costo);
$row3= mysqli_fetch_array($resultado_costo);
$costo= $row3['costo'];

$total = $subtotal + $costo; 
{
$pdf->Ln(2);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(60,4,'',0,1,'');
$pdf->Cell(60,4,'Subtotal =  C$ '.$subtotal,0,1,'');
$pdf->Ln(1);
$pdf->Cell(60,2,'Delivery =  C$ '.$costo,0,1,'');
$pdf->Ln(1);
$pdf->SetFont('Helvetica','',9);
$pdf->Cell(60,4,'Total a pagar =  C$ '.$total,0,1,'');
$pdf->Cell(60,4,'',0,1,'');
}



// PIE DE PAGINA
$pdf->Ln(4);
$pdf->SetFont('Arial','',7);
$pdf->Cell(60,2,'GRACIAS POR SU COMPRA ',0,1,'C');
$pdf->Ln(3);
$pdf->Cell(60,0,'LES ESPERAMOS NUEVAMENTE',0,1,'C');
$pdf->Output('Factura_#'.$row_id['orderID'].'.pdf','f');
$pdf->Output('Factura_#'.$row_id['orderID'].'.pdf','i');
?>