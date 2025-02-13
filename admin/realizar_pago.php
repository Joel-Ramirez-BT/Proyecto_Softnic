<?php
include("../functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $cliente_id = $_POST['cliente_id'];
    $monto_pago = $_POST['monto_pago'];
    $saldo_pendiente = $_POST['saldo_pendiente'];
    $fecha_pago = $_POST['fecha_pago'];

    // Verificar que el monto del pago no sea mayor al saldo pendiente
    if ($monto_pago > $saldo_pendiente) {
        echo "El monto del pago no puede ser mayor al saldo pendiente.";
        exit;
    }

    // Actualizar el saldo pendiente del cliente
    $nuevo_saldo = $saldo_pendiente - $monto_pago;
    $query = "UPDATE tbl_cuentas SET saldo_pendiente = $nuevo_saldo WHERE customer_id = $cliente_id";
    
    if ($sqlconnection->query($query) === TRUE) {
        // Registrar el pago en la base de datos (puedes agregar un campo de pagos en tu tabla)
        $query_pago = "INSERT INTO pagos (cliente_id, monto_pago, fecha_pago) VALUES ($cliente_id, $monto_pago, '$fecha_pago')";
        
        if ($sqlconnection->query($query_pago) === TRUE) {
            echo "Pago realizado exitosamente.";
        } else {
            echo "Error al registrar el pago: " . $sqlconnection->error;
        }
    } else {
        echo "Error al actualizar el saldo pendiente: " . $sqlconnection->error;
    }
}
?>
