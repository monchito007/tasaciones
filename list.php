<?php

/**********************************************************************

Titulo: list.php
Autor: Moisés Aguilar Miranda
Fecha: 15/12/2020
Descripción: Página para listar los datos en la base de datos.
Comentarios:
 
**********************************************************************/

?>
<?php
include 'functions/connect_db.php';
include 'functions/functions.php';

if(!isset($_SESSION['order'])){
    $order = 'ASC';
}else{
    $order = $_SESSION['order'];
    
    if($order=="ASC"){$order="DESC";}     
    else{$order="ASC";}
}

if(isset($_REQUEST['orderby'])){
    
    switch ($_REQUEST['orderby']) {
        case "id":
            $orderby = "d.id";
            break;
        case "comunidad":
            $orderby = "a.comunidad";
            break;
        case "provincia":
            $orderby = "b.provincia";
            break;
        case "municipio":
            $orderby = "c.municipio";
            break;
        case "direccion":
            $orderby = "d.direccion";
            break;
        case "tipo_via":
            $orderby = "e.tipo";
            break;
        case "tipo_vivienda":
            $orderby = "f.tipo";
            break;
        case "vivienda":
            $orderby = "g.vivienda";
            break;
        case "metros_reales":
            $orderby = "d.metros_reales";
            break;
        case "metros_computados":
            $orderby = "d.metros_computados";
            break;
        case "metros_cuadrados":
            $orderby = "d.valor_metros_cuadrados";
            break;
        case "fecha_tasacion":
            $orderby = "d.fecha_tasacion";
            break;
    }
    
}else{
    
    $orderby = "d.id";
    
}

$_SESSION['orderby'] = $orderby;
$_SESSION['order'] = $order;

$query_busqueda = " ";

if(isset($_REQUEST["busqueda"])){
    $busqueda=$_REQUEST["busqueda"];
    if($busqueda!=""){
        $query_busqueda = "AND (d.id LIKE '%$busqueda%' OR a.comunidad LIKE '%$busqueda%' OR b.provincia LIKE '%$busqueda%' OR c.municipio LIKE '%$busqueda%' OR d.direccion LIKE '%$busqueda%' OR e.tipo LIKE '%$busqueda%'"
        ." OR f.tipo LIKE '%$busqueda%' OR g.vivienda LIKE '%$busqueda%' OR d.metros_reales LIKE '%$busqueda%' OR d.metros_computados LIKE '%$busqueda%' OR d.valor_metros_cuadrados LIKE '%$busqueda%' OR d.fecha_tasacion LIKE '%$busqueda%') ";    
    }
}

$query_periodo = " ";

if(isset($_REQUEST['fecha_inicial'])&&(isset($_REQUEST['fecha_final']))){
    $fecha_inicial = $_REQUEST['fecha_inicial'];
    $fecha_final = $_REQUEST['fecha_final'];
    
    if(($fecha_inicial!="")&&($fecha_final!="")){
        $query_periodo = "AND d.fecha_tasacion BETWEEN '$fecha_inicial' AND '$fecha_final' ";
    }
}

$query = "SELECT d.id, a.comunidad, b.provincia, c.municipio, d.direccion, e.tipo, f.tipo, g.vivienda, d.metros_reales, d.metros_computados, d.valor_metros_cuadrados, DATE_FORMAT(d.fecha_tasacion, '%d/%m/%Y') "
        . "FROM comunidades as a, provincias as b, municipios as c, tasaciones as d, tipos_de_via as e, tipos_de_vivienda as f, viviendas as g "
        . "WHERE d.comunidad_id=a.id AND d.provincia_id=b.id AND d.municipio_id=c.id AND d.id_tipo_de_via=e.id AND d.id_tipo_de_vivienda=f.id AND d.id_vivienda=g.id "
        . $query_busqueda
        . $query_periodo
        . "ORDER BY ".$orderby." ".$order;

//echo $query;

$result = consulta_sql($query);

?>
<div id="title"><h1>Listado de Tasaciones</h1></div>
<div id="buscar">
<h3><i class="fa-solid fa-magnifying-glass"></i> Buscar</h3>
</div>
<div id="form_busqueda">
    <form id="form_buscador" action="content.php" onsubmit="return validar_form(this)">
        <table>
            <tr>
                <td><label><b>Texto</b></label></td>
            </tr>
            <tr>
                <td><label><input type="text" name="busqueda" id="busqueda" placeholder="Introduce palabra de busqueda..."></label></td>
            </tr>
            <tr>
                <td><label><b>Periodo</b></label></td>
            </tr>
            <tr>
                <td><label><label>Desde</label><input type="date" name="fecha_inicial" id="fecha_inicial"><label>hasta</label><input type="date" name="fecha_final" id="fecha_final"></label></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Buscar"></td>
            </tr>
        </table>
    </form>
    <div id="errores_form"></div>
