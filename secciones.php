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

?>

<title>Secciones</title>





<script src="jquery-3.0.0.min.js"></script>


<script>
$(document).ready(function(){
function obtener_secciones(){
$.ajax({
url:"mostrar_secciones.php",
method:"POST", 
success:function(data){
$("#resultadosecciones").html(data)
}
})
}
obtener_secciones();






//ACTUALIZAR seccion
function actualizarsec(id,texto,columna){
$.ajax({
url:"datos_secciones.php",
method:"post",
data:{id: id, texto: texto, columna: columna},
success:function(data){
obtener_secciones();
alert(data);
}})}


$(document).on("blur", "#www", function(){
var idw=$(this).data("wwt");
var x1w=$(this).html();
alert(idw);
alert(x1w);
actualizarsec(id, x1,"nombre")
})

//ACTUALIZAR tarea de seccion
$(document).on("blur", "#sec_tarea", function(){
var id=$(this).data("c1www");
var x1=$(this).html();
actualizarsec(id, x1,"tarea")
})

$(document).on("blur", "#rrr", function(){
var id=$(this).data("wwtexto");
var x1=$(this).html();
alert(id);
//actualizarsec(id, x1,"texto")
})


//ELIMINAR seccionw
$(document).on("click", "#deleteww", function(){
if(confirm("Esta seguro de eliminar esta fila")){
var idw=$(this).data("idw");
//alert(idw);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{ideleteww:idw},
success:function(data){
obtener_secciones();
//alert(data);
}
})
};
})

obtener_secciones();

});

</script>


<div id ="resultadosecciones"></div>



<?php include('first.php');?><?php include('margin.php'); ?>



<?php

$_SESSION['clavew']=$_GET['clavew'];
$_SESSION['clave']=$_GET['clave'];



if(isset($_REQUEST['jjw'])){
    $clave = $_SESSION['clavew'];
    $clav = $_SESSION['clave'];
    $n = $_REQUEST['nombre'];
    $n = mysqli_real_escape_string($link, $n);
    $text = $_REQUEST['text'];
    $text = mysqli_real_escape_string($link, $text); 
    $tarea = $_REQUEST['tarea'];
    mysqli_query($link, "INSERT INTO secciones VALUES(NULL, '$n','$text', '$clave', '$tarea', '$clav')");
}

if(isset($_REQUEST['e'])){
mysqli_query($link, "DELETE FROM secciones WHERE idseccion=".$_REQUEST['e']);
mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['calvew']."'");

}

$con=mysqli_query($link,"SELECT * FROM secciones WHERE clavew='".$_SESSION['clavew']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con);
?>
<article>


<?php
if($w['tipo']=='docente'){
?>

<h1>Gestión de secciones</h1>

<form action="secciones.php?clavew=<?php echo $_SESSION['clavew']?>&clave=<?php echo $_SESSION['clave']?>" method="post" enctype="multipart/form-data">
  <input class='crearclase' style='width:300px;' type="text" name="nombre" placeholder="Nombre de la sección" required>
  <textarea name="text" id="" cols="30" rows="10" placeholder="Descripcion de la sección" required></textarea><br><br> 
  <textarea name="tarea" id="" cols="30" rows="10" placeholder="Escriba la tarea" required></textarea> 
  <input class='crearclase' type="submit" value="Crear" name="jjw">
</form>


<?php
}
?>
<div style= "    display:flex;    width:100%;    flex-wrap:wrap;    align-items: center;    justify-content: center;">
  <?php

