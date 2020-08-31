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

if(isset($_POST['id'])){
$cc=$_POST['id'];
$consulta=mysqli_query($link, "DELETE FROM chat WHERE id='$cc'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok seccion refresh";
}

  }

//echo $_SESSION['tema'];

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

if(isset($_REQUEST['clavew'])){
    $nom=$w['nombre'];
    $men=$_POST['x1'];
    $men = mysqli_real_escape_string($link, $men);  
    
    $uu=$_POST['user'];
    $cc=$_POST['clavew'];
    
    $consulta=mysqli_query($link, "INSERT INTO chat VALUES(NULL, '$nom', '$men', NULL, '$cc', '$uu')");
if(!$consulta){
  echo "no ok";
}else{
echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
//  echo "ok seccion refresh";
}

  }



$qcomen=mysqli_query($link,"SELECT * FROM chat, usuario WHERE chat.idusuario=usuario.idusuario AND clave='".$_SESSION['clave']."' ORDER BY fecha DESC");
$ncomen=mysqli_num_rows($qcomen);
$arraycomen=mysqli_fetch_assoc($qcomen);

//if($ncomen == true) {
//echo "<script> alert('wwwwwwww');</script>";
//} else {
//echo "<script> alert('wwwwwwww');</script>";
//}
//ECHO $ncomen;
?>


<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>



<title>Tema actual</title>



<style>

.wrap {
  width:50px;
  height:50px;
  overflow: hidden;
  border-radius:50%;
  position: relative;
  object-fit:cover;
}
.wrap img {
  height:50px;
  position: absolute;
  top:50%;
  object-fit:cover;
  left:50%;
  transform: translate(-50%,-50%)
}
</style>




<?php
if($ncomen>0){
    $i=1;
do{
  echo "<div style='display:block;width:90%;margin:5px auto;padding:5px;border-radius:5px;border:2px solid;flex-wrap:wrap;align-items:center;justify-content:left;'>";
  
  echo "<div class='wrap' style='display:inline-block'><img src= 'archivos/".$arraycomen['idusuario']."".$arraycomen['foto']."'></div>";
  echo "<div style='display:inline-block;margin:5px;font-weight:bold;'>".$arraycomen['nombre']."<br>[".$arraycomen['fecha']."]";
     if($w['tipo']=='docente'){
       echo " <a style='cursor:pointer;color:red;' id='delete' data-id='".$arraycomen['id']."'> Eliminar comentario</a>";
      }
      echo "</div>";
      echo "<article style='padding:5px;display:block;margin:0px auto;width:100%;'>".$arraycomen['mensaje']."</article>";
      
      echo "</div>";
  //    echo $i;

      $i++;
//echo $i;

    }while($arraycomen=mysqli_fetch_assoc($qcomen));
}else{
  echo "No hay comentarios aún para este tema.";
}
//echo "--".$ncomen;
//  echo "--".$i;

//if($ncomen$i){
//  echo "<script> alert('wwwwwwww');</script>";
//$ncomen
  //echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
//}

?>

