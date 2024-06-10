<?php 
include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "admin")
    header("Location: login.php");

  // echo $_SESSION['uid'];
  //echo $_SESSION['username'];
  //echo $_SESSION['user_level'];
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel de Control - Casa de Watta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Control</span>
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="menu.php">
            <i class="fas fa-fw fa-utensils"style="color: #2dfb31;"></i>
            <span>Menú</span></a>
        </li>

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

        
        <li class="nav-item">
          <a class="nav-link" href="sales.php">
            <i class="fas fa-fw fa-chart-area"style="color: #2dfb31;"></i>
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
          <i class="fas fa fa-wrench" style="color: #2dfb31;"></i>
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
            <li class="breadcrumb-item active">Vista General</li>
          </ol>

          <!-- Page Content -->
          <h1>Panel de Administración</h1>
          <hr>
          <p>Vista General del Sistema.</p>

          <div class="row">
            <div class="col-lg-8">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-utensils"></i>
                  Lista de Pedidos Actuales</div>
                <div class="card-body">
                  <table id="tblCurrentOrder"  class="table table-responsive table-bordered" width="100%" cellspacing="0">
                    <thead class="table table-dark">
                      <th>Número de Orden</th>
                      <th>Menú</th>
                      <th>Nombre de Ítem</th>
                      <th class='text-center'>Cantidad</th>
                      <th class='text-center'>Estado</th>
                    </thead>
                    
                    <tbody id="tblBodyCurrentOrder">
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer small text-muted"><i>Se refresca automáticamente cada 5 segundos</i></div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar""></i>
                  Disponibilidad del Personal</div>
                <div class="card-body">
                  <table  class="table table-responsive table-bordered" width="100%" cellspacing="0">
                    <tr>
                      <td><b>Personal</b></td>
                      <td><b>Estado</b></td>
                    </tr>

                    <?php 
                      $displayStaffQuery = "SELECT username,status FROM tbl_staff";

                          if ($result = $sqlconnection->query($displayStaffQuery)) {
                            while($staff = $result->fetch_array(MYSQLI_ASSOC)) {
                              echo "<tr>";
                              echo "<td>{$staff['username']}</td>";

                              if ($staff['status'] == "Online") {
                                echo "<td><span class=\"badge badge-success\">Activo</span></td>";
                              }

                              if ($staff['status'] == "Offline") {
                                echo "<td><span class=\"badge badge-secondary\">Inactivo</span></td>";
                              }

                              echo "</tr>";
                            }
                          }
                    ?>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Sistema de Restaurante Brazos tecnologias</span>
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
          <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
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

    <script type="text/javascript">

    $( document ).ready(function() {
        refreshTableOrder();
    });

    function refreshTableOrder() {
      $( "#tblBodyCurrentOrder" ).load( "displayorder.php?cmd=display" );
    }

    //refresh order current list every 3 secs
    setInterval(function(){ refreshTableOrder(); }, 3000);

  </script>


  </body>

</html>