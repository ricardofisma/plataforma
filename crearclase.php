<?php
require('conect.php');
session_start();

if(!isset($_SESSION['user'])){
header("Location:index.php");
        }

if(isset($_REQUEST['jj'])){
    $n=$_REQUEST['clase'];
    $f1=$_FILES['gg']['name'];
    $str= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $cad="";
    for($i=0;$i<11;$i++){
        $cad .=substr($str,rand(0,62),1);
    }
    $u=$_SESSION['user'];
    mysqli_query($link, "INSERT INTO clase VALUES(NULL, '$n','$cad','$u', NULL , '$f1')");
    copy($_FILES['gg']['tmp_name'],"archivoscrearclase/".$u.$f1);  
}


if(isset($_REQUEST['e'])){
mysqli_query($link, "DELETE FROM clase WHERE clase.idclase=".$_REQUEST['e']);
}

$con=mysqli_query($link,"SELECT * FROM clase WHERE usuario='".$_SESSION['user']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con);
?>




<?php include('first.php'); ?>

<article>
    <h1>Gestión de cursos</h1>

<form action="crearclase.php" method="post" enctype="multipart/form-data">
<input type="text" name="clase" placeholder="Escriba el nombre de la clase" required>
<input type="file" name="gg" required><br>
<input type="submit" value="Crear" name="jj">
</form>

<table border>
<tr>
<td>Nombre</td>
<td>Clave</td>
<td>Fecha</td>
<td>Foto</td>
<td>Eliminar</td>
<td>Plan</td>
</tr>

<?php
if($n>0){
    do{
        echo "<tr><td>".$a['nombre']."</td>";
        echo "<td>".$a['clave']."</td>";
        echo "<td>".$a['fecha']."</td>";
        echo "<td class='wrapper'><img src= 'archivoscrearclase/".$a['usuario']."".$a['foto']."'></td>";
        echo "<td><a href=\"javascript:preguntar('".$a['idclase']."')\">Eliminar</a></td>";
        echo "<td><a href='plan.php?clave=".$a['clave']."'>Ver plan</a></td></tr>";
    }while($a=mysqli_fetch_assoc($con));
}else{
    echo "<tr><td> No hay clase creadas</td></tr>";
}

?>

</table>
</article>

<script>
function preguntar(valor){
eliminar=confirm("Estas de acuerdo de eliminar esta clase?")
if(eliminar)
window.location.href="crearclase.php?e="+valor;
}
</script>


<?php include "footer.php"; ?>


