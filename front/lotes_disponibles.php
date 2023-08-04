<?php

  session_start();

  if (!isset($_SESSION['active'])) {

    header('Location: ../index.php');

  }

  $nombre = $_SESSION['nombre'];
  $id_rol = $_SESSION['id_rol'];
  $id_usuario = $_SESSION['id_usuario'];

  $id_loteo = -1;
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
          <h2 class="mt-4">Listado de lotes disponibles</h2>
          <hr>
          <div class="alert alert-primary" role="alert" id="div_contenido" style="text-align: center;">
                
                <div class="row" style="padding-bottom: 5px; display: flex; justify-content: space-between;">
                  <div class="col-md4">
                  <form name="" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
                     
                      <!-- <a href="../plantillaspdf/vistas/vista_lotes_disponibles.php" 
                         class="btn btn-primary btn-sm"
                         target="_banck">
                        Listado <i class="fa fa-download"></i> 
                      </a> -->
                      <table>
                        <tr>
                          <td>
                            <select class="form-control form-control-sm select_loteo" name="select_loteo">
                              <?php 
                                  $info_loteo = "";
                                  $info_lote  = "";
                                  $dres = "";
                                  $datos_dqry = "";
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
                                  
                                  if(isset($_POST["select_loteo"])) 
                                  {
                                    
                                    $id_loteo = $_POST["select_loteo"];
                                    include('../conexion.php');
                                    include('../funciones.php');
                                    $info = Get_loteo($id_loteo);
                                    $info_loteo = $info['loteo'];
                                    $info_lote  = $info['codigo_loteo'];
                                    // consulta sql para la decarga de listado 
                                    $dqry = "SELECT 
                                              id_lote as id,
                                              id_estado,
                                              loteo as loteo,
                                              (SELECT id_loteo FROM loteos WHERE loteo = l.loteo) as id_loteo,
                                              codigo_lote as lote,
                                              frente,
                                              esquina,
                                              superficie,
                                              preciolista,
                                              (SELECT descripcion FROM estado_lotes WHERE id_estado = l.id_estado) as estado
                                            FROM lotes l 
                                            WHERE l.id_estado = 1 and l.id_loteo = '$id_loteo'
                                            ORDER BY loteo, lote";  
                                    $dres = mysqli_query($connection,$dqry);
                                    
                                    mysqli_close($connection);
                                  }
                              ?>
                            </select>
                          </td>  
                          <td>
                            <button type="submit" class="btn btn-primary btn-sm btnBuscar" id="btnBuscar" name="listar">
                              <i class="fa fa-search"></i> Buscar
                            </button>
                          </td>
                        </tr>
                      </table>

                      <!-- <input type="text" style="display: none;" id="input_loteo" value="<?php echo $datos_dqry['loteo'];?>" >
                      <input type="text" style="display: none;" id="input_lote"  value="<?php echo substr($datos_dqry['lote'],0,2);?>" > -->
                      
                      <div  style=" text-align: right;">                     
                        <?php  
                        /*echo "<a class='btn btn-primary btn-sm' 
                                 href='../dompdf/vista_lotes_disponibles.php?id_loteo=$id_loteo'
                                 target='_bank'>
                                 Listado <i class='fa fa-download'></i>
                              </a>";*/
                        ?>                      
                      </div>
                     
                  </form> 
                  </div>
                  <div class="col-md4">
                    <button class='btn btn-primary btn-sm' id="btnListado" target='_bank'>
                      Listado <i class='fa fa-download'></i>
                    </button>
                  </div>
                </div>
                
                <div class="row">                
                                 
                    <div class="card-body" style="background-color: white;">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover border-primary table-sm" id="lotes" width="100%" cellspacing="0">
                          <thead>
                            <tr>                            
                              <th>Loteo</th>
                              <th>Lote</th>
                              <th>Frente</th>  
                              <th>Esquina</th>  
                              <th>Superficie</th>  
                              <th>Precio</th>    
                              <th>Estado</th>
                              <th>Acciones</th> 
                              <th></th>                                                   
                            </tr>
                          </thead>                      
                          <tbody id="tbody">   
                             <?php 
                              if(isset($_POST['listar']))
                              {
                                include('../conexion.php');
                                $qry = "SELECT 
                                        id_lote as id,
                                        id_estado,
                                        loteo as loteo,
                                        (SELECT id_loteo FROM loteos WHERE loteo = l.loteo) as id_loteo,
                                        codigo_lote as lote,
                                        frente,
                                        esquina,
                                        superficie,
                                        preciolista,
                                        (SELECT descripcion FROM estado_lotes WHERE id_estado = l.id_estado) as estado
                                        FROM lotes l 
                                        WHERE l.id_estado = 1 and l.id_loteo = '$id_loteo'
                                        ORDER BY loteo, lote";  
                                $res = mysqli_query($connection,$qry);
                                if($res->num_rows > 0)
                                {
                                  while ($datos = mysqli_fetch_array($res)) 
                                  {
                                    $id = $datos['id'];

                                    if($id_rol == 1)                                 
                                    $acciones = "
                                              <a href='financiacion.php?id=$id' class='btn btn-primary btn-sm' title='Financiar'>
                                                <i class='fa fa-info-circle'></i>
                                              </a>";
                                              
                                              // Accion original antes de crear la edicion de lotes
                                              // <button class='btn btn-secondary btn-sm btnEditar' title='Editar precio' id='".$id."' value='0'>
                                              //   <i class='fa fa-edit'></i>
                                              // </button>

                                              // <input type='number' name='txtedicion' class='boxprecio' disabled style='width: 130px;' id='".$id."'>";                                 
                                    else
                                    $acciones = "
                                              <a href='financiacion.php?id=$id' class='btn btn-primary btn-sm' title='Financiar'>
                                                <i class='fa fa-info-circle'></i>
                                              </a>";
                                  
                                    echo "<tr id='".$id."'>                                       
                                        <td>".$datos['loteo']."</td>
                                        <td>".$datos['lote']."</td>
                                        <td>".$datos['frente']."</td>
                                        <td>".$datos['esquina']."</td>
                                        <td>".$datos['superficie']."</td>
                                        <td>"."<b>$</b>".number_format( $datos['preciolista'],2,',','.')."</td>
                                        <td>".$datos['estado']."</td>
                                        <td>".$acciones."</td>
                                        <td><i class='fa fa-check check' style='color: green; display: none;'></i>
                                        </td>
                                       </tr>";
                                  }                               
                                } 
                                mysqli_close($connection);
                              }
                            ?> 
                            <!-- Consulta original -->
                            <!-- <?php 
                              include('../conexion.php');
                              $qry = "SELECT 
                                      id_lote as id,
                                      id_estado,
                                      loteo as loteo,
                                      (SELECT id_loteo FROM loteos WHERE loteo = l.loteo) as id_loteo,
                                      codigo_lote as lote,
                                      frente,
                                      esquina,
                                      superficie,
                                      preciolista,
                                      (SELECT descripcion FROM estado_lotes WHERE id_estado = l.id_estado) as estado
                                      FROM lotes l 
                                      WHERE l.id_estado = 1
                                      ORDER BY loteo, lote";  
                              $res = mysqli_query($connection,$qry);
                              if($res->num_rows > 0)
                              {
                                while ($datos = mysqli_fetch_array($res)) 
                                {
                                  $id = $datos['id'];

                                  if($id_rol == 1)                                 
                                  $acciones = "
                                              <a href='financiacion.php?id=$id' class='btn btn-primary btn-sm' title='Financiar'>
                                                <i class='fa fa-info-circle'></i>
                                              </a>
                                              
                                              <button class='btn btn-secondary btn-sm btnEditar' title='Editar precio' id='".$id."' value='0'>
                                                <i class='fa fa-edit'></i>
                                              </button>

                                              <input type='number' name='txtedicion' class='boxprecio' disabled style='width: 130px;' id='".$id."'>";                                 
                                  else
                                  $acciones = "
                                              <a href='financiacion.php?id=$id' class='btn btn-primary btn-sm' title='Financiar'>
                                                <i class='fa fa-info-circle'></i>
                                              </a>";
                                  
                                  echo "<tr id='".$id."'>                                       
                                        <td>".$datos['loteo']."</td>
                                        <td>".$datos['lote']."</td>
                                        <td>".$datos['frente']."</td>
                                        <td>".$datos['esquina']."</td>
                                        <td>".$datos['superficie']."</td>
                                        <td>"."<b>$</b>".number_format( $datos['preciolista'],2,',','.')."</td>
                                        <td>".$datos['estado']."</td>
                                        <td>".$acciones."</td>
                                        <td><i class='fa fa-check check' style='color: green; display: none;'></i>
                                        </td>
                                       </tr>";
                                }                               
                              } 
                              mysqli_close($connection);
                            ?> -->
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
  
  <!--Botones dataTable-->
  
  
  <script src="../assets/demo/datatables-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {

      $("#lotes").DataTable({
        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10,25, 50, "Mostrar Todo"] ],
        "language":{
          url:"https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }      
      
      })



      $('input[type=search]').keyup(function(){
        console.log( $('input[type=search]').val() )
      })


      var cant = parseInt(0);
      datos = [];
      var id_loteo = parseInt(0);

      // $(".select_loteo").on("change", function(){
      //     id_loteo = $(".select_loteo").val();
      //     console.log('loteo: '+ id_loteo)
      // })

      // // mostrar lotes disponibles
      // $("#btnBuscar").on("click", function(){
      //   console.log('id loteo: '+id_loteo)
      //   $.post("../back/generarFilas.php", {'id_loteo': id_loteo}, res => {
      //     //console.log(res)
      //     $("#tbody").html(res);
      //   })
      // })

      // descargar listado
      $("#btnListado").on("click", function(){
        id_loteo = <?php echo $id_loteo; ?>;
        if(id_loteo != parseInt(-1))
        {
          //proceso de descarga
          var pdf = new jsPDF();

          var objFoto = new Image();
          // objFoto.src = '../img/baba-img.jpeg';
          // pdf.addImage(objFoto,'JPEG',10, 10, 10, 10);

          var loteo = "<?php echo $info_loteo; ?>";
          var lote = "<?php echo $info_lote ?>";
          pdf.text(15,20,"Lotes disponibles "+loteo); //10,20

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

          pdf.save("lotes_disponibles_"+lote+".pdf");
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

      // realizar edición
      $(".btnEditar").on('click', function(){

        var id = $(this).prop('id')*1;
        if($(this).val() == 0)
        {
          //habilitar  box
          $(this).val('1');         
          $(this).css("background-color" , "green");
          $("input[id="+id+"]").prop("enabled","enabled");
          $('#lotes tr[id='+id+']').find(".boxprecio").removeAttr('disabled');    
        }
        else
        {
          //Chequear si el box tiene un valor para actualizar la base de datos y desabilitar
          if( $("input[id="+id+"]").val() != "" )
          {
            var valor = $('#lotes tr[id='+id+']').find(".boxprecio").val();

            // actualizamos la base de datos 'lotes' en el campo 'preciom2' con ese nuevo valor
            datos.push(id);
            datos.push(valor); 
            $.post("../back/actualizar_precios_lote.php", {'datos': JSON.stringify(datos)}, res => {
              
              if( parseInt(res) > parseInt(0) )
              {
                $(this).val('0');
                $(this).css("background-color" , "gray");
                $("input[id="+id+"]").prop("disabled","disabled");
                $('#lotes tr[id='+id+']').find(".boxprecio").prop("disabled","disabled");
                $('#lotes tr[id='+id+']').find(".check").slideDown().fadeIn(1000);
              }

            }) 

          }
          else 
          {
            //Solo desabilitamos el box
            $(this).val('0');           
            $(this).css("background-color" , "gray");
            $("input[id="+id+"]").prop("disabled","disabled");
            $('#lotes tr[id='+id+']').find(".boxprecio").prop("disabled","disabled");            
          }
        }

      })


    })
  </script>
</body>

</html>