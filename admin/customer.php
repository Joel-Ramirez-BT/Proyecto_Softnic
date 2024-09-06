<?php
  include("../functions.php");
  include("../config.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "admin")
    header("Location: login.php");

  if (!empty($_POST['role'])) {
    $role = $sqlconnection->real_escape_string($_POST['role']);
    $staffID = $sqlconnection->real_escape_string($_POST['staffID']);

    $updateRoleQuery = "UPDATE tbl_staff SET role = '{$role}'  WHERE staffID = {$staffID}  ";

      if ($sqlconnection->query($updateRoleQuery) === TRUE) {
        echo "";
      } 

      else {
        //handle
        echo "someting wong";
        echo $sqlconnection->error;
      }
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Administración de Mesas - Brazos Tecnologias</title>

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



    <script>
		function Eliminar() {
			// Mostrar una alerta con un mensaje de confirmación y botones Aceptar y Cancelar
				window.location.href = "addtables.php";
			} 
	</script>

  </head>

  <body id="page-top">

   
  
  <?php 
  //Incluir la barra superior de navegacion
  include_once('../include/navbar.php');?>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <?php     
include_once('../include/sidebar.php');
?>
      <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">clientes</li>
          </ol>

          <h1>Administración de clientes</h1>
<hr>
<p>Gestión de Clientes.</p>

<div class="row">
  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
      <i class="fas fa-fw fa-user-circle" ></i>
        Agregar cliente
      </div>
      <div class="card-body">
        <form action="addcustomer.php" method="POST">
          <div class="form-group">
            <label for="nombre_cliente">Nombre del Cliente:</label>
            <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" placeholder="Ejemplo: Joel Ramirez" required>
          </div>
          <div class="form-group">
              <label for="direccion">Dirección:</label>
              <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese una direccion" required>
            </div>
            <div class="form-group">
              <label for="telefono">Telefono:</label>
              <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Ejemplo: 86543210" maxlength="8">
            </div>
          
          <div class="text-center">
            <input class="btn btn-success" type="submit" name="agregar" id="agregar" value="Agregar">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
      <i class="fas fa-fw fa-user-circle" ></i>
        Lista de Clientes
      </div>
      <div class="card-body">
        <table id="tblCurrentOrder" class="table table-responsive table-bordered" width="100%" cellspacing="0">
          <thead class="table-success">
            <tr>
              <th>#id</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Telefono</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody id="tblBodyCurrentOrder">
            <?php

require("../config.php");
  
$conn = new mysqli($servername, $username, $password, $dbname);

            //$conexion = mysqli_connect('localhost', 'root', '', 'fosdb');
            $consulta = "SELECT * FROM tbl_customer";
            $resultado = mysqli_query($conn, $consulta);

            while ($row = mysqli_fetch_array($resultado)) {
              echo "<tr>";
              echo "<td class='text-center'>" . $row['id'] . "</td>
              <td >" . $row['nombre'] . "</td>";
              echo"<td rowspan='' class='text-center'>". $row['direccion'] . "</td>";
              echo"<td rowspan='' class='text-center'>". $row['telefono'] . "</td>";
              echo "<td rowspan='' class='text-center'>
              <a href='editcustomer.php?id=" . $row['id'] . "' class='btn btn-warning'><i class='fas fa-fw fa-edit'></i></a>
              <a href='deletecustomer.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='fas fa-fw fa-trash'></i></a>
              </td>";
              
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer small text-muted"><i>Se refresca automáticamente cada 5 segundos</i></div>
    </div>
  </div>
</div>


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
            <h5 class="modal-title" id="exampleModalLabel">¿Deseas cerrar tu sesión?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
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