<?php
require('conect.php');

$clavecurso=$_POST['clave'];
$clavepreg=$_POST['clavew'];
$idcpt=$_POST['idcpt'];
$alternativa=$_POST['alterna'];
$resp=$_POST['respta'];
$consulta=mysqli_query($link, "INSERT INTO preguntas VALUES(NULL, '$alternativa', '$clavecurso', '$clavepreg', '$resp', NULL,'$idcpt')");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}


