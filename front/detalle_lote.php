<?php

  session_start();

  if (!isset($_SESSION['active'])) 
  {
    header('Location: index.php');
  }

  $nombre = $_SESSION['nombre'];
  $id_rol = $_SESSION['id_rol'];
  $id_usuario = $_SESSION['id_usuario'];

  $id_lote = 0;
  $lote = "";

  if( isset($_GET['id'])  )
  {
    if($_GET['id'] > 0)
    {
      $id_lote = $_GET['id'];

      include ('../conexion.php');
      include ('../funciones.php');

      $qry = "SELECT *,
              (SELECT descripcion FROM estado_lotes WHERE id_estado = l.id_estado) as estado 
              FROM lotes l 
              WHERE id_lote = '$id_lote'";
      $res = mysqli_query($connection, $qry);

      $datos = mysqli_fetch_array($res);
      $loteo =  $datos['loteo'];
      $cod_lote = $datos['codigo_lote'];
      $estado = $datos['estado'];
      $frente = $datos['frente'];
      $esquina = $datos['esquina'];
      $precio = "$".number_format($datos['preciolista'],2,',','.');

      $qry = "SELECT * FROM financiacion WHERE id_lote = '$id_lote'";
      $res = mysqli_query($connection, $qry);

      $infolote = get_infoLote($id_lote);

      $datos = $res->num_rows > 0 ? mysqli_fetch_array($res) : 0;
      $lote = $res->num_rows > 0 ? $datos['codigo_lote'] : $infolote['codigo_lote'];
      $anticipo = $res->num_rows > 0 ? number_format($datos['anticipo'],2,',','.') : "";
      $saldoafinanciar = $res->num_rows > 0 ? number_format($datos['saldo_financiar'],2,',','.') : "";
      $cuotas = $res->num_rows > 0 ? $datos['cuotas'] : "";
      $montofinanciado = $res->num_rows > 0 ? number_format($datos['monto_financiado'],2,',','.') : "";
      $valorcuota = $res->num_rows > 0 ? number_format($datos['valor_cuota'],2,',','.') :"";
      $total = $res->num_rows > 0 ? number_format($datos['total_operacion'],2,',','.') : "";

      mysqli_close($connection); 
    }  
    else header('Location: lotes_seniados.php');
  }
  

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
  <style>
    .txtestado{
      color: red;
    }
  </style>
</head>

<body class="sb-nav-fixed">

  <!-- cabecera -->
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <?php include('cabecera.php') ?>
  </nav>

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <!-- menú lateral -->
      <?php require 'menu.php' ?>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          <h2 class="mt-4"><?php echo "Datos de Financiación lote ". strtoupper($lote)?> </h2>
          
          <hr>      

              <!-- Datos de lote señado -->  
              <div class="alert alert-primary" role="alert" id="div_fcontenido" style="text-align: center;">

                <div class="row" style="padding-bottom: 5px">
                  <div style="padding-left: 12px;">
                  <?php 
                    // BOTON ORIGINAL PARA DESCARGA : TERMINAR ACCION CUANDO SEA SOLICITADO POR LOS USUARIOS
                    // echo "<a href='../plantillaspdf/vistas/vista_lote_financiado.php?id=".$id_lote."' 
                    //          class='btn btn-primary btn-sm'
                    //          target='_banck'>
                    //         Descargar <i class='fa fa-download'></i> 
                    //       </a>";
                  ?>  
                  </div>              
                </div>
                
                <div class="row">

                   <!-- Datos loteo -->
                  <div class="col-md-4">
                    <div class="card">
                         
                      <ul class="list-group">
                        <li class="list-group-item">
                          <strong class="col-md-2" >Información del lote</strong >
                        </li>
                        <li class="list-group-item">Loteo : <strong class="col-md-2 txtloteo"><?php echo $loteo ?></strong ></li>
                        <li class="list-group-item">Lote : <strong class="col-md-2 txtlote" ><?php echo $cod_lote ?></strong></li>
                        <li class="list-group-item">Estado : <strong class="col-md-2 txtestado" ><?php echo $estado ?></strong></li>
                        <li class="list-group-item">Frente : <strong class="col-md-2 txtfrente" ><?php echo $frente ?></strong></li>
                        <li class="list-group-item">Esquina : <strong class="col-md-2 txtesquina" ><?php echo $esquina ?></strong></li>
                        <li class="list-group-item">Precio : <strong class="col-md-2 txtpreciolista" ><?php echo $precio ?></strong></li>
                      </ul>

                    </div>
                  </div>

                  <!-- --------------------------------------------------------------  -->

                  <!-- Datos financiacion -->
                  <div class="col-md-7">

                    <div class="card" style="padding-top: 10px; width: 500px;">
                        <div class="form-group row">
                          <strong class="col-sm-4 col-form-label">Anticipo</strong>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" readonly style="background-color: white;"
                            value = "<?php echo '$'.$anticipo ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <strong class="col-sm-4 col-form-label">Saldo a financiar</strong>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" readonly style="background-color: white;"
                            value = "<?php echo '$'.$saldoafinanciar ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <strong class="col-sm-4 col-form-label">N° de cuotas</strong>
                          <div class="col-sm-6">
                            <input type="number" class="form-control" readonly style="background-color: white;"
                            value = "<?php echo $cuotas ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <strong class="col-sm-4 col-form-label">Monto financiado</strong>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" readonly style="background-color: white;"
                            value = "<?php echo '$'.$montofinanciado ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <strong class="col-sm-4 col-form-label">Valor de la cuota</strong>
                          <div class="col-sm-6">
                            <input type="text" class="form-control"  readonly style="background-color: white;"
                            value = "<?php echo '$'.$valorcuota ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <strong class="col-sm-4 col-form-label">Total de la operación</strong>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" readonly style="background-color: white;"
                            value = "<?php echo '$'.$total ?>">
                          </div>
                        </div>
                    </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="../assets/demo/datatables-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>

    $(document).ready(function() {
      
    });
  </script>
</body>

</html>