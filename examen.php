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

if(isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])){
  $_SESSION['clave']=$_REQUEST['clave'];
}
  ?>
<?php

if(isset($_REQUEST['jjw'])){
    $clave = $_SESSION['clave'];
    $pregunta = $_REQUEST['pregunta'];
    $nota = $_REQUEST['nota'];
      $tipo = $_REQUEST['tipo'];
    mysqli_query($link, "INSERT INTO examen VALUES(NULL, '$clave','$pregunta', '$nota', '$tipo', NULL)");
}

if(isset($_REQUEST['e'])){
mysqli_query($link, "DELETE FROM examen WHERE idpregunta='".$_REQUEST['e']."'");
mysqli_query($link, "DELETE FROM preguntas WHERE clavepregunta='".$_REQUEST['e']."'");
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
}



//echo $_SESSION['clave'];
$conw=mysqli_query($link,"SELECT * FROM examen WHERE clavecurso='".$_SESSION['clave']."'");
$nw=mysqli_num_rows($conw);
$ww=mysqli_fetch_assoc($conw);

  if(!isset($_GET['idcapitulo'])){
	  $_GET['idcapitulo'] = 'cpt';
	}

$_SESSION['idcapitulo']=$_GET['idcapitulo'];

$_SESSION['clavew']= $ww['idpregunta'];



  if(!isset($_GET['cap'])){
	  $_GET['cap'] = 'cpt';
	}

$_SESSION['cap']=$_GET['cap'];





if(isset($_REQUEST['enviar'])){
  $texto=$_REQUEST['respuesta'];
  $texto = mysqli_real_escape_string($link, $texto); 
mysqli_query($link,"UPDATE examen SET rptaescrita= '$texto', WHERE idpregunta = '".$_SESSION['claves']."'");
header("Location:examen.php?clave=".$_SESSION['clave']);
}

//echo $_SESSION['clave']."<br>";
//echo $a['idpregunta'];

?>

<title>Examen y tarea</title>


<?php include('first.php');?><?php include('margin.php'); ?>


<!--
    <form>
    <textarea name="pregunta" id="pregunta" cols="30" rows="7" placeholder="Pregunta" required></textarea>
   Puntos: <input type="text" name="nota" id="nota" placeholder="Puntos" required>
  Tipo: 
  <select name="tipo" class="select" id="tipo">
        <option value="alternativa">Con alternativas</option>
        <option value="escrita">Respuesta escrita</option>
    </select> 
    <input class='crearclase' type="submit" value="Crear pregunta" name="jjw">
    </form>
-->



<script src="jquery-3.0.0.min.js"></script>






