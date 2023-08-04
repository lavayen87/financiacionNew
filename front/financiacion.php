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
      
      $qry = "SELECT codigo_lote FROM lotes WHERE id_lote = '$id_lote'";
      $res = mysqli_query($connection, $qry);

      $datos = mysqli_fetch_array($res);
      $lote =  $datos['codigo_lote'];
      mysqli_close($connection); 
    }  
    else header('Location: financiacion.php');
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
          <h2 class="mt-4">Financiación</h2>
          
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
                           value="<?php echo $lote !="" ? $lote : "" ?>">
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

              <!-- formulario de financiacion -->                             
              <div class="alert alert-primary" role="alert" id="div_contenido" style="display: none; text-align: center;">
                
                <div class="row">
                  <!-- Datos loteo -->
                  <div class="col-md-4">
                    <div class="card">
                         
                      <ul class="list-group">
                        <li class="list-group-item">
                          <strong class="col-md-2" >Información del lote</strong >
                        </li>
                        <li class="list-group-item">Loteo : <strong class="col-md-2 txtloteo" ></strong ></li>
                        <li class="list-group-item">Lote : <strong class="col-md-2 txtlote" ></strong></li>
                        <li class="list-group-item">Estado : <strong class="col-md-2 txtestado" ></strong></li>
                        <li class="list-group-item">Frente : <strong class="col-md-2 txtfrente" ></strong></li>
                        <li class="list-group-item">Esquina : <strong class="col-md-2 txtesquina" ></strong></li>
                        <li class="list-group-item">Precio : <strong class="col-md-2 txtpreciolista" ></strong></li>
                      </ul>

                    </div>
                  </div>
                  <!-- --------------------------------------------------------------  -->

                  <!-- Datos financiacion -->
                  <div class="col-md-7">

                    <div class="card" style="padding-top: 10px;">
                       
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Anticipo</strong>
                        <div class="col-sm-6">
                          <input type="number" class="form-control boxanticipo datos" style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Saldo a financiar</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxsaldoafinanciar datos" readonly style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">N° de cuotas</strong>
                        <div class="col-sm-6">
                          <input type="number" class="form-control boxnumerocuotas datos" style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Monto financiado</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxmontofinanciado datos" readonly style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Valor de la cuota</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxvalorcuota datos"  readonly style="background-color: white;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Total de la operación</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxtotal datos" readonly style="background-color: white;">
                        </div>
                      </div>
                    </div>
                    <!-- --------------- -->

                    <br>

                                         
                    <div style="text-align: right;">
                      <button class="btn btn-primary" id="btnAceptar" style="display: none;"> <!-- disabled -->
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

      var id_lote, id_usuario,lote, x1, x2, anticipo, precioLista, saldoafinanciar, montofinanciado, cuotas, valorcuota, estado, tasaint, color;
      var band = false;

      // tasa de interes para financiación.
      $.get("../back/obtenerTasaInteres.php", (res) =>{tasaint = res});
      
      // Buscar lote
      $('#btnBuscarLote').on('click', function() {

          if( $('.div_alerta').is(':visible') ) $('.div_alerta').hide();  

          lote = $('#lote').val();
          let datos;
          color = ''; 
          // $("#div_contenido").load('inc_financiacion.php?pepe='+lote);
          // $("#div_contenido").show();
          $.post("../back/datos_lote.php", {'lote':lote}, res =>{
            if(res != parseInt(0))
            {             
         
              datos = JSON.parse(res);
              datos.forEach(d => 
              {
                       if(d.id_estado < parseInt(3)) // >=2
                       {  

                          if(d.id_estado == parseInt(2)) 
                          {
                            color = 'red';
                            estado = "<label style='color: "+color+";'>"+d.estado+"</label>";                            
                            id_lote = d.id_lote;
                            $.post("../back/datos_financiacion.php", {'id_lote':id_lote}, res =>{
                              console.log(res)
                              if(res != parseInt(0)) 
                              {
                                let fdatos = JSON.parse(res);
                                fdatos.forEach(fd =>
                                {
                                  $('.boxanticipo').val(fd.anticipo);
                                  $('.boxsaldoafinanciar').val(fd.saldo_financiar);
                                  $('.boxnumerocuotas').val(fd.cuotas);
                                  $('.boxmontofinanciado').val(fd.monto_financiado);
                                  $('.boxvalorcuota').val(fd.valor_cuota);
                                  $('.boxtotal').val(fd.total_operacion);   

                                  $('.boxanticipo').prop("readonly", true);
                                  $('.boxnumerocuotas').prop("readonly", true);                          
                                })
                              }
                              else
                              {
                                  $('.boxanticipo').val(0);
                                  $('.boxsaldoafinanciar').val("");
                                  $('.boxnumerocuotas').val(0);
                                  $('.boxmontofinanciado').val("");
                                  $('.boxvalorcuota').val("");
                                  $('.boxtotal').val("");

                                  // en caso de que no tenga datos de financiacion
                                  $('.boxanticipo').prop("readonly", false);
                                  $('.boxnumerocuotas').prop("readonly", false);
                                  // Habilitar el boton en caso de que no tenga financiacion y este señado
                                  //$('#btnAceptar').show();
                              }
                            })

                            /*Agregado*/
                            $('.txtloteo').html(d.loteo); 
                            $('.txtlote').html(d.codigo_lote); 
                            $('.txtestado').html(estado); 
                            $('.txtfrente').html(d.frente); 
                            $('.txtesquina').html(d.esquina);
                            precioLista = d.preciolista*1;
                            $('.txtpreciolista').html("$"+ new Intl.NumberFormat('es-ES').format(precioLista));                           
                            /*-------*/                            
                            $('#btnAceptar').hide();
                          }
                          else
                          {
                            estado = "<label style='color: "+color+";'>"+d.estado+"</label>";    
                            $('.txtloteo').html(d.loteo); 
                            $('.txtlote').html(d.codigo_lote); 
                            $('.txtestado').html(estado); 
                            $('.txtfrente').html(d.frente); 
                            $('.txtesquina').html(d.esquina);
                            precioLista = d.preciolista*1;
                            $('.txtpreciolista').html("$"+ new Intl.NumberFormat('es-ES').format(precioLista));

                            $('.boxanticipo').prop("readonly", false);
                            $('.boxnumerocuotas').prop("readonly", false);

                            $('.boxanticipo').val("");
                            $('.boxsaldoafinanciar').val("");
                            $('.boxnumerocuotas').val("");
                            $('.boxmontofinanciado').val("");
                            $('.boxvalorcuota').val("");
                            $('.boxtotal').val("");   
                            $('#btnAceptar').hide();
                            // Habilitar el boton en caso de que sea sliditado por Baba para realizar Financiacion
                            //$('#btnAceptar').show();
                          }
                       } 
                       else
                       {

                          $('.txtloteo').html(""); 
                          $('.txtlote').html(""); 
                          $('.txtestado').html(""); 
                          $('.txtfrente').html(""); 
                          $('.txtesquina').html("");                          
                          $('.txtpreciolista').html(""); 

                          estado = d.estado;

                          $('.boxanticipo').prop("readonly", true);
                          $('.boxnumerocuotas').prop("readonly", true);

                          $('.boxanticipo').val("");
                          $('.boxsaldoafinanciar').val("");
                          $('.boxnumerocuotas').val("");
                          $('.boxmontofinanciado').val("");
                          $('.boxvalorcuota').val("");
                          $('.boxtotal').val("");                          
                       }

                       // seccion original
                       // $('.txtloteo').html(d.loteo); 
                       // $('.txtlote').html(d.codigo_lote); 
                       // $('.txtestado').html(estado); 
                       // $('.txtfrente').html(d.frente); 
                       // $('.txtesquina').html(d.esquina);
                       // precioLista = d.preciolista*1;
                       // $('.txtpreciolista').html("$"+ new Intl.NumberFormat('es-ES').format(precioLista)); 
                       $("#id_lote").val(d.id_lote);  
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


      // Ingreso Anticipo
      $('.boxanticipo').keyup(function() {
              
              if( $('.boxanticipo').val() <= parseInt(0) || $('.boxanticipo').val() == "" )
              {
                $('.boxsaldoafinanciar').val("");
                $('.boxnumerocuotas').val("");
                $('.boxmontofinanciado').val("");
                $('.boxvalorcuota').val("");
                $('.boxtotal').val("");
              }
              else
              {                           
                anticipo = $('.boxanticipo').val();
                saldoafinanciar = precioLista - anticipo ;
                x2 = (saldoafinanciar*tasaint)/100;               
                $('.boxsaldoafinanciar').val('$' + new Intl.NumberFormat('es-ES').format(saldoafinanciar));
              }
      }); 

      //ingreso numero de cuotas
      $('.boxnumerocuotas').keyup(function() {
          

              if( $('.boxnumerocuotas').val() <= parseInt(0) || $('.boxnumerocuotas').val() == "" )
              {
                $('.boxmontofinanciado').val("");
                $('.boxvalorcuota').val("");
                $('.boxtotal').val("");
              }
              else
              {
                if( $('.boxanticipo').val() > parseInt(0) )
                {
                  cuotas = parseInt($('.boxnumerocuotas').val());
                  x1 = cuotas/12;
                  montofinanciado = (x1*x2) + saldoafinanciar;
                  valorcuota = montofinanciado/cuotas;
                  total = (anticipo*1) + montofinanciado;

                  $('.boxmontofinanciado').val('$' + new Intl.NumberFormat('es-ES').format(montofinanciado.toFixed(2)) );
                  $('.boxvalorcuota').val('$' + new Intl.NumberFormat('es-ES').format(valorcuota.toFixed(2)) );
                  $('.boxtotal').val('$' + new Intl.NumberFormat('es-ES').format(total.toFixed(2)) );
                  band = true;
                }
              } 
      });       
     
      // Registrar datos de financiación
      $('#btnAceptar').on('click', function() {
        if(band)
        {
              datos = [];
              id_lote = $("#id_lote").val()*1;
              id_usuario = $("#id_usuario").val()*1;
              datos.push(id_lote);
              datos.push(lote);
              datos.push(anticipo);
              datos.push(saldoafinanciar);
              datos.push(cuotas);
              datos.push(x1);
              datos.push(x2);
              datos.push(montofinanciado);
              datos.push(valorcuota);
              datos.push(total);
              datos.push(id_usuario);
       
              $.post('../back/registrar_financiacion.php', {'datos': JSON.stringify(datos)}, res =>{
                console.log(res)
                if( parseInt(res) == parseInt(1) )
                {
                  Swal.fire({
                    icon: 'success',
                    title: 'lote señado correctamente.',
                    showConfirmButton: false,
                    timer: 1600
                  })
                }
                else
                {
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
      
    });
  </script>
</body>

</html>