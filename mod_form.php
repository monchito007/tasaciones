<?php
session_start();
?>
<?php

/**********************************************************************

Titulo: save_form.php
Autor: Moisés Aguilar Miranda
Fecha: 14/12/2020
Descripción: Página para guardar los datos en la base de datos.
Comentarios:
 
**********************************************************************/

?>
<?php
//phpinfo();

include 'functions/connect_db.php';
include 'functions/functions.php';

$id_tasacion = $_POST["id_tasacion"];
$select_comunidad = $_POST["select_comunidad"];
$select_provincia = $_POST["select_provincia"];
$select_municipio = $_POST["select_municipio"];
$select_tipo_via = $_POST["select_tipo_via"];
$direccion = $_POST["direccion"];
$select_tipo_vivienda = $_POST["select_tipo_vivienda"];
$select_viviendas = $_POST["select_viviendas"];
$metros_reales = str_replace(",",".", $_POST["metros_reales"]);
$metros_computados = str_replace(",",".", $_POST["metros_computados"]);
$valor_metro_cuadrado = str_replace(",",".", $_POST["valor_metro_cuadrado"]);
$fecha_tasacion = $_POST["fecha_tasacion"];
$SubirBtn = $_POST["SubirBtn"];

echo "<table border=1>";
echo "<tr>";
echo "<th>select_comunidad</th>";
echo "<th>select_provincia</th>";
echo "<th>select_municipio</th>";
echo "<th>select_tipo_via</th>";
echo "<th>direccion</th>";
echo "<th>select_tipo_vivienda</th>";
echo "<th>select_viviendas</th>";
echo "<th>metros_reales</th>";
echo "<th>metros_computados</th>";
echo "<th>valor_metro_cuadrado</th>";
echo "<th>fecha_tasacion</th>";
echo "<th>SubirBtn</th>";
echo "</tr>";

echo "<tr>";
echo "<td>$select_comunidad</td>";
echo "<td>$select_provincia</td>";
echo "<td>$select_municipio</td>";
echo "<td>$select_tipo_via</td>";
echo "<td>$direccion</td>";
echo "<td>$select_tipo_vivienda</td>";
echo "<td>$select_viviendas</td>";
echo "<td>$metros_reales</td>";
echo "<td>$metros_computados</td>";
echo "<td>$valor_metro_cuadrado</td>";
echo "<td>$fecha_tasacion</td>";
echo "<td>$SubirBtn</td>";
echo "</tr>";


echo "</table>";


//Obtenemos el id de la nueva tasación

$direccion = str_replace("'", "''", $direccion);


$query = "UPDATE tasaciones SET comunidad_id=$select_comunidad, provincia_id=$select_provincia, municipio_id=$select_municipio, direccion='$direccion', id_tipo_de_via=$select_tipo_via, id_tipo_de_vivienda=$select_tipo_vivienda, id_vivienda=$select_viviendas, metros_reales=$metros_reales, metros_computados=$metros_computados, valor_metros_cuadrados=$valor_metro_cuadrado, fecha_tasacion='$fecha_tasacion' "
        . "WHERE id=$id_tasacion";

//UPDATE Customers
//SET ContactName = 'Alfred Schmidt', City= 'Frankfurt'
//WHERE CustomerID = 1;



consulta_sql($query);

$_SESSION['page']='list.php';

//Redrirección Javascript
echo '<script type="text/javascript">window.location.href = "content.php";</script>';

//El header de php no se puede usar para direccionar una página en cualquier punto. 
//Unicamente se puede utilizar si es exactamente la primera salida que se envía, 
//si no lo es no funcionará (por tanto no se puede usar en un punto intermedio de una web)
header('Location: content.php');
die();


echo $query;


?>
