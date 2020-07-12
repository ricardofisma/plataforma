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

$user=mysqli_query($link,"SELECT * FROM usuario WHERE email='".$_SESSION['user']."'")     ;
$g=mysqli_fetch_assoc($user);
echo $_SESSION['user'];

if(isset($_REQUEST['actualizar']) && !empty($_REQUEST['actualizar'])){
    $p=$_REQUEST['pass'];
    $n=$_REQUEST['nombre'];
    $t=$_REQUEST['tipo'];
      $c=$_REQUEST['correo'];
    $f="";
    $img=$_FILES['foto']['name'];
if($img==""){
        $f=$_REQUEST['fotow'];
    }else{
        unlink('archivos/'.$g['usuario'].$g['foto']);
        $f=$img;
        move_uploaded_file($_FILES['foto']['tmp_name'], "archivos/".$g['usuario'].$f);
    }

        mysqli_query($link,"UPDATE usuario SET passw= '$p', nombre = '$n', foto = '$f', email='$c' WHERE email='".$_SESSION['user']."'");
        header("Location:inicio.php");
    }

?>







<?php include('first.php'); ?>



<article class='plan'>

<form action="editar.php" method="post" enctype="multipart/form-data">

 <h1>
 Hola <?php echo $g['nombre']; ?> cambie sus datos actuales</h1>
     
     
Contraseña
<input class="crearclase" type="password" name="pass" value="<?php echo $g['passw']; ?>"  required>
Correo
<input class="crearclase" type="text" name="correo" value="<?php echo $g['email']; ?>"  required>
Nombre
<input class="crearclase" type="text" name="nombre" value="<?php echo $g['nombre']; ?>"  required>
Foto actual: <?php echo $g['foto']; ?><br>Cambiar foto<br>
<input class="crearclase" style="background:rgb(100,200,250);cursor:pointer;" placeholder="ww" type="file" name="foto">
<input class="crearclase" type="hidden" name="tipo"  value="<?php echo $g['tipo']; ?>">
<input class="crearclase" type="hidden" name="fotow"  value="<?php echo $g['foto']; ?>"><br>
<input class="crearclase" style="background:blue;cursor:pointer;"  type="submit" value="Actualizar" name="actualizar"><br>
</form>

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