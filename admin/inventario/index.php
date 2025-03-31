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
            <i class="fas fa-fw fa-tachometer-alt" style="color:rgb(230, 127, 11);"></i>
            <span>Panel de Control</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-area"style="color: rgb(238, 92, 7);"></i>
            <span>Agregar Categoria</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="agregar_producto.php">
            <i class="fas fa-fw fa-plus"style="color:rgb(238, 120, 10);"></i>
            <span>Agregar Producto</span></a>
            
            <li class="nav-item">
  <a class="nav-link" href="#">
    <i class="fas fa-undo-alt" style="color:rgb(247, 140, 18);"></i>
    <span>Devoluciones</span>
  </a>
</li>

        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-truck"style="color:rgb(243, 144, 16);"></i>
            <span>Proveedores</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-list"style="color:rgb(240, 143, 16);"></i>
            <span>Ordenes de compras</span></a>
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
$addOrderQuery = "SELECT * FROM tbl_menu;";
$resultado= mysqli_query($sqlconnection,$addOrderQuery);

while ($row1 = mysqli_fetch_array($resultado)) {
      $id_menu = $row1['menuID'];
      $categoria = $row1['menuName'];
      echo "<option value='where menuID = $id_menu'>$categoria</option>";
   }
   ?> 
      <!-- Otras opciones de campos según la tabla seleccionada -->
</select>
<br>

        <input type="button" class="btn btn-success btn-sm " value="Procesar" onclick="Mostrarinventario()" >
        
    </form>

    <div id="resultados">
        <!-- Aquí se mostrarán los resultados -->
    </div>
    

                    </tbody>
              </table>



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

    <!-- Modal para Agregar -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Agregar Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="POST">
                    <!-- Categoría -->
                    <div class="mb-3">
                        <label for="menuID" class="form-label">Categoría</label>
                        <select class="form-control" id="menuID" name="menuID" required>
                            <?php
                                // Obtén las categorías desde la base de datos
                                $consultaCategorias = "SELECT * FROM tbl_menuitem where itemID = 76";
                                $result = $sqlconnection->query($consultaCategorias);
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['itemID']}'>{$row['menuItemName']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <!-- Nombre del Producto -->
                    <div class="mb-3">
                        <label for="menuItemName" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="menuItemName" name="menuItemName" required>
                    </div>
                    
                    <!-- Cantidad Disponible -->
                    <div class="mb-3">
                        <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
                        <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Editar -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    <input type="hidden" id="editItemID" name="itemID"> <!-- Campo oculto para el ID del producto -->

                    <div class="mb-3">
                        <label for="editMenuItemName" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="editMenuItemName" name="menuItemName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCantidadDisponible" class="form-label">Cantidad Disponible</label>
                        <input type="number" class="form-control" id="editCantidadDisponible" name="cantidad_disponible" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMenuID" class="form-label">Categoría</label>
                        <select class="form-control" id="editMenuID" name="menuID" required>
                            <?php
                                // Obtén las categorías desde la base de datos
                                $consultaCategorias = "SELECT * FROM tbl_menu";
                                $result = $sqlconnection->query($consultaCategorias);
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['menuID']}'>{$row['menuName']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>



  <!-- Función javascrpit mostrar inventario-->
<script>  
function Mostrarinventario() {
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
<script>
    // Captura el evento cuando se hace clic en el botón de "Agregar"
    $('#addModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que abrió el modal
        var itemID = button.data('id'); // Obtiene el id del item desde el botón
        
        // Opcionalmente, puedes pasar el ID a un campo oculto en el formulario del modal si es necesario
        // $('#itemID').val(itemID); // Si es que el formulario tiene un campo oculto llamado itemID
    });

    // Acción de envío del formulario (agregar)
    $('#addForm').on('submit', function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario (recarga de página)

        var formData = $(this).serialize(); // Obtener los datos del formulario

        $.ajax({
            url: 'agregar_producto.php', // Archivo PHP que procesará la inserción
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Cerrar el modal
                    $('#addModal').modal('hide');
                    
                    // Aquí puedes actualizar la tabla sin recargar la página, usando JavaScript o AJAX para recargar los datos
                    alert("Producto agregado con éxito.");
                    location.reload(); // Recargar la página para mostrar el nuevo producto
                } else {
                    alert("Error al agregar el producto.");
                }
            },
            error: function() {
                alert("Error al enviar la solicitud.");
            }
        });
    });
</script>



<!-- modal para editar -->
<script>
    // Captura el evento cuando se hace clic en el botón de "Editar"
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que abrió el modal
        var itemID = button.data('id'); // Obtiene el id del item desde el botón
        
        // Realiza la consulta AJAX para obtener los datos del producto
        $.ajax({
            url: 'obtener_producto.php', // El archivo PHP que obtiene los datos del producto
            type: 'GET',
            data: { itemID: itemID },
            success: function(response) {
                var producto = JSON.parse(response);
                if (producto) {
                    // Llena los campos del modal con los datos obtenidos
                    $('#editItemID').val(producto.itemID);
                    $('#editMenuItemName').val(producto.menuItemName);
                    $('#editCantidadDisponible').val(producto.cantidad_disponible);
                    $('#editMenuID').val(producto.menuID); // Esto selecciona la categoría correcta
                } else {
                    alert("Error al obtener los datos del producto.");
                }
            },
            error: function() {
                alert("Error en la solicitud.");
            }
        });
    });

    // Acción de envío del formulario de edición
    $('#editForm').on('submit', function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario (recarga de página)

        var formData = $(this).serialize(); // Obtener los datos del formulario

        $.ajax({
            url: 'editar_producto.php', // Archivo PHP que procesará la actualización
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Cerrar el modal
                    $('#editModal').modal('hide');
                    
                    // Actualiza la tabla o recarga la página
                    alert("Producto actualizado con éxito.");
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert("Error al editar el producto.");
                }
            },
            error: function() {
                alert("Error al enviar la solicitud.");
            }
        });
    });
</script>




    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

  </body>

</html>