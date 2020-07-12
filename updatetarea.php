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


//echo $_SESSION['claveww'];
//echo $_SESSION['clave'];

$tareas=mysqli_query($link,"SELECT * FROM tareas WHERE idplan='".$_SESSION['claveww']."' AND clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."'");
$arraytareas=mysqli_fetch_assoc($tareas);
$nts=mysqli_num_rows($tareas);


//echo $_SESSION['user'];

//$_SESSION['claveww']=$_GET['claveww'];



if(isset($_REQUEST['actualizar'])){
    $text=$_REQUEST['texto'];
    $text = mysqli_real_escape_string($link, $text); 
    
    $f="";
    $img=$_FILES['foto']['name'];
	if($img==""){
        $f=$_REQUEST['fotow'];
    }else{
        unlink('archivostarea/'.$arraytareas['idplan'].$arraytareas['archivo']);
        $f=$img;
        copy($_FILES['foto']['tmp_name'],"archivostarea/".$_SESSION['claveww'].$f);
    }
    mysqli_query($link,"UPDATE tareas SET texto= '$text', archivo= '$f' WHERE idplan='".$_SESSION['claveww']."' AND clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."'");
    
header("Location:sesion.php?claveww=".$_SESSION['claveww']);
	}

?>







<?php include('first.php'); ?>



<article class='plan'>

<form action="updatetarea.php" method="post" enctype="multipart/form-data">     
    <textarea name="texto" id="" cols="30" rows="5" name="texto" placeholder="" required><?php echo $arraytareas['texto']; ?></textarea>

Foto actual: <?php echo $arraytareas['idplan'].$arraytareas['archivo']; ?><br>Cambiar foto<br>
<input class="crearclase" style="background:rgb(100,20,250);cursor:pointer;" placeholder="ww" type="file" name="foto">
<input class="crearclase" type="hidden" name="fotow"  value="<?php echo $arraytareas['archivo']; ?>"><br>


   
<input class="crearclase" style="background:blue;cursor:pointer;"  type="submit" value="Actualizar" name="actualizar"><br>
</form>



<script>
function fileUpload() {
    $("#myFile").click();
}
</script>

</article>


<style>
.crearclase{
width:300px;
    margin: 5px auto;
display:block;
border:none;
border-radius:5px;
background:#2333ee22;
padding:5px;

}

</style>