<?php
include('../../dbconnection.php'); // Incluye la conexión a la base de datos
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Incluir estilos de mac -->
     <?php include_once('../../css/stylesmac.css');?>

  </head>
<body>
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

      <?php 

$mostar_catgorias = "SELECT * FROM tbl_menu";

if ($result = $sqlconnection->query($displayStaffQuery)) {

  if ($result->num_rows == 0) {
    echo "<td colspan='4'>No tiene empleados disponibles</td>";
  }

  $staffno = 1;
  $staff = $result->fetch_array(MYSQLI_ASSOC)) {
  ?>  
      <tr class="text-center">
        <td><?php echo $staffno++; ?></td>
        <td><?php echo $staff['username']; ?></td>
  


<div class="container mt-5">
  <h3 class="mb-4">Agregar Producto</h3>
  <form>
    <!-- Categoría -->
    <div class="mb-3">
      <label for="categoria" class="form-label">Categoría</label>
      <select class="form-select" id="categoria" name="categoria">
        <option selected disabled>Selecciona una categoría</option>
        <option value="1">Bebidas</option>
        <option value="2">Snacks</option>
        <option value="3">Lácteos</option>
      </select>
    </div>

    <!-- Producto -->
    <div class="mb-3">
      <label for="producto" class="form-label">Producto</label>
      <input type="txt" class="form-control" id="producto" name="producto" placeholder="Ej: Computadoras" min="1" max="20" required>
    </div>

    <!-- Cantidad -->
    <div class="mb-3">
      <label for="cantidad" class="form-label">Cantidad a agregar</label>
      <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ej: 10" min="1" required>
    </div>

    <!-- Botón -->
    <button type="submit" class="btn btn-primary">Agregar</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
