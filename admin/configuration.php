<?php
  include("../functions.php");

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


    <title>Configuraciones - Brazos Tecnologias</title>

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



  </head>

  <body id="page-top">

   
  
  <?php 
  //Incluir la barra superior de navegacion
  include_once('../include/navbar.php');?>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Control</span>
          </a>
        </li>

        <!--
        <li class="nav-item">
          <a class="nav-link" href="menu.php">
            <i class="fas fa-fw fa-utensils"style="color: #2dfb31;"></i>
            <span>Menú</span></a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="order.php">
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
          <i class="fas fa fa-wrench" aria-hidden="true" ></i>
            <span>Configuraciones</span>
          </a>
        </li>
--> 
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-power-off" style="color: #FF0000;"></i>
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
            <li class="breadcrumb-item active">Configuraciones</li>
          </ol>

          <h1><i class="fas fa-cog"></i> Configuraciones</h1>
<hr>
<p>Resetear contraseña de administrador.</p>

<div class="row">
  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
      <i class="fa fa-retweet" aria-hidden="true"></i>
        Resetear contraseña
      </div>
      <div class="card-body">
        <form action="updatepassword.php" method="POST" onsubmit="return validateForm()">
          <div class="form-group"> 
            <label for="nombre_table">Ingrese nuevo usuario</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Ingrese el nuevo usuario" required>
          </div>
          <div class="form-group">
              <label for="capacidad">Nueva Contraseña</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese una nueva contraseña"  required>
            </div>
            <div class="form-group">
              <label for="capacidad">Confirmar contraseña</label>
              <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Ingrese la contraseña nuevamente"  required>
            </div>
          
          <div class="text-center">
            <input class="btn btn-danger" type="submit" name="agregar" id="agregar" value="Cambiar">
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
	function validateForm() {
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmpassword").value;

  // Verificar que ambos campos no estén vacíos
  if (password === "" || confirmPassword === "") {
    alert("Por favor, ingresa ambas contraseñas.");
    return false;
  }

  // Verificar si las contraseñas son iguales
  if (password !== confirmPassword) {
    alert("Las contraseñas no coinciden. Por favor, inténtalo nuevamente.");
    return false;
  }
  if (password == confirmPassword) {
    alert("Se cerrara la session y tendra que acceder con la nueva contraseña");
    return true;
  } 
}
	</script>

<!-- Siguiente caja de configuraciones -->

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