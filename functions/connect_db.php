<?php

function connect_db(){

    //Conexión Strato    
    $con = mysqli_connect("PMYSQL154.dns-servicio.com:3306", "tasaciones", "Pellizquito666*", "9060392_tasaciones");
    //Conexión Localhost
    //$con = mysqli_connect("localhost", "root", "", "tasaciones_db");

    //Comprobamos la conexión.
    if (!$con) {
        die('Error de Conexión (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }else{
        //echo 'Éxito... ' . mysqli_get_host_info($con) . "\n";
    }

    return $con;

}
?>
