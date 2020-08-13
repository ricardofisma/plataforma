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


$_SESSION['claveww']=$_GET['claveww'];

echo $_SESSION['clavew'];


if(isset($_REQUEST['www'])){
$clave=$_SESSION['clave'];
$clavew=$_SESSION['clavew'];
$user=$_SESSION['user'];
$na=$_FILES['archivo']['name'];
$t=$_REQUEST['texto'];
$t=mysqli_real_escape_string($link, $t); 
$id=$_SESSION['claveww'];
mysqli_query($link,"INSERT INTO tareas VALUES(NULL, '$t','$user','$clave',NULL,'$na', NULL, '$id', '$clavew')");
$idtarea=mysqli_insert_id($link);
echo $idtarea;
copy($_FILES['archivo']['tmp_name'],"archivostarea/".$_SESSION['claveww'].$na);
}


$con=mysqli_query($link,"SELECT * FROM secciones WHERE idseccion='".$_SESSION['claveww']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con); 

?>

<?php include('first.php');?><?php include('margin.php'); ?>


<article>

<?php
echo "<div><h1>" .$a['nombre']. "</h1></div>";
echo "<p>".$a['texto']."</p>";

//echo "<p>".$a['tarea']."</p>";
?>
</article>



<article>

<?php

$tareas=mysqli_query($link,"SELECT * FROM tareas WHERE idplan='".$_SESSION['claveww']."' AND clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);

//echo $arraytareas['idplan'];

$ww=$arraytareas['idplan'];

if(isset($_REQUEST['clavewww'])){
    mysqli_query($link,"DELETE FROM tareas WHERE idplan=".$ww=$arraytareas['idplan']);
}

//echo $_SESSION['claveww'];


//echo "<div>" .$a['texto']. "</div>";
echo "<h1>Tarea</h1>";
echo "<p>".$a['tarea']."</p>";

if($w['tipo']=='estudiante'){
if($nts==0){
//echo "<h3>".$a['nombre']."</h3>";
//echo "<p>".$a['texto']."</p>";
//echo "<p>".$a['tarea']."</p>";
?>




<h1>Entregar tarea</h1>



    <form action="sesion.php?claveww=<?php echo $_SESSION['claveww']?>" method="post" enctype="multipart/form-data">
    <textarea name="texto" id="" cols="30" rows="5" <?php if(isset($_REQUEST['ma'])){ echo "value='".$arraytareas['texto']."'";} ?> placeholder="Descripcion de la tarea o la tarea hecha en codigo html" required></textarea>

    <input type="file" name="archivo" style="display:none" id="myFile">
    <a style='cursor:pointer;background:rgb(155,155,255);padding:5px;border-radius:5px;margin:5px auto;display:block;width:300px;text-align:center;' onclick="fileUpload()"> Cargar foto de tu tarea</a>
    <?php if(isset($_REQUEST['claveww'])){ echo "<input type='hidden' name='modificar' value='".$_REQUEST['claveww']."'>";} ?>   
    <input type="submit" name="www" style='cursor:pointer;background:rgb(155,155,255)" <?php if(isset($_REQUEST['claveww'])){ echo "value='Entregar'";}else{echo "value='Entregar tarea'";} ?>> 

    </form>

<script>
function fileUpload() {
    $("#myFile").click();
}
</script>

</article>

<?php
}else{
    
    echo "<h1> Tarea entregada</h1>";
    ?>

<div  style= "display:flex; width:100%;">
<?php
echo "<div class='imagen' style='float:left;'>";
echo "<div style='text-align: center;width:370px;border:0px solid;;border-radius:1px;position:relative;margin:5px;'>";
echo "<div title='Edite su perfil' style='width:250px;height:250px;overflow: hidden;border-radius:1px;position: relative;object-fit:cover;margin:5px auto;'><a style='cursor: pointer;' href='javascript:abrir()'><img style='cursor: pointer;' src= 'archivostarea/".$_SESSION['claveww'].$arraytareas['archivo']."' onerror=this.src='foto.png'></a></div>";
echo "<div style='margin:auto;width:97%; margin-bottom:0px;'><p style='border-radius:5px 5px 0px 0px;background:rgba(255,255,255,0.95);'>" .$arraytareas['archivo']. "</p></div>";
echo "</div>";
echo "</div>";
?>
</div>
<?php

//    echo $arraytareas['idplan'];
echo "<p>".$arraytareas['texto']."</p>";
if($arraytareas['evaluacion']==""){echo "<br><a style=' color: rgb(70,0,70); margin-right: 10px; font-size: 20px;' href='updatetarea.php?claveww=".$_SESSION['claveww']."'><i class='fa fa-edit'></i></a>";}
if($arraytareas['evaluacion']==""){echo "<a style=' color: rgb(70,0,70); font-size: 20px;' href=\"javascript:preguntar('".$_SESSION['claveww']."')\"><i class='fa fa-trash'></i></a>";}
echo "<a style=' color: rgb(70,0,70); margin: 10px; font-size: 20px;' href='archivostarea/".$_SESSION['claveww'].$arraytareas['archivo']."'><i class='fa fa-download'></i></a>";
 
if($arraytareas['evaluacion']!=""){echo "[ Evaluacion: <span>".$arraytareas['evaluacion']."</span> ]";}
echo "[ Fecha de entrega: ".$arraytareas['fecha']." ] <br>";
if($arraytareas['evaluacion']==""){echo "<h1 style=' color: rgb(70,0,70); margin-right: 10px; font-size: 18px;'>Tarea aun no evaluada</h1>";}

//if($arraytareas['evaluacion']==""){echo "<td><a  type='submit' href='sesion.php?claveww=".$_SESSION['claveww']."' name='wwwz'> [ Eliminar ]</a>";}
//if($arraytareas['evaluacion']==""){echo "<td><a href='sesion.php?claveww=".$_SESSION['claveww']."'>  Modificar </a>";}
}
}
?>



<?php
//echo $_SESSION['claveww']."<br>";
//echo $_SESSION['user']."<br>";
//echo $_SESSION['clave']."<br>";


if(isset($_REQUEST['notas'])){
$nota=$_REQUEST['nota'];
mysqli_query($link,"UPDATE  tareas SET evaluacion='$nota' WHERE usuario='".$_SESSION['user']."' AND idplan='".$_SESSION['claveww']."'");
}
if($w['tipo']=='docente'){

?>



<form action="sesion.php?claveww=<?php echo $_SESSION['claveww']?>" method="post" class="">
<input type="text" name="nota" id="">
<input type="submit" value="Calificar" name="notas">
</form>  
<?php 
}
?>

<div id="ff">
<form action="sesion.php" method="post" class="sesion">
<img src="archivostarea/<?php echo $_SESSION['claveww'].$arraytareas['archivo']?>" style="border-radius:10px;width:98%;height:98%;object-fit: contain;position:absolute;transform:translate(-50%,-50%);top:50%;left:50%;" alt="">
<div id="cerrar"><a href="javascript:cerrar()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
</form>  
</div>



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
  z-index: 999;
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
 z-index: 999;
text-align: center;
background-color: rgb(255,255,255);
transform:translate(-50%,-50%);
} 

input{
display:block;
border:none;
padding:5px;
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




<script>
function preguntar(valor){
eliminar=confirm("¿Esta seguro de eliminar esta tarea?");
if(eliminar)
window.location.href="deletetarea.php?claveww="+valor;
}
</script>

</article>






<?php include('footer.php'); ?>
