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

$_SESSION['claves']=$_GET['update'];
echo $_SESSION['clave'];

$tareas=mysqli_query($link,"SELECT * FROM examen WHERE idpregunta='".$_SESSION['claves']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);


if(isset($_REQUEST['actualizar'])){
  $texto=$_REQUEST['pregunta'];
  $texto = mysqli_real_escape_string($link, $texto); 
  $punto = $_REQUEST['punto']; 
      mysqli_query($link,"UPDATE examen SET pregunta= '$texto', calificativo= '$punto' WHERE idpregunta = '".$_SESSION['claves']."'");
      header("Location:examen.php?clave=".$_SESSION['clave']);
}
?>

<?php include('first.php'); ?><?php include('margin.php'); ?>

<article class='plan'>

<form action="updateexamen.php?update=<?php echo $_SESSION['claves']?>" method="post" enctype="multipart/form-data">    
<textarea name="pregunta" cols="30" rows="5" required><?php echo $arraytareas['pregunta']?></textarea> 
<input name="punto" value="<?php echo $arraytareas['calificativo']?>" required></input>
<input class="crearclase" style="background:rgb(155,200,225);cursor:pointer; border:none;padding:7px;"  type="submit" value="Actualizar" name="actualizar"><br>
</form>


</article>
<?php include('footer.php'); ?>
