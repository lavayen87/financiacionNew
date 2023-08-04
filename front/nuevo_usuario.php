<?php

  session_start();

  if (!isset($_SESSION['active'])) 
  {
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
      <?php require 'menu.php' ?>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          <h2 class="mt-4">Alta de usuario</h2>
          
          <hr>
              
              <!-- formulario de financiacion -->                             
              <div class="alert alert-primary" role="alert" id="div_contenido" style="text-align: center;">
                
                <div style="text-align: left;">
                  <a href="usuarios.php" class="btn btn-primary" title="Volver"> <i class="fa fa-reply-all"></i></a>
                </div>

                <br>

                <div class="row">

                  <!-- Datos del nuevo usuario -->
                  <div class="col-md-7">

                    <div class="card" style="padding-top: 10px;">
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Nombre y apellido</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxnombre datos">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Usuario</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxusuario datos">
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Rol</strong>
                        <div class="col-sm-6">
                          <select class="form-control select_rol datos">
                            <?php 
                              include ('../conexion.php');
                              $qry = "SELECT * FROM roles";
                              $res = mysqli_query($connection, $qry);
                              if($res->num_rows > 0)
                              {
                                while($datos = mysqli_fetch_array($res))
                                  echo "<option value=".$datos['id_rol'].">".$datos['descripcion']."</option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <strong class="col-sm-4 col-form-label">Contraseña</strong>
                        <div class="col-sm-6">
                          <input type="text" class="form-control boxpass datos">
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

     var nombre, usuario, rol, pass, cont = parseInt(0);
      datos = [];

      //confirmar registro de usuario
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

        if(parseInt(cont) == parseInt(4))
        {
          nombre = $('.boxnombre').val();
          usuario = $('.boxusuario').val();
          rol = $('.select_rol').val();
          pass = $('.boxpass').val();

          datos.push(nombre);
          datos.push(usuario);
          datos.push(rol);
          datos.push(pass);     
          
          $.post("../back/registrar_usuario.php", {'datos': JSON.stringify(datos)}, res => {
            console.log(res);
            if(parseInt(res) > parseInt(0))
            {
              Swal.fire({
                icon: 'success',
                title: 'Usuario registrado correctamente.',
                showConfirmButton: false,
                timer: 1600
              })
            }
            else
            {            
              Swal.fire({
                icon: 'error',
                title: 'Ya existe el usuario.',
                showConfirmButton: false,
                timer: 1600
              })
            }
          });       
        } 
        else 
        {
          Swal.fire({
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