 <?php
  include("../functions.php");

  // Verificar sesión y nivel de usuario
  if(!isset($_SESSION['uid']) || !isset($_SESSION['username']) || $_SESSION['user_level'] != "admin") {
    header("Location: login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Estado de Cuentas | Softnic</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <link href="../css/stylesmac.css" rel="stylesheet">
</head>

<body id="page-top">
    <?php include_once('../include/navbar.php'); ?>

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt" style="color: #2dfb31;"></i>
                    <span>Panel de Control</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pay.php">
                    <i class="fas fa-fw fa-tachometer-alt" style="color: #2dfb31;"></i>
                    <span>Pagos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-power-off"style="color: #FF0000;"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    
    <div id="content-wrapper">
    <div class="container-fluid">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Cliente</th>
                            <th>Nombre</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
// Recuperar los valores de los filtros desde el formulario GET
$campo = isset($_GET['campo']) ? $_GET['campo'] : '';  // El campo a mostrar
$startdate = isset($_GET['startdate']) ? $_GET['startdate'] : '';  // Fecha de inicio
$enddate = isset($_GET['enddate']) ? $_GET['enddate'] : '';  // Fecha de fin

// Iniciar la consulta base
$query = "SELECT o.orderID, o.status, o.total, o.order_date, 
                 o.forma_pago, c.nombre 
          FROM tbl_order o 
          LEFT JOIN tbl_customer c ON o.OrderID = c.id";

// Filtrar por fechas si se especificaron
if (!empty($startdate) && !empty($enddate)) {
    $query .= " WHERE o.order_date BETWEEN '$startdate' AND '$enddate'";
} elseif (!empty($startdate)) {
    $query .= " WHERE o.order_date >= '$startdate'";
} elseif (!empty($enddate)) {
    $query .= " WHERE o.order_date <= '$enddate'";
}

// Ejecutar la consulta
$result = $sqlconnection->query($query);

// Comprobar si se encontraron resultados
if ($result && $result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        // Si el pago fue en efectivo, se muestra "Pago en efectivo"
        $cliente_nombre = $order['forma_pago'] == 'efectivo' ? 'Pago en efectivo' : $order['nombre'];

        echo "<tr>";
        echo "<td>{$order['orderID']}</td>";
        echo "<td>{$cliente_nombre}</td>";
        echo "<td>{$order['total']}</td>";
        echo "<td>{$order['status']}</td>";
        echo "<td>{$order['order_date']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";
}
?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para realizar pago -->
<div class="modal fade" id="pagoModal" tabindex="-1" role="dialog" aria-labelledby="pagoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pagoModalLabel">Realizar Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pagoForm" method="POST" action="realizar_pago.php">
                    <input type="hidden" id="cliente_id" name="cliente_id">
                    <input type="hidden" id="saldo_pendiente" name="saldo_pendiente">
                    <div class="form-group">
                        <label for="monto_pago">Monto a pagar:</label>
                        <input type="number" class="form-control" id="monto_pago" name="monto_pago" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_pago">Fecha de Pago:</label>
                        <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" required>
                    </div>
                    <button type="submit" class="btn btn-success">Realizar Pago</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Código para llenar el modal con la información del cliente
    $('#pagoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var clienteId = button.data('id');
        var clienteNombre = button.data('nombre');
        var saldoPendiente = button.data('saldo');
        
        var modal = $(this);
        modal.find('.modal-title').text('Pago para ' + clienteNombre);
        modal.find('#cliente_id').val(clienteId);
        modal.find('#saldo_pendiente').val(saldoPendiente);
    });
</script>
    <!-- Sticky Footer -->
            <?php include_once('../include/footer.php'); ?>
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Preparado para partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar Sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

</body>

</html>
