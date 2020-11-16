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

//echo json_encode(sql_to_array($comunidades));

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
                    //crear_lista($comunidades);
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
                    //crear_lista($provincias);
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
                <td><input type="text" id="metros_reales" class="decimales"/></td>
            </tr>
            <tr>
                <td><label>Metros computados</label></td>
                <td><input type="text" id="metros_computados" class="decimales"/></td>
            </tr>
            <tr>
                <td><label>Valor m<sup>2</sup></label></td>
                <td><input type="text" id="valor_metro_cuadrado"/></td>
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
    
    //Función para cargar un select desde un archivo JSON    
    $.getJSON('json/comunidades.json', function(data) {
        $.each(data, function(key, value) {
                $("#select_comunidad").append('<option value=' + value.id + '>' + value.comunidad + '</option>');
        }); // close each()
    }); // close getJSON()
    
    $("#select_comunidad").change(function(){
        
        var id_comunidad = $("#select_comunidad").val();
        
        if(id_comunidad==='0'){
            $("#select_provincia").prop("disabled",true);
        }else{
            $("#select_provincia").prop("disabled",false);
            
            //Vaciamos el select
            $("#select_provincia").empty();
            
            //Función para cargar un select desde un archivo JSON    
            $.getJSON('json/provincias.json', function(data){
                $.each(data, function(key, value) {
                    
                        if(parseInt(id_comunidad)===value.comunidad_id){
                            $("#select_provincia").append('<option value=' + value.id + '>' + value.provincia + '</option>');
                            //alert(value.id + " - " + value.provincia);
                        }
                }); // close each()
            }); // close getJSON()
            
        }
        
    });
    
    
    
    
    
    
 
    
    //Creamos la clase decimales para los imput.
    $('.decimales').on('input', function () {
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    });
    
    
    
    

    
    
    
    
    
    
    
    
    
    
});//Final Document Ready Function

</script>


