<?php

/**********************************************************************

Titulo: form.php
Autor: Moisés Aguilar Miranda
Fecha: 04/11/2020
Descripción: Formulario para añadir las tasaciones.
Comentarios:
 
**********************************************************************/

?>
<?php

include 'functions/connect_db.php';
include 'functions/functions.php';

//echo "Num Tasaciones: ".obtener_num_tasaciones();

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

<div id="content2">

    <form method="POST" action="save_form.php" enctype="multipart/form-data" onsubmit="return validar_form(this)">
        <table class="tabla" id="table_formulario">
            <!-- Selects dinamicos
            https://desarrolloweb.com/articulos/1281.php -->
            <tr>
                <td><label>Comunidad</label></td>
                <td>
                    <select id="select_comunidad" name="select_comunidad">
                        <option value="0" selected>Selecciona...</option> 
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Provincia</label></td>
                <td>
                    <select id="select_provincia" name="select_provincia">
                        <option value="0" selected>Selecciona...</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Municipio</label></td>
                <td>
                    <select id="select_municipio" name="select_municipio">
                        <option value="0" selected>Selecciona...</option> 
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Tipo de via</label></td>
                <td>
                    <select id="select_tipo_via" name="select_tipo_via">
                        <option value="0" selected>Selecciona...</option> 
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Direccion</label></td>
                <td><textarea id="direccion" name="direccion" placeholder="Añade la dirección..."></textarea></td>
            </tr>
            <tr>
                <td><label>Tipo de vivienda</label></td>
                <td>
                    <select id="select_tipo_vivienda" name="select_tipo_vivienda">
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
                    <select id="select_viviendas" name="select_viviendas">
                        <option value="0" selected>Selecciona...</option> 
                        <?php
                        //crear_lista($viviendas);
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Metros reales</label></td>
                <td><input type="text" id="metros_reales" name="metros_reales" maxlength="7" onkeypress="return filterFloat(event,this);" placeholder="metros reales..."/><i>metros</i></td>
            </tr>
            <tr>
                <td><label>Metros computados</label></td>
                <td><input type="text" id="metros_computados" name="metros_computados" maxlength="7" onkeypress="return filterFloat(event,this);" placeholder="metros computados..."/><i>metros</i></td>
            </tr>
            <tr>
                <td><label>Valor m<sup>2</sup></label></td>
                <td><input type="text" id="valor_metro_cuadrado" name="valor_metro_cuadrado" maxlength="7" onkeypress="return filterFloat(event,this);" placeholder="valor metro..."/><i>€</i></td>
            </tr>
            <tr>
                <td><label>Fecha de tasación</label></td>
                <td><input type="date" id="fecha_tasacion" name="fecha_tasacion"></td>
            </tr>
            <!-- https://desarrolloweb.com/articulos/1307.php -->
            <tr>
                <td><label>Archivo de tasación</label></td>
                <td><input id="file" name="file" type="file"></td>                
            </tr>
            <tr>
                <td></td>
                <td><input type="button" id="DelBtn" name="DelBtn" value="Eliminar archivo" onclick="eliminar_archivo()"/></td>
            </tr>
            <tr>
                <td><input type="submit" id="SubirBtn" name="SubirBtn" value="Subir" /></td>
                <td><input type="reset" value="Borrar"></td>
                
            </tr>
        </table>
    </form>

</div>
<div id="errores_form"></div>

<script type="text/javascript">

function eliminar_archivo(){
    
    document.getElementById("file").value = "";
    
}

function validar_form(){
    
    var valido=true;
    
    document.getElementById("select_comunidad").style.borderColor = "green";
    document.getElementById("select_provincia").style.borderColor = "green";
    document.getElementById("select_municipio").style.borderColor = "green";
    document.getElementById("select_tipo_via").style.borderColor = "green";
    document.getElementById("direccion").style.borderColor = "green";
    document.getElementById("select_tipo_vivienda").style.borderColor = "green";
    document.getElementById("select_viviendas").style.borderColor = "green";
    document.getElementById("metros_reales").style.borderColor = "green";
    document.getElementById("metros_computados").style.borderColor = "green";
    document.getElementById("valor_metro_cuadrado").style.borderColor = "green";
    document.getElementById("fecha_tasacion").style.borderColor = "green";
    
    document.getElementById("errores_form").innerHTML="<ul id='errores'></ul>";
    
    if(document.getElementById("select_comunidad").value==="0"){
        document.getElementById("errores").innerHTML+="<li>Debes seleccionar una comunidad.</li>";
        document.getElementById("select_comunidad").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("select_provincia").value==="0"){
        document.getElementById("errores").innerHTML+="<li>Debes seleccionar una provincia.</li>";
        document.getElementById("select_provincia").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("select_municipio").value==="0"){
        document.getElementById("errores").innerHTML+="<li>Debes seleccionar un municipio.</li>";
        document.getElementById("select_municipio").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("select_tipo_via").value==="0"){
        document.getElementById("errores").innerHTML+="<li>Debes seleccionar un tipo de via.</li>";
        document.getElementById("select_tipo_via").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("direccion").value.length < 3){
        document.getElementById("errores").innerHTML+="<li>Debes introducir una dirección</li>";
        document.getElementById("direccion").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("select_tipo_vivienda").value==="0"){
        document.getElementById("errores").innerHTML+="<li>Debes seleccionar un tipo de vivienda.</li>";
        document.getElementById("select_tipo_vivienda").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("select_viviendas").value==="0"){
        document.getElementById("errores").innerHTML+="<li>Debes seleccionar una vivienda.</li>";
        document.getElementById("select_viviendas").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("metros_reales").value===""){
        document.getElementById("errores").innerHTML+="<li>Debes añadir los metros reales.</li>";
        document.getElementById("metros_reales").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("metros_computados").value===""){
        document.getElementById("errores").innerHTML+="<li>Debes añadir los metros computados.</li>";
        document.getElementById("metros_computados").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("valor_metro_cuadrado").value===""){
        document.getElementById("errores").innerHTML+="<li>Debes añadir el valor del m<sup>2</sup>.</li>";
        document.getElementById("valor_metro_cuadrado").style.borderColor = "red";
        valido=false;
    }
    if(document.getElementById("fecha_tasacion").value===""){
        document.getElementById("errores").innerHTML+="<li>Debes seleccionar una fecha.</li>";
        document.getElementById("fecha_tasacion").style.borderColor = "red";
        valido=false;
    }
        
    var filePath = document.getElementById('file').value;    
    var extension = filePath.slice(-3).toLowerCase();
    var fileSize = document.getElementById('file').size;
    
    //alert("filesize: " + fileSize);
    
    if((extension==='')||(extension!=='pdf')){
        document.getElementById("errores").innerHTML+="<li>Archivo no cargado o de extensión incorrecta. Debe ser en formato PDF. Máximo 10 Mb. </li>";
        document.getElementById("file").style.borderColor = "red";
        valido=false;
    }
    
    return valido;
    
}

</script>
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
    
    
});//Final Document Ready Function

</script>
<script type="text/javascript">

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

</script>


