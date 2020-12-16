<?php
session_start();
if(!$_SESSION["page"]){
    $_SESSION["page"] = "form.php"; 
}
?>
<?php
/**********************************************************************

Titulo: contenido.php
Autor: Moisés Aguilar Miranda
Fecha: 04/11/2020
Descripción: Página para añadir el contenido.
Comentarios:
 
**********************************************************************/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tasaciones</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
        <meta http-equiv="Content-Type" content="text/html; iso-8859-1">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
        <script src="js/jquery-3.5.1.min.js"></script>
        <style>
            body{
                background-color: gainsboro;
            }
            .sidebar{
                background-color: dodgerblue;
            }
            .content{
                background-color: #cacaca;
            }
            ::placeholder {
                font-style: italic;
                color: #cacaca;
            }
            textarea {
                width: 250px;
            }
        </style>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="page.php?page=form.php">Form</a></li>
                <li><a href="page.php?page=list.php">List</a></li>                
            </ul>
        </nav>
        <div id="content">
            <?php
                include $_SESSION["page"];
                //include 'list.php';
            ?>                        
        </div>
    </body>
</html>
