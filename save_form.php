<?php
//phpinfo();

$select_comunidad = $_POST["select_comunidad"];
$select_provincia = $_POST["select_provincia"];
$select_municipio = $_POST["select_municipio"];
$select_tipo_via = $_POST["select_tipo_via"];
$direccion = $_POST["direccion"];
$select_tipo_vivienda = $_POST["select_tipo_vivienda"];
$select_viviendas = $_POST["select_viviendas"];
$metros_reales = $_POST["metros_reales"];
$metros_computados = $_POST["metros_computados"];
$valor_metro_cuadrado = $_POST["valor_metro_cuadrado"];
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
echo "<td>$file</td>";
echo "<td>$SubirBtn</td>";
echo "</tr>";


echo "</table>";

//if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
//...
//}

//datos del arhivo
$nombre_archivo = $_FILES['file']['name'];
$tipo_archivo = $_FILES['file']['type'];
$tamano_archivo = $_FILES['file']['size'];
	
//compruebo si las características del archivo son las que deseo
if (strpos($tipo_archivo, "application/pdf") && ($tamano_archivo < 100000)) {
   	echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
}else{
   	if (move_uploaded_file($_FILES['file']['tmp_name'],  $nombre_archivo)){
      		echo "El archivo ha sido cargado correctamente.";
   	}else{
      		echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
   	}
}

?>
