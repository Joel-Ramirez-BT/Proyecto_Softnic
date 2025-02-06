
<?php 
ob_start();

include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "admin")
    header("Location: login.php");

    
    
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Panel de Control - Softnic</title>

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

        <!-- Estilos de mac-->
        <link href="../css/stylesmac.css" rel="stylesheet">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
     <!-- Incluyendo jQuery desde CDN -->
  
  </head>

  <body id="page-top">

  <?php     
include_once('../include/navbar.php');
?>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
<?php     
include_once('../include/sidebar.php');
?>

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
                  <i class="fas fa-chart-bar"></i>
                  Disponibilidad del Personal</div>
                <div class="card-body">
                  <table  class="table table-responsive table-bordered" width="100%" cellspacing="0">
                    <tr>
                      <td><b>Personal</b></td>
                      <td><b>Estado</b></td>
                    </tr>

                    <?php 
                      $displayStaffQuery = "SELECT username, status FROM tbl_staff";

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
      <?php  include_once('../include/footer.php');?>

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
   <?php 
   //include("../include/traslate.php");
   ?>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <script sc="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
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