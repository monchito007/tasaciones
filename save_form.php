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
$file = $_FILES["file"]["name"];
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
echo "<th>file</th>";
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
echo "<td>$file</td>";
echo "<td>$SubirBtn</td>";
echo "</tr>";


echo "</table>";

//datos del arhivo
$nombre_archivo = $_FILES['file']['name'];
$tipo_archivo = $_FILES['file']['type'];
$tamano_archivo = $_FILES['file']['size'];

//Obtenemos el id de la nueva tasación
$id_tasacion = obtener_id_tasacion()+1;

$direccion = str_replace("'", "''", $direccion);


$query = "INSERT INTO tasaciones (comunidad_id, provincia_id, municipio_id, direccion, id_tipo_de_via, id_tipo_de_vivienda, id_vivienda, metros_reales, metros_computados, valor_metros_cuadrados, fecha_tasacion) "
        . "VALUES ($select_comunidad, $select_provincia, $select_municipio, '$direccion', $select_tipo_via, $select_tipo_vivienda, $select_viviendas, $metros_reales, $metros_computados, $valor_metro_cuadrado, '$fecha_tasacion');";


//Colocamos el autoincrement en el id que toca.
set_autoincrement();

//compruebo si las características del archivo son las que deseo
if (strpos($tipo_archivo, "application/pdf") && ($tamano_archivo < 20000000)){
        echo "La extensión o el tamaño del archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .pdf<br><li>se permiten archivos de 10 Mb máximo.</td></tr></table>";
}else{
        //Creamos el directorio y le damos permisos
        $path="docs/".$id_tasacion;
        mkdir($path,0777,TRUE);

        //Movemos el archivo 
        if (move_uploaded_file($_FILES['file']['tmp_name'],  $path."/".$id_tasacion.".pdf")){
                echo "El archivo ha sido cargado correctamente.";
                consulta_sql($query);
                
                $_SESSION['page']='list.php';
                
                //Redrirección Javascript
                echo '<script type="text/javascript">window.location.href = "content.php";</script>';
                
                //El header de php no se puede usar para direccionar una página en cualquier punto. 
                //Unicamente se puede utilizar si es exactamente la primera salida que se envía, 
                //si no lo es no funcionará (por tanto no se puede usar en un punto intermedio de una web)
                header('Location: content.php');
                die();
                
        }else{
                echo utf8_decode("Ocurrió algún error al subir el fichero. No pudo guardarse.");
        }
} 

echo $query;


?>
