<?php

require('conect.php');


if(isset($_REQUEST['texto'])){
$id=$_POST['id'];
$idw=$_POST['idw'];
$texto=$_POST['texto'];
$texto2="incorrecto";
$columna=$_POST['columna'];
$consulta=mysqli_query($link,"UPDATE preguntas SET rpta= '$texto2' WHERE clavepregunta='$idw'");
$consulta=mysqli_query($link,"UPDATE preguntas SET rpta= '$texto' WHERE idalternativa='$id'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}
}


