<?php 

  include('../conexion.php');
  
  if(isset($_POST['id_lote']))
  {
    $id_lote = $_POST['id_lote'];
    //$codigo_lote = $_POST['lote'];
  }
  else
  {
    $id_lote = 0;
    $codigo_lote = '##';
  }
  
  $qry = "SELECT * 
          FROM financiacion
          WHERE id_lote = '$id_lote'";
          
  $res = mysqli_query($connection,$qry);
  
  if($res->num_rows > 0)
  {
     $lista = array();
      while($row = mysqli_fetch_array($res)) 
      {
        $lista[] = array(
          'id_lote' => $row['id_lote'],          
          'codigo_lote' => $row['codigo_lote'],
          'id_estado' => $row['id_estado'],
          'anticipo' => $row['anticipo'],
          'saldo_financiar' => number_format($row['saldo_financiar'],2,',','.'),
          'cuotas' => $row['cuotas'],
          'monto_financiado' => number_format($row['monto_financiado'],2,',','.'),
          'valor_cuota' => number_format($row['valor_cuota'],2,',','.'),
          'total_operacion' => number_format($row['total_operacion'],2,',','.')
        );
      }
      
      $datos = json_encode($lista);
      echo $datos;
  }
  else echo 0;

  mysqli_close($connection);
?>
			      