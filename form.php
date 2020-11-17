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

/*
$comunidades = get_comunidades();
$provincias = get_provincias();
$municipios = get_municipios();
$tipos_de_via = get_tipos_de_via();
$tipos_de_vivienda = get_tipos_de_vivienda();
$viviendas = get_viviendas();
*/

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
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Provincia</label></td>
                <td>
                    <select id="select_provincia">
                        <option value="0" selected>Selecciona...</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Municipio</label></td>
                <td>
                    <select id="select_municipio">
                        <option value="0" selected>Selecciona...</option> 
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Tipo de via</label></td>
                <td>
                    <select id="select_tipo_via">
                        <option value="0" selected>Selecciona...</option> 
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
                        //crear_lista($tipos_de_vivienda);
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Vivienda</label></td>
                <td>
                    <select id="select_viviendas">
                        <option value="0" selected>Selecciona...</option> 
                        <?php
                        //crear_lista($viviendas);
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Metros reales</label></td>
                <td><input type="text" id="metros_reales" maxlength="7" onkeypress="return filterFloat(event,this);" placeholder="metros reales..."/></td>
            </tr>
            <tr>
                <td><label>Metros computados</label></td>
                <td><input type="text" id="metros_computados" maxlength="7" onkeypress="return filterFloat(event,this);" placeholder="metros computados..."/></td>
            </tr>
            <tr>
                <td><label>Valor m<sup>2</sup> (€)</label></td>
                <td><input type="text" id="valor_metro_cuadrado" maxlength="7" onkeypress="return filterFloat(event,this);" placeholder="valor metro..."/></td>
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
$(document).ready(function(){
    
    //Deshabilitamos los Selects Provincias y Municipios porque no hemos seleccionado ninguna Comunidad.
    $("#select_provincia").prop("disabled",true);
    $("#select_municipio").prop("disabled",true);
    $("#select_viviendas").prop("disabled",true);
    
    
    //Función para cargar un select Comunidades desde un archivo JSON
    $.getJSON('json/comunidades.json', function(data) {
        $.each(data, function(key, value) {
                //Añadimos la comunidades en el Select
                $("#select_comunidad").append('<option value=' + value.id + '>' + value.comunidad + '</option>');
        }); // close each()
    }); // close getJSON()
    
    
    //Si cambiamos el valor del Select Comunidad, cargamos las provincias pertinentes en el Select Provincias
    $("#select_comunidad").change(function(){
        
        //Obtenemos el ID de la comunidad
        var id_comunidad = $("#select_comunidad").val();
        
        //Según el valor habilitamos o no el Select provincia.
        if(id_comunidad==='0'){
            $("#select_provincia").prop("disabled",true);
            $("#select_municipio").prop("disabled",true);
        }else{
            $("#select_provincia").prop("disabled",false);
            
            //Vaciamos el select en caso de haber cargado las provincias de otra comunidad antes.
            $("#select_provincia").empty();
            
            //Función para cargar un select desde un archivo JSON    
            $.getJSON('json/provincias.json', function(data){
                
                //Añadimos la opción selecciona en el select provincia
                $("#select_provincia").append('<option value=0 selected>Selecciona...</option>');
                
                //Recorremos el JSON
                $.each(data, function(key, value){
                    
                        //Si la comunidad coincide con la provincia la añadimos al select.
                        if(parseInt(id_comunidad)===value.comunidad_id){
                            $("#select_provincia").append('<option value=' + value.id + '>' + value.provincia + '</option>');
                        }
                }); // close each()
            }); // close getJSON()
            
        }
        
    });    
    
    //Si cambiamos el valor del Select Provincia, cargamos los municipios pertinentes en el Select Municipios
    $("#select_provincia").change(function(){
        
        //Obtenemos el ID de la provincia
        var id_provincia = $("#select_provincia").val();
        
        //Según el valor habilitamos o no el Select Municipio.
        if(id_provincia==='0'){
            $("#select_municipio").prop("disabled",true);
        }else{
            $("#select_municipio").prop("disabled",false);
            
            //Vaciamos el select en caso de haber cargado los municipios de otra provincias antes.
            $("#select_municipio").empty();
            
            //Función para cargar un select desde un archivo JSON    
            $.getJSON('json/municipios.json', function(data){
                
                //Añadimos la opción selecciona en el select municipios
                $("#select_municipio").append('<option value=0 selected>Selecciona...</option>');
                
                //Recorremos el JSON
                $.each(data, function(key, value){
                    
                        //Si la provincias coincide con municipio lo añadimos al select.
                        if(parseInt(id_provincia)===value.provincia_id){
                            $("#select_municipio").append('<option value=' + value.id + '>' + value.municipio + '</option>');
                        }
                }); // close each()
            }); // close getJSON()
            
        }
        
    });    
    
    
    //Función para cargar un select Tipos de Via desde un archivo JSON
    $.getJSON('json/tipos_de_via.json', function(data) {
        $.each(data, function(key, value) {
                //Añadimos la comunidades en el Select
                $("#select_tipo_via").append('<option value=' + value.id + '>' + value.tipo + '</option>');
        }); // close each()
    }); // close getJSON()
    
    
    //Función para cargar un select Tipos de Vivienda desde un archivo JSON
    $.getJSON('json/tipos_de_vivienda.json', function(data) {
        $.each(data, function(key, value) {
                //Añadimos la comunidades en el Select
                $("#select_tipo_vivienda").append('<option value=' + value.id + '>' + value.tipo + '</option>');
        }); // close each()
    }); // close getJSON()
    
    
        //Si cambiamos el valor del Select Provincia, cargamos los municipios pertinentes en el Select Municipios
    $("#select_tipo_vivienda").change(function(){
        
        //Obtenemos el ID de la provincia
        var id_tipo_vivienda = $("#select_tipo_vivienda").val();
        
        //Según el valor habilitamos o no el Select Municipio.
        if(id_tipo_vivienda==='0'){
            $("#select_viviendas").prop("disabled",true);
        }else{
            $("#select_viviendas").prop("disabled",false);
            
            //Vaciamos el select en caso de haber cargado los municipios de otra provincias antes.
            $("#select_viviendas").empty();
            
            //Función para cargar un select desde un archivo JSON    
            $.getJSON('json/viviendas.json', function(data){
                
                //Añadimos la opción selecciona en el select municipios
                $("#select_viviendas").append('<option value=0 selected>Selecciona...</option>');
                
                //Recorremos el JSON
                $.each(data, function(key, value){
                    
                        //Si la provincias coincide con municipio lo añadimos al select.
                        if(parseInt(id_tipo_vivienda)===value.id_tipo_de_vivienda){
                            $("#select_viviendas").append('<option value=' + value.id + '>' + value.vivienda + '</option>');
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
<script type="text/javascript">
<!--
function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘,’ = 44, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{       
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {     
              return true;              
          }else if(key == 44){
                if(filter(tempValue)=== false){
                    return false;
                }else{       
                    return true;
                }
          }else{
              return false;
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\,?[0-9]{0,2})$/; 
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
    
}
-->
</script>


