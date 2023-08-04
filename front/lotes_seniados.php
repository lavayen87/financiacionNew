<?php

  session_start();

  if (!isset($_SESSION['active'])) {

    header('Location: ../index.php');

  }

  $nombre = $_SESSION['nombre'];
  $id_rol = $_SESSION['id_rol'];
  $id_usuario = $_SESSION['id_usuario'];

  include('../conexion.php');
  $dqry ="SELECT 
            id_lote as id,
            loteo as loteo,
            codigo_lote as lote,
            frente,
            esquina,
            superficie,
            preciolista,
            (SELECT descripcion FROM estado_lotes WHERE id_estado = l.id_estado) as estado
          FROM lotes l 
          WHERE L.id_estado = 2 
          ORDER BY loteo, lote";
  $dres = mysqli_query($connection,$dqry);
  $datos_qry = "";
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
  <script src="../jspdf/dist/jspdf.min.js"></script>
  <script src="../js/jspdf.plugin.autotable.min.js"></script>
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
          <h2 class="mt-4">Listado de lotes señados</h2>
          <hr>

          <div class="alert alert-primary" role="alert" id="info" style="display: none;">
            <label>No se registran lotes para mostrar.</label>
          </div>
          
          <div class="alert alert-primary" role="alert" id="div_contenido" style="text-align: center;">
                
                <div class="row" style="padding-bottom: 5px">
                  <!-- <a href="../plantillaspdf/vistas/vista_lotes_disponibles.php" 
                     class="btn btn-primary btn-sm"
                     target="_banck">
                    Listado <i class="fa fa-download"></i> 
                  </a> -->
                  <!-- <a class="btn btn-primary btn-sm" 
                     href="../dompdf/vista_lotes_seniados.php"
                     target="_bank">
                     Listado <i class="fa fa-download"></i>
                  </a> -->
                  <button class="btn btn-primary btn-sm" id="btnListado">
                    Listado <i class="fa fa-download"></i>
                  </button>
                </div>

                <div class="row">                
                                 
                    <div class="card-body" style="background-color: white;">
                      <div class="table-responsive">

                        <table class="table table-bordered table-hover border-primary table-sm" id="lotes" width="100%" cellspacing="0">
                          <thead>
                            <tr>                            
                              <th>Loteo</th>
                              <th>Lote</th>
                              <th>Estado</th>
                              <th>Usuario</th>
                              <th>Acciones</th> 
                              <th></th>                                                   
                            </tr>
                          </thead>                      
                          <tbody>         
                            <?php 

                              include('../conexion.php');
                              
                              $qry = "SELECT 
                                      id_lote as id,
                                      loteo as loteo,
                                      codigo_lote as lote,
                                      (SELECT descripcion FROM estado_lotes WHERE id_estado = L.id_estado) as estado,
                                      (SELECT nombre FROM usuarios 
                                       WHERE id_usuario = (SELECT id_usuario FROM financiacion where id_lote = L.id_lote)
                                      ) as usuario
                                      FROM lotes L 
                                      WHERE L.id_estado = 2
                                      ORDER BY loteo, lote";  

                              $res = mysqli_query($connection,$qry);

                              if($res->num_rows > 0)
                              {
                                while ($datos = mysqli_fetch_array($res)) 
                                {
                                  $id = $datos['id'];
                                  echo "<tr id='".$id."'>                                       
                                        <td>".$datos['loteo']."</td>
                                        <td>".$datos['lote']."</td>
                                        <td>".$datos['estado']."</td>
                                        <td>".$datos['usuario']."</td>
                                        <td>".
                                              "<a href='detalle_lote.php?id=$id' class='btn btn-primary btn-sm' title='Detalle'>
                                                <i class='fa fa-info-circle'></i>
                                              </a>
                                              
                                              <button class='btn btn-success btn-sm btnEditar' title='Habilitar lote' id='".$id."' value='0'>
                                                <i class='fa fa-reply-all'></i>
                                              </button>

                                              <button class='btn btn-danger btn-sm btnEliminar' title='Marcar como Vendido' id='".$id."'>
                                                <i class='fa fa-check-circle'></i>
                                              </button>"                                              
                                              .                                             
                                        "</td>
                                         <td><i class='fa fa-check check' style='color: green; display: none;'></i>
                                          </td>
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

      if( $("#lotes tr").length == parseInt(1) ) 
      {
        $("#btnListado").hide();
        $("#div_contenido").hide();
        $("#info").show();
      }
        
      $("#lotes").DataTable({
        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10,25, 50, "Mostrar Todo"] ],
        "language":{
          url:"https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }      
      
      })

      datos = [];
      var cant = parseInt(0);

      $("#btnListado").on("click", function(){
        cant = <?php echo $dres->num_rows; ?>;
        if(cant != parseInt(0))
        {
          //proceso de descarga
          var pdf = new jsPDF();

          var objFoto = new Image();
          // objFoto.src = '../img/baba-img.jpeg';
          // pdf.addImage(objFoto,'JPEG',10, 10, 10, 10);
                    
          pdf.text(15,20,"Lotes seniados"); //10,20

          var columns = ["Loteo", "Lote", "Frente", "Esquina","Superficie","Precio","Estado"];
          var data = [
              <?php
              if($dres != ""){
               while($datos_dqry = mysqli_fetch_array($dres)) { ?>
              
              [              
                "<?php  echo $datos_dqry['loteo'];  ?>" ,
                "<?php echo $datos_dqry['lote'];    ?>" ,
                "<?php echo $datos_dqry['frente'];  ?>" ,
                "<?php echo $datos_dqry['esquina']; ?>",
                "<?php echo $datos_dqry['superficie']; ?>",
                "<?php echo '$'.number_format($datos_dqry['preciolista'],2,',','.'); ?>",
                "<?php echo $datos_dqry['estado']; ?>"
              ],
             <?php }} ?>
          ];

          pdf.autoTable(columns,data,
            { margin:{ top: 25  }}
          );

          pdf.save("lotes_seniados.pdf");
        }
        else
        {
          Swal.fire({
            //position: 'top-end',
            icon: 'error',
            title: 'No hay datos para mostrar.',
            showConfirmButton: false,
            timer: 1600
          })
        }
      })

      // Marcar el lote como Habilitado
      $(".btnEditar").on('click', function(){

        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-primary',
            denyButton: 'btn btn-danger'
          },
          buttonsStyling: false   
        })

        swalWithBootstrapButtons.fire({
          title: 'Desea habilitar el lote nuevamente?',
          text: "Esta acción eliminará los datos de financiación del lote.",
          icon: 'question',
          showDenyButton: true,          
          confirmButtonText: 'Habilitar', 
          denyButtonText: 'Cancelar',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed)
          {
            var id = $(this).prop('id')*1;
            datos.push(id);
            datos.push(1);

            // origibalmente: habilitar_lote.php
            $.post("../back/cambiarEstado_lote.php", {'datos': JSON.stringify(datos)}, res => {
              
              if( parseInt(res) > parseInt(0) )
              {

                $('tr[id='+parseInt(id)+']').remove();

                Swal.fire({
                     icon: 'success',
                     title:'Lote habilitado con exito !', 
                     showConfirmButton: false,
                     timer: 1600
                 })

                datos = [];
              }
              else
              {
                Swal.fire({
                    icon: 'error',
                    title: 'Error inseperado...intente nuevamente.',
                    showConfirmButton: false,
                    timer: 1600
                })

                datos = [];
              }

            }) 
            
          } 
        })
              
      })


       // Marcar el lote como vendido
      $(".btnEliminar").on('click', function(){

        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-primary',
            denyButton: 'btn btn-danger'
          },
          buttonsStyling: false   
        })

        swalWithBootstrapButtons.fire({
          title: 'Desea pasar el lote a estado vendido?',
          text: "Esta acción no eliminará los datos de financiación del lote.",
          icon: 'question',
          showDenyButton: true,          
          confirmButtonText: 'Marcar como Vendido', 
          denyButtonText: 'Cancelar',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed)
          {
            var id = $(this).prop('id')*1;
            datos.push(id);
            datos.push(3)

            $.post("../back/cambiarEstado_lote.php", {'datos': JSON.stringify(datos)}, res => {
              
              if( parseInt(res) > parseInt(0) )
              {
 
                $('tr[id='+parseInt(id)+']').remove();
            
                Swal.fire({
                     icon: 'success',
                     title:'El Lote pasó a estado Vendido.', 
                     showConfirmButton: false,
                     timer: 1600
                 })

                datos = [];
              }
              else
              {
                Swal.fire({
                    icon: 'error',
                    title: 'Error inseperado...intente nuevamente.',
                    showConfirmButton: false,
                    timer: 1600
                  })

                datos = [];
              }

            }) 
            
          } 
        })
              
      })

    })
  </script>
</body>

</html>