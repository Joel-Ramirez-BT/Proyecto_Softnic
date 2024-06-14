<?php
  include("../functions.php");

  if((!isset($_SESSION['uid']) && !isset($_SESSION['username']) && isset($_SESSION['user_level'])) ) 
    header("Location: login.php");

  if($_SESSION['user_level'] != "admin")
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

    <title>Finanzas | Casa de Watta</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">


    <link href="../css/stylesmac.css" rel="stylesheet">

    <script>
		function confirmarEliminacion() {
			// Mostrar una alerta con un mensaje de confirmación y botones Aceptar y Cancelar
			if (confirm("¿Estás seguro de que deseas eliminar los datos?")) {
				// Si el usuario hace clic en Aceptar, redirigir a la página de eliminación del archivo
				window.location.href = "deletesales.php";
			} else {
				// Si el usuario hace clic en Cancelar, no hacer nada
			}
		}
	</script>
</head>


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
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt" style="color: #2dfb31;"></i>
            <span>Panel de Control</span>
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="menu.php">
            <i class="fas fa-fw fa-utensils" style="color: #2dfb31;"></i>
            <span>Menú</span></a>



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

            
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sales.php">
            <i class="fas fa-fw fa-chart-area"></i>
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
          <i class="fas fa fa-wrench" aria-hidden="true" style="color: #2dfb31;"></i>
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
            <li class="breadcrumb-item active">Finanzas</li>
          </ol>

          <!-- Page Content -->
          <h1><i class="fas fa-fw fa-chart-area"></i> Administración de Finanzas</h1>
          <hr>
          <p>Todos los datos de venta se encuentran aquí.</p>

          <div class="card mb-3">
            <div class="card-header">
            <button class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#deleteModal" data-category="" data-menuid="" onclick="confirmarEliminacion()">
            Limpiar
          </button>
              <i class="fas fa-chart-area"></i>
              Estadística de Ventas
            </div>
            <div class="card-body">
              <table class="table  table-bordered" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <td>Hoy</td>
                    <td>C$ <?php echo getSalesGrandTotal("DAY"); ?></td>
                  </tr>
                  <tr>
                    <td>Esta Semana</td>
                    <td>C$ <?php echo getSalesGrandTotal("WEEK"); ?></td>
                  </tr>
                  <tr>
                    <td>Este Mes</td>
                    <td>C$ <?php echo getSalesGrandTotal("MONTH"); ?></td>
                  </tr>
                  <tr class="table-success">
                    <td><b>Todo el Tiempo</b></td>
                    <td><b>C$ <?php echo getSalesGrandTotal("ALLTIME"); ?></b></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card mb">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Tabla de consultas y reportes</div>
            <div class="card-body">
              <table id="tblCurrentOrder" class="table table-responsive table-bordered" width="100%" cellspacing="0">
                      
		
       

    <form id="consultaForm">
        <label for="tabla">Seleccionar Tabla:</label>
        <select class="form-control form-control-mb" name="tabla" required>
            <option value="tbl_order">Ordenes</option>
            <!-- Agregar más opciones según tus tablas -->
        </select>


        <label for="campo">Seleccionar Campo:</label>
<select class="form-control form-control-mb" name="campo" required>
    <option value="orderID AS '#', status AS 'ESTADO', total AS 'TOTAL', order_date AS 'FECHA', nombre AS 'CLIENTE', forma_pago AS 'FORMA DE PAGO', direccion AS 'DIRECCION', servicio AS 'SERVICIO', costo AS 'COSTO'">TODO</option>
    <option value="nombre AS 'NOMBRE CLIENTE', total AS 'VENTAS'">NOMBRE CLIENTE Y VENTAS</option>
    <option value="SUM(total) AS 'Total de ventas'">TOTAL DE VENTAS</option>
    <!-- Otras opciones de campos según la tabla seleccionada -->
</select>



        <label for="condicion">Agregar Condición:</label>
        <select class="form-control form-control-mb" name="condicion" required>
        <option value="1=1;">Ninguna</option>
        <option value="forma_pago='Contado'">SI pago es de contado</option>
        <option value="forma_pago='Contado' AND order_date = CURDATE(); ">SI pago es contado de hoy</option>
        <option value="forma_pago='Credito'">SI pago es al credito</option>
        <option value="forma_pago='Credito' AND order_date = CURDATE();">Credito de hoy</option>
            <!-- Opciones de campos según la tabla seleccionada -->
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

            xhr.open("POST", "procesar_consulta.php", true);
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

  </body>

</html>