<link rel="stylesheet" href="./richtext.min.css">
<script type="text/javascript" src="./jquery.richtext.js"></script>

<script type="text/javascript"
src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({ "fast-preview": {disabled:true},TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {preview: "none", inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>


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


if(isset($_REQUEST['clavecurso'])){
$clave=$_POST['clavecurso'];
$idseccion=$_POST['idseccion'];
$idcapitulo=$_POST['idcapitulo'];
$user=$_POST['user'];
$text=$_POST['text'];
$text=mysqli_real_escape_string($link, $text); 
//$na=$_FILES['archivo']['name'];

$tarea=mysqli_query($link,"SELECT * FROM tareas WHERE idseccion='$idseccion' AND usuario='$user' AND clave='$clave'");
$ntarea=mysqli_num_rows($tarea);
if($ntarea>0){
    $consulta=mysqli_query($link,"UPDATE  tareas SET texto='$text' WHERE usuario='$user' AND idseccion='$idseccion'");
    if(!$consulta){
  echo "no ok refresh";
}else{
  echo "ok refresh";
}

}else{
    $consulta=mysqli_query($link,"INSERT INTO tareas VALUES(NULL, '$text','$user','$clave',NULL,'foto', NULL, '$idseccion', '$idcapitulo')");
    if(!$consulta){
  echo "no ok insert";
}else{
  echo "ok insert";
}

}
//$idtarea=mysqli_insert_id($link);
//echo $idtarea;
//copy($_FILES['archivo']['tmp_name'],"archivostarea/".$_SESSION['claveww'].$na);
//echo $_SERVER["REQUEST_URI"];


}

if(isset($_FILES["file"])){
//$na=$_FILES['file'];
$idseccion=$_POST['idseccion'];
$user=$_POST['user'];
$na=$_FILES['file']['name'];echo $na;
$tipo=$_FILES['file']['type'];
$t=$_FILES['file']['size'];

    array_map('unlink', glob("archivostarea/".$idseccion."_*")); 
$consulta=mysqli_query($link,"UPDATE  tareas SET archivo='$na' WHERE idseccion='$idseccion' AND usuario='$user'");
copy($_FILES['file']['tmp_name'],"archivostarea/".$idseccion."_".$na);
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}

}


//delete tarea
if(isset($_REQUEST['ideleteww1'])){
$id=$_POST['ideleteww1'];
$ids=$_POST['ids'];
$consulta=mysqli_query($link, "DELETE FROM tareas WHERE idtarea=$id");
    array_map('unlink', glob("archivostarea/".$ids."_*")); 
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok delete seccion";
}

}


$con=mysqli_query($link,"SELECT * FROM secciones WHERE idseccion='".$_SESSION['idsec']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con); 

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);










echo "<article>";

