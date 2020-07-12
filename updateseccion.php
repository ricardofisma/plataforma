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
//echo $_SESSION['claves'];


$tareas=mysqli_query($link,"SELECT * FROM secciones WHERE idseccion='".$_SESSION['claves']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);


if(isset($_REQUEST['actualizar'])){
   $text=$_REQUEST['texto'];
   $text = mysqli_real_escape_string($link, $text); 
   $tarea=$_REQUEST['tarea'];
   $tarea = mysqli_real_escape_string($link, $tarea); 
   $titulo = $_REQUEST['titulo']; 
   $titulo = mysqli_real_escape_string($link, $titulo); 
   mysqli_query($link,"UPDATE secciones SET texto= '$text', nombre= '$titulo',  tarea='$tarea'  WHERE idseccion='".$_SESSION['claves']."'");
   
   header("Location:secciones.php?clavew=".$_SESSION['clavew']."&clave=".$_SESSION['clave']);
}

?>


<?php include('first.php'); ?><?php include('margin.php'); ?>



<article class='plan'>

<form action="updateseccion.php?update=<?php echo $_SESSION['claves']?>" method="post" enctype="multipart/form-data">    
<input style="padding:7px" cols="30" rows="5" name="titulo" value="<?php echo $arraytareas['nombre']?>" required></input>
<textarea name="texto"><?php echo$arraytareas['texto']?></textarea>
<textarea name="tarea"><?php echo$arraytareas['tarea']?></textarea>
<input class="crearclase" style="background:rgb(155,200,225);cursor:pointer; border:none;padding:7px;"  type="submit" value="Actualizar" name="actualizar"><br>
</form>





</article>


<article>

<?php
echo "<div style='margin:auto;width:90%'><p>" .$arraytareas['texto']. "</p></div>";
echo "<div style='margin:auto;width:90%'><h1>Tarea</h1></div>";
echo "<div style='margin:auto;width:90%'><p>" .$arraytareas['tarea']. "</p></div>";

?>
</article>
<?php include('footer.php'); ?>
