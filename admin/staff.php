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

    <title>Administración de Empleados - Brazos Tecnologias</title>

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
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-power-off"></i>
            <span>Cerrar Sesión</span>
          </a>
        </li>

      </ul>

     <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Panel de Control</a>
            </li>
            <li class="breadcrumb-item active">Empleados</li>
          </ol>

          <!-- Page Content -->
          <h1>Configuracion  de Empleados</h1>
          <hr>
          <p>Empleados Disponibles.</p>

          <div class="row">
            <div class="col-lg-6">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-user-circle"></i>
                  Lista Actual de empleados</div>
                <div class="card-body">
                  <table id="dataTable" class="table table-responsive table-bordered" width="100%" cellspacing="0">
                    <tr>
                      <th>#</th>
                      <th>Usuario</th>
                      <th>Estado</th>
                      <th>Cargo</th>
                      <th class="text-center">Opción</th>
                    </tr>
                    
                      <?php 

                        $displayStaffQuery = "SELECT * FROM tbl_staff";

                        if ($result = $sqlconnection->query($displayStaffQuery)) {

                          if ($result->num_rows == 0) {
                            echo "<td colspan='4'>No tiene empleados disponibles</td>";
                          }

                          $staffno = 1;
                          while($staff = $result->fetch_array(MYSQLI_ASSOC)) {
                          ?>  
                          	<tr class="text-center">
                            	<td><?php echo $staffno++; ?></td>
                            	<td><?php echo $staff['username']; ?></td>

                              <?php

                            	if ($staff['status'] == "Online") {
                                echo "<td><span class=\"badge badge-success\">En línea</span></td>";
                              }

                              if ($staff['status'] == "Offline") {
                                echo "<td><span class=\"badge badge-secondary\">Fuera de línea</span></td>";
                              }

                              ?>

                              <td>
                                <form method="POST">
                                <input type="hidden" name="staffID" value="<?php echo $staff['staffID']; ?>"/>
                                <select name="role" class="form-control" onchange="this.form.submit()">
                                  <?php

                                  $roleQuery = "SELECT role FROM tbl_role";

                                  if ($res = $sqlconnection->query($roleQuery)) {
                                    
                                    if ($res->num_rows == 0) {
                                      echo "no role";
                                    }

                                    while ($role = $res->fetch_array(MYSQLI_ASSOC)) {

                                      if ($role['role'] == $staff['role']) 
                                        echo "<option selected='selected' value='".$staff['role']."'>".ucfirst($staff['role'])."</option>";

                                      else
                                        echo "<option value='".$role['role']."'>".ucfirst($role['role'])."</option>";
                                    }
                                  }

                                  ?>
                                </select>
                                <noscript><input type="submit" value="Enviar"></noscript>
                                </form>
                              </td>

                            	<td class="text-center"><a href="deletestaff.php?staffID=<?php echo $staff['staffID']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a></td>
                        	</tr>

                          <?php 
                          }

                        }
                        else {
                          echo $sqlconnection->error;
                          echo "Something wrong.";
                        }

                      ?>

                  </table>
                </div>
                <div class="card-footer small text-muted"><i>Contraseña predeterminada para nuevo usuario : 1234</i></div>
              </div>
            </div>
            

            <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
      <i class="fa fa-plus" aria-hidden="true"></i>
        Agregar Empleado
      </div>
      <div class="card-body">
        <form action="addstaff.php" method="POST" >
          <div class="form-group"> 
            <label for="staff_name">Nombre de empleado</label>
            <input type="text" name="staffname" id="staffname" class="form-control" placeholder="Ingrese empleado" required>
          </div>
          <div class="form-group">
              <label for="role">Cargo</label>
              <select class="form-control form-control-mb" name="staffrole" id="staffrole" Required>
              <option>Seleccione un cargo:</option>
              <option value="Mesero">Mesero</option>
              <option value="chef">Cocinero</option>
              </select>
            </div>
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" name="staffpwd" id="staffpwd" class="form-control" placeholder="Ingrese la contraseña"  required>
            </div>
          
          <div class="text-center">
            <input class="btn btn-success" type="submit" name="addstaff" id="addstaff" value="Agregar">
          </div>
        </form>
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