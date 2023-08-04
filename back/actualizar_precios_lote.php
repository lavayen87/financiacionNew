<?php 

$datos = json_decode($_POST['datos']);
	
	$id_lote = $datos[0];
	$precio = $datos[1];
	
    include ('../conexion.php');

    $qry1 = "UPDATE lotes SET preciom2 = '$precio'
             WHERE id_lote = '$id_lote'";

    mysqli_query($connection, $qry1);

    $qry2 = "UPDATE lotes SET preciolista = (superficie * preciom2)
             WHERE id_lote = '$id_lote'";

    mysqli_query($connection, $qry2);
    
    echo 1;

    mysqli_close($connection);  
?>