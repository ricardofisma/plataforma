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


$tareas=mysqli_query($link,"SELECT * FROM capitulo WHERE idcapitulo='".$_SESSION['claves']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);


if(isset($_REQUEST['e'])){
  mysqli_query($link, "DELETE FROM clase WHERE clase.idclase=".$_REQUEST['e']);
}

//echo $_SESSION['user'];

//$_SESSION['claveww']=$_GET['claveww'];



if(isset($_REQUEST['actualizar'])){
      $text=$_REQUEST['texto'];
         $text = mysqli_real_escape_string($link, $text); 
      $titulo = $_REQUEST['titulo']; 
      $titulo = mysqli_real_escape_string($link, $titulo);
       mysqli_query($link,"UPDATE capitulo SET descripcion= '$text', nombre= '$titulo' WHERE idcapitulo='".$_SESSION['claves']."'");

header("Location:capitulo.php?clave=".$_SESSION['clave']);
	}

?>


<?php include('first.php'); ?><?php include('margin.php'); ?>



<article class='plan'>

<form action="updatecapitulo.php?update=<?php echo $_SESSION['claves']?>" method="post" enctype="multipart/form-data">    
<input style="padding:7px" name="titulo" value="<?php echo $arraytareas['nombre']; ?>" required></input>
<textarea name="texto" id="" cols="30" rows="5" name="texto" placeholder="" required><?php echo $arraytareas['descripcion']; ?></textarea>

<input class="crearclase" style="background:rgb(155,200,225);cursor:pointer; border:none;padding:7px;"  type="submit" value="Actualizar" name="actualizar"><br>
</form>



</article>
<?php include('footer.php'); ?>
