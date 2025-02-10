<?php
if (!file_exists("../functions.php")) {
    die("Error: No se encontró el archivo functions.php");
  }
  include("../functions.php");
  
  
  if (!isset($_SESSION['uid']) || !isset($_SESSION['username']) || !isset($_SESSION['user_level'])) {
      header("Location: login.php");
      exit();
  }
  
  if ($_SESSION['user_level'] != "admin") {
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

    <title>Panel de Control - Softnic</title>


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

<body>
  <!-- Navbar y Sidebar -->
    <?php 
    include_once('../include/navbar.php');
    //include_once('../include/sidebar.php');
    ?>
     <div class="col-md-10 offset-md-2 mt-5 d-flex justify-content-end">
      <div class="container text-center">
        <div class="card shadow-lg p-4 border-0 rounded-3">
            <h2 class="mb-4 text-primary text-center">Respaldo de Base de Datos</h2>
            <p class="text-muted aling-center ">Se crearan 2 copias, 1 se guardara en la carpeta backups y la otra usted tendra que elejir su ubicación</p><br>
            <form action="export_manual.php" method="post"><br>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-download"></i> Generar Backup
                </button>
            </form>
        </div>
    </div>

    <div class="container text-center">
        <div class="card shadow-lg p-4 border-0 rounded-3">
            <h2 class="mb-3 text-primary">Restaurar Backup</h2>
            <p class="text-muted">Selecciona un archivo SQL y presiona el botón para restaurar la base de datos.</p>
            <form action="restore.php" method="post" enctype="multipart/form-data">
                <input type="file" name="backup_file" class="form-control mb-3" accept=".sql" required>
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-upload"></i> Restaurar Backup
                </button>
            </form>
        </div>
    </div>
    </div>
    <!-- Sticky Footer -->
    <?php include_once('../include/footer.php'); ?>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

</body>
</html>
