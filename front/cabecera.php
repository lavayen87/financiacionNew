    
    <a class="navbar-brand" href="financiacion.php">
      <label style="color: white;">Sistema Web</label> 
      <img src="../img/favicon.png" style="margin-left: 10px;" width="35" height="35">
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
        class="fas fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
           <label style="color: white;"><?php echo $nombre ?></label> 
          <i class="fas fa-user fa-fw" style="color: white;"></i></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Configuración</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="../back/logout.php">Salir</a>
        </div>
      </li>
    </ul> 