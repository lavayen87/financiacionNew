<?php 
	
	$datos = json_decode($_POST['datos']);
	
    $id_lote = $datos[0];
    $lote = strtoupper($datos[1]);
    $anticipo = $datos[2];
    $saldoafinanciar = $datos[3];
    $cuotas = $datos[4];
    $x1 = $datos[5];
    $x2 = $datos[6];
    $montofinanciado = $datos[7];
    $valorcuota = $datos[8];
    $total = $datos[9];
    $id_usuario = $datos[10];

    include('../conexion.php');


    // verificar lote financiado

    $qry = "SELECT * FROM financiacion WHERE codigo_lote = '$lote'";
    $res = mysqli_query($connection, $qry);
   
    if( $res->num_rows > 0 )
    {
        // actulaizamo el lote 
        $update_fcion = "UPDATE financiacion 
                SET 
                    anticipo = '$anticipo',
                    saldo_financiar = '$saldoafinanciar',
                    cuotas = '$cuotas',
                    x1 = '$x1',
                    x2 = '$x2',
                    monto_financiado = '$montofinanciado',
                    valor_cuota = '$valorcuota',
                    total_operacion = '$total',
                    id_usuario = '$id_usuario',
                    id_estado = 2
                WHERE
                    codigo_lote = '$lote' AND 
                    id_lote = '$id_lote'";

        mysqli_query($connection,$update_fcion);

        $update_lote = "UPDATE lotes
                SET id_estado = 2
                WHERE
                    codigo_lote = '$lote' AND
                    id_lote = '$id_lote'";

        mysqli_query($connection,$update_lote);
        
        echo 1; 
    }
    else
    {
        // agregamos una nueva financiacion
        $insert = "INSERT IGNORE INTO financiacion VALUES
               ('',
               '$id_lote',
               '$lote',
               2,
               '$anticipo',
               '$saldoafinanciar',
               '$cuotas',
               '$x1',
               '$x2',
               '$montofinanciado',
               '$valorcuota',
               '$total',
               '$id_usuario'
               )"; 
        mysqli_query($connection,$insert);

        $update_lote = "UPDATE lotes
                SET id_estado = 2
                WHERE
                    codigo_lote = '$lote' AND
                    id_lote = '$id_lote'";

        mysqli_query($connection,$update_lote);

        echo 1; 
    }
   
	

?>