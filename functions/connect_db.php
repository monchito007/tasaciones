<?php

function connect_db(){

    //Conexión Strato    
    //$con = = mysqli_connect("rdbms.strato.de", "U4340425", "habitatgestions2020", "DB4340425");
    //Conexión Localhost
    $con = mysqli_connect("localhost", "root", "", "tasaciones_db");

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
