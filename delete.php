<?php
if(!isset($_SESSION['id'])){
    $_SESSION['page'] = 'list.php';
    header('Location: content.php');
}

/**********************************************************************

Titulo: delete.php
Autor: Moisés Aguilar Miranda
Fecha: 17/12/2020
Descripción: Página para mostrar el registro que se quiere eliminar.
Comentarios:
 
**********************************************************************/

?>
<?php

include 'functions/connect_db.php';
include 'functions/functions.php';

//$query = "SELECT * FROM tasaciones";

$query = "SELECT d.id, a.comunidad, b.provincia, c.municipio, d.direccion, e.tipo, f.tipo, g.vivienda, d.metros_reales, d.metros_computados, d.valor_metros_cuadrados "
        . "FROM comunidades as a, provincias as b, municipios as c, tasaciones as d, tipos_de_via as e, tipos_de_vivienda as f, viviendas as g "
        . "WHERE d.comunidad_id=a.id AND d.provincia_id=b.id AND d.municipio_id=c.id AND d.id_tipo_de_via=e.id AND d.id_tipo_de_vivienda=f.id AND d.id_vivienda=g.id "
        . "AND d.id=".$_SESSION['id'];

$result = consulta_sql($query);

?>
<div id="title"><h1>Modificar tasaci&oacute;n <?php echo $_SESSION['id']; ?></h1></div>

<div id="content2">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Comunidad</th>
                <th scope="col">Provincia</th>
                <th scope="col">Municipio</th>
                <th scope="col">Direcci&oacute;n</th>
                <th scope="col">Tipo de via</th>
                <th scope="col">Tipo de vivienda</th>
                <th scope="col">Vivienda</th>
                <th scope="col">Metros reales</th>
                <th scope="col">Metros computados</th>
                <th scope="col">Valor m<sup>2</sup></th>
                <th scope="col">Archivo</th>
                        
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
        echo "<td>".$datos[4]."</td>";
        echo "<td>".$datos[5]."</td>";
        echo "<td>".$datos[6]."</td>";
        echo "<td>".$datos[7]."</td>";
        echo "<td>".$datos[8]."</td>";
        echo "<td>".$datos[9]."</td>";
        echo "<td>".$datos[10]."</td>";
        echo "<td><a href='docs/".$datos[0]."/".$datos[0].".pdf' target='_BLANK'>Archivo</a></td>";
        echo "</tr>";
       
    }

?>      
        </tbody>
    </table>
</div>
<div id="options">
    <table>
        <tr>
            <td colspan="2">Seguro que deseas eliminar la tasaci&oacute;n?</td>
        </tr>
        <tr>
            <?php
            echo "<td><a href='delete2.php?id=".$_SESSION['id']."'>S&iacute;</a></td>";
            echo "<td><a href='page.php?page=list.php'>No</a></td>";
            ?>
        </tr>
    </table>
</div>