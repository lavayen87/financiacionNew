<?php 

    $datos = json_decode($_POST['datos']);
	
	$id_lote = $datos[0];
    $id_estado = $datos[1];
	
    include ('../conexion.php');

    $qry1 = "UPDATE lotes SET id_estado = '$id_estado'
             WHERE id_lote = '$id_lote'";

    mysqli_query($connection, $qry1);


    if( $id_estado == 1)
    {
        $qry2 = "DELETE FROM financiacion
                 WHERE id_lote = '$id_lote'";

        mysqli_query($connection, $qry2);
    }
        
    echo 1;

    mysqli_close($connection);  
?>