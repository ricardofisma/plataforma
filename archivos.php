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


if(isset($_REQUEST['subir']) && !empty($_REQUEST['subir'])){
$clave=$_SESSION['clave'];
$user=$_SESSION['user'];
$na=$_FILES['archivo']['name'];
$tipo=$_FILES['archivo']['type'];
$t=$_FILES['archivo']['size'];
mysqli_query($link,"INSERT INTO archivos VALUES(NULL, '$na','$tipo','$t','$clave','$user')");
$idarchivo=mysqli_insert_id($link);
copy($_FILES['archivo']['tmp_name'],"archivosclase/".$idarchivo.$na);
}


if(isset($_REQUEST['eliminararchivos'])){
    mysqli_query($link,"DELETE FROM archivos WHERE idarchivo=".$_REQUEST['eliminararchivos']);
    header("Location:archivos.php");
}



$queryarchivos=mysqli_query($link,"SELECT * FROM archivos WHERE clave='".$_SESSION['clave']."'");
$numarchivos=mysqli_num_rows($queryarchivos);
$todoslosarchivo=mysqli_fetch_assoc($queryarchivos);

?>




	<title>Archivos</title>






<?php include('first.php'); ?><?php include('margin.php'); ?>




<?php
$con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
    $wew=mysqli_fetch_assoc($con);
    ?>




<article>

<h1>Archivos del curso de <?php echo $wew['nombre']?></h1> 



<form action="archivos.php" enctype="multipart/form-data" method="post">
<label for="archivo">Subir archivos</label><br>
<input class="crearclase" type="file" name="archivo" required>
<input class="crearclase" type="hidden" name="subir" value="ok"><br>
<input class="crearclase" type="submit" value="Subir archivo">
</form>


<style>

.crearclase{
margin: 5px auto;
display:block;
border: 1px solid ;
border-radius:3px;
background:#2333ee22;
padding:5px;

}

</style>











<div style= "    display:flex;    width:100%;    flex-wrap:wrap;    align-items: center;    justify-content: center;font-size:15px">


<?php
if($numarchivos>0){
    do{
        echo "<div style='text-align: center;background:#2333ee22;width:280px;height:190px;border-radius:10px;position:relative;margin:5px;box-shadow:0px 0px 5px 0px rgba(0,0,0,.75);'>";
 //   echo "<h1> ".$todoslosarchivo['idarchivo']." </h1>";
    echo "<p style='text-align:center;'> ".$todoslosarchivo['nombre']." </p>";
    echo "<h1> ".$todoslosarchivo['tipo']."</h1>";
    echo "<h1> ".round($todoslosarchivo['tamanio']/1024,3)." KB </h1>";
    echo "<h1><a target='_blank' href='archivosclase/".$todoslosarchivo['idarchivo'].$todoslosarchivo['nombre']."' > Descargar </a></h1>";
    echo "<h1><a href=\"javascript:preguntar('".$todoslosarchivo['idarchivo']."')\" > Eliminar </a></h1>";
    echo "</div>";
}while($todoslosarchivo=mysqli_fetch_assoc($queryarchivos));
}else{
    echo "<tr><td colspan=6>No hay archivos</td></tr>";
}
?> 
</div>





<script>
function preguntar(valor){
eliminar=confirm("Estas de acuerdo de eliminar esta clase");
if(eliminar)
window.location.href="archivos.php?eliminararchivos="+valor;
}
</script>
</article>





<?php include('footer.php'); ?>

