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


if(isset($_REQUEST['et'])){
    mysqli_query($link, "DELETE FROM temas WHERE idtema=".$_REQUEST['et']);
}

if(isset($_REQUEST['ff'])){
    $u=$_SESSION['user'];
    $c=$_SESSION['clave'];
    $t=$_REQUEST['tema'];
    $t = mysqli_real_escape_string($link, $t); 
    mysqli_query($link, "INSERT INTO temas VALUES(NULL, '$c','$u','$t', NULL)");
}

$qtemas=mysqli_query($link,"SELECT * FROM temas WHERE clave='".$_SESSION['clave']."' ORDER BY fecha DESC");
$ntemas=mysqli_num_rows($qtemas);
$arraytemas=mysqli_fetch_assoc($qtemas);

?>


<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>



<title>Foro de discución</title>

<?php include('first.php'); ?><?php include('margin.php'); ?>

<?php
$con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
    $wew=mysqli_fetch_assoc($con);
    ?>
<h1>Foro del curso de <?php echo $wew['nombre']?></h1> 

<?php
if($w['tipo']=='docente'){
  ?>
  <article class="plan">
<form action="foro.php" method="post">
<textarea name="tema" id="" cols="80" rows="10" placeholder="Nuevo tema"></textarea><br>
<input type="submit" value="Agregar tema" name="ff"> 
</form>
</article>



<?php
}
if($ntemas>0){
//  $i=1;
  do{
    echo "<article class='plan'>";
//     echo "Tema:" .$i."<br>"; 
     echo "<article class='plan'>".$arraytemas['tema']."</article>";
     echo " [ <span>Fecha: </span>".$arraytemas['fecha']." ]";
     if($w['tipo']=='docente'){
echo "<a href=\"javascript:preguntar('".$arraytemas['idtema']."')\">[ Eliminar tema ]</a>";
}
echo "[<a href='comentarforo.php?idtema=".$arraytemas['idtema']."'> Comentar</a> ]";
$cc=mysqli_num_rows(mysqli_query($link,"SELECT * FROM comentarios WHERE idtema=".$arraytemas['idtema']));
echo "[ ".$cc." comentarios ]";
echo "</article>";
//$i++;
}while($arraytemas=mysqli_fetch_assoc($qtemas));
}else{
echo "No hay temas";
}
?>


<script>
function preguntar(valor){
eliminar=confirm("Estas de aceurdo de eliminar esta clase");
if(eliminar)
window.location.href="foro.php?et="+valor;
}
</script>


<?php include('footer.php');?>
