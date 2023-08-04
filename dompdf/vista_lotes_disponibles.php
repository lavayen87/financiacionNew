<?php 
    ob_start(); 
    date_default_timezone_set('America/Argentina/Salta');
    session_start();

      if (!isset($_SESSION['active'])) {

        header('Location: ../index.php');

      }

      $nombre = $_SESSION['nombre'];
      $id_rol = $_SESSION['id_rol'];
      $id_usuario = $_SESSION['id_usuario'];

      //id_loteo enviado por post
      $id_loteo = $_GET['id_loteo'];
      include("../conexion.php");
      $cta = "SELECT codigo_loteo  FROM loteos WHERE id_loteo = '$id_loteo'";
      $res = mysqli_query($connection,$cta);
      $dato = mysqli_fetch_array($res); 
?>

<link rel="stylesheet" href="css/table-style.css">
<style>
    @page { margin: 4px; } 
    body { margin: 4px; } 
</style>

<!-- <h2>Listado de lotes señados</h2> -->
<div style="background-color: #d6e9c6; width: 100%; height: 4%; padding: 8px 8px;">
    <div style="float: left;">
        <img src="img/baba-img.png" style="height: 40px; width: 40px; padding-top: 8px;">
        <span style="display: inline-block; padding-bottom: 8px;">Baba Urbanizaciones </span>
        <span style="display: inline-block; padding-bottom: 8px; padding-left: 18%;">
            <?php echo "Listado de lotes disponibles"; ?>
        </span>
    </div>
    <div style="float: right; padding-top: 3px;">
        <?php 
        include('../funciones.php');
            $p="<p>";
            // $p.="<label>Fecha: ".fecha_min(date('Y-m-d'))." - Hora: ".date('G').':'.date('i').':'.date('s')."</label>";
            $p.="<label>Emitido por: ".$nombre."</label></p><br>"; 
            echo $p;
            
        ?>
    </div>
</div>

<div class="row">                
                                 
    <div class="card-body" style="background-color: white;">
        <div class="table-responsive">
            <table class="table table-bordered border-primary table-sm" width="100%" cellspacing="0">
                <thead>
                    <tr>                            
                        <th>Loteo</th>
                        <th>Lote</th>
                        <th>Frente</th>  
                        <th>Esquina</th>  
                        <th>Superficie</th>  
                        <th>Precio</th>                                                       
                    </tr>
                </thead>                      
                <tbody>         
                    <?php 
                        include('../conexion.php');
                        $qry = "SELECT 
                                    id_lote as id,
                                    loteo as loteo,
                                    codigo_lote as lote,
                                    frente,
                                    esquina,
                                    superficie,
                                    preciolista,
                                    (SELECT descripcion FROM estado_lotes WHERE id_estado = l.id_estado) as estado
                                    FROM lotes l 
                                    WHERE L.id_estado = 1 and L.id_loteo = '$id_loteo'
                                    ORDER BY loteo, lote";  
                        $res = mysqli_query($connection,$qry);
                        if($res->num_rows > 0)
                        {
                            while ($datos = mysqli_fetch_array($res)) 
                            {                               
                                echo "<tr>                                       
                                        <td>".$datos['loteo']."</td>
                                        <td>".$datos['lote']."</td>
                                        <td>".$datos['frente']."</td>
                                        <td>".$datos['esquina']."</td>
                                        <td>".$datos['superficie']."</td>
                                        <td>".number_format($datos['preciolista'],2,',','.')."</td>
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
<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "lotes_disponibles_".$dato['codigo_loteo'].".pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>
