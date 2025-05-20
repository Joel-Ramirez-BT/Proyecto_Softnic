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

    <style>
      /* Aquí está la modificación para poner las tablas lado a lado */
      #orderContainer {
        display: flex;
        gap: 20px;
        align-items: flex-start;
      }
      .table-wrapper {
        width: 50%;
      }
    </style>

  </head>

  <body id="page-top">

  
  <?php 
  //Incluir la barra superior de navegacion
  include_once('../include/navbar.php');?>


    <div id="wrapper">

      <!------------------ Sidebar ------------------->
    <?php
  include_once("./../include/sidebar.php");
?>

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

          <!-- Contenedor que envuelve las dos tablas -->
          <div id="orderContainer">

            <div class="table-wrapper">
              <div class="card mb-3">
                  <div class="card-header">
                      <i class="fas fa-utensils"></i> Tomar Órdenes
                  </div>
                  <div class="card-body">
                      
                      <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar por ID o nombre..." onkeyup="filterMenuItems()">

                      <div id="menuContainer" class="row">
                          <?php
                          $menuItemQuery = "SELECT ItemID, menuItemName, price FROM tbl_menuitem ORDER BY menuItemName ASC";
                          $result = $sqlconnection->query($menuItemQuery);

                          while ($item = $result->fetch_assoc()) {
                              $id = htmlspecialchars($item['ItemID']);
                              $name = htmlspecialchars($item['menuItemName']);
                              $price = htmlspecialchars($item['price']);
                              echo "
                              <div class='col-md-4 menu-item' data-id='{$id}' data-name='{$name}'>
                                  <button class='_favorit' style='margin-bottom:10px; background-color:#ffffff; color:#000; white-space: normal;' onclick='setQty({$id})'>
                                      {$name} <br>
                                      <small>Precio: C$ {$price}</small>
                                  </button>
                              </div>";
                          }
                          ?>
                      </div>

                      <table id="tblItem" class="table table-responsive table-bordered" width="100%" cellspacing="0"></table>

                      <div id="qtypanel" hidden>
                          Cantidad:
                          <input id="qty" required type="number" min="1" max="50" name="qty" value="1" />
                          <button class="btn btn-info" onclick="insertItem()">Listo</button>
                          <br><br>
                      </div>
                  </div>
              </div>
            </div>

            <div class="table-wrapper">
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

          </div> <!-- Fin orderContainer -->

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
    var currentItemName = '';
    var currentItemPrice = 0;

    function filterMenuItems() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const items = document.getElementsByClassName("menu-item");

        for (let i = 0; i < items.length; i++) {
            const name = items[i].getAttribute("data-name").toLowerCase();
            const id = items[i].getAttribute("data-id").toLowerCase();

            if (name.includes(input) || id.includes(input)) {
                items[i].style.display = "block";
            } else {
                items[i].style.display = "none";
            }
        }
    }

    function setQty(id) {
        currentItemID = id;

        // Obtener el nombre y precio del producto desde el DOM para mostrar en el panel (opcional)
        var itemDiv = document.querySelector(`.menu-item[data-id='${id}']`);
        if (itemDiv) {
            currentItemName = itemDiv.getAttribute('data-name');
            // Extraemos el precio mostrado en el botón
            currentItemPrice = itemDiv.querySelector('small') ? parseFloat(itemDiv.querySelector('small').textContent.replace('Precio: C$ ', '')) : 0;
        }

        document.getElementById("qtypanel").hidden = false;
        document.getElementById("qty").focus();
    }

 function insertItem() {
    var quantity = parseInt(document.getElementById("qty").value);
    if (isNaN(quantity) || quantity < 1) {
        alert("Ingrese una cantidad válida.");
        return;
    }

    var total = currentItemPrice * quantity;
    var tableBody = document.querySelector("#tblOrderList tbody");

    var newRow = document.createElement("tr");

    newRow.innerHTML = `
        <td>
            <input type="hidden" name="itemID[]" value="${currentItemID}" />
            <input type="hidden" name="itemname[]" value="${currentItemName}" />
            ${currentItemName}
        </td>
        <td>
            <input type="hidden" name="price[]" value="${currentItemPrice}" />
            C$ ${currentItemPrice.toFixed(2)}
        </td>
        <td>
            <input type="number" required min="0.01" max="50" step="0.01" name="itemqty[]" class="form-control" value="${quantity.toFixed(2)}" />
        </td>
        <td>C$ ${total.toFixed(2)}</td>
        <td>
            <button class='btn btn-danger deleteBtn' type='button'><i class='fas fa-times'></i></button>
        </td>
    `;

    tableBody.appendChild(newRow);

    // Añadir evento para borrar fila
    newRow.querySelector('.deleteBtn').addEventListener('click', function() {
        this.closest('tr').remove();
    });

    document.getElementById("qtypanel").hidden = true;
    document.getElementById("qty").value = 1;
}

    // Mostrar u ocultar costo de envío según el tipo de servicio seleccionado
    function mostrarCosto() {
        var servicio = document.getElementById("servicio").value;
        var costoGroup = document.getElementById("costoGroup");
        if (servicio === "Delivery") {
            costoGroup.classList.remove("d-none");
        } else {
            costoGroup.classList.add("d-none");
            document.getElementById("costo").value
= '';
}
}
</script>

</body> </html>
