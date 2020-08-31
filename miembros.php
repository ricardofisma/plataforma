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



$docent=mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM clase, usuario WHERE clase.usuario=usuario.idusuario  AND clase.clave ='".$_SESSION['clave']."'"));  

$estudian=mysqli_query($link,"SELECT * FROM misclases, usuario WHERE misclases.usuario=usuario.idusuario  AND misclases.clave ='".$_SESSION['clave']."'");   
$estudiant=mysqli_fetch_assoc($estudian);
$nm=mysqli_num_rows($estudian);
?>



<title>Participantes</title>

<?php include('first.php'); ?><?php include('margin.php'); ?>


<?php
$con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
    $wew=mysqli_fetch_assoc($con);
    ?>



<style>

.contenedor-imagenesw{
    display:flex;
    width:100%;
    
    flex-wrap:wrap;
    align-items: center;
  justify-content: center;
}
.contenedor-imagenesw .imagen{
text-align: center;
width:300px;
border-radius:6px;
position:relative;
margin:10px;
border:.05em solid ;
background-color: rgb(210, 250, 250);
box-shadow:0px 0px 0px 0px rgba(0,0,0,.75);
}

</style>


<article>
    <h1 style='text-align:center;'>Integrantes del curso de <?php echo $wew['nombre']?></h1> 
    
<div class= "contenedor-imagenesw">
        <?php
echo "<div class='imagen'>";
echo "<h1 style='border-radius:5px 5px 0px 0px;font-size:15px'>" .$docent['tipo']. "</h1>";
echo "<div class='wrapper' style='margin:5px auto;'><img src= 'archivos/".$docent['usuario']."".$docent['foto']."' onerror=this.src='foto.png'></div>";
echo "<h1 style='background:rgba(255,255,255);width:90%; margin:0px auto;font-size:0.7em;border-radius:5px;padding:3px;'>" .$docent['nombre']. "</h1>";
if($docent['confirmar']=='confirmado'){
echo "<h1 style='border-radius:0px 0px 5px 5px;font-size:15px;background:rgba(255,105,10)'><a style='text-decoration:none;color:white' href='email.php?enviara='".$docent['email']."'>" .$estudiant['email']. "</a></h1>";
}else{
//    echo "<h1 style='background:red; font-size:15px;border-radius:0px 0px 5px 5px'>Correo no confirmado</h1>";
}
echo "</div>";
?>
</tr>
<?php
if($nm>0){
do{
echo "<div class='imagen'>";
echo "<h1 style='border-radius:5px 5px 0px 0px;font-size:15px'>" .$estudiant['tipo']. "</h1>";
echo "<div class='wrapper' style='margin:5px auto;'><img src= 'archivos/".$estudiant['usuario']."".$estudiant['foto']."' onerror=this.src='foto.png'></div>";
echo "<h1 style='background:rgba(255,255,255);width:90%; margin:0px auto;font-size:.7em;border-radius:5px;padding:3px'>" .$estudiant['nombre']. "</h1>";
if($estudiant['confirmar']=='confirmado'){
echo "<h1 style='border-radius:0px 0px 5px 5px;font-size:15px;background:rgba(255,105,10)'><a style='text-decoration:none;color:white' href='email.php?enviara='".$estudiant['email']."'>" .$estudiant['email']. "</a></h1>";
}else{
//echo "<h1 style='background:red; font-size:15px;border-radius:0px 0px 5px 5px'>Correo no confirmado</h1>";
}
echo "</div>";
}while($estudiant=mysqli_fetch_assoc($estudian));
}else{"<div>No hay inscritos</div>";
}
?>
</div>


</article>




<?php include "footer.php"; ?>
