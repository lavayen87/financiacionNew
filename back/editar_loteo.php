<?php 

$datos = json_decode($_POST['datos']);
	
	$id_loteo = $datos[0];
	$cabecera = $datos[1];
	$anticipo = $datos[2];
    $posesion = $datos[3];
    $anticipo_uno = $datos[4];
    $anticipo_dos = $datos[5];
    $servicios = $datos[6];

    include ('../conexion.php');

    $qry = "UPDATE info_loteos
    		SET
    			cabecera = '$cabecera',
    			anticipo_minimo = '$anticipo',
    			posesion = '$posesion',
    			anticipo_uno = '$anticipo_uno',
                anticipo_dos = '$anticipo_dos',
                servicios = '$servicios'
    		WHERE id_loteo = '$id_loteo'";
            
    mysqli_query($connection, $qry);

    echo 1;

    mysqli_close($connection);
?>