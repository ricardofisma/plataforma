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

$_SESSION['idcpt']=$_GET['clavezz'];
$_SESSION['idsec']=$_GET['clavez'];

//echo $_SESSION['idcpt']."--";
//echo $_SESSION['idsec'];
?>

<title>Secciones</title>




<?php include('first.php');?><?php include('margin.php'); ?>


<script src="jquery-3.0.0.min.js"></script>

<script>
$(document).ready(function(){
function obtener_secciones(){
$.ajax({
url:"mostrar_secciones.php",
method:"POST", 
success:function(data){
$("#resultadoseccionesww").html(data)
}})}


obtener_secciones();

//ACTUALIZAR seccion
function actualizarseccion(id,texto,columna){
$.ajax({
url:"mostrar_secciones.php",
method:"post",
data:{id: id, texto: texto, columna: columna},
success:function(data){
obtener_secciones();//alert(data);
}})}



//ACTUALIZAR tarea de seccion
$(document).on("blur", "#w77777", function(){
var idw=$(this).data("fff");
var x1w=$(this).text();
//   alert(idw);
//   alert(x1w);
actualizarseccion(idw, x1w,"nombre")
})



//ACTUALIZAR tarea de seccion
$(document).on("blur", "#rrr", function(){
var id=$(this).data("wwtexto");
var x1=$(this).val();
//alert(id);
//alert(x1);
actualizarseccion(id, x1,"texto")
})

//ACTUALIZAR tarea de seccion
$(document).on("blur", "#r777", function(){
var id=$(this).data("www77");
var x1=$(this).val();
actualizarseccion(id, x1,"tarea")
})


});

</script>


<div id ="resultadoseccionesww"></div>







<?php include('footer.php'); ?>
