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


$tareas=mysqli_query($link,"SELECT * FROM clase WHERE idclase='".$_SESSION['claves']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);

echo $arraytareas['usuario'];

if(isset($_REQUEST['actualizar'])){
   $text=$_REQUEST['texto'];
   $precio=$_REQUEST['price'];
   $text = mysqli_real_escape_string($link, $text); 
   $titulo = $_REQUEST['titulo']; 
   $titulo = mysqli_real_escape_string($link, $titulo); 
   $video=$_REQUEST['link'];
   $f="";
   $img=$_FILES['foto']['name'];
   if($img==""){
       $f=$_REQUEST['fotow'];
    }else{
        unlink('archivoscrearclase/'.$arraytareas['usuario'].$arraytareas['foto']);
        $f=$img;
        copy($_FILES['foto']['tmp_name'],"archivoscrearclase/".$arraytareas['usuario'].$f);
    }
   mysqli_query($link,"UPDATE clase SET descripcion= '$text', nombre= '$titulo', link='$video', foto='$f', precio='$precio' WHERE idclase='".$_SESSION['claves']."'");
   mysqli_query($link,"UPDATE clase SET  link = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
   
header("Location:inicio.php");
	}

?>



<?php 
if(isset($_REQUEST['www'])){
 unlink('archivoscrearclase/'.$arraytareas['usuario'].$arraytareas['foto']);
}

?>
<form action="updatecursos.php?update=<?php echo $_SESSION['claves']?>" method="post" enctype="">
<input type="submit" value="ww" name="www">
</form>



<?php include('first.php'); ?><?php include('margin.php'); ?>



<article class='plan'>

<form action="updatecursos.php?update=<?php echo $_SESSION['claves']?>" method="post" enctype="multipart/form-data">    
<input style="padding:7px" cols="30" rows="5" name="titulo" value="<?php echo $arraytareas['nombre']?>" required></input>

Foto actual: <?php echo $arraytareas['usuario'].$arraytareas['foto']; ?><br>Cambiar foto<br>
<input class="crearclase" style="background:rgb(100,20,250);cursor:pointer;" placeholder="ww" type="file" name="foto">
<input class="crearclase" type="hidden" name="fotow"  value="<?php echo $arraytareas['foto']?>"><br>

<input style='border:1px solid;padding:5px;border-radius:3px;width:200px;margin:5px' type="text" name="price" value="<?php echo $arraytareas['precio']?>" required>

  <input style='border:1px solid;padding:5px;border-radius:3px;width:350px;margin:5px' type="text" name="link" value="<?php echo $arraytareas['link']?>" required>

<textarea name="texto"><?php echo$arraytareas['descripcion']?></textarea>
<input class="crearclase" style="background:rgb(155,200,225);cursor:pointer; border:none;padding:7px;"  type="submit" value="Actualizar" name="actualizar"><br>
</form>



</article>
<?php include('footer.php'); ?>
