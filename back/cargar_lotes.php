<?php 

	$datos = json_decode($_POST['datos']);
	
	  $id_loteo = $datos[0];
    $numlote = $datos[1];
    $frente = $datos[2];
    $superficie = $datos[3];
    $esquina = $datos[4];
    $preciom2 = $datos[5];

    $preciolista = $superficie * $preciom2; 

    include ('../conexion.php');
    include ('../funciones.php');

    $info = Get_Loteo($id_loteo);
    $loteo = $info['loteo'];
    $lote = set_codigo($id_loteo , $numlote );

    // verificar lote 
    $qry = "SELECT * FROM lotes WHERE codigo_lote = '$lote'";
    $res = mysqli_query($connection, $qry);

    if( $res->num_rows == 0)
    {

      $insert = "INSERT IGNORE INTO lotes VALUES
               ('',
                '$id_loteo',
           		  '$loteo',
           	    '$lote',
           	    1,
           	    '$frente',
           	    '$esquina',
           	    '$superficie',
           	    '$preciom2',
           	    '$preciolista'
           	   )";
           	   
      mysqli_query($connection, $insert);
      mysqli_close($connection);
      echo 1;   
    }
    else
    {
      mysqli_close($connection);
      echo 0;  
    }

 ?>