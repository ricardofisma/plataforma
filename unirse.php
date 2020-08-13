<?php
    require('conect.php');
    session_start();


    if(!isset($_SESSION['user'])){
    header("Location:index.php");
    }
    

    if(isset($_REQUEST['clave'])){
        $n=mysqli_num_rows(mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_REQUEST['clave']."'"));
        if($n>0){       
        $nc=mysqli_num_rows(mysqli_query($link,"SELECT * FROM misclases WHERE clave='".$_REQUEST['clave']."' AND usuario='".$_SESSION['user']."'"));    
        if($nc==0){
            
            $u = $_SESSION['user'];
            $c = $_REQUEST['clave'];
            mysqli_query($link,"INSERT INTO misclases VALUES(NULL,'$u','$c')");
            
        }else{
            
        echo "<script> alert('Ya te uniste a esa clase')</script>";
        }
        }else{
        echo "<script> alert('La clase no existe')</script>";
        }
    }
   
    
 if(isset($_REQUEST['e'])){
     mysqli_query($link,"DELETE FROM misclases WHERE idmiclase=".$_REQUEST['e']);
 }

 
    $con= mysqli_query($link,"SELECT clase.nombre, misclases.idmiclase, clase.clave FROM clase, misclases WHERE clase.clave=misclases.clave AND misclases.usuario='".$_SESSION['user']."'");
    $n=mysqli_num_rows($con);
    $a=mysqli_fetch_assoc($con);

?>






<?php include('first.php'); ?>

<article>
<h1>Unirse a clases</h1>

    <form action="unirse.php" method="post">

    <input type="text" name="clave" placeholder="Clave de la clase" required><br>

    <input type="submit" value="Unirse a clase"><br>
    </form>


<hr>


<h1>Mis clases</h1><hr>


<table>
<tr>
<td>Nombre</td>
<td>Eliminar</td>
<td>Planes</td>
</tr>

<?php
if($n>0){
    do{
        echo "<tr><td>".$a['nombre']."</td>";
echo "<td><a href=\"javascript:preguntar('".$a['idmiclase']."')\">Eliminar</a></td>";
echo "<td><a href='plan.php?clave=".$a['clave']."'>Var plan</a></td></tr>";
}while($a=mysqli_fetch_assoc($con));
}else{
    echo "<tr><td>No hay clases</tr></td>";
}
?>

</table>



</article>

<script>
function preguntar(valor){
eliminar=confirm("Estas de aceurdo de eliminar esta clase");
if(eliminar)
window.location.href="unirse.php?e="+valor;
}
</script>
<?php include('footer.php');?>
