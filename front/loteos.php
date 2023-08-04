<?php

  session_start();

  if (!isset($_SESSION['active'])) {

    header('Location: ../index.php');

  }

  $nombre = $_SESSION['nombre'];
  $id_rol = $_SESSION['id_rol'];
  $id_usuario = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>WebCost</title>
  <link href="../css/styles.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
    crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
  </script>
</head>

<body class="sb-nav-fixed">

  <!-- cabecera -->
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <?php include('cabecera.php') ?>
  </nav>

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <!-- menú lateral -->
      <?php include('menu.php') ?>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          <h2 class="mt-4">Administrar loteos</h2>
          <hr>
          <div class="alert alert-primary" role="alert" id="div_contenido" style="text-align: center;">
                
                <div class="row">                
                                 
                    <div class="card-body" style="background-color: white;">
                      <div class="table-responsive">
                        <table class="table table-bordered border-primary table-sm" id="lotes" width="100%" cellspacing="0">
                          <thead>
                            <tr>                            
                              <th>Loteo</th>
                              <th>Acciones</th>                                                 
                            </tr>
                          </thead>                      
                          <tbody>         
                            <?php 
                              include('../conexion.php');
                              $qry = "SELECT * FROM loteos"; 
                              $res = mysqli_query($connection,$qry);
                              if($res->num_rows > 0)
                              {
                                while ($datos = mysqli_fetch_array($res)) 
                                {
                                  $id = $datos['id_loteo'];
                                  echo "<tr>                                       
                                        <td>".$datos['loteo']."</td>           
                                        <td>".
                                              "<a href='editar_loteo.php?id=$id' 
                                                class='btn btn-secondary btn-sm'
                                                title='Editar información'>
                                                <i class='fa fa-edit'></i>
                                              </a>
                                              
                                              <a href='actualizar_precios.php?id=$id' 
                                                class='btn btn-info btn-sm precios' 
                                                title='Editar Precios'>
                                                <i class='fa fa-cog'></i>
                                              </a>"
                                              .                                             
                                        "</td>
                                       </tr>";
                                }                               
                              } 
                              mysqli_close($connection);
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                                 
                </div>         

          </div>
          
          
        </div>
      </main>
     <!--  <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website <?php echo date('Y'); ?></div> 
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer> -->
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="../js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="../assets/demo/datatables-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {

      $("#lotes").DataTable({
        "lengthMenu": [ [5, 10], [5, 10] ],
        "language":{
          url:"https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
      })
    })
  </script>
</body>

</html>