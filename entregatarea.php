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


if(isset($_REQUEST['tarea'])){
$_SESSION['tarea']=$_REQUEST['tarea'];
}

if(isset($_REQUEST['idtarea']) && !empty($_REQUEST['idtarea']) && isset($_REQUEST['cal']) && !empty($_REQUEST['cal'])){
mysqli_query($link,"UPDATE  tareas SET evaluacion='".$_REQUEST['cal']."' WHERE idtarea=".$_REQUEST['idtarea']);
}

if(isset($_REQUEST['eliminartarea'])){
    mysqli_query($link,"DELETE FROM tareas WHERE idtarea=".$_REQUEST['eliminartarea']);
    header("Location:entregatarea.php");
}

if(isset($_REQUEST['texto']) && !empty($_REQUEST['texto'])){
$clave=$_SESSION['clave'];
$user=$_SESSION['user'];
$na=$_FILES['archivo']['name'];
$t=$_REQUEST['texto'];
$t = mysqli_real_escape_string($link, $t); 
$id=$_SESSION['tarea'];
mysqli_query($link,"INSERT INTO tareas VALUES(NULL, '$t','$user','$clave',NULL,'$na', NULL, '$id')");
$idtarea=mysqli_insert_id($link);
copy($_FILES['archivo']['tmp_name'],"archivostarea/tarea".$idtarea.$na);
}

$tarea=mysqli_query($link,"SELECT * FROM plan WHERE idplan=".$_SESSION['tarea']);
$arraytarea=mysqli_fetch_assoc($tarea);
$nt=mysqli_num_rows($tarea);
?>







<title>Entrega tarea</title>

<?php include('first.php'); ?><?php include('margin.php'); ?>




<?php 
$tareas=mysqli_query($link,"SELECT * FROM tareas WHERE idplan='".$_SESSION['tarea']."' AND clave='".$_SESSION['clave']."' AND usuario='".$w['usuario']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);
?>


<article>

<?php
if($w['tipo']=='estudiante'){
if($nts==0){
echo "<h3>".$arraytarea['titulo']."</h3>";
echo "<p>".$arraytarea['texto']."</p>";
?>

<form action="entregatarea.php" method="post" enctype="multipart/form-data">
        <textarea name="texto" id="" cols="30" rows="10" placeholder="Introduce la descripcion de tu tarea" required></textarea>
        <input type="file" name="archivo" required><br>
        <input type="submit" value="Entregar">
</form>

<?php
}else{
echo "<h1> Tarea entregada</h1>";
echo "<p>".$arraytareas['texto']."</p>";
if($arraytareas['evaluacion']!=""){echo "[ Evaluacion: <span>".$arraytareas['evaluacion']."</span> ]";}
echo "[ Fecha: ".$arraytareas['fecha']." ] ";
echo "<a href='archivostarea/tarea".$arraytareas['idtarea'].$arraytareas['archivo']."'>[ Descargar ]</a>";
if($arraytareas['evaluacion']==""){echo "<td><a href=\"javascript:preguntar('".$arraytareas['idtarea']."')\" > [ Eliminar ]</a></td>";}
if($arraytareas['evaluacion']==""){echo "<td><a href='entregatarea.php?ma=".$arraytareas['idplan']."'>  Modificar </a></td>";}
}
?>


<script>
function preguntar(valor){
eliminar=confirm("¿Esta seguro de eliminar esta tarea?");
if(eliminar)
window.location.href="entregatarea.php?eliminartarea="+valor;
}
</script>

<?php
}
if($w['tipo']=='docente'){
$tareas=mysqli_query($link,"SELECT * FROM tareas, usuario WHERE usuario.usuario=tareas.usuario AND idplan='".$_SESSION['tarea']."' AND clave='".$_SESSION['clave']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);
?>

<table>
<tr>
<td>Estudiante</td>
<td>Fecha</td>
<td>Descripcion</td>
<td>Descarga</td>
<td>Evaluacion</td>
</tr>

<?php
if($nts>0){
        do{
echo "<tr>";
echo "<td>".$arraytareas['nombre']."</td>";
echo "<td>".$arraytareas['fecha']."</td>";
echo "<td>".$arraytareas['texto']."</td>";
echo "<td><a href='archivostarea/tarea".$arraytareas['idtarea'].$arraytareas['archivo']."'>Descargar</a><td>";
if($arraytareas['evaluacion']==""){
echo "<select name='evaluar' onChange='evaluar(\"parent\",this,1)'>";
echo "<option value=''>Nota</option>";
echo "<option value='entregatarea.php?idtarea=".$arraytareas['idtarea']."&cal=5'>5</option>";
echo "<option value='entregatarea.php?idtarea=".$arraytareas['idtarea']."&cal=6'>6</option>";
echo "<option value='entregatarea.php?idtarea=".$arraytareas['idtarea']."&cal=7'>7</option>";
echo "<option value='entregatarea.php?idtarea=".$arraytareas['idtarea']."&cal=8'>8</option>";
echo "<option value='entregatarea.php?idtarea=".$arraytareas['idtarea']."&cal=9'>9</option>";
echo "<option value='entregatarea.php?idtarea=".$arraytareas['idtarea']."&cal=10'>10</option>";
echo "</select>";
}else{echo $arraytareas['evaluacion'];}
echo "</td></tr>";
        }while($arraytareas=mysqli_fetch_assoc($tareas));  
}else{
        echo "<tr><td colspan=5>No hay tareas</td></tr>";
}
?> 
</table>

<script>
function evaluar(targ,selObj,restore){
    eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
    if(restore)selObj.selectedIndex=0;
}
</script>

<?php
}
?>

</article>



<?php include('footer.php');?>
