<?php 
	
	$id_loteo = $_POST['id_loteo'];

	 $filas = "";
	
    include ('../conexion.php');

    $qry = "SELECT 
                id_lote as id,
                id_estado,
                loteo as loteo,
                (SELECT id_loteo FROM loteos WHERE loteo = l.loteo) as id_loteo,
                codigo_lote as lote,
                frente,
                esquina,
                superficie,
                preciolista,
                (SELECT descripcion FROM estado_lotes WHERE id_estado = l.id_estado) as estado
                FROM lotes l 
                WHERE l.id_estado = 1 and l.id_loteo = '$id_loteo'
                ORDER BY loteo, lote";  
    $res = mysqli_query($connection,$qry);
    if($res->num_rows > 0)
    {
      while ($datos = mysqli_fetch_array($res)) 
      {
        $id = $datos['id'];

        // esta parte ($acciones) es un cambio de la consulta original en lotes_disponibles                             
        $acciones = "<a href='financiacion.php?id=$id' class='btn btn-primary btn-sm' title='Financiar'>
	                    <i class='fa fa-info-circle'></i>
	                 </a>";           
      
        $filas.= "<tr id='".$id."'>                                       
            <td>".$datos['loteo']."</td>
            <td>".$datos['lote']."</td>
            <td>".$datos['frente']."</td>
            <td>".$datos['esquina']."</td>
            <td>".$datos['superficie']."</td>
            <td>"."<b>$</b>".number_format( $datos['preciolista'],2,',','.')."</td>
            <td>".$datos['estado']."</td>
            <td>".$acciones."</td>
            <td><i class='fa fa-check check' style='color: green; display: none;'></i>
            </td>
           </tr>";
      }                               
    } 
    mysqli_close($connection);
    echo $filas;
?>