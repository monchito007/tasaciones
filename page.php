<?php
session_start();
if($_REQUEST['page']){
    $_SESSION["page"] = $_REQUEST['page'];
}else{
    $_SESSION["page"] = 'list.php';
}

header('Location: content.php');

?>