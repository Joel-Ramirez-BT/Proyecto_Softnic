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
<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "1234", "fosdb");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener el número de notificaciones no leídas
$sql_contador = "SELECT COUNT(*) as total_no_leidas FROM tbl_notificaciones WHERE leido = 0";
$resultado_contador = $conexion->query($sql_contador);
$total_no_leidas = $resultado_contador->fetch_assoc()['total_no_leidas'];

// Obtener las notificaciones más recientes
$sql_notificaciones = "SELECT mensaje, fecha FROM tbl_notificaciones ORDER BY fecha DESC LIMIT 5";
$resultado_notificaciones = $conexion->query($sql_notificaciones);
?>


<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="index.php">
        <?php echo isset($resultado_pymes['nombre_pymes']) ? 'Farmacia | '.$resultado_pymes['nombre_pymes'] : 'Nombre no disponible'; ?>
    </a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Icono de notificaciones -->
        <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw" style="color: #f39c12;"></i><br
        
        <!-- Contador dinámico -->
        <span class="badge badge-danger badge-counter"><?php echo $total_no_leidas; ?></span> 
    </a>
    
    <div class="dropdown-menu dropdown-menu-right bg-dark text-white" aria-labelledby="notificationsDropdown">
        <h6 class="dropdown-header text-white">Notificaciones:</h6>
        <?php while ($fila = $resultado_notificaciones->fetch_assoc()): ?>
            <a class="dropdown-item text-white" href="#"><?php echo $fila['mensaje']; ?></a>
        <?php endwhile; ?>
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
<script>
    //Cuando el usuario abra el menú de notificaciones, puede marcar las notificaciones como leídas mediante AJAX o una petición PHP.
document.getElementById('notificationsDropdown').addEventListener('click', function() {
    fetch('marcar_notificaciones.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        console.log('Notificaciones marcadas como leídas.');
    })
    .catch(error => console.error('Error:', error));
});


//el contador se actualice en tiempo real, puedes usar setIntervalAJAX
setInterval(() => {
    fetch('obtener_contador.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.badge-counter').textContent = data.total_no_leidas;
        });
}, 5000);


</script>
