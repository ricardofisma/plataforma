<?php

require('conect.php');



$clave=$_POST['clavv'];;
$preg=$_POST['w1'];
$nota=$_POST['w2'];
$tipo=$_POST['ww'];
$idcpt=$_POST['idcapitulo'];
$consulta=mysqli_query($link, "INSERT INTO examen VALUES(NULL, '$clave','$preg', '$nota', '$tipo', 'Escriba aqui su respuesta', '$idcpt')");
//if(!$consulta){
//  echo "no ok";
//}else{
//  echo "ok";
//}
//
//