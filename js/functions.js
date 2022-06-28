
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


