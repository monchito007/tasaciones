<?php
//Función para realizar una consulta SQL a partir de una Query y devolver el resultado
function consulta_sql($query){
    
    //Abrimos la conexión al servidor MySQL
    $con = connect_db();
    
    //formato de datos utf8
    //mysqli_set_charset($con, "utf8"); //formato de datos utf8
    
    //Obtenemos los datos de la Query
    $datos = mysqli_query($con, $query);
    
    //Liberamos la memoria del resultado, 
    //mysqli_free_result($datos);

    //Cerramos la conexion al servidor MySQL
    mysqli_close($con);
    
    //Devolvemos los datos
    return $datos;    
    
}

//Función para obtener el número de registros de la tabla Tasaciones
function obtener_num_tasaciones(){
    
    //Abrimos la conexión al servidor MySQL
    $con = connect_db();
    
    //Obtenemos los datos de la Query
    $res = mysqli_query($con, "SELECT COUNT(*) FROM tasaciones");
    
    //Convertimos el resultado en array
    $fila= mysqli_fetch_array($res);

    //Cerramos la conexion al servidor MySQL
    mysqli_close($con);
    
    //Devolvemos los datos
    return $fila[0]; 
    
}

//Función para crear una lista a partir del resultado de una consulta SQL
function crear_lista($result){
    
    while($datos = mysqli_fetch_array($result)){
        echo "<option value=".utf8_encode($datos[0]).">".utf8_encode($datos[1])."</option>";
    }
    
}

//Función para convertir el resultado de una consulta MySQL en un Array
function sql_to_array($res_sql){

    while($fila = mysqli_fetch_assoc($res_sql)){
        $res_array[] = $fila;
        echo $fila;
    }
    
    return $res_array;
    
}

//funcion para obtener las comunidades a partir de una consulta SQL
function get_comunidades(){
    
    //Declaramos la sentencia SQL
    $query = "SELECT id,comunidad FROM comunidades ORDER BY comunidad ASC";
    
    //Obtenemos los datos de la consulta SQL
    $datos = consulta_sql($query);
    
    //Devolvemos los datos
    return $datos;

}
//funcion para obtener las comunidades a partir de una consulta SQL
function get_provincias(){
    
    //Declaramos la sentencia SQL
    $query = "SELECT id,provincia FROM provincias ORDER BY provincia ASC";
    
    //Obtenemos los datos de la consulta SQL
    $datos = consulta_sql($query);
    
    //Devolvemos los datos
    return $datos;

}
//funcion para obtener las comunidades a partir de una consulta SQL
function get_municipios(){    
    
    //Declaramos la sentencia SQL
    $query = "SELECT id,municipio FROM municipios ORDER BY municipio ASC";
    
    //Obtenemos los datos de la consulta SQL
    $datos = consulta_sql($query);
    
    //Devolvemos los datos
    return $datos;

}
//funcion para obtener las comunidades a partir de una consulta SQL
function get_tipos_de_via(){    
    
    //Declaramos la sentencia SQL
    $query = "SELECT id,tipo FROM tipos_de_via ORDER BY tipo ASC";
    
    //Obtenemos los datos de la consulta SQL
    $datos = consulta_sql($query);
    
    //Devolvemos los datos
    return $datos;

}
//funcion para obtener las comunidades a partir de una consulta SQL
function get_tipos_de_vivienda(){    
    
    //Declaramos la sentencia SQL
    $query = "SELECT id,tipo FROM tipos_de_vivienda ORDER BY tipo ASC";
    
    //Obtenemos los datos de la consulta SQL
    $datos = consulta_sql($query);
    
    //Devolvemos los datos
    return $datos;

}
//funcion para obtener las comunidades a partir de una consulta SQL
function get_viviendas(){    
    
    //Declaramos la sentencia SQL
    $query = "SELECT id,vivienda FROM viviendas ORDER BY vivienda ASC";
    
    //Obtenemos los datos de la consulta SQL
    $datos = consulta_sql($query);
    
    //Devolvemos los datos
    return $datos;

}






?>
