<?php 

	include ('../funciones.php');
	
	$datos = get_query("tasainteres");

	echo $datos['valor'];
?>