<?php
  include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "staff")
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

    <title>Finanzas | Softnic</title>

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

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Restaurante | Softnic</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"style="color: #2dfb31;"></i>
          </a>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"style="color: #2dfb31;"></i>
            <span>Panel de Control</span>
          </a>
        </li>

   
        <?php

          if ($_SESSION['user_role'] == "Mesero") {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="order.php">
                <i class="fas fa-fw fa-book" style="color: #2dfb31;"></i>
                <span>Orden</span></a>
            </li>
          ';
          }

          if ($_SESSION['user_role'] == "chef") {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="kitchen.php">
                <i class="fas fa-fw fa-utensils" style="color: #2dfb31;"></i>
                <span>Cocina</span></a>
            </li>
            ';
          }

        ?>


<li class="nav-item">
          <a class="nav-link" href="facturar.php">
          <i class="fas fa-regular fa-print"></i>
            <span>Facturar</span></a>
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
            <li class="breadcrumb-item active">Facturas</li>
          </ol>

          <!-- Page Content -->
          <h1>Administración de Facturas</h1>
          <hr>
          <p>Todos las facturas se encuentran aquí.</p>

          <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-regular fa-print" ></i>
              Lista de Órdenes y facturas</div>
            <div class="card-body">
              <table id="tblCurrentOrder" class="table table-responsive table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <th># Orden</th>
                      <th>Menú</th>
                      <th>Nombre de Producto</th>
                      <th class='text-center'>Cantidad</th>
                      <th class='text-center'>Precio total</th>
                      <th class='text-center'>Fecha</th>
                      <th class='text-center'>Opciones</th>
                      
                    </thead>
                    
                    <tbody id="tblBodyCurrentOrder">
                      <?php 
                      $displayOrderQuery =  "
                        SELECT o.orderID, o.nombre,m.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,mi.price ,o.order_date
                        FROM tbl_order O
                        LEFT JOIN tbl_orderdetail OD
                        ON O.orderID = OD.orderID
                        LEFT JOIN tbl_menuitem MI
                        ON OD.itemID = MI.itemID
                        LEFT JOIN tbl_menu M
                        ON MI.menuID = M.menuID ORDER BY orderID DESC
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

                              

                              echo "<td rowspan=".$rowspan." class='text-center'>".getSalesTotal($orderRow['orderID'])."</td>";

                              echo "<td rowspan=".$rowspan." class='text-center'>".$orderRow['order_date']."</td>";

                                
                                  $id = $orderRow['orderID'];
                                  
                                  echo "<td rowspan=".$rowspan." class='text-center'><a href='../admin/factura.php?id=$id' class='btn btn-primary'><i class='fas fa-regular fa-print' style=''></i></a>
                                  <a href='./deletefactura.php?id=$id' class='btn btn-danger'><i class='fas fa-regular fa-trash' style=''></i></a>
                                  <a href='./editorder.php?id=$id' class='btn btn-success'><i class='fas fa-regular fa-plus' style=''></i></a>";
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