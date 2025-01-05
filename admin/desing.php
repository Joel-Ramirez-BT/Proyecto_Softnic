<?php
include('./../config.php');
// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Guardar la selección en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipoNegocio = $_POST['tipoNegocio'];
    
    // Limpiar la entrada
    $tipoNegocio = $conn->real_escape_string($tipoNegocio);
    
    // Insertar o actualizar la configuración
    $sql = "UPDATE tbl_configuracion 
        SET tipo_negocio = '$tipoNegocio'";
    
    
    if ($conn->query($sql) === TRUE) {
            echo '';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Recuperar la configuración
$sql = "SELECT tipo_negocio FROM tbl_configuracion LIMIT 1";
$result = $conn->query($sql);
$tipoNegocio = "";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tipoNegocio = $row['tipo_negocio'];
}

$conn->close();
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
  <!--
   <style>
        body {
            font-family: Arial, sans-serif;
            transition: background-color 0.5s, color 0.5s;
        }
        .restaurante {
            background-color: #ffebcd; /* Color de fondo para restaurante */
            color: #8b4513; /* Color de texto para restaurante */
        }
        .farmacia {
            background-color: #e0ffff; /* Color de fondo para farmacia */
            color: #006400; /* Color de texto para farmacia */
        }
    </style>
-->
</head>

<?php 
include_once('../include/navbar.php');

if ($tipoNegocio == 'restaurante') {
  
    echo'
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
  
';

} elseif ($tipoNegocio == 'farmacia') {
    $titulo = "Bienvenido a nuestra Farmacia";
    $descripcion = "Encuentra los mejores medicamentos y productos de salud.";
    $productos = "<ul>
                    <li>Medicamentos</li>
                    <li>Suplementos</li>
                    <li>Cuidado personal</li>
                  </ul>";
}

//Incluir la barra superior de navegacion
?>

<div id="content-wrapper" class="right-content mt-4">
<div class="container-fluid">
<div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
      <i class="fa fa-plus" aria-hidden="true"></i>
        Elegir el diseño
      </div>
      <div class="card-body">
<body class="<?php echo $tipoNegocio; ?>">

    <h3>Selecciona el tipo de negocio</h3>
    <form method="POST" action="">
        <select name="tipoNegocio" onchange="this.form.submit()">
            <option value="">-- Selecciona --</option>
            <option value="restaurante" <?php if ($tipoNegocio == 'restaurante') echo 'selected'; ?>>Restaurante</option>
            <option value="farmacia" <?php if ($tipoNegocio == 'farmacia') echo 'selected'; ?>>Farmacia</option>
        </select>
    </form>
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