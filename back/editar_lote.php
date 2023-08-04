<?php 

	$datos = json_decode($_POST['datos']);
	
	$id_lote = $datos[0];
	$loteo = $datos[1];
	$codigolote = $datos[2];
	$id_estado = $datos[3];
    $frente = $datos[4];
    $esquina = $datos[5];
    $superficie = $datos[6];
    $preciom2 = $datos[7];

    //echo print_r($datos); exit;

	include('../conexion.php');
  
	$qry = "UPDATE lotes 
	  		SET loteo = '$loteo',
  		  	    codigo_lote = '$codigolote',
  		  	    id_estado = '$id_estado',
  		  	    frente = '$frente',
  		  	    esquina = '$esquina',
  		  	    superficie = '$superficie',
  		  	    preciom2 = '$preciom2',
	  		    preciolista = '$superficie'*'$preciom2' 
	        WHERE id_lote = '$id_lote'";
	          
	mysqli_query($connection, $qry);
	
	
	$qry2 = "DELETE FROM financiacion WHERE id_lote = '$id_lote'";
	mysqli_query($connection,$qry2);


	echo 1;

	mysqli_close($connection);

?>