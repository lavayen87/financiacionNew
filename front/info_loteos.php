<?php

  session_start();

  if (!isset($_SESSION['active'])) {

    header('Location: ../index.php');

  }

  $nombre = $_SESSION['nombre'];
  $id_rol = $_SESSION['id_rol'];
  $id_usuario = $_SESSION['id_usuario'];

  $link_Airampo  = "https://drive.google.com/file/d/1djsOb5xwc8IvkGT0ULFMakn3MgCWq0y3/view?usp=share_link";
  $link_BClima   = "https://drive.google.com/file/d/1-1-J-TMedtivMkscOT-ajHsjiMMEEmN8/view?usp=share_link";
  $link_Libertad = "https://drive.google.com/file/d/1-1_jq4TtHdUhANt-oSc3eQBPOGPowMfa/view?usp=share_link";
  $link_PMarcado = "https://drive.google.com/file/d/1-4RMgvLFBZ8al2i80gH2DVMSaHPwmGdA/view?usp=share_link";
  $link_Terranova= "https://drive.google.com/file/d/14XK77mz1fu162X1sHffEMMZvF9R6Kbxb/view?usp=share_link"; 
  
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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
          <h2 class="mt-4">Info y Planos</h2>
          
          <hr>

          <!-- cards -->
          <!--  <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card bg-primary text-white mb-4">
                <div class="card-body">Airampo</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="#">View Details</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-warning text-white mb-4">
                <div class="card-body">Warning Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="#">View Details</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-success text-white mb-4">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="#">View Details</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="#">View Details</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- -->
          
          <div class="alert alert-primary" role="alert">
            <div class="row g-2 align-items-center">
                  
                <div class='accordion accordion-flush' id='flush'>
                  <?php  
                  
                    include('../conexion.php');
                    include('../funciones.php');
                    $id = 0;
                    $link = "";
                    $anticipo_uno = ""; 
                    $anticipo_dos = ""; 
                    $qry = "SELECT * 
                            FROM loteos l inner join info_loteos i 
                            on l.id_loteo = i.id_loteo 
                            order by l.loteo";
                    $res = mysqli_query($connection,$qry);
                    while ( $datos = mysqli_fetch_array($res) )
                    {                    
                      $id++;   
                      $texto1 = $datos['anticipo_uno'];    
                      $texto2 = $datos['anticipo_dos'];                                                       
                      $anticipo_uno = lineas($texto1);
                      $anticipo_dos = lineas($texto2); 
                         
                      switch ($id) {
                        case 1:
                          $link = $link_Airampo;
                          break;
                        case 2: 
                          $link = $link_BClima;
                          break;
                        case 3: 
                          $link = $link_Libertad;
                          break;
                        case 4: 
                          $link = $link_PMarcado;
                          break;
                        case 5: 
                          $link = $link_Terranova;
                          break;
                      }
                      echo "<div class='accordion-item'>
                                <h2 class='accordion-header' id='flush-heading'".$id."'>
                                  <button class='accordion-button collapsed ac_loteo' 
                                          id='".$id."' 
                                          value='0' 
                                          type='button' 
                                          data-bs-toggle='collapse' 
                                          data-bs-target='#flush-collapse".$id."' 
                                          aria-expanded='false' 
                                          aria-controls='flush-collapse".$id."'>
                                          <b>".$datos['loteo']."</b>
                                  </button>
                                </h2>
                                <div id='flush-collapse".$id."' 
                                          class='accordion-collapse collapse' 
                                          aria-labelledby='flush-heading".$id."' 
                                          data-bs-parent='#flush'>
                                  <div class='accordion-body'>
                                          <ul>
                                            <li>".$datos['cabecera']."</li></br>
                                            <li>".$datos['anticipo_minimo']."</li></br>
                                            <li>".$datos['posesion']."</li></br>
                                            <li>".$anticipo_uno."</li></br>
                                            <li>".$anticipo_dos."</li></br>
                                            <li>".$datos['servicios']."</li>
                                            <li>
                                              <a href='".$link."' target='_blank' title='Mapa ".$datos['loteo']."' 
                                                class='link-offset-2 link-underline link-underline-opacity-0'>
                                                Descargar Plano <img width='50' hight='50' src='../img/map.png'/>
                                              </a>
                                            </li>
                                          </ul>                                    
                                  </div>
                                </div>
                            </div>";                           
                    }

                    mysqli_close($connection);
                     
                  ?> 
                </div>                

            </div>
          </div>
          
        </div>
      </main>
      <!-- <footer class="py-4 bg-light mt-auto">
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
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
  <!-- <script src="../assets/demo/datatables-demo.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>

    $(document).ready(function() {     

      $('.ac_loteo').on('click', function() {
          
          var id = parseInt( $(this).attr('id') );
          if($(this).val() == 0)
          {            
            $( "button[id="+id+"]" ).css("background-color","#0d6efd");
            $( "button[id="+id+"]" ).css("color","white");
            $(this).val("1");

            $( ".ac_loteo" ).each(function(){
              if(parseInt( $(this).attr('id') ) != id)
              {
                $(this).css("background-color","white");
                $(this).css("color","black");
                $(this).val("0");
              }
            })
          }
          else{
            $( "button[id="+id+"]" ).css("background-color","white");
            $( "button[id="+id+"]" ).css("color","black");
            $(this).val("0");
          }
          
          return false;                 
      });
           
    });
  </script>
</body>

</html>