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

<title>Inicio</title>



<?php include('first.php');?><?php include('margin.php'); ?>


<script src="jquery-3.0.0.min.js"></script>

<script>
$(document).ready(function(){
function obtener_datos(){
$.ajax({
url:"preguntas.php",
method:"POST", 
success:function(data){
  $("#result").html(data)
}
})
}
obtener_datos();



//INSERTAR DATOS
$(document).on("click", "#add", function(){

var clave="<?php echo $_SESSION['clave']?>";
var pregunta=$("#preg").text();
var calif=$("#nota").text();
var tipo="alternativa";
//alert(nombrew);

$.ajax({
url:"sendpreguntas.php",
method:"post",
data:{w1:pregunta,w2:calif,clavv:clave,ww:tipo},
success:function(data){
obtener_datos();
//alert(data);
}
})
})


//INSERTAR items
$(document).on("click", "#addw", function(){

var clavecurso="<?php echo $_SESSION['clave']?>";
var clavepregunta=$(this).data("idpreg");
var alternativa=$("#clavepregunta").text();
var resp="incorrecta";
alert(clavepregunta) ;
alert(clavecurso);
alert(alternativa);

$.ajax({
url:"sendalternativas.php",
method:"post",
data:{clave:clavecurso,clavew:clavepregunta,alterna:alternativa,respta:resp},
success:function(data){
obtener_datos();
//alert(data);
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
var x1=$(this).text();
//alert(x1);
actualizar_datos(id, x1,"pregunta")
})

$(document).on("blur", "#cc2", function(){
var id=$(this).data("c2");
var x2=$(this).text();
//alert(nombrew);
actualizar_datos(id, x2,"calificativo")
})

$(document).on("blur", "#cc3", function(){
var id=$(this).data("c3");
var x3=$(this).select();
//alert(nombrew);
actualizar_datos(id, x3,"tipo")
})

$(document).on("blur", "#ccc", function(){
var id=$(this).data("cc");
var xx=$(this).text();
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
//alert(data);
}
})
}
//
$(document).on("click", "#alternativa", function(){
var id=$(this).data("alt");
var idw=$(this).data("altw");
var zw="correcta";
//alert(id);
//alert(zw);
actualizar_pregunta(id, idw, zw,"respuesta")
})
//

function actualizar_preguntas(id,texto,columna){
$.ajax({
url:"actualizarpreguntas.php",
method:"post",
data:{id: id, texto: texto, columna: columna},
success:function(data){
obtener_datos();
//alert(data);
}})}

$(document).on("blur", "#alternativaedit", function(){
var id=$(this).data("alteditw");
//var idw=$(this).data("alteditw");
var ff=$(this).text();
alert(id);
alert(ff);
actualizar_preguntas(id, ff,"pregunta")
})
//



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




});
</script>

<div id ="result"></div>







<?php

$conw1=mysqli_query($link,"SELECT * FROM preguntas WHERE clavepregunta='".$_SESSION['clavew']."'");
$ww1=mysqli_fetch_assoc($conw1);
$nw1=mysqli_num_rows($conw1);

if($ww['tipo']=='alternativa'){
  if($nw1>0){
    $j=1;
    
    do{
   //   if($ww1['rpta']=='correcta'){
//        echo "<div>".$j.". <button style='background:rgb(255,100,155);border:none;border-radius:5px;padding:7px;margin:3px;' id='alternativa' data-alt='".$ww['idpregunta']."' data-altw='".$ww1['idalternativa']."'>
//      ".$ww1['alternativa']."</button></div>";
 //     }else{
 //       echo "<div>".$j.". <button style='background:rgb(78,0,200);border:none;border-radius:5px;padding:5px;margin:2px;' id='alternativa' data-alt='".$ww1['idalternativa']."' data-altw='".$ww1['clavepregunta']."'>
 //     ".$ww1['alternativa']."</button></div>";
 //     }
        echo "<div style='background:rgb(155,100,155);border:none;border-radius:5px;padding:7px;margin:3px;' id='alternativaedit' data-altedit='".$ww1['idalternativa']."' data-alteditw='".$ww['idpregunta']."' contenteditable>
      ".$ww1['alternativa']."</div>"; 
      
      $j++;
    }while($ww1=mysqli_fetch_assoc($conw1));  
  }else{
    echo "No hay aún alternativas";
  }
  
  echo "<div style='background:rgb(100,10,100);padding:5px;border-radius:5px;'>";
  echo  "<div style='background:rgb(225,220,210);border:none;border-radius:5px;padding:5px;margin:5px;' placeholder='Escriba su pregunta' id='".$ww['idpregunta']."' contenteditable></div>";
  echo  "<div><button id='addw' data-idpreg='".$ww['idpregunta']."' data-idpregw='".$ww1['idalternativa']."'>Agregar alternativa</button></div>";
  echo "</div>";
  
}else{
  if($ww['rptaescrita']!=""){
    echo "<div style='background:rgb(20,200,100);border-radius:5px;margin:3px;padding:5px;'>".$ww['rptaescrita']."</div>";
  }else{
    echo "<div style='background:rgb(250,200,100);border-radius:5px;margin:3px;padding:5px;' id='ccc' data-cc='".$ww['idpregunta']."' contenteditable>".$ww['rptaescrita']."</div>";
  }
}

echo "</div>";

?>










<?php

$_SESSION['clavew']=$_GET['clavew'];
$_SESSION['clave']=$_GET['clave'];

//echo $_SESSION['clavew'];

//echo $_SESSION['clave'];  

if(isset($_REQUEST['jjw'])){
    $text = $_REQUEST['alternativa'];
    $text = mysqli_real_escape_string($link, $text);
    $clave = $_SESSION['clavew'];
    $clav = $_SESSION['clave'];
    $rpta = $_REQUEST['respuesta'];
    mysqli_query($link, "INSERT INTO preguntas VALUES(NULL, '$text', '$clav', '$clave', '$rpta',NULL)");
}

if(isset($_REQUEST['e'])){
mysqli_query($link, "DELETE FROM preguntas WHERE idalternativa=".$_REQUEST['e']);
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['calvew']."'");

}

