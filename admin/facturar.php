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

    <title>Finanzas | Softnic</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <link href="../css/stylesmac.css" rel="stylesheet">

  </head>
 

  <body id="page-top">

  <?php     
include_once('../include/navbar.php');
?>

    <div id="wrapper">

      <!------------------ Sidebar ------------------->
      <?php     
include_once('../include/sidebar.php');
?>

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Panel de Control</a>
            </li>
            <li class="breadcr umb-item active">Facturas</li>
          </ol>

          <!-- Page Content -->
          <h1>Administración de Facturas</h1>
          <hr>
          <p>Todos las facturas se encuentran aquí.</p>

          <div class="card mb-3">
            <div class="card-header">
            <i class="fas fa-regular fa-print" ></i>
              Lista de Órdenes y facturas</div>
            <div class="card-body">
              <table id="tblCurrentOrder" class="table table-responsive table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <th># Orden</th>

                      <th>Nombre de Producto</th>
                      <th class='text-center'>Cantidad</th>
                      <th class='text-center'>Precio total</th>
                      <th class='text-center'>Fecha</th>
                      <th class='text-center'>Opciones</th>
                    
                    </thead>
                    
                    <tbody id="tblBodyCurrentOrder">
                      <?php 
                      $displayOrderQuery =  "
                        SELECT o.orderID, o.nombre,m.menuName, OD.itemID,MI.menuItemName,OD.quantity,O.status,mi.price ,o.order_date
                        FROM tbl_order O
                        LEFT JOIN tbl_orderdetail OD
                        ON O.orderID = OD.orderID
                        LEFT JOIN tbl_menuitem MI
                        ON OD.itemID = MI.itemID
                        LEFT JOIN tbl_menu M
                        ON MI.menuID = M.menuID ORDER BY orderID DESC
                        ";

                      if ($orderResult = $sqlconnection->query($displayOrderQuery)) {
                          
                        $currentspan = 0;
                        $total = 0;

                        //if no order
                        if ($orderResult->num_rows == 0) {

                          echo "<tr><td class='text-center' colspan='7' >Actualmente no hay pedido en este momento. </td></tr>";
                        }

                        else {
                          while($orderRow = $orderResult->fetch_array(MYSQLI_ASSOC)) {

                            //basically count rowspan so no repetitive display id in each table row
                            $rowspan = getCountID($orderRow["orderID"],"orderID","tbl_orderdetail"); 

                            if ($currentspan == 0) {
                              $currentspan = $rowspan;
                              $total = 0;
                            }

                            //get total for each order id
                            $total += ($orderRow['price']*$orderRow['quantity']);

                            echo "<tr>";

                            if ($currentspan == $rowspan) {
                              echo "<td rowspan=".$rowspan."># ".$orderRow['orderID']."</td>";
                            }

                            echo "
                              <td>".$orderRow['menuName']."</td>
                              <td class='text-center'>".$orderRow['menuItemName']."</td>
                              <td class='text-center'>".$orderRow['quantity']."</td>
                            ";

                            if ($currentspan == $rowspan) {

                              $color = "badge";

                              switch ($orderRow['status']) {
                                case 'waiting':
                                  $color = "badge badge-warning";
                                  break;
                                
                                case 'preparing':
                                  $color = "badge badge-primary";
                                  break;

                                case 'ready':
                                  $color = "badge badge-success";
                                  break;

                                case 'cancelled':
                                  $color = "badge badge-danger";
                                  break;

                                case 'finish':
                                  $color = "badge badge-success";
                                  break;

                                case 'Completed':
                                  $color = "badge badge-success";
                                  break;
                              }

                              

                              echo "<td rowspan=".$rowspan." class='text-center'>".getSalesTotal($orderRow['orderID'])."</td>";

                              echo "<td rowspan=".$rowspan." class='text-center'>".$orderRow['order_date']."</td>";

                                $id=$orderRow['orderID'];

                               echo "<td rowspan=".$rowspan." class='text-center'><a href='./factura/factura.php?id=$id' class='btn btn-primary'><i class='fas fa-regular fa-print' style=''></i></a>
                               <a href='./deletefactura.php?id=$id' class='btn btn-danger'><i class='fas fa-regular fa-trash' style=''></i></a>
                               <a href='./editorder.php?id=$id' class='btn btn-success'><i class='fas fa-regular fa-plus' style=''></i></a>";
                              echo "</td>";

                            }

                            echo "</tr>";

                            $currentspan--;
                          }
                        }
                        } 
                      ?>
                    </tbody>
              </table>
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