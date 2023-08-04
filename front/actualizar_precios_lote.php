<?php

  session_start();

  if (!isset($_SESSION['active'])) {

    header('Location: ../index.php');

  }

  $nombre = $_SESSION['nombre'];
  $id_rol = $_SESSION['id_rol'];
  $id_usuario = $_SESSION['id_usuario'];

  $id_lote = 0;
  $lote = 0;
   
  if(isset($_GET['id']) && $_GET['id'] > 0 )
  {
    $id_lote = $_GET['id'];

    include ('../conexion.php');
    
    $qry = "SELECT codigo_lote FROM lotes WHERE id_lote = '$id_lote'";
    $res = mysqli_query($connection, $qry);

    $datos = mysqli_fetch_array($res);
    $lote =  $datos['codigo_lote'];
    mysqli_close($connection);                           
  }
  else header('Location: loteos.php');
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
          <h2 class="mt-4"><?php echo "Actualizar precio ".strtoupper($lote) ?></h2>
          <hr>

          <input type="text" id="lote" value="<?php echo $lote ?>" style="display: none;">

          <div class="alert alert-warning" role="alert" id="div_contenido" style="text-align: center;">
                Este módulo permite actualizar el precio por metro cuadrado de un lote.
          </div>
          <br>
          <div class="alert alert-primary" role="alert" id="div_contenido" style="text-align: center;">
            
            <div class="row">
              <div class="col-md-0">
                <strong>precio</strong>
              </div>  
              <div class="col-md-2">
                <input type="number" class="form-control boxprecio">
              </div> 
              <div class="col-md-0">
                <button class="btn btn-primary" id="btnRealizar">
                  Realizar <i class="fa fa-check"></i>
                </button>
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

      $(document).ready(function() {

        var precio = parseInt(0), lote = parseInt(0);
        datos = [];

         //confirmar actualizacion de precios
        $('#btnRealizar').on('click', function(){

          if( parseInt($(".boxprecio").val()) >= parseInt(0) )
          {
            precio = parseInt($(".boxprecio").val());
            lote = $('#lote').val();

            datos.push(id_loteo); 
            datos.push(porcentaje);
            
            $.post("../back/actualizar_precios.php", {'datos': JSON.stringify(datos)}, res => {
              console.log(res);
              if(parseInt(res) > parseInt(0))
              {
                Swal.fire({
                  //position: 'top-end',
                  icon: 'success',
                  title: 'Precios actualizados correctamente.',
                  showConfirmButton: false,
                  timer: 1600
                })

                $(".boxporcentaje").val(0);
                datos = [];
              }
              else
              {            
                Swal.fire({
                  //position: 'top-end',
                  icon: 'error',
                  title: 'Error al guardar los datos...intente nuevamente.',
                  showConfirmButton: false,
                  timer: 1600
                })

                $(".boxporcentaje").val(0);
                datos = [];
              }
            }); 
                
          } 
          else 
          {
            Swal.fire({
              //position: 'top-end',
              icon: 'warning',
              title: 'Debe ingresar el porcentaje de incremento.',
              showConfirmButton: false,
              timer: 1600
            })
          }
        })

      })
    })
  </script>
</body>

</html>