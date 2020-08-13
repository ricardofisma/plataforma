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


$tareas=mysqli_query($link,"SELECT * FROM preguntas WHERE idalternativa='".$_SESSION['claves']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);


if(isset($_REQUEST['actualizar'])){
   $text=$_REQUEST['texto'];
   $text = mysqli_real_escape_string($link, $text); 
   $titulo = $_REQUEST['respuesta']; 
   mysqli_query($link,"UPDATE preguntas SET alternativa= '$text', respuesta= '$titulo'  WHERE idalternativa='".$_SESSION['claves']."'");
   
   header("Location:preguntas.php?clavew=".$_SESSION['clavew']."&clave=".$_SESSION['clave']);
}

?>


<?php include('first.php'); ?><?php include('margin.php'); ?>

<article class='plan'>

<form action="updatepregunta.php?update=<?php echo $_SESSION['claves']?>" method="post" enctype="multipart/form-data">    
<textarea name="texto"><?php echo$arraytareas['alternativa']?></textarea>
  <select name="respuesta" class="select">
        <option value="incorrecta">Incorrecta</option>
        <option value="correcta">Correcta</option>
    </select> 
<input class="crearclase" style="background:rgb(155,200,225);cursor:pointer; border:none;padding:7px;"  type="submit" value="Actualizar" name="actualizar"><br>
</form>





</article>


<article>

<?php
echo "<div style='margin:auto;width:90%'><p>" .$arraytareas['alternativa']. "</p></div>";
//echo "<div style='margin:auto;width:90%'><h1>Tarea</h1></div>";
echo "<div style='margin:auto;width:90%'><p>" .$arraytareas['respuesta']. "</p></div>";

?>
</article>
<?php include('footer.php'); ?>
