<?php

  session_start();

  if (!isset($_SESSION['active'])) {

    header('Location: index.php');

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
      <?php include ('menu.php') ?>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          <h2 class="mt-4">Cargar lotes</h2>
          <hr>

            <div class="alert alert-primary" role="alert" id="div_contenido" style="text-align: center;">
                
                <div class="row">
                 <!-- Datos financiacion -->
                  <div class="col-md-7">

                    <div class="card" style="padding-top: 10px;">
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Loteo</strong>
                        <div class="col-sm-6">
                          <select class="form-control select_loteo datos">
                            <?php 
                              include('../conexion.php');
                              $qry = "SELECT * FROM loteos";
                              $res = mysqli_query($connection,$qry);
                              if($res->num_rows > 0)
                              {
                                while($datos = mysqli_fetch_array($res))
                                {
                                  echo "<option value=".$datos['id_loteo'].">".$datos['loteo']."</option>";
                                }
                              }
                              mysqli_close($connection);
                             ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Lote</strong>
                        <div class="col-sm-6">
                          <input type="number" class="form-control boxlote datos">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Frente</strong>
                        <div class="col-sm-6">
                          <input type="number" class="form-control boxfrente datos">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Superficie</strong>
                        <div class="col-sm-6">
                          <input type="number" class="form-control boxsuperficie datos">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Esquina</strong>
                        <div class="col-sm-6">
                          <select class="form-control select_esquina datos">
                            <option value="NO">N0</option>
                            <option value="SI">SI</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Precio X m2</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxpreciom2 datos">
                        </div>
                      </div>
                    </div>
                    <!-- --------------- -->

                    <br>
                    
                    <div>
                      <div class="row">
                        <div class="col" style="width: 100%; text-align: right;">
                          <button class="btn btn-primary" id="btnAceptar">
                            Aceptar <i class="fa fa-check"></i> 
                          </button>
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

      var id_loteo , lote, frente, esquina = "", superficie, preciom2, cont = parseInt(0);
      datos = [];

      //confirmar carga de datos
      $('#btnAceptar').on('click', function(){

        if(cont > parseInt(0))
        {
          cont = parseInt(0);
          datos = [];
        } 

        $('.datos').each(function(){
          if( $(this).val() != "" ) 
            cont++; 
        });

        if(parseInt(cont) == parseInt(6))
        {
          id_loteo = $('.select_loteo').val()*1;
          lote = $('.boxlote').val()*1;
          frente = $('.boxfrente').val()*1;
          superficie = $('.boxsuperficie').val()*1;
          esquina = $('.select_esquina').val();
          preciom2 = $('.boxpreciom2').val()*1;

          datos.push(id_loteo);
          datos.push(lote);
          datos.push(frente);
          datos.push(superficie);
          datos.push(esquina);
          datos.push(preciom2);   
       
          $.post("../back/cargar_lotes.php", {'datos': JSON.stringify(datos)}, res => {
            console.log(res);
            if(parseInt(res) > parseInt(0))
            {
              Swal.fire({
                //position: 'top-end',
                icon: 'success',
                title: 'Lote creado correctamente.',
                showConfirmButton: false,
                timer: 1600
              })
            }
            else
            {            
              Swal.fire({
                //position: 'top-end',
                icon: 'error',
                title: 'El lote ya existe.',
                showConfirmButton: false,
                timer: 1600
              })
            }
          });       
        } 
        else 
        {
          Swal.fire({
            //position: 'top-end',
            icon: 'warning',
            title: 'Debe completar todos los campos.',
            showConfirmButton: false,
            timer: 1600
          })
        }
      })

    });
  </script>
</body>

</html>