$tareas=mysqli_query($link,"SELECT * FROM tareas WHERE idseccion='".$_SESSION['idsec']."' AND clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);


echo "<h1 style='display:block;margin:auto;background:rgb(100,100,200);text-align: center'>Tarea</h1><br>";
echo "<div style='display:block;margin:auto;background:rgb(10,10,100);color:white;text-align: center'>".$a['tarea']."</div><br>";

if($w['tipo']=='estudiante'){

if($nts==0){                                                                                                                                                       //
    
echo "<h1 style='display:block;margin:auto;background:rgb(100,10,100);text-align: center'>Entregar tarea</h1>";

echo "<textarea class='".$arraytareas['idtarea']."ww' name='texto' id='addtarea' placeholder='Escriba su tarea'; required></textarea>";

      ?>

<script>
$(document).ready(function() {
    $('.<?php echo  $arraytareas['idtarea']."ww" ?>').richText();
});
</script>

<?php


echo "<input id='imagew' id='".$arraytareas['idtarea']."' type='file' style='display:none'></input>";

//echo "<a style='cursor:pointer;background:rgb(155,155,255);padding:5px;border-radius:5px;margin:5px auto;display:block;width:300px;text-align:center;' onclick='fileUpload()'>Cargar archivos </a>";

      ?>

<script>
function fileUpload() {
    $("#imagew").click();
}
</script>

</article>

<?php
}else{                                                                                                                                                                //
    
echo "<h1 style='display:block;margin:auto;text-align: center;font-size:0.8em;margin:3px;'> Tarea entregada</h1>";

echo "<div  style= 'display:flex; width:100%;flex-wrap:wrap;align-items: center;  justify-content: center;'>";
echo "<div class='imagen' style='display:block;margin:auto;background:rgb(200,200,200);text-align: center'>";
echo "<div style='text-align: center;width:370px;border:0px solid;;border-radius:1px;position:relative;margin:5px;'>";

echo "<div title='Edite su perfil' style='width:250px;height:250px;overflow: hidden;border-radius:1px;position: relative;object-fit:cover;margin:5px auto;'><a style='cursor: pointer;' href='javascript:abrir()'><img style='cursor: pointer;' src= 'archivostarea/".$_SESSION['idsec']."_".$arraytareas['archivo']."' onerror=this.src='foto.png'></a></div>";
echo "<div style='margin:auto;width:97%; margin-bottom:0px;'><p style='border-radius:5px 5px 0px 0px;background:rgba(255,255,255,0.95);'>" .$arraytareas['archivo']. "</p></div>";

echo "</div>";
echo "</div>";
echo "</div>";

    
    echo "<input id='imagew' id='".$arraytareas['idtarea']."' type='file' style='display:none'></input>";  
    echo "<a style='cursor:pointer;background:rgb(205,205,205);padding:5px;border-radius:5px;margin:5px auto;display:block;width:300px;text-align:center;' onclick='fileUpload()'>Actualizar archivos </a>";

      ?>
<script>
function fileUpload() {
    $("#imagew").click();
}
</script>


        <script>
        $(document).ready(function() {
            $('.<?php echo  $arraytareas['idtarea']?>').richText();
        });
        </script>

<?php


echo "<div class='imagen' style='display:block;margin:auto;background:rgb(100,250,200);text-align: center'>";

echo "<textarea class='".$arraytareas['idtarea']."' name='texto' id='addtarea' required>".$arraytareas['texto']."</textarea>";
echo "<p>".$arraytareas['texto']."</p>";

echo "<div>";
echo "</article>";

echo "<div style='display:block;margin:auto;text-align:center;width:95%;'>";
if($arraytareas['evaluacion']==""){
    echo "<a style=' color: rgb(200,75,100); cursor:pointer' id='deleteww' data-idw='".$arraytareas['idtarea']."' data-ids   ='".$_SESSION['idsec']."'><i class='fa fa-trash'></i></a>";
    echo "<h1 style='display:block;margin:auto;text-align: center; font-size: 18px;'>Tarea aun no evaluada</h1>";
}

if($arraytareas['evaluacion']!=""){
  echo "[ Evaluacion: <span>".$arraytareas['evaluacion']."</span> ]";
}

echo " [ Fecha de entrega: ".$arraytareas['fecha']." ] <br>";

echo "</div>";

echo "<article>";
echo "<div style='display:block;margin:auto;background:rgb(100,100,100);text-align: center'><h1>" .$a['nombre']. "</h1></div>";
echo "<p>".$a['texto']."</p>";
}                                                                                                                                              //
}
?>





<div id="ff">
<form action="sesion.php" method="post" class="sesion">
<img src="archivostarea/<?php echo $_SESSION['idsec']."_".$arraytareas['archivo']?>" style="border-radius:10px;width:98%;height:98%;object-fit: contain;position:absolute;transform:translate(-50%,-50%);top:50%;left:50%;" alt="">
<div id="cerrar"><a href="javascript:cerrar()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
</form>  
</div>

</article>

<style>
#ff{
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.9);
  z-index: 9999;
}
.sesion{
height:97%;
width:97%;
position:absolute;
z-index: 9999;
padding:18px;
border-radius:3px;
position:absolute;
top:50%;
left:50%;
text-align: center;
background-color: rgb(255,255,255);
transform:translate(-50%,-50%);
} 

input{
display:block;
border:none;
padding:0px;
border-radius:5px;
margin:1em auto;
}

#cerrar{
	right:5px;
	top:50%;
	font-size:20px;
	color:white;
	cursor:pointer;
	position:absolute;
}
#cerrar a i {
color:rgb(25,25,0);
}

</style>

<script>
function abrir(){
	document.getElementById("ff").style.display="block";
}

function cerrar(){
document.getElementById("ff").style.display="none"
}
</script>

