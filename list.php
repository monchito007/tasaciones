<?php

/**********************************************************************

Titulo: list.php
Autor: Moisés Aguilar Miranda
Fecha: 15/12/2020
Descripción: Página para guardar los datos en la base de datos.
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


$query = "SELECT d.id, a.comunidad, b.provincia, c.municipio, d.direccion, e.tipo, f.tipo, g.vivienda, d.metros_reales, d.metros_computados, d.valor_metros_cuadrados, DATE_FORMAT(d.fecha_tasacion, '%d/%m/%Y') "
        . "FROM comunidades as a, provincias as b, municipios as c, tasaciones as d, tipos_de_via as e, tipos_de_vivienda as f, viviendas as g "
        . "WHERE d.comunidad_id=a.id AND d.provincia_id=b.id AND d.municipio_id=c.id AND d.id_tipo_de_via=e.id AND d.id_tipo_de_vivienda=f.id AND d.id_vivienda=g.id "
        . "ORDER BY ".$orderby." ".$order;

//echo $query;

$result = consulta_sql($query);

?>
<div id="title"><h1>Listado de Tasaciones</h1></div>

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
        echo "<td>".$datos[1]."</td>";
        echo "<td>".$datos[2]."</td>";
        echo "<td>".$datos[3]."</td>";
        echo "<td>".utf8_decode($datos[4])."</td>";
        echo "<td>".$datos[5]."</td>";
        echo "<td>".$datos[6]."</td>";
        echo "<td>".$datos[7]."</td>";
        echo "<td>".$datos[8]."</td>";
        echo "<td>".$datos[9]."</td>";
        echo "<td>".$datos[10]."</td>";
        echo "<td>".$datos[11]."</td>";
        echo "<td><a href='docs/".$datos[0]."/".$datos[0].".pdf' target='_BLANK'>Archivo</a></td>";
        echo "<td><a href='page.php?page=delete.php&id=".$datos[0]."'>Eliminar</a></td>";
        echo "</tr>";
       
    }

?>      
        </tbody>
    </table>
</div>