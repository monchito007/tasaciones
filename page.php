<?php
session_start();
if($_REQUEST['page']){
    $_SESSION["page"] = $_REQUEST['page'];
}else{
    $_SESSION["page"] = 'list.php';
}
if($_REQUEST['id']){
    $_SESSION["id"] = $_REQUEST['id'];
}

header('Location: content.php');

?>