
      <!------------------ Sidebar ------------------->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Control</span>
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="menu.php">
            <i class="fas fa-fw fa-utensils"style="color: #2dfb31;"></i>
            <span>Menú</span></a>
        </li>

         <li class="nav-item">
          <a class="nav-link" href="order.php">
            <i class="fas fa-duotone fa-table"style="color: #2dfb31;"></i>
            <span>Ordenar</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="facturar.php">
          <i class="fas fa-regular fa-print" style="color: #2dfb31;"></i>
            <span>Facturar</span></a>
        </li>

      <!--  
        <li class="nav-item">
          <a class="nav-link" href="sales.php">
            <i class="fas fa-fw fa-chart-area"style="color: #2dfb31;"></i>
            <span>Finanzas</span></a>
        </li>
-->
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="sales.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-chart-area" style="color: #2dfb31;"></i>
                    <span>Finanzas</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="./inventario/index.php">Inventario</a>
                    <a class="dropdown-item" href="sales.php">Estadisticas</a>
                    <a class="dropdown-item" href="Statement.php">Cuentas pendientes</a>
                </div> 
            </li>


<li class="nav-item">
          <a class="nav-link" href="tables.php">
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

<!--Estilos del menu de expansion en configuraciones -->
        <style>
        .dropdown-menu {
            background-color: #00188f; /* Negro */
            color: #fff; /* Blanco para el texto */
        }
        .dropdown-item:hover {
            background-color: #555; /* Color de fondo al pasar el mouse, opcional */
        }
    </style>

      
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-wrench" style="color: #2dfb31;"></i>
                    <span>Ajustes</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="staff.php">Empleados</a>
                    <a class="dropdown-item" href="configuration.php">Más</a>
                  <a class="dropdown-item" href="desing.php">Diseño</a>  
                  <a class="dropdown-item" href=".#">Idiomas</a>
				  <a class="dropdown-item" href="backup.php">Backup</a>  
                    
                </div>
            </li>
        </ul>
   


        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-power-off"style="color: #FF0000;"></i>
            <span>Cerrar Sesión</span>
          </a>
        </li>

      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

