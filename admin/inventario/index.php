<?php
include("../../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: ../login.php");

  if($_SESSION['user_level'] != "admin")
    header("Location: ../login.php");

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Menu -  Brazos Tecnologias</title>


    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Incluir estilos de mac -->
     <?php include_once('../../css/stylesmac.css');?>

  </head>
  <body id="page-top">
	
  <?php 
  //Incluir la barra superior de navegacion
  include_once('../../include/navbar.php');?>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../index.php">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #2dfb31;"></i>
            <span>Panel de Control</span>
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
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
          <h1><i class="fas fa-fw fa-chart-area"></i> Inventario</h1>
          <hr>
          <p>Todos los datos de venta se encuentran aquí.</p>

         
          <div class="card mb">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Inventario</div>
            <div class="card-body">
              <table id="tblCurrentOrder" class="table table-responsive table-bordered" width="100%" cellspacing="0">
                    
    <form id="consultaForm">
        <label for="campo">Seleccione la categoria:</label>
<select class="form-control form-control-mb" name="campo" required>
<?php

$conexion = $sqlconnection;
$addOrderQuery = "SELECT * FROM tbl_menu;";
$resultado= mysqli_query($conexion,$addOrderQuery);

while ($row1 = mysqli_fetch_array($resultado)) {
      $id_menu = $row1['menuID'];
      $categoria = $row1['menuName'];
      echo "<option value='where menuID = $id_menu'>$categoria</option>";
   }
   ?> 
      <!-- Otras opciones de campos según la tabla seleccionada -->
</select>
<br>

        <input type="button" class="btn btn-success btn-sm " value="Ejecutar Consulta" onclick="realizarConsulta()">
        
    </form>

    <div id="resultados">
        <!-- Aquí se mostrarán los resultados -->
    </div>
    
    <script>
        function realizarConsulta() {
            var form = document.getElementById("consultaForm");
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("resultados").innerHTML = xhr.responseText;
                }
            };

            xhr.open("POST", "Inventario_Controller.php", true);
            xhr.send(formData);
        }
    </script>
                    </tbody>
              </table>


<!--SEGUNDA TABLA / ESTADISTICAS DE VENTA -->







            </div>
            </div>
          </div>
                     
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php  include_once('../../include/footer.php');?>

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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

  </body>

</html>