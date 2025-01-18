<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Restaurante 3.0/dbconnection.php');


// Verificar la conexión
if ($sqlconnection->connect_error) {
  die("Conexión fallida: " . $sqlconnection->connect_error);
}

// Consulta para obtener el nombre_pymes
$consulta_pymes = "SELECT nombre_pymes FROM tbl_configuracion";
$result = $sqlconnection->query($consulta_pymes);

// Verificar si hay resultados
if ($result->num_rows > 0) {
  // Obtener y mostrar el resultado
  $resultado_pymes = $result->fetch_assoc();
      
}


?>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="index.php">
        <?php echo isset($resultado_pymes['nombre_pymes']) ? 'Restaurante | '.$resultado_pymes['nombre_pymes'] : 'Nombre no disponible'; ?>
    </a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Icono de notificaciones -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw" style="color: #f39c12;"></i><br>
                
                <!-- Contador de notificaciones -->
                <span class="badge badge-danger badge-counter">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown">
                <h6 class="dropdown-header text-white">Notificaciones:</h6>
                <a class="dropdown-item text-white" href="#">Nueva orden recibida</a>
                <a class="dropdown-item text-white" href="#">Mensaje nuevo de cliente</a>
                <a class="dropdown-item text-white" href="#">Actualización de inventario</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-white" href="#">Ver todas las notificaciones</a>
            </div>
        </li>
        <!-- Icono de usuario -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw" style="color: #2dfb31;"></i>
            </a>
        </li>
    </ul>
</nav>
