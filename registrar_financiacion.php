<?php 
	
	$datos = json_decode($_POST['datos']);
	
    $lote = $datos[0];
    $anticipo = $datos[1];
    $saldoafinanciar = $datos[2];
    $cuotas = $datos[3];
    $x1 = $datos[4];
    $x2 = $datos[5];
    $montofinanciado = $datos[6];
    $valorcuota = $datos[7];
    $total = $datos[8];

    include('conexion.php');


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
                            id_estado = 2
                        WHERE
                            codigo_lote = '$lote'";

        mysqli_query($connection,$update_fcion);

        $update_lote = "UPDATE lotes
                        SET 
                            id_estado = 2
                        WHERE
                            codigo_lote = '$lote'";

        mysqli_query($connection,$update_lote);
        
        echo 1; 
    }
    else
    {
        // agregamos una nueva financiacion
        $insert = "INSERT IGNORE INTO financiacion VALUES
                   ('',
                   '$lote',
                   2,
                   '$anticipo',
                   '$saldoafinanciar',
                   '$cuotas',
                   '$x1',
                   '$x2',
                   '$montofinanciado',
                   '$valorcuota',
                   '$total'
                   )"; 
        mysqli_query($connection,$insert);

        $update_lote = "UPDATE lotes
                        SET 
                            id_estado = 2
                        WHERE
                            codigo_lote = '$lote'";

        mysqli_query($connection,$update_lote);

        echo 1; 
    }
   
	

?>