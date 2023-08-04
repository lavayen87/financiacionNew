<?php 

  include('../conexion.php');
  
  if(isset($_POST['lote']))
    $codigo_lote = $_POST['lote'];
  else
    $codigo_lote = '##';
  
  $qry = "SELECT * , (SELECT descripcion 
                     FROM estado_lotes e 
                     WHERE e.id_estado = l.id_estado) 
                     as estado 
          FROM lotes l
          WHERE codigo_lote = '$codigo_lote'";
          
  $res = mysqli_query($connection,$qry);
  
  if($res->num_rows > 0)
  {
     $lista = array();
      while($row = mysqli_fetch_array($res)) 
      {
        $lista[] = array(
          'id_lote' => $row['id_lote'],
          'loteo' => $row['loteo'],
          'codigo_lote' => $row['codigo_lote'],
          'id_estado' => $row['id_estado'],
          'estado' => $row['estado'], 
          'frente' => $row['frente'],  
          'esquina' => $row['esquina'], 
          'superficie' => $row['superficie'],
          'preciom2' => $row['preciom2'],
          'preciolista' => $row['preciolista']
        );
      }
      
      $datos = json_encode($lista);
      echo $datos;
  }
  else echo 0;

  mysqli_close($connection);
?>
			      