<?php

require('conect.php');

if(isset($_REQUEST['texto'])){
$id=$_POST['id'];
$texto=$_POST['texto'];
$texto = mysqli_real_escape_string($link, $texto); 
$columna=$_POST['columna'];
$consulta=mysqli_query($link,"UPDATE preguntas SET $columna='$texto' WHERE idalternativa ='$id'");
if(!$consulta){
  echo "no ok";
}else{ 
  echo "ok";
}
}