if($n>0){
$i=1;
  do{
      echo "<a style='cursor: pointer;;text-decoration: none;color:white;' href='sesion.php?claveww=".$a['idseccion']."'>";
      echo "<div class='imagen' style='float:left;'>";
      echo "<div style='text-align: center;background:rgb(90,95,90);width:350px;border-radius:10px;position:relative;margin:5px;box-shadow:0px 0px 5px 0px rgba(0,0,0,.75);'>";   
      echo "Seccion ".$i."<div style='margin:auto;width:80%;color:rgb(10,10,100);'><h1>" .$a['nombre']."</h1></div>";
//      echo "<div style='margin:auto;width:80%'><p>" .$a['texto']. "</p></div>";

$nombre=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'");
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
$works=mysqli_query($link,"SELECT * FROM tareas, usuario WHERE usuario.idusuario=tareas.usuario AND idplan='".$a['idseccion']."' AND clave='".$_SESSION['clave']."'");
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
  echo "<h1 style='font-size:20px;color:rgb(180,0,10);'>Aún no entregaron tarea</h1>";
}
echo "</table>";
}

      echo "<div style='margin:auto;width:80%;color:rgb(0,10,200)'><p>Ver sección</p></div>";
      if($w['tipo']=='docente'){
        echo "<a href='updateseccion.php?update=".$a['idseccion']."' style='margin:auto;width:80%; text-decoration:none;color:rgb(275,105,75);'> Editar </a>";
        echo "<a style='text-decoration: none;' href=\"javascript:preguntarw('".$_SESSION['clavew']."',  '".$_SESSION['clave']."', '".$a['idseccion']."')\"><div  style='margin:auto;width:80%; margin-bottom:0px;'><p style='border-radius:5px 5px 0px 0px;background:rgb(200,100,100);'>Eliminar</p></div></a>";

      }
      echo "</div>";
      $i++;
      echo "</div>";
      echo "</a>";      
}while($a=mysqli_fetch_assoc($con));
}else{ 
  echo "<tr><td> No hay secciones creadas</td></tr>";
}
?>
</div>

</article>



<script>
function preguntarw(www, ww, w){
eliminar=confirm("Esta seguro de eliminar esta sección?")
if(eliminar)
window.location.href="secciones.php?clavew="+www+"&clave="+ww+"&e="+w;
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

//echo $_SESSION['clavew'];
$conw1=mysqli_query($link,"SELECT * FROM secciones WHERE clavew='".$_SESSION['clavew']."'");
      $ww1=mysqli_fetch_assoc($conw1);
      $nw1=mysqli_num_rows($conw1);
      
      
      if($nw1>0){
  $j=1;
  do{

    echo "<button style='border:none;border-radius:5px;padding:5px;cursor:pointer' id='deletew' data-idw='".$ww1['idseccion']."'><span class='fa fa-trash'></span></button>";

    //    echo "<div style='margin:auto;width:90%;background:rgb(250,255,255);'><h1>Seccion ".$j.": ".$ww1['nombre']. "</h1></div>";
    echo "<button id='".$ww1['idseccion']."7' style='margin-left:35px;border:none;padding:5px;background:rgb(110,100,100);margin:1px;border-radius:5px;color:rgb(255,255,255);cursor:pointer;display:inline-block;'>
    Sección ".$j.":</button>
    <div id='".$ww1['idseccion']."7' style='margin-left:35px;border:none;padding:5px;width:50%;background:rgb(110,10,100);margin:1px;border-radius:5px; color:rgb(255,255,255);cursor:pointer;display:inline-block;'>Sección ".$j.": ".$ww1['nombre']."</div><br>";
    echo "<div style='display:none;' id='".$ww1['idseccion']."'>";
  
  ?>     
<script>
var button = document.getElementById('<?php echo $ww1['idseccion']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $ww1['idseccion']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
        <?php
    echo "<div style='margin:auto;width:90%;background:rgb(200,250,255);padding:5px'>" .$ww1['texto']. "</div>";
    echo "<div style='margin:auto;width:85%;background:rgb(255,255,255);padding:5px;'><h1>Tarea: </h1>".$ww1['tarea']."</div>";
   echo "<div style='margin:auto;width:85%;background:rgb(100,100,100);margin-bottom:5px;padding:5px;'>";
    $not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idplan ='".$ww1['idseccion']."'");   
        $notw=mysqli_fetch_assoc($not);
        $nnot=mysqli_num_rows($not);

        if($notw['evaluacion']!=""){
          echo "Calificación: \(".$notw['evaluacion']."\)";
        }elseif($nnot>0){ 
            echo "Tarea aún no evaluada - ";
            echo "<a style='text-decoration:none;color:rgb(255,100,100);' href='sesion.php?claveww=".$ww1['idseccion']."'>Modificar</a>";
        }else{
          echo "Tarea no entregada - ";
            echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='sesion.php?claveww=".$ww1['idseccion']."'>Entregar</a>";
        }
        echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='calificaciones.php'> - Resumen de ".$zz['nombre']."</a>";
        
        echo "</div>";
        echo "</div>";


 //     echo "<div style='margin:auto;width:80%;background:rgb(10,100,100)'>" .$ww1['idseccion']. "</div>";
      $j++;
      
    }while($ww1=mysqli_fetch_assoc($conw1));  
  }else{
    echo "<tr><td> No hay secciones creadas</td></tr>";
  }
  
  echo "</div>";
    echo "</article>";
  

?>




</article>






<?php include('footer.php'); ?>
