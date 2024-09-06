<?php
include("../functions.php");
include("../dbconnection.php");

// Validar sesión
if (!isset($_SESSION['uid']) || !isset($_SESSION['username']) || !isset($_SESSION['user_level'])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['user_level'] != "admin" && $_SESSION['user_level'] != "staff") {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Order - FOS Staff</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="../css/stylesmac.css" rel="stylesheet">
</head>

<body id="page-top">

    <?php
    // Barra de navegación
    include_once('../include/navbar.php');
    ?>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once('../include/sidebar.php'); ?>

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Panel de Control</a></li>
            <li class="breadcrumb-item active">Orden</li>
        </ol>

        <!-- Page Content -->
        <h1>Administración de Órdenes</h1>
        <hr>
        <p>Administración de nuevas órdenes en esta página.</p>

        <div class="row">
            <!-- Sección de Menús -->
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

            <!-- Sección de Órdenes -->
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-chart-bar"></i> 
                        Datos de orden
                    </div>
                    <div class="card-body">
                        <form action="insertorder.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="nombrec" placeholder="Ingrese nombre del cliente" id="nombrec" class="form-control" list="clientes" />
                                <datalist id="clientes">
                                    <?php
                                    $consulta1 = "SELECT nombre, direccion FROM tbl_customer";
                                    $stmt = $sqlconnection->prepare($consulta1);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row1 = $result->fetch_assoc()) {
                                        echo "<option value='" . $row1['nombre'] . "' data-direccion='" . $row1['direccion'] . "'>" . $row1['nombre'] . "</option>";
                                    }
                                    $stmt->close();
                                    ?>
                                </datalist>
                            </div>


                            <div class="form-group">
                                <input type="text" name="direccion" placeholder="Dirección" id="direccion" class="form-control" />
                            </div>


                            <script>
 $(document).ready(function() {
   $('#nombrec').on('input', function() {
      var selectedCliente = $(this).val();
      var direccionCliente = $('#clientes option').filter(function() {
         return $(this).val() === selectedCliente;
      }).data('direccion');
      
      if(direccionCliente) {
         $('#direccion').val(direccionCliente);
      } else {
         $('#direccion').val('');  // Limpiar si no coincide
      }
   });
});

</script>


                            <div class="form-group">
                                <select class="form-control" name="forma_pago" id="forma_pago" required>
                                    <option value=''>Forma de pago:</option>
                                    <option value='Contado'>De contado</option>
                                    <option value='Credito'>Al Crédito</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control" name="servicio" id="servicio" onchange="mostrarCosto()" required>
                                    <option value=''>Selecciona el tipo de servicio:</option>
                                    <option value='Delivery'>Delivery</option>
                                    <?php
                                    $consulta2 = "SELECT nombre_table, capacidad FROM tbl_table";
                                    $stmt = $sqlconnection->prepare($consulta2);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['nombre_table'] . "'>" . $row['nombre_table'] . "</option>";
                                    }
                                    $stmt->close();
                                    ?>
                                </select>
                            </div>

                            <div class="form-group d-none" id="costoGroup">
                                <input type="number" name="costo" id="costo" placeholder="Costo de envío (C$)" class="form-control" min="0" max="100">
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

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin.min.js"></script>

    <script>
        var currentItemID = null;

        function displayItem(id) {
            $.ajax({
                url: "displayitem.php",
                type: 'POST',
                data: {
                    btnMenuID: id
                },
                success: function(output) {
                    $("#tblItem").html(output);
                }
            });
        }

        function insertItem() {
            var id = currentItemID;
            var quantity = $("#qty").val();
            $.ajax({
                url: "displayitem.php",
                type: 'POST',
                data: {
                    btnMenuItemID: id,
                    qty: quantity
                },
                success: function(output) {
                    $("#tblOrderList").append(output);
                    $("#qtypanel").prop('hidden', true);
                }
            });
            $("#qty").val(1);
        }

        function setQty(id) {
            currentItemID = id;
            $("#qtypanel").prop('hidden', false);
        }

        function mostrarCosto() {
    var servicioSeleccionado = document.getElementById("servicio").value;
    var costoGroup = document.getElementById("costoGroup");

    if (servicioSeleccionado === "Delivery") {
        costoGroup.classList.remove("d-none");
    } else {
        costoGroup.classList.add("d-none");
    }
}


        $(document).on('click', '.deleteBtn', function(event) {
            event.preventDefault();
            $(this).closest('tr').remove();
            return false;
        });
    </script>

</body>

</html>