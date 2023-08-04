<?php 
	
	//obtener datos de una tabla
	function get_query($tabla)
	{
		include ('conexion.php');
		$qry = "SELECT * FROM $tabla";
		$res = mysqli_query($connection,$qry);
		$datos = mysqli_fetch_array($res);
		mysqli_close($connection);
		return $datos;
	}

	//obtener datos de un lote
	function get_infoLote(int $id_lote)
	{
		include ('conexion.php');
		$qry = "SELECT * FROM lotes WHERE id_lote = '$id_lote'";
		$res = mysqli_query($connection,$qry);
		$datos = mysqli_fetch_array($res);
		mysqli_close($connection);
		return $datos;
	}
	

	// Genera el fomrato de fecha '1/2/23'
	function fecha_min(string $fecha)
	{
 
		$aux = substr($fecha,2,8);   
		$d = substr($aux,6,2);
		$m = substr($aux,3,2);
		$a = substr($aux,0,2);
		$nueva_fecha = $d.'/'.$m.'/'.$a;
		return $nueva_fecha;
	}

	// generar el codigo de un lote
	function set_codigo(int $id_loteo, int $numlote)
	{
		include ('conexion.php');
		$let = "";
		$qry = "SELECT * FROM loteos WHERE id_loteo = '$id_loteo'";
		$res = mysqli_query($connection,$qry);
		$datos = mysqli_fetch_array($res);
		$let = $datos['codigo_loteo'];

		if($numlote < 10)
            $lote = $let.'000'.$numlote;
        else
        {
            if($numlote >= 10 && $numlote < 100)
                $lote = $let.'00'.$numlote; 
            else
            {
                if($numlote >= 100 && $numlote < 1000)
                    $lote = $let.'0'.$numlote;
                else
                    $lote = $let.$numlote;
            }
        }
        mysqli_close($connection);
        return $lote;
	}

	// obtener un loteo
	function Get_Loteo(int $id_loteo)
	{
		include ('conexion.php');
		$qry = "SELECT * FROM loteos WHERE id_loteo = '$id_loteo'";
		$res = mysqli_query($connection,$qry);
		$datos = mysqli_fetch_array($res);		
		mysqli_close($connection);
		return $datos; // obtener loteo y codigo_loteo
	}

	// obtener un listado de subcadenas a partir de una cadena
	function lineas(string $texto)
	{    
		$cadena = "";                                                   
        $lineas = explode("." , $texto);
        for ($i=0; $i < count($lineas)-1 ; $i++) 
        { 
            $cadena.= $lineas[$i]."."."<br>";
        }  
        return $cadena;  
	}
?>