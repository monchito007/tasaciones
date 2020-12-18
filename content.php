<?php
session_start();
if(!$_SESSION["page"]){
    $_SESSION["page"] = "list.php";
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
        <?php
        if($_SESSION["page"] == "form.php"){echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';}
        else{echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';}
        ?>
        <meta http-equiv="Content-Type" content="text/html; iso-8859-1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.5.1.min.js"></script>
        <style>
            .sidebar{
                background-color: dodgerblue;
            }
            #content{
               background-color: #gggggg;
               margin: 20px;               
            }
            ::placeholder {
                font-style: italic;
                color: #cacaca;
            }
            input[type=text]{
                width: 250px;
            }
            select{
                width: 250px;
            }
            textarea {
                width: 250px;
            }
            li a{
                color: white;
            }
            footer p{
                font-size: 12px;
                color: #999999;
                text-align: center;
                font-style: italic;
            }
            input{
                background-color: white;
            }
            #errores_form ul li{
                color: #cc0000;
                font-style: italic;
                font-size: 14px;
            }

        </style>
    </head>
    <body>
        <!-- https://getbootstrap.com/docs/4.1/components/navbar/ -->
        <nav class="navbar sidebar">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active"><a class="nav-link" href="page.php?page=form.php">Formulario</a></li>
                <li class="nav-item active"><a class="nav-link" href="page.php?page=list.php">Listado de Tasaciones</a></li>
            </ul>
        </nav>
        <div id="content">
            <?php
                include $_SESSION["page"];
                //include 'list.php';
            ?>
        </div>
        <footer>
            <p>Habitat Gestions <?php echo date("Y") ?></p>
        </footer>
    </body>
</html>
