
<?php 
  include('../conexion.php');
  $qry = "SELECT descripcion FROM roles WHERE id_rol = '$id_rol'";
  $res = mysqli_query($connection,$qry);
  $datos = mysqli_fetch_array($res);
  $rol = $datos['descripcion'];
?>
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading"> 
              <table> 
                  <tr> 
                    <td> <img src="../img/user.png" height="50" width="50"> </td>
                    <td> <label style="float: right; color: aqua; margin-left: 5px"><?php echo $nombre?></label></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td> <label style="float: right; margin-left: 5px"><?php echo $rol;?></label></td>
                  </tr>
              </table>
              
              <hr>
            </div>
            <!-- <a class="nav-link" href="index.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Administrar
            </a> -->
            <!-- <div class="sb-sidenav-menu-heading">pantallas</div> -->
            
            <!-- <a class="nav-link" href="financiacion.php">
              <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
              Inicio
            </a> -->
            
            <a class="nav-link" href="financiacion.php">
              <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
              Financiación
            </a>
            <a class="nav-link" href="info_loteos.php">
                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                Info y Planos
            </a>
            <?php  
              if( $id_rol == 1 )
              {     
            ?>
                
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                  aria-expanded="false" aria-controls="collapseLayouts">
                  <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                  Administrar
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="loteos.php">Loteos</a>
                    <a class="nav-link" href="lotes_edicion.php">Lotes</a>
                    <a class="nav-link" href="lotes_disponibles.php">Lotes disponibles</a>
                    <a class="nav-link" href="lotes_seniados.php">Lotes señados</a>
                    <a class="nav-link" href="cargar_lotes.php">Crear Lotes</a>
                    <a class="nav-link" href="usuarios.php">Usuarios</a>
                    <!-- <a class="nav-link" href="tasainteres.php">Tasa Interes</a> -->               
                  </nav>
                </div>
            <?php 
              }
              else
              { 
            ?>
              <!-- Seccion Usuarios -->             
              <a class="nav-link" href="lotes_disponibles.php">
                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                Lotes disponibles
              </a>
            <?php 
              }
            ?>
            

            <!-- //////***////// -->
            <!-- SUBMENU -->
            <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
              Pages 
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth"
                  aria-expanded="false" aria-controls="pagesCollapseAuth">
                  Authentication
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                  data-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="login.html">Login</a>
                    <a class="nav-link" href="register.html">Register</a>
                    <a class="nav-link" href="password.html">Forgot Password</a>
                  </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError"
                  aria-expanded="false" aria-controls="pagesCollapseError">
                  Error
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                  data-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="401.html">401 Page</a>
                    <a class="nav-link" href="404.html">404 Page</a>
                    <a class="nav-link" href="500.html">500 Page</a>
                  </nav>
                </div>
              </nav>
            </div>     -->        

            <!-- <div class="sb-sidenav-menu-heading">Addons</div>
            
            <a class="nav-link" href="tablas.php">
              <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
              Tablas
            </a> -->
            <!-- //////***////// -->
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <!-- <div class="small">Logged in as:</div>
          Start Bootstrap -->
        </div>
      </nav>