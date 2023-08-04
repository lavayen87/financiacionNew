<?php

  session_start();

  if (!isset($_SESSION['active'])) 
  {
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
      <?php require 'menu.php' ?>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          <h2 class="mt-4">Editar información de un lote</h2>
          
          <hr>
              
              <!-- Id de lole -->
              <input type="text" id="id_lote" style="display: none;">

             <!--  Id de usuario -->
              <input type="text" id="id_usuario" value="<?php   echo $id_usuario; ?>" style="display: none;">

              <!-- Busqueda de lotes -->
              <div class="alert alert-primary" role="alert">
                <div class="row g-3 align-items-center">
                  <div class="col-auto">
                    <strong class="col-form-label">Lote</strong>
                  </div>
                  <div class="col-auto">
                    <input type="text" id="lote" class="form-control sm" 
                           value="">
                  </div>
                  <div class="col-auto">
                    <span  class="form-text">
                      <button id="btnBuscarLote" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                  <div class="col-auto div_alerta" style="display: none; border-radius: 10px; border: 2px solid #dc3545; background-color: pink; padding: .3rem 1.10rem;">
                     
                      <div class="align-items-center" style="display: inline-flex;">
                        <i class="fa fa-exclamation-circle" style="color: #dc3545;"></i> <div class="alerta" ></div>
                      </div>
                     
                  </div>
                </div>
              </div>       

              <!--  -->                             
              <div class="alert alert-primary" role="alert" id="div_contenido" style="display: none; text-align: center;">
                
                <div class="row">                 

                  <!-- Datos del lote -->
                  <div class="col-md-7">

                    <div class="card" style="padding-top: 10px;">                     
                      
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Loteo</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxloteo datos" style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Codigo lote</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxcodigolote datos" style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Estado</strong>
                        <div class="col-sm-6">
                          <!-- <input type="text" class="form-control boxestado datos" style="background-color: white;"> -->
                          <select class="form-control boxestado datos">
                            <?php 
                              include ('../conexion.php');
                              $qry = "SELECT * FROM estado_lotes";
                              $res = mysqli_query($connection, $qry);
                              if($res->num_rows > 0)
                              {
                                while($roles = mysqli_fetch_array($res))
                                {
                                  echo "<option value=".$roles['id_estado'].">".$roles['descripcion']."</option>";
                                }
                              }
                              mysqli_close($connection);
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Frente</strong>
                        <div class="col-sm-6">
                          <input type="number" class="form-control boxfrente datos"  style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Esquina</strong>
                        <div class="col-sm-6">
                          <!-- <input type="text" class="form-control boxesquina datos"   style="background-color: white;"> -->
                          <select class="form-control boxesquina datos">
                            <option value="NO">N0</option>
                            <option value="SI">SI</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Superficie</strong>
                        <div class="col-sm-6">
                          <input type="number" class="form-control boxsuperficie datos"  style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Precio x m2</strong>
                        <div class="col-sm-6">
                          <input type="number" class="form-control boxpreciom2 datos"  style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Precio de Lista</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxpreciolista datos"  readonly style="background-color: white;">
                        </div>
                      </div>
                    </div>
                    <!-- --------------- -->

                    <br>

                                         
                    <div style="text-align: right;">
                      <button class="btn btn-primary" id="btnAceptar">
                        Realizar <i class="fa fa-check"></i> 
                      </button>
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

      var id_lote,id_estado,loteo,lote,frente,esquina,superficie,preciom2,preciolista; 
      datos_array = [];

      // Buscar lote
      $('#btnBuscarLote').on('click', function() {

          if( $('.div_alerta').is(':visible') ) $('.div_alerta').hide();  

          lote = $('#lote').val();
          let datos_lote;
           
          $.post("../back/datos_lote.php", {'lote':lote}, res =>{
            if(res != parseInt(0))
            {             
              console.log(res)
              datos_lote = JSON.parse(res);
              datos_lote.forEach(d => 
              {                                         
                 $('.boxloteo').val(d.loteo); 
                 $('.boxcodigolote').val(d.codigo_lote);                
                 $('.boxestado option').each(function(){
                     if( $(this).val() == d.id_estado)
                      $(this).attr('selected', true);
                 });
                 $('.boxfrente').val(d.frente); 
                 $('.boxesquina option').each(function(){
                     if( $(this).val() == d.esquina)
                      $(this).attr('selected', true);
                 }); 
                 $('.boxsuperficie').val(d.superficie);
                 $('.boxpreciom2').val(d.preciom2);                      
                 $('.boxpreciolista').val("$"+ new Intl.NumberFormat('es-ES').format(d.preciolista)); 
                 id_lote = d.id_lote*1;  
                 id_estado = d.id_estado*1;
              });

              $("#div_contenido").show();
            }
            else
            { 
              $('.alerta').html('No existe el lote '+'<b>'+"'"+lote+"'"+'</b>');
              $('.div_alerta').show(); 
            }       
          })
          return false;                 
      });


      $('.boxestado').on('change', function(){
            //$('.boxestado').val($(this).val());
            $(this).attr('selected', true);
            console.log('nuevo valor: '+$('.boxestado').val())
      });

      $('.boxesquina').on('change', function(){
            //$('.boxesquina').val($(this).val());
            $(this).attr('selected', true);
            console.log('nuevo valor: '+$('.boxesquina').val())
      });


      // Registrar datos del lote
      $('#btnAceptar').on('click', function() {
        if(FormComplet())
        {
                          
          loteo = $('.boxloteo').val();
          lote = $('.boxcodigolote').val();
          id_estado = $('.boxestado').val()*1;
          frente = $('.boxfrente').val()*1;
          esquina = $('.boxesquina').val();
          superficie = $('.boxsuperficie').val()*1;
          preciom2 = $('.boxpreciom2').val()*1;
          preciolista = preciom2*superficie;

          datos_array.push(id_lote);
          datos_array.push(loteo);
          datos_array.push(lote);
          datos_array.push(id_estado);           
          datos_array.push(frente);  
          datos_array.push(esquina);
          datos_array.push(superficie);
          datos_array.push(preciom2);
          //datos_array.push($('.boxpreciolista').val()); 

          console.log(datos_array)
       
          $.post('../back/editar_lote.php', {'datos': JSON.stringify(datos_array)}, res =>{
            console.log('Res: '+res)
            if( parseInt(res) == parseInt(1) )
            {              
              datos_array = [];

              Swal.fire({
                icon: 'success',
                title: 'Datos guardados correctamente.',
                showConfirmButton: false,
                timer: 1600
              })
            }
            else
            {
              datos_array = [];

              Swal.fire({
                icon: 'error',
                title: 'Error inseperado...intente nuevamente.',
                showConfirmButton: false,
                timer: 1600
              })
            }
          });
        }
        else
        {
          Swal.fire({
            icon: 'error',
            title: 'Debe completar todos los campos de financiación',
            showConfirmButton: false,
            timer: 1600
          })
        }

      })


      function FormComplet()
      {
        var cant = parseInt(0);

        $(".datos").each(function(){
          if( $(this).val().length > parseInt(0) || $(this).val() != "")      
            cant++;    
        })
        return cant == parseInt(8);
      }
      
    });
  </script>
</body>

</html>