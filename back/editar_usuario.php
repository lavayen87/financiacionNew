<?php 

$datos = json_decode($_POST['datos']);
	
	$id_usuario = $datos[0];
	$id_rol = $datos[1];
	$nombre = $datos[2];
    $usuario = $datos[3];
    $pass = $datos[4];

    include ('../conexion.php');

    $qry = "UPDATE usuarios 
    		SET
    			id_rol = '$id_rol',
    			nombre = '$nombre',
    			usuario = '$usuario',
    			pass = '$pass'
    		WHERE id_usuario = '$id_usuario'";
    mysqli_query($connection, $qry);

    echo 1;

    mysqli_close($connection);
?>