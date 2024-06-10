<?php
  include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "admin")
    header("Location: login.php");

?>
<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Finanzas | Casa de Watta</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <script>
		function confirmarEliminacion() {
			// Mostrar una alerta con un mensaje de confirmación y botones Aceptar y Cancelar
			if (confirm("¿Estás seguro de que deseas eliminar los datos?")) {
				// Si el usuario hace clic en Aceptar, redirigir a la página de eliminación del archivo
				window.location.href = "deletesales.php";
			} else {
				// Si el usuario hace clic en Cancelar, no hacer nada
			}
		}
	</script>
</head>


  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Restaurante | Casa de Watta</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #2dfb31;"></i>
            <span>Panel de Control</span>
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="menu.php">
            <i class="fas fa-fw fa-utensils" style="color: #2dfb31;"></i>
            <span>Menú</span></a>



         <li class="nav-item">
          <a class="nav-link" href="../staff/order.php">
            <i class="fas fa-duotone fa-table"style="color: #2dfb31;"></i>
            <span>Ordenar</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="facturar.php">
          <i class="fas fa-regular fa-print" style="color: #2dfb31;"></i>
            <span>Facturar</span></a>
        </li>

            
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sales.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Finanzas</span></a>
        </li>


      
<li class="nav-item">
          <a class="nav-link" href="tables.php">
            <i class="fas fa-duotone fa-table" style="color: #2dfb31;"></i>
            <span>Mesas</span>
          </a>
        </li>

        
<li class="nav-item">
          <a class="nav-link" href="customer.php">
            <i class="fas fa-fw fa-user-circle" style="color: #2dfb31;"></i>
            <span>Clientes</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="configuration.php">
          <i class="fas fa fa-wrench" aria-hidden="true" style="color: #2dfb31;"></i>
            <span>Configuraciones</span>
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

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">Finanzas</li>
          </ol>

          <!-- Page Content -->
          <h1>Administración de Finanzas</h1>
          <hr>
          <p>Todos los datos de venta se encuentran aquí.</p>

          <div class="card mb-3">
            <div class="card-header">
            <button class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#deleteModal" data-category="" data-menuid="" onclick="confirmarEliminacion()">
            Limpiar
          </button>
              <i class="fas fa-chart-area"></i>
              Estadística de Ventas
            </div>
            <div class="card-body">
              <table class="table  table-bordered" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <td>Hoy</td>
                    <td>C$ <?php echo getSalesGrandTotal("DAY"); ?></td>
                  </tr>
                  <tr>
                    <td>Esta Semana</td>
                    <td>C$ <?php echo getSalesGrandTotal("WEEK"); ?></td>
                  </tr>
                  <tr>
                    <td>Este Mes</td>
                    <td>C$ <?php echo getSalesGrandTotal("MONTH"); ?></td>
                  </tr>
                  <tr class="table-success">
                    <td><b>Todo el Tiempo</b></td>
                    <td><b>C$ <?php echo getSalesGrandTotal("ALLTIME"); ?></b></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
