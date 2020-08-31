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
$consulta=mysqli_query($link, "DELETE FROM comentarios WHERE idcom='$cc'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok seccion refresh";
}

  }

//echo $_SESSION['tema'];

if(isset($_REQUEST['clavew'])){
    $u=$_SESSION['user'];
    $c=$_SESSION['clavew'];
    $id=$_SESSION['tema'];
    $cc=$_POST['x1'];
    $cc = mysqli_real_escape_string($link, $cc);  
    $consulta=mysqli_query($link, "INSERT INTO comentarios VALUES(NULL, '$id', '$c','$u','$cc', NULL)");
if(!$consulta){
  echo "no ok";
}else{
echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
//  echo "ok seccion refresh";
}

  }


$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

$qcomen=mysqli_query($link,"SELECT * FROM comentarios, usuario WHERE comentarios.usuario=usuario.idusuario AND idtema='".$_SESSION['tema']."' ORDER BY fecha DESC");
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


<article>



<?php
if($ncomen>0){
    $i=1;
do{
  echo "<div style='display:flex;width:100%;margin:5px 0px 0px;padding:5px;border-radius:5px;border:1px solid;flex-wrap:wrap;align-items:center;justify-content:left;'>";
  
  echo "<div class='wrap' style='display:inline-block'><img src= 'archivos/".$arraycomen['usuario']."".$arraycomen['foto']."'></div>";
  echo "<div style='display:inline-block;margin:5px;font-weight:bold;'>".$arraycomen['nombre']."<br>[".$arraycomen['fecha']."]";
     if($w['tipo']=='docente'){
       echo " <a style='cursor:pointer;color:red;' id='delete' data-id='".$arraycomen['idcom']."'> Eliminar comentario</a>";
      }
      echo "</div>";
      echo "<article style='padding:5px;display:block;margin:0px auto;width:100%;'>".$arraycomen['comentario']."</article>";
      
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



</article>

