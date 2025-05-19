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
        <!-- Sección de Productos (Submenús) -->
        <div class="col-lg-6">
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

        <!-- Sección de Órdenes -->
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-bar"></i> 
                    Datos de orden
                </div>
                <div class="card-body">
                    <!-- FORMULARIO CORREGIDO: incluye toda la tabla dentro del form -->
                    <form action="insertorder.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="nombrec" placeholder="Ingrese nombre del cliente" id="nombrec" class="form-control" list="clientes" />
                            <datalist id="clientes">
                                <?php
                                $consulta1 = "SELECT id, nombre, direccion FROM tbl_customer";
                                $stmt = $sqlconnection->prepare($consulta1);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row1 = $result->fetch_assoc()) {
                                    echo "<option value='" . $row1['id'] ." ". $row1['nombre']. "' data-direccion='" . $row1['direccion'] . "'>" . $row1['nombre'] . "</option>";
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

                        <div class="form-group" id="notasGroup">
                            <input type="text" name="notas" id="notas" placeholder="Nota: (Opcional)" class="form-control" min="0" max="100">
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

<?php
include("../include/logout_modal.php");
?>
<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin.min.js"></script>

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