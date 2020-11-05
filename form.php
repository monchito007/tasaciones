<?php

/**********************************************************************

Titulo: form.php
Autor: Moisés Aguilar Miranda
Fecha: 04/11/2020
Descripción: Página para añadir tasaciones a la base de datos.
Comentarios:
 
**********************************************************************/

?>
<?php

include 'connection/connect_db.php';
include 'functions/functions.php';

$comunidades = get_comunidades();
$provincias = get_provincias();
$municipios = get_municipios();
$tipos_de_via = get_tipos_de_via();
$tipos_de_vivienda = get_tipos_de_vivienda();
$viviendas = get_viviendas();

echo json_encode(sql_to_array($comunidades));

?>
<div id="title"><h1>Añadir tasación</h1></div>

<div id="form">

    <form method="POST" action="save_form.php">
        <table id="table_formulario">
            <!-- Selects dinamicos
            https://desarrolloweb.com/articulos/1281.php -->
            <tr>
                <td><label>Comunidad</label></td>
                <td>
                <select id="select_comunidad">
                    <option value="0" selected>Selecciona...</option> 
                    <?php
                    crear_lista($comunidades);
                    ?>                  
                </select>
                </td>
            </tr>
            <tr>
                <td><label>Provincia</label></td>
                <td>
                <select id="select_provincia">
                    <option value="0" selected>Selecciona...</option> 
                    <?php
                    crear_lista($provincias);
                    ?>     
                </select>
                </td>
            </tr>
            <tr>
                <td><label>Municipio</label></td>
                <td>
                <select id="select_municipio">
                    <option value="0" selected>Selecciona...</option> 
                    <?php
                    crear_lista($municipios);
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td><label>Tipo de via</label></td>
                <td>
                <select id="select_tipo_via">
                    <option value="0" selected>Selecciona...</option> 
                    <?php
                    crear_lista($tipos_de_via);
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td><label>Direccion</label></td>
                <td><textarea id="direccion" placeholder="Añade la dirección..."></textarea></td>
            </tr>
            <tr>
                <td><label>Tipo de vivienda</label></td>
                <td>
                <select id="select_tipo_vivienda">
                    <option value="0" selected>Selecciona...</option> 
                    <?php
                    crear_lista($tipos_de_vivienda);
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td><label>Vivienda</label></td>
                <td>
                <select id="viviendas">
                    <option value="0" selected>Selecciona...</option> 
                    <?php
                    crear_lista($viviendas);
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td><label>Metros reales</label></td>
                <td><input type="number" id="metros_reales" class="decimales"/></td>
            </tr>
            <tr>
                <td><label>Metros computados</label></td>
                <td><input type="number" id="metros_computados" class="decimales"/></td>
            </tr>
            <tr>
                <td><label>Valor m<sup>2</sup></label></td>
                <td><input type="number" id="valor_metro_cuadrado"/></td>
            </tr>
            <!-- https://desarrolloweb.com/articulos/1307.php -->
            <tr>
                <td><label>Archivo de tasación</label></td>
                <td><input name="userfile" type="file"></td>
            </tr>





        </table>
    </form>

</div>
<script>
// A $( document ).ready() block.
$(document).ready(function() {
    //Deshabilitamos los selectsde provincia y municipio al iniciar la página
    $("#select_provincia").prop("disabled",true);
    $("#select_municipio").prop("disabled",true);
    $("#select_municipio").prop("disabled",true);
    
    //Habilitamos el select provincia si se ha seleccionado una comunidad
    $("#select_comunidad").on('change', function() {
        if(this.value!=="0"){
            $("#select_provincia").prop("disabled",false);
        }else{
            $("#select_provincia").prop("disabled",true);
        }
    });
    
    //Habilitamos el select municipio si se ha seleccionado una provincia
    $("#select_provincia").on('change', function() {
        if(this.value!=="0"){
            $("#select_municipio").prop("disabled",false);
        }else{
            $("#select_municipio").prop("disabled",true);
        }
    });
    
    //Habilitamos el campo de texto direccion si se ha seleccionado tipo de via
    $("#select_tipo_via").on('change', function() {
        if(this.value!=="0"){
            $("#direccion").prop("disabled",false);
        }else{
            $("#direccion").prop("disabled",true);
        }
    });
    
    //Creamos la clase decimales para los imput.
    $('.decimales').on('input', function () {
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    });
    
});//Final Document Ready Function

</script>


