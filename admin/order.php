<?php
	include("../functions.php");
  include("../dbconnection.php");
  
  

  if (!isset($_SESSION['uid']) || !isset($_SESSION['username']) || !isset($_SESSION['user_level'])) {
    // Si alguna de las variables de sesión no está establecida, redirige a login.php
    header("Location: login.php");
} elseif ($_SESSION['user_level'] != "admin" && $_SESSION['user_level'] != "staff") {
    // Si el nivel de usuario no es "admin" ni "staff", redirige a login.php
    header("Location: login.php");
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

    <title>Order - FOS Staff</title>

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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
          <a class="nav-link" href="../admin/index.php">
            <i class="fas fa-fw fa-tachometer-alt"style="color: #2dfb31;"></i>
            <span>Panel de Control</span>
          </a>
        </li>


        
        <li class="nav-item">
          <a class="nav-link" href="../admin/menu.php">
            <i class="fas fa-fw fa-utensils"style="color: #2dfb31;"></i>
            <span>Menú</span></a>
        </li>
        
        <?php

echo '
<li class="nav-item">
<a class="nav-link" href="#">
  <i class="fas fa-duotone fa-table"></i>
  <span>Ordenar</span>
</a>
</li>
';
        ?>


<li class="nav-item">
          <a class="nav-link" href="../admin/facturar.php">
          <i class="fas fa-regular fa-print" style="color: #2dfb31;"></i>
            <span>Facturar</span></a>
        </li>


  <li class="nav-item">
          <a class="nav-link" href="../admin/sales.php">
            <i class="fas fa-fw fa-chart-area"style="color: #2dfb31;"></i>
            <span>Finanzas</span></a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="../admin/tables.php">
            <i class="fas fa-duotone fa-table" style="color: #2dfb31;"></i>
            <span>Mesas</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="../admin/customer.php">
            <i class="fas fa-fw fa-user-circle" style="color: #2dfb31;"></i>
            <span>Clientes</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="../admin/configuration.php">
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
            <li class="breadcrumb-item active">Orden</li>
          </ol>

          <!-- Page Content -->
          <h1>Administración de Órdenes</h1>
          <hr>
          <p>Administración de nuevas órdenes en esta página.</p>

          <div class="row">
            <div class="col-lg-6">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-utensils"></i>
                  Tomar Ordenes</div>
                <div class="card-body">
                  <table class="table table-responsive table-bordered text-center" width="100%" cellspacing="0">
                  	<tr>
                  	<?php 
						$menuQuery = "SELECT * FROM tbl_menu";

						if ($menuResult = $sqlconnection->query($menuQuery)) {
							$counter = 0;
							while($menuRow = $menuResult->fetch_array(MYSQLI_ASSOC)) { 
								if ($counter >=3) {
									echo "</tr>";
									$counter = 0;
								}

								if($counter == 0) {
									echo "<tr>";
								} 
								?>

								<td><button style="margin-bottom:4px;white-space: normal;" class="btn btn-danger" onclick="displayItem(<?php echo $menuRow['menuID']?>)"><?php echo $menuRow['menuName']?></button>

                </td>
							<?php

							$counter++;
							}
						}
					?>
<!-- 

          <?php
     include("../config.php");
        $con = mysqli_connect($servername, $username, $password) or die("No se ha podido conectar al Servidor");
        $db = mysqli_select_db($con, $dbname) or die("Upps! Error en conectar a la Base de Datos");
        
        $sqlClientes         = ("SELECT * FROM  tbl_clientes ORDER BY id DESC LIMIT 10");
        $dataClientesSelect  = mysqli_query($con, $sqlClientes);
      ?>
--->
					</tr>
                  </table>
                  <table id="tblItem" class="table table-responsive table-bordered" width="100%" cellspacing="0"></table>

                <div id="qtypanel" hidden="">
        					Cantidad : <input id="qty" required="required" type="number" min="1" max="50" name="qty" value="1" />
        					<button class="btn btn-info" onclick = "insertItem()">Listo</button>
        					<br><br>
				</div>

                </div>
              </div>
            </div>


            
            <div class="col-lg-6">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar"></i>
                  Lista de Órdenes</div>

                <div class="card-body">
                  
        
                    <form action="insertorder.php" method="POST">
              <div class="card-body">
              <div>

              
              <label class="form-group"></label>
<input type="text" name="nombrec" placeholder="Ingrese nombre del cliente" id="nombrec" class="form-control form-control-mb" list="clientes"/>
<datalist id="clientes">
   <?php
   $conexion1 = $sqlconnection;
   $consulta1 = "SELECT nombre, direccion FROM tbl_customer";
   $resultado1 = mysqli_query($conexion1, $consulta1);

   while ($row1 = mysqli_fetch_array($resultado1)) {
      $nombre_cliente = $row1['nombre'];
      $direccion_cliente = $row1['direccion'];
      echo "<option value='$nombre_cliente' data-direccion='$direccion_cliente'>$nombre_cliente</option>";
   }
   mysqli_close($conexion1);
   ?>
</datalist>

<div>
   <label class="form-group"></label>
   <input type="text" name="direccion" placeholder="Dirección" id="direccion" class="form-control" >
</div>

<script>
   $(document).ready(function() {
      // Manejar el evento de cambio en el campo de entrada del nombre del cliente
      $('#nombrec').on('input', function() {
         // Obtener la dirección asociada al cliente seleccionado
         var selectedCliente = $(this).val();
         var selectedOption = $('#clientes option[value="' + selectedCliente + '"]');
         var direccionCliente = selectedOption.data('direccion');

         // Mostrar la dirección en el campo de dirección
         $('#direccion').val(direccionCliente);
      });
   });
</script>

  </br>
            <div class="input-group mb-3">
            <label class="form-group"></label>
            <select class="form-control form-control-mb" name="forma_pago" id="forma_pago" Required>
            <option value=''>Forma de pago:</option>
            <option value='Contado'>*De contado</option>"
            <option value='Credito'>*Al Credito</option>"
             </select>
  <span class="input-group-text"> </span>
  <label class="form-group"></label>
  
  <select class="form-control form-control-mb" name="servicio" id="servicio" onchange="mostrarCosto()" required>
        <option value=''>Selecciona el tipo de servicio:</option>
        <option value='Delivery'>Delivery</option>
        <?php
          $conexion = $connection;
          $consulta = "SELECT Nombre_table, capacidad FROM tbl_table";
          $resultado = mysqli_query($conexion, $consulta);

          while ($row = mysqli_fetch_array($resultado)) 
          {  
            // Suponiendo que $row contiene los datos de la mesa
            $nombreMesa = $row['Nombre_table'];
            $capacidadMesa = $row['capacidad'];
            
            // Generar la opción de selección en HTML
            $opcion = "<option value='$nombreMesa'>$nombreMesa</option>";
            
            // Imprimir la opción
            echo $opcion; 
          }
        ?>
      </select>
    </div>

    <script>
    // Función para mostrar u ocultar el campo de costo según el tipo de servicio seleccionado
    function mostrarCosto() {
      var servicioSeleccionado = document.getElementById("servicio").value;
      var costoGroup = document.getElementById("costo");
      var costoGroup = document.getElementById("costoGroup");
      // Si el tipo de servicio es "Delivery", muestra el campo de costo, de lo contrario, ocúltalo
      if (servicioSeleccionado === "Delivery") {
        costo.classList.remove("hidden");
        costoGroup.classList.remove("hidden");
        
      } else {
        costo.classList.add("hidden");
        costoGroup.classList.add("hidden");
      }
    }
  </script>

<style>

.hidden {
    display: none;
}

</style>

<div class="form-group" id="costoGroup">
      <input type="number" name="costo" id="costo" placeholder="Costo de envío (C$)" class="form-control hidden" min='0' max='100'>
    </div>


           </div>

						<table id="tblOrderList" class="table table-responsive table-bordered" width="100%" cellspacing="0">
         
            
            <tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Total (C$)</th>
							</tr>
						</table>
						<input class="btn btn-success" type="submit" name="sentorder" id="sentorder" value="Ordenar">
					</form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer 
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Sistema de Restaurante Brazos Tecnologias</span>
            </div>
          </div>
        </footer>
-->
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
            <h5 class="modal-title" id="exampleModalLabel">¿Realmente deseas cerrar sesión?</h5>
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

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	<script>
		var currentItemID = null;

		function displayItem (id) {
			$.ajax({
				url : "displayitem.php",
					type : 'POST',
					data : { btnMenuID : id },

					success : function(output) {
						$("#tblItem").html(output);
					}
				});
		}

		function insertItem () {
			var id = currentItemID;
			var quantity = $("#qty").val();
			$.ajax({
				url : "displayitem.php",
					type : 'POST',
					data : { 
						btnMenuItemID : id,
						qty : quantity 
					},

					success : function(output) {
						$("#tblOrderList").append(output);
						$("#qtypanel").prop('hidden',true);
					}
				});

			$("#qty").val(1);
		}

		function setQty (id) {
			currentItemID = id;
			$("#qtypanel").prop('hidden',false);
		}

		$(document).on('click','.deleteBtn', function(event){
		        event.preventDefault();
		        $(this).closest('tr').remove();
		        return false;
		    });

	</script>

  </body>

</html>