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
include_once('../include/sidebar.php'); // incluye el menu desplegable
?>

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">cajas</li>
          </ol>

          <h1><i class="fas fa-table"></i> Administración de cajas</h1>
<hr>
<p>Gestión de cajas.</p>

<div class="row">
  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
      <i class="fas fa-duotone fa-table"></i>
        Agregar caja
      </div>
      <div class="card-body">
        <form action="addtables.php" method="POST">
          <div class="form-group">
            <label for="table_id"></label>
            <input type="hidden" name="table_id" id="table_id" class="form-control" value="<?php echo $row['id']; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="nombre_table">Nombre de la caja</label>
            <input type="text" name="nombre_table" id="nombre_table" class="form-control" placeholder="Ejemplo: caja 1" required>
          </div>
          <div class="form-group">
              <label for="capacidad">Capacidad (opcional)</label>
              <input type="number" name="capacidad" id="capacidad" class="form-control" placeholder="Ingrese un número">
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
      <i class="fas fa-duotone fa-table"></i>
        Lista de cajas Actuales
      </div>
      <div class="card-body">
        <table id="tblCurrentOrder" class="table table-responsive table-bordered" width="100%" cellspacing="0">
          <thead class="table-success">
            <tr>
              <th>#id</th>
              <th>N° caja</th>
              <th>Capacidad</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody id="tblBodyCurrentOrder">
            <?php
            include("../dbconnection.php");
            $conexion = $connection;
            $consulta = "SELECT * FROM tbl_table";
            $resultado = mysqli_query($conexion, $consulta);

            while ($row = mysqli_fetch_array($resultado)) {
              echo "<tr>";
              echo "<td class='text-center'>" . $row['id'] . "</td>
              <td >" . $row['nombre_table'] . "</td>";
              echo"<td rowspan='' class='text-center'>". $row['capacidad'] . "</td>";
              echo "<td rowspan='' class='text-center'>
              <a href='editables.php?id=" . $row['id'] . "' class='btn btn-warning'>
              <i class='fas fa-fw fa-edit'></i>
              </a>
              <a href='deletetable.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='fas fa-fw fa-trash'></i></a>
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