<script>
$(document).ready(function(){
function obtener_datos(){
$.ajax({
url:"mostrar_examen.php",
method:"POST", 
success:function(data){
  $("#result").html(data)
}
})
}
obtener_datos();



//INSERTAR DATOS Preguntas
$(document).on("click", "#add", function(){

var clave="<?php echo $_SESSION['clave']?>";
var pregunta="Escriba su pregunta aqui";
var idcapitulo=$(this).data("idcapitulo");
var calif="3";
var tipo="alternativa";
//   alert(tipo);
//   alert(calif);
//   alert(tipo);
$.ajax({
url:"sendpreguntas.php",
method:"post",  
data:{w1:pregunta,w2:calif,clavv:clave,ww:tipo,idcapitulo:idcapitulo},
success:function(data){
obtener_datos();
alert(data);
}
})
})

//INSERTAR DATOS respuestas
$(document).on("click", "#addresp", function(){
var clave="<?php echo $_SESSION['clave']?>";
var clavepregunta=$(this).data("altresp");
var clavepreguntaw=$(this).data("altwresp");
var user="<?php echo $_SESSION['user']?>";
//    alert(clave);
//    alert(clavepregunta);
//    alert(clavepreguntaw);
$.ajax({
url:"sendrespuestas.php",
method:"post",
data:{clavecurso:clave,clavepreg:clavepregunta,clavepregw:clavepreguntaw,userr:user},
success:function(data){
obtener_datos();
//alert(data);
}
})
})

//INSERTAR y actualizar DATOS respuestas escrita
$(document).on("blur", "#ccc", function(){
var clave="<?php echo $_SESSION['clave']?>";
var clavepregunta=$(this).data("cc");
var user="<?php echo $_SESSION['user']?>";
var x3=$(this).text();
////alert(nombrew);
//alert(clavepregunta);
//    alert(clave);
//    alert(x3);
$.ajax({
url:"sendrespuestas.php",
method:"post",
data:{clavecursow:clave,clavepregw:clavepregunta,x3w:x3,userrw:user},
success:function(data){
obtener_datos();
//   alert(data);
}
})
})



//ACTUALIZAR
function actualizar_datos(id,texto,columna){
$.ajax({
url:"actualizar.php",
method:"post",
data:{id: id, texto: texto, columna: columna},
success:function(data){
obtener_datos();
//alert(data);
}
})
}
//ACTUALIZAR CONTINUACION
$(document).on("blur", "#cc1", function(){
var id=$(this).data("c1");
var x1=$(this).html();
//alert(x1);
actualizar_datos(id, x1,"pregunta")
})

$(document).on("blur", "#cc2", function(){
var id=$(this).data("c2");
var x2=$(this).text();
//alert(nombrew);
actualizar_datos(id, x2,"calificativo")
})

//$(document).on("blur", "#cc3", function(){
//var id=$(this).data("c3");
//var x3=$(this).select();
////alert(nombrew);
//actualizar_datos(id, x3,"tipo")
//})

$(document).on("blur", "#ccc", function(){
var id=$(this).data("cc");
var xx=$(this).html();
//alert(nombrew);
actualizar_datos(id, xx,"rptaescrita")
})

$(document).on("click", "#alt", function(){
var id=$(this).data("alternativa");
var zz="alternativa";
//alert(nombrew);
actualizar_datos(id, zz,"tipo")
})
$(document).on("click", "#esc", function(){
var id=$(this).data("escrita");
var zz1="escrita";
//alert(zz1);
actualizar_datos(id, zz1,"tipo")
})


function actualizar_pregunta(id,idw,texto,columna){
$.ajax({
url:"respuestaspreguntas.php",
method:"post",
data:{id: id, idw: idw, texto: texto, columna: columna},
success:function(data){
obtener_datos();
//   alert(data);
}
})
}
//
$(document).on("click", "#alternativa", function(){
var id=$(this).data("alt");
var idw=$(this).data("altw");
var zw="correcta";
//   alert(id);
//   alert(idw);
//   alert(zw);
actualizar_pregunta(id, idw, zw,"respuesta")
})


//INSERTAR altr
$(document).on("click", "#altr", function(){
var clavecurso="<?php echo $_SESSION['clave']?>";
var clavepregunta=$(this).data("idpregunta");
var alternativa="Editar Alternativa haciendo click aqui";
var resp="incorrecta";
//alert(clavepregunta);
//alert(clavecurso);
//alert(alternativa);
$.ajax({
url:"sendalternativas.php",
method:"post",
data:{clave:clavecurso,clavew:clavepregunta,alterna:alternativa,respta:resp},
success:function(data){
obtener_datos();
// alert(data);
}})})


//actualizar
function actualizar_datosww(id,texto,columna){
$.ajax({
url:"actualizarpreguntas.php",
method:"post",
data:{id: id, texto: texto, columna: columna},
success:function(data){
obtener_datos();
//alert(data);
}
})
}

$(document).on("blur", "#alternativaww", function(){
var id=$(this).data("altww");
var x1=$(this).text();
//  alert(id);
//  alert(x1);
actualizar_datosww(id, x1,"alternativa")
})



//ELIMINAR
$(document).on("click", "#delete", function(){
if(confirm("Esta seguro de eliminar esta fila")){

var id=$(this).data("id");
//alert(id);
$.ajax({
url:"delete.php",
method:"post",
data:{id:id},
success:function(data){
obtener_datos();
//alert(data);
}
})
};
})

//ELIMINAR altr 
$(document).on("click", "#deletealtr", function(){
if(confirm("Esta seguro de eliminar esta fila")){

var id=$(this).data("idaltr");
//   alert(id);
$.ajax({
url:"deletealternativa.php",
method:"post",
data:{id:id},
success:function(data){
obtener_datos();
//alert(data);
} 
}) 
}; 
})



});
</script>


<div id ="result"></div>








<?php include('footer.php'); ?>




