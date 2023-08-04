<?php 

$datos = json_decode($_POST['datos']);
	
	$id_loteo = $datos[0];
	$porcentaje = $datos[1];
	
    include ('../conexion.php');

    //CONSULTA ORIGIANL

    // $qry = "UPDATE lotes 
    //         SET preciolista = (preciom2*superficie) + (('$porcentaje'*(preciom2*superficie))/100)
    //         WHERE id_lote IN 
    //         ( SELECT lo.id_lote
    //           FROM loteos l INNER JOIN lotes lo
    //           ON l.loteo = lo.loteo 
    //           WHERE l.id_loteo = '$id_loteo' AND lo.id_estado = 1 
    //         )";

    $qry1 = "UPDATE lotes SET preciom2 = preciom2 + ((preciom2*'$porcentaje')/100) 
             WHERE loteo = (SELECT loteo FROM  loteos WHERE id_loteo = '$id_loteo')
             AND id_estado = 1";

    mysqli_query($connection, $qry1);

    $qry2 = "UPDATE lotes SET preciolista = (preciom2*superficie) 
             WHERE loteo = (SELECT loteo FROM  loteos WHERE id_loteo = '$id_loteo')
             AND id_estado = 1";

    mysqli_query($connection, $qry2);
    
    echo 1;

    mysqli_close($connection);  
?>