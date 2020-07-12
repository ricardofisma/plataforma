<?php

require('conect.php');
session_start();

if(!isset($_SESSION['user'])){
header("Location:index.php");
        }


if(isset($_REQUEST['cerrar'])){
session_destroy();
        header("Location:index.php");
}



if(isset($_REQUEST['user'])){
    $user=$_POST['user'];
    $clave=$_POST['clave'];

mysqli_query($link,"INSERT INTO misclases VALUES(NULL,'$user','$clave')");
}


?>