<!--
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Lista de Órdenes de Finanzas</div>
            <div class="card-body">
              <table id="tblCurrentOrder" class="table table-responsive table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <th># Orden</th>
                      <th>Menú</th>
                      <th>Nombre de Producto</th>
                      <th class='text-center'>Cantidad</th>
                      <th class='text-center'>Estado</th>
                      <th class='text-center'>Total (C$)</th>
                      <th class='text-center'>Fecha</th>
                      <th class='text-center'>Facturar</th>
                    </thead>
                    
                    <tbody id="tblBodyCurrentOrder">
                      <?php 
                      $displayOrderQuery =  "
                        SELECT o.orderID, m.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,mi.price ,o.order_date
                        FROM tbl_order O
                        LEFT JOIN tbl_orderdetail OD
                        ON O.orderID = OD.orderID
                        LEFT JOIN tbl_menuitem MI
                        ON OD.itemID = MI.itemID
                        LEFT JOIN tbl_menu M
                        ON MI.menuID = M.menuID
                        ";

                      if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
                          
                        $currentspan = 0;
                        $total = 0;

                        //if no order
                        if ($orderResult->num_rows == 0) {

                          echo "<tr><td class='text-center' colspan='7' >Actualmente no hay pedido en este momento. </td></tr>";
                        }

                        else {
                          while($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

                            //basically count rowspan so no repetitive display id in each table row
                            $rowspan = getCountID($orderRow["orderID"],"orderID","tbl_orderdetail"); 

                            if ($currentspan == 0) {
                              $currentspan = $rowspan;
                              $total = 0;
                            }

                            //get total for each order id
                            $total += ($orderRow['price']*$orderRow['quantity']);

                            echo "<tr>";

                            if ($currentspan == $rowspan) {
                              echo "<td rowspan=".$rowspan."># ".$orderRow['orderID']."</td>";
                            }

                            echo "
                              <td>".$orderRow['menuName']."</td>
                              <td>".$orderRow['menuItemName']."</td>
                              <td class='text-center'>".$orderRow['quantity']."</td>
                            ";

                            if ($currentspan == $rowspan) {

                              $color = "badge";

                              switch ($orderRow['status']) {
                                case 'waiting':
                                  $color = "badge badge-warning";
                                  break;
                                
                                case 'preparing':
                                  $color = "badge badge-primary";
                                  break;

                                case 'ready':
                                  $color = "badge badge-success";
                                  break;

                                case 'cancelled':
                                  $color = "badge badge-danger";
                                  break;

                                case 'finish':
                                  $color = "badge badge-success";
                                  break;

                                case 'Completed':
                                  $color = "badge badge-success";
                                  break;
                              }

                              echo "<td class='text-center' rowspan=".$rowspan."><span class='{$color}'>".$orderRow['status']."</span></td>";

                              echo "<td rowspan=".$rowspan." class='text-center'>".getSalesTotal($orderRow['orderID'])."</td>";

                              echo "<td rowspan=".$rowspan." class='text-center'>".$orderRow['order_date']."</td>";

                                $variable=$orderRow['orderID'];

                               echo "<td rowspan=".$rowspan." class='text-center'><a href='./factura/factura.php?id=$variable' class='btn btn-primary'>Facturar</a></td>";

                            
                              echo "</td>";

                            }

                            echo "</tr>";

                            $currentspan--;
                          }
                        }
                        } 
                      ?>
                    </tbody>
              </table>
            </div>
            </div>
          </div>
     
<!-- Formulario para seleccionar fecha y método de pago -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-search"></i>
    Consulta de Ventas por Fecha y Método de Pago
  </div>
  <div class="card-body">
    <form id="salesFilterForm" method="GET" action="consult_sales.php">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputDay">Día:</label>
          <select class="form-control" id="inputDay" name="day">
            <?php
            for ($i = 1; $i <= 31; $i++) {
              echo "<option value=\"$i\">$i</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="inputMonth">Mes:</label>
          <select class="form-control" id="inputMonth" name="month">
            <?php
            $months = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
            foreach ($months as $key => $value) {
              echo "<option value=\"" . ($key + 1) . "\">$value</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="inputYear">Año:</label>
          <select class="form-control" id="inputYear" name="year">
            <?php
            $currentYear = date("Y");
            for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
              echo "<option value=\"$i\">$i</option>";
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputPaymentMethod">Método de Pago:</label>
          <select class="form-control" id="inputPaymentMethod" name="payment_method">
            <option value="contado">Contado</option>
            <option value="credito">Crédito</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>&nbsp;</label>
          <button type="submit" class="btn btn-primary btn-block">Consultar</button>
        </div>
      </div>
    </form>
  </div>
</div>

   
        
        
        
      
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Sistema de Restaurante Brazos Tecnologias</span>
            </div>
          </div>
        </footer>

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
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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