</div>
<div id="filtros">
    <?php


    if(isset($_REQUEST["busqueda"])||(isset($_REQUEST['fecha_inicial'])||(isset($_REQUEST['fecha_final'])))){
        if(($_REQUEST["busqueda"]!="")||(($_REQUEST['fecha_inicial']!="")||($_REQUEST['fecha_final']!=""))){
            echo "<label><i><b>Parámetros de búsqueda:</b></i></label><br>";

            if($_REQUEST["busqueda"]!=""){
                echo "<label><i><b>Texto: </b>".$_REQUEST["busqueda"]."</i></label><br>";
            }

            if(($_REQUEST['fecha_inicial']!="")&&($_REQUEST['fecha_final']!="")){
                echo "<label><i><b>Periodo: </b>Desde ".$_REQUEST['fecha_inicial']." hasta ".$_REQUEST['fecha_final']."</i></label>";
            }
        }
    }

    ?>
</div>


<div id="content2">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><a href="content.php?orderby=id">Id</a></th>
                <th scope="col"><a href="content.php?orderby=comunidad">Comunidad</a></th>
                <th scope="col"><a href="content.php?orderby=provincia">Provincia</a></th>
                <th scope="col"><a href="content.php?orderby=municipio">Municipio</a></th>
                <th scope="col"><a href="content.php?orderby=direccion">Direcci&oacute;n</a></th>
                <th scope="col"><a href="content.php?orderby=tipo_via">Tipo de via</a></th>
                <th scope="col"><a href="content.php?orderby=tipo_vivienda">Tipo de vivienda</a></th>
                <th scope="col"><a href="content.php?orderby=vivienda">Vivienda</a></th>
                <th scope="col"><a href="content.php?orderby=metros_reales">Metros reales</a></th>
                <th scope="col"><a href="content.php?orderby=metros_computados">Metros computados</a></th>
                <th scope="col"><a href="content.php?orderby=metros_cuadrados">Valor m<sup>2</sup></a></th>
                <th scope="col"><a href="content.php?orderby=fecha_tasacion">Fecha de tasación</a></th>
                <th scope="col">Archivo</th>
                <th scope="col">Funci&oacute;n</th>
            </tr>
        </thead>
        <tbody>
<?php
    while($datos = mysqli_fetch_array($result)){
        
        echo "<tr>";
        echo "<th scope='row'>".$datos[0]."</th>";
        echo "<td>".utf8_encode($datos[1])."</td>";
        echo "<td>".utf8_encode($datos[2])."</td>";
        echo "<td>".utf8_encode($datos[3])."</td>";
        echo "<td>".utf8_encode($datos[4])."</td>";
        echo "<td>".utf8_decode($datos[5])."</td>";
        echo "<td>".utf8_encode($datos[6])."</td>";
        echo "<td>".utf8_encode($datos[7])."</td>";
        echo "<td>".utf8_encode($datos[8])."</td>";
        echo "<td>".utf8_encode($datos[9])."</td>";
        echo "<td>".utf8_encode($datos[10])."</td>";
        echo "<td>".utf8_encode($datos[11])."</td>";
        echo "<td><a href='docs/".$datos[0]."/".$datos[0].".pdf' target='_BLANK'>Archivo</a><br></td>";
        echo "<td><a href='page.php?page=edit.php&id=".$datos[0]."'>Modificar</a><br><a href='page.php?page=delete.php&id=".$datos[0]."'>Eliminar</a></td>";
        echo "</tr>";
       
    }

?>      
        </tbody>
    </table>
</div>
<script type="text/javascript">

function validar_form(){
    
    var valido=true;
    
    var fecha_inicial = new Date(document.getElementById("fecha_inicial").value);
    var fecha_final = new Date(document.getElementById("fecha_final").value);
    
    document.getElementById("errores_form").innerHTML="<ul id='errores'></ul>";
    
    if(fecha_inicial > fecha_final){
        
        document.getElementById("errores").innerHTML="<li>La fecha inicial no puede ser mayor que la final.</li>";
        document.getElementById("fecha_inicial").style.borderColor = "red";
        document.getElementById("fecha_final").style.borderColor = "red";
        
        return false;
        
    }else{
        
        return valido;
        
    }    
    
}



</script>
<script type="text/javascript">
$(document).ready(function(){

$("#form_busqueda").hide();

$("#buscar").click(function(){
 
 if($("#form_busqueda").is(":hidden")){
                $("#form_busqueda").show(1000);
                $("#busqueda").focus();
            } else{
                $("#form_busqueda").hide(1000);
            }
 
 
});

});//Final Document Ready Function
</script>