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


?>

<title>Calificaciones</title>

<?php include('first.php'); ?><?php include('margin.php'); ?>



<script src="jquery-3.0.0.min.js"></script>
<script>
$(document).ready(function(){
function mostrar_datos(){
$.ajax({
url:"calificacionesajax.php",
method:"POST", 
success:function(data){
  $("#resultado").html(data)
}
})
}
mostrar_datos();


//INSERTAR y actualizar DATOS respuestas escrita
$(document).on("blur", "#fff", function(){
var user=$(this).data("user");
var clavepregunta=$(this).data("fffff");
var x3=$(this).text();
//alert(clavepregunta);
$.ajax({
url:"sendrespuestas.php",
method:"post",
data:{clavepregw:clavepregunta,xww:x3,userww: user},
success:function(data){
mostrar_datos();
//alert(data);
}
})
})


//INSERTAR nota tareas
$(document).on("blur", "#nota", function(){
var ids=$(this).data("nota");
//var clavepregunta=$(this).data("fffff");
var x3=$(this).text();///
//alert(ids);
$.ajax({
url:"sendrespuestas.php",
method:"post",
data:{ids:ids,x3:x3},
success:function(data){
mostrar_datos();
//alert(data);
}
})
})


});
</script>

<div id ="resultado"></div>


<?php include "footer.php"; ?>
