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

//$query = "SELECT * FROM tasaciones";

$query = "SELECT d.id, a.comunidad, b.provincia, c.municipio, d.direccion, e.tipo, f.tipo, g.vivienda, d.metros_reales, d.metros_computados, d.valor_metros_cuadrados, d.archivo "
        . "FROM comunidades as a, provincias as b, municipios as c, tasaciones as d, tipos_de_via as e, tipos_de_vivienda as f, viviendas as g "
        . "WHERE d.comunidad_id=a.id AND d.provincia_id=b.id AND d.municipio_id=c.id AND d.id_tipo_de_via=e.id AND d.id_tipo_de_vivienda=f.id AND d.id_vivienda=g.id";

$result = consulta_sql($query);

?>
<div id="title"><h1>Listado de Tasaciones</h1></div>

<div id="content2">
    <table class="tabla">
        <tr>
            <th>Id</th>
            <th>Comunidad</th>
            <th>Provincia</th>
            <th>Municipio</th>
            <th>Direccion</th>
            <th>Tipo de via</th>
            <th>Tipo de vivienda</th>
            <th>Vivienda</th>
            <th>Metros reales</th>
            <th>Metros computados</th>
            <th>Valor m<sup>2</sup></th>
            <th>Archivo</th>            
        </tr>
<?php
    while($datos = mysqli_fetch_array($result)){
        
        echo "<tr>";
        echo "<td>".$datos[0]."</td>";
        echo "<td>".$datos[1]."</td>";
        echo "<td>".$datos[2]."</td>";
        echo "<td>".$datos[3]."</td>";
        echo "<td>".$datos[4]."</td>";
        echo "<td>".$datos[5]."</td>";
        echo "<td>".$datos[6]."</td>";
        echo "<td>".$datos[7]."</td>";
        echo "<td>".$datos[8]."</td>";
        echo "<td>".$datos[9]."</td>";
        echo "<td>".$datos[10]."</td>";
        echo "<td><a href='docs/".$datos[11]."/".$datos[11].".pdf' target='_BLANK'>Archivo</a></td>";
        echo "</tr>";
       
    }

?>      
    </table>
</div>