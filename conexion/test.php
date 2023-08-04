<?php 
require('Conexion.php');
	$data=new Conexion();
	$conexion=$data->conect();
	$strquery ="SELECT * FROM usuarios";
	$result = $conexion->prepare($strquery);
	$result->execute();
	$data = $result->fetchall(PDO::FETCH_ASSOC);
	
	var_dump($data);
 ?>