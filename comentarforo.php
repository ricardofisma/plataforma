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

if(isset($_REQUEST['ec'])){
    mysqli_query($link, "DELETE FROM comentarios WHERE idcom=".$_REQUEST['ec']);
}
if(isset($_REQUEST['idtema'])){
    $_SESSION['tema']=$_REQUEST['idtema'];
}

if(isset($_REQUEST['comentario'])){
    $u=$_SESSION['user'];
    $c=$_SESSION['clave'];
    $id=$_SESSION['tema'];
    $c=$_REQUEST['comentario'];
    $c = mysqli_real_escape_string($link, $c);  
    mysqli_query($link, "INSERT INTO comentarios VALUES(NULL, '$id', '$c','$u','$c', NULL)");
}

$qtemas=mysqli_query($link,"SELECT * FROM temas WHERE idtema='".$_SESSION['tema']."' ORDER BY fecha ASC");
$ntemas=mysqli_num_rows($qtemas);
$arraytemas=mysqli_fetch_assoc($qtemas);


$qcomen=mysqli_query($link,"SELECT * FROM comentarios, usuario WHERE comentarios.usuario=usuario.idusuario AND idtema='".$_SESSION['tema']."' ORDER BY fecha DESC");
$ncomen=mysqli_num_rows($qcomen);
$arraycomen=mysqli_fetch_assoc($qcomen);

?>


<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>



<title>Tema actual</title>

<?php include('first.php'); ?><?php include('margin.php'); ?>


<h1>Tema actual</h1>
<article class='plan'><?php echo $arraytemas['tema']; ?></article>
<article class='plan'>



<?php
?>
<form action="comentarforo.php" method="post">
    <h2>Igrese su comentario acerca de este tema</h2>
<textarea name="comentario" id="" cols="30" rows="10" placeholder="Nuevo comentario"></textarea><br>
<input type="submit" value="Agregar comentario" name="ff"> 
</form>


<style>

.wrap {
  width:150px;
  height:150px;
  overflow: hidden;
  border-radius:50%;
  position: relative;
  object-fit:cover;
}
.wrap img {
  height:150px;
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
    echo "<article class='plan'>";
     echo "<div class='wrap'><img src= 'archivos/".$arraycomen['usuario']."".$arraycomen['foto']."'></div>";
     echo $arraycomen['nombre'];
     echo "<article class='plan'>".$arraycomen['comentario']."</article>";
     echo " [".$arraycomen['fecha']."]";
     if($w['tipo']=='docente'){
echo "<a href=\"javascript:preguntar('".$arraycomen['idcom']."')\"> Eliminar comentario</a><br><br><br>";
}
echo "</article>";
$i++;
}while($arraycomen=mysqli_fetch_assoc($qcomen));
}else{
echo "No hay comentarios aún para este tema.";
}
?>


<script>
function preguntar(valor){
eliminar=confirm("Estas de aceurdo de eliminar esta comentario");
if(eliminar)
window.location.href="comentarforo.php?ec="+valor;
}
</script>


</article>


<?php include('footer.php');?>
 