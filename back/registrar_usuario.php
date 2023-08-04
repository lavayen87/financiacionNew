<?php 

$datos = json_decode($_POST['datos']);
	
	$nombre = $datos[0];
    $usuario = $datos[1];
    $id_rol = $datos[2];
    $pass = $datos[3];

    include ('../conexion.php');
    include ('../funciones.php');

    // verificar la existencia del usuario
    $qry = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $res = mysqli_query($connection, $qry);
    if($res->num_rows > 0)
    {	
    	echo 0;
    	mysqli_close($connection);
    }
    else
    {
    	$insert = "INSERT IGNORE INTO usuarios VALUES
    			  ('',
    			   '$id_rol',
    			   '$nombre',
    			   '$usuario',
    			   '$pass'
    			   )";

    	mysqli_query($connection,$insert);

    	echo 1;

    	mysqli_close($connection);
    }
?>