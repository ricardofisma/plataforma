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
$_SESSION['clavew']=$_GET['clavew'];
$_SESSION['clave']=$_GET['clave'];

echo $_SESSION['clave'];
echo $_SESSION['clavew'];


?>
<title>Alternativas</title>



<?php include('first.php');?><?php include('margin.php'); ?>


<script src="jquery-3.0.0.min.js"></script>

<script>
$(document).ready(function(){
function obtener_datos(){
$.ajax({
url:"mostrar_preguntas.php",
method:"POST", 
success:function(data){
  $("#result").html(data)
}
})
}
obtener_datos();

//


//INSERTAR items
$(document).on("click", "#altr", function(){
var clavecurso="<?php echo $_SESSION['clave']?>";
var clavepregunta=$(this).data("idpregunta");
var alternativa=$("#pregww").text();
var resp="incorrecta";
alert(clavepregunta);
// alert(clavecurso);
// alert(alternativa);
$.ajax({
url:"sendalternativas.php",
method:"post",
data:{clave:clavecurso,clavew:clavepregunta,alterna:alternativa,respta:resp},
success:function(data){
obtener_datos();
//alert(data);
}})})


//ACTUALIZAR CONTINUACION

function actualizar_datosw(idw,textow,columnaw){
$.ajax({
url:"actualizarpreguntas.php",
method:"post",
data:{id: idw, texto: textow, columna: columnaw},
success:function(data){
obtener_datos();
alert(data);
}
})
}

$(document).on("blur", "#cww", function(){
var id=$(this).data("altwww");
var x1=$(this).text();
//alert(x1);
actualizar_datosw(id, x1,"alternativa")
})



});
</script>

<div id ="result"></div>








<?php include('footer.php'); ?>