$con=mysqli_query($link,"SELECT * FROM preguntas WHERE clavepregunta='".$_SESSION['clavew']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con);

$pregunta=mysqli_query($link,"SELECT * FROM examen WHERE idpregunta='".$_SESSION['clavew']."'");
$preguntaw=mysqli_fetch_assoc($pregunta);
?>
<article>


<?php
if($w['tipo']=='docente'){
?>

<h1>Gestión de alternativas</h1>
<p>La pregunta es: <?php echo $preguntaw['pregunta']?></p>
<form action="preguntas.php?clavew=<?php echo $_SESSION['clavew']?>&clave=<?php echo $_SESSION['clave']?>" method="post" enctype="multipart/form-data">
  <textarea name="alternativa" id="" cols="30" rows="3" placeholder="Alternativa" required></textarea> 
  
  <select name="respuesta" class="select">
        <option value="incorrecta">Incorrecta</option>
        <option value="correcta">Correcta</option>
    </select> 
  <input class='crearclase' type="submit" value="Crear pregunta" name="jjw">
</form>


<?php
}
?>
<div style= "    display:flex;    width:100%;    flex-wrap:wrap;    align-items: center;    justify-content: center;">
  <?php

if($n>0){
$i=1;
  do{
      echo "<a style='cursor: pointer;;text-decoration: none;color:white;' href='sesion.php?claveww=".$a['idalternativa']."'>";
      echo "<div class='imagen' style='float:left;'>";
      echo "<div style='text-align: center;background:rgb(90,95,90);width:350px;border-radius:10px;position:relative;margin:5px;box-shadow:0px 0px 5px 0px rgba(0,0,0,.75);'>";   
      echo "Alternativa ".$i."<div style='margin:auto;width:90%;color:rgb(10,10,100);'><p>" .$a['alternativa']."</p></div>";
      echo "<div style='margin:auto;width:80%'><p>" .$a['respuesta']. "</p></div>";

$nombre=mysqli_query($link,"SELECT * FROM usuario WHERE email='".$_SESSION['user']."'");
$usuario=mysqli_fetch_assoc($nombre);


if($w['tipo']=='estudiante'){
$tareas=mysqli_query($link,"SELECT * FROM tareas WHERE idplan='".$a['idseccion']."' AND usuario='".$_SESSION['user']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$ntsw=mysqli_num_rows($tareas);        
if($ntsw>0){
  echo "<div style='font-size:20px;color:rgb(100,200,250);'>Tarea entregada</div>";
  echo "<td>".$usuario['nombre']."</td> ";
  echo "<td>".$arraytareas['fecha']."</td><br>";
  //echo "<td>".$arraytareas['texto']."</td>";
}else{
  echo "<h1 style='font-size:20px;color:rgb(200,0,10);'>Aún no entregó tarea</h1>";
}
}
if($w['tipo']=='docente'){
$works=mysqli_query($link,"SELECT * FROM tareas, usuario WHERE usuario.email=tareas.usuario AND idplan='".$a['idalternativa']."' AND clave='".$_SESSION['clave']."'");
$worksw=mysqli_fetch_assoc($works);
$nw=mysqli_num_rows($works);        

echo "<table style='width:100%; border-spacing:5px;border-collapse: separate;'><tr>";
if($nw>0){
  do{
  echo "<td style='text-align:right;border-right: 0.0px solid black;'>".$worksw['nombre']."</td> ";
  echo "<td style='text-align:left;'>".$worksw['fecha']."</td>";
  echo "<tr>";
  
}while($worksw=mysqli_fetch_assoc($works));  
}else{
//  echo "<h1 style='font-size:20px;color:rgb(180,0,10);'>Aún no entregaron tarea</h1>";
}
echo "</table>";
}
//    echo "<div style='margin:auto;width:80%;color:rgb(0,10,200)'><p>Ver sección</p></div>";
      if($w['tipo']=='docente'){
        echo "<a href='updatepregunta.php?update=".$a['idalternativa']."' style='margin:auto;width:80%; text-decoration:none;color:rgb(275,105,75);'> Editar </a>";
        echo "<a style='text-decoration: none;' href=\"javascript:preguntarw('".$_SESSION['clavew']."',  '".$_SESSION['clave']."', '".$a['idalternativa']."')\"><div  style='margin:auto;width:80%; margin-bottom:0px;'><p style='border-radius:5px 5px 0px 0px;background:rgb(200,100,100);'>Eliminar</p></div></a>";

      }
      echo "</div>";
      $i++;
      echo "</div>";
      echo "</a>";      
}while($a=mysqli_fetch_assoc($con));
}else{ 
  echo "<tr><td> No hay alternativas creadas</td></tr>";
}
?>
</div>

</article>



<script>
function preguntarw(www, ww, w){
eliminar=confirm("Esta seguro de eliminar esta sección?")
if(eliminar)
window.location.href="preguntas.php?clavew="+www+"&clave="+ww+"&e="+w;
}
</script>

</article>



<style>
.crearclase{
margin: 5px auto;
display:block;
border: 1px solid ;
border-radius:3px;
background:#2333ee22;
padding:5px;

}
</style>




<style>
.contenedor-imageneswr{
    display:flex;
    width:100%;
}
.contenedor-imageneswr .imagen{
text-align: center;
width:250px;
background:rgb(11, 146, 94);
border-radius:5px;
position:relative;
margin:5px;
box-shadow:0px 0px 2px 0px rgba(0,0,0,.75);
}


.contenedor-imagenesw{
    display:flex;
    width:100%;
    
    flex-wrap:wrap;
    align-items: center;
  justify-content: center;
}
.contenedor-imagenesw .imagen{
text-align: center;
width:250px;
border-radius:10px;
position:relative;
margin:5px;
box-shadow:0px 0px 1px 0px rgba(0,0,0,.75);
}
.imagen img{
width:100%;
height:100%;
}


.overlayw{
position:absolute;
bottom:0;
left:0;
width:100%;
height:0;
transition: .5 ease;
overflow:hidden;
}

.overlayw a{
color:#fff;
font-weight:300;
font-size:20px;
position:absolute;
top:50%;
left:50%;
text-align: center;
transform:translate(-50%,-50%);
}
.imagen:hover .overlayw{
height:100%;
cursor:pointer;
}
</style>












<article>

  <?php


$conw1=mysqli_query($link,"SELECT * FROM preguntas WHERE clavepregunta='".$_SESSION['clavew']."'");
      $ww1=mysqli_fetch_assoc($conw1);
      $nw1=mysqli_num_rows($conw1);
      
      
      if($nw1>0){
  $j=1;
  do{
    echo "<button id='".$ww1['idalternativa']."7' style='margin-left:35px;border:none;padding:5px;width:90%;background:rgb(110,100,100);margin:1px;border-radius:5px;font-family:serif;font-size:20px;text-align:left;color:rgb(255,255,255);'>Alternativa ".$j.": ".$ww1['alternativa']."</button>";
    echo "<div style='display:;' id='".$ww1['idalternativa']."'>";
  
  ?>     
<script>
var button = document.getElementById('<?php echo $ww1['idalternativa']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $ww1['idalternativa']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
        <?php
        
        echo "</div>";
        echo "</div>";

        $j++;
      
    }while($ww1=mysqli_fetch_assoc($conw1));  
  }else{
    echo "<tr><td> No hay alternativas creadas</td></tr>";
  }
  
  echo "</div>";
    echo "</article>";
  

?>
<article>
<a style='cursor: pointer;;text-decoration: none;color:red;background:rgb(50,0,50); border-radius:5px;padding:5px;' href='examen.php?clave=<?php echo $_SESSION['clave']?>'>Volver</a>
</article>
    


</article>






<?php include('footer.php'); ?>
