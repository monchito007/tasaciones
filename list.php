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

$query = "SELECT * FROM tasaciones";

$result = consulta_sql($query);

?>
<div id="title"><h1>Listado de Tasaciones</h1></div>

<div id="content2">
    <table class="tabla">
        <tr>
            <th>id</th>
            <th>comunidad_id</th>
            <th>provincia_id</th>
            <th>municipio_id</th>
            <th>direccion</th>
            <th>id_tipo_de_via</th>
            <th>id_tipo_de_vivienda</th>
            <th>id_vivienda</th>
            <th>metros_reales</th>
            <th>metros_computados</th>
            <th>valor_metros_cuadrados</th>
            <th>archivo</th>            
        </tr>
<?php
    while($datos = mysqli_fetch_array($result)){
        
        echo "<tr>";
        echo "<td>".$datos["id"]."</td>";
        echo "<td>".$datos["comunidad_id"]."</td>";
        echo "<td>".$datos["provincia_id"]."</td>";
        echo "<td>".$datos["municipio_id"]."</td>";
        echo "<td>".$datos["direccion"]."</td>";
        echo "<td>".$datos["id_tipo_de_via"]."</td>";
        echo "<td>".$datos["id_tipo_de_vivienda"]."</td>";
        echo "<td>".$datos["id_vivienda"]."</td>";
        echo "<td>".$datos["metros_reales"]."</td>";
        echo "<td>".$datos["metros_computados"]."</td>";
        echo "<td>".$datos["valor_metros_cuadrados"]."</td>";
        echo "<td><a href='docs/".$datos["archivo"]."/".$datos["archivo"].".pdf' target='_BLANK'>Archivo</a></td>";
        echo "</tr>";
       
    }

?>      
        
    </table>
</div>