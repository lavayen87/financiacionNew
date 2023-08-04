<?php 

    $datos = json_decode($_POST['datos']);
	
	$valor = $datos[0];
	
    include ('../conexion.php');

    $qry = "UPDATE tasainteres SET valor = '$valor'";
            
    mysqli_query($connection, $qry);

    mysqli_close($connection);

    echo 1;

    
?>