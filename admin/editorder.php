<?php
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


  </head>

  <body id="page-top">

  
  <?php 
  //Incluir la barra superior de navegacion
  include_once('../include/navbar.php');?>


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
<a class="nav-link" href="../staff/order.php">
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
          <a class="nav-link" href="customer.php">
            <i class="fas fa-fw fa-user-circle" style="color: #2dfb31;"></i>
            <span>Clientes</span>
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
          <h1>Agregando elementos a Órden</h1>
          <hr>
          <p> órdenes en esta página.</p>

          <div class="row">
          <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-utensils"></i> Tomar Órdenes
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-bordered text-center" width="100%" cellspacing="0">
                            <tr>
                                <?php
                                $menuQuery = "SELECT * FROM tbl_menu";
                                $stmt = $sqlconnection->prepare($menuQuery);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $counter = 0;

                                while ($menuRow = $result->fetch_assoc()) {
                                    if ($counter % 3 == 0) {
                                        echo "</tr><tr>";
                                    }
                                    echo "<td>
        <button class='_favorit' style='margin-bottom:4px; white-space: normal; background-color: #ffffff; color: #000;' onclick='displayItem(" . $menuRow['menuID'] . ")'>
            " . $menuRow['menuName'] . "
            <img src='../image/" . $menuRow['menu_imagen'] . "' alt='" . $menuRow['menu_imagen'] . "' style='width:100%; height:auto;'>
        </button>
      </td>";

                                    $counter++;
                                }
                                $stmt->close();
                                ?>
                            </tr>
                        </table>
                        <table id="tblItem" class="table table-responsive table-bordered" width="100%" cellspacing="0"></table>

                        <div id="qtypanel" hidden="">
                            Cantidad: <input id="qty" required="required" type="number" min="1" max="50" name="qty" value="1" />
                            <button class="btn btn-info" onclick="insertItem()">Listo</button>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar"></i>
                  Lista de elementos a añadir</div>

                <div class="card-body">
                  <?php
$id= $_GET['id'];

               ?>
        
                    <form action="addorder.php" method="POST">
              <div class="card-body">
                <div>
                <label for="id"></label>
              <input type="hidden" id="id"  name="id" class="form-control" value="<?php echo$id ?>">
               </div>
						<table id="tblOrderList" class="table table-responsive table-bordered" width="100%" cellspacing="0">
         
            
            <tr>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Total (C$)</th>
							</tr>
						</table>
						<input class="btn btn-success" type="submit" name="sentorder" id="sentorder" value="Añadir">
					</form>
                </div>
              </div>
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