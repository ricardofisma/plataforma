 
<?php

if(isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])){
    $n=$_SESSION['clave']=$_REQUEST['clave'];
}


if(isset($_REQUEST['fe']) && !isset($_REQUEST['modificar'])){
    $u=$_SESSION['user'];
    $c=$_SESSION['clave'];
    $t=$_REQUEST['titulo'];
    $ex=$_REQUEST['ejercicios'];
    $tx=$_REQUEST['texto'];
    $fe=$_REQUEST['fe'];
mysqli_query($link,"INSERT INTO plan VALUES (NULL,'$u','$c','$t','$tx', NULL, '$fe', '$ex')");
}

if(isset($_REQUEST['modificar']) ){
    $u=$_SESSION['user'];
    $c=$_SESSION['clave'];
    $t=$_REQUEST['titulo'];
    $tx=$_REQUEST['texto'];
        $ex=$_REQUEST['ejercicios'];
    $tx = mysqli_real_escape_string($link, $tx); 
    $fe=$_REQUEST['fe'];
mysqli_query($link,"UPDATE plan SET titulo='$t', texto='$tx', fechaentrega='$fe', ejercicios='$ex' WHERE idplan='".$_REQUEST['modificar']."'");
}



if(isset($_REQUEST['ea'])){
    $e=$_REQUEST['ea'];
mysqli_query($link,"DELETE FROM plan WHERE idplan='$e'");
}



if(isset($_REQUEST['ma'])){
    $m=$_REQUEST['ma'];
    $mq=mysqli_query($link,"SELECT * FROM plan WHERE idplan='$m'");
    $mplan=mysqli_fetch_assoc($mq);   
}


$queryplan=mysqli_query($link,"SELECT * FROM plan WHERE clave='".$_SESSION['clave']."' ORDER BY fecha DESC");    
$n=mysqli_num_rows($queryplan);
$aplan=mysqli_fetch_assoc($queryplan);




$user=mysqli_query($link,"SELECT * FROM usuario WHERE usuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);


$con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
    $wew=mysqli_fetch_assoc($con);

    $con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
    $ww=mysqli_fetch_assoc($con);
    
    ?>




<form action="plan.php" method="post">
 
    <input type="text" name="titulo" <?php if(isset($_REQUEST['ma'])){ echo "value='".$mplan['titulo']."'";} ?> placeholder="Título" required><br><br>

    <textarea  name="texto" id="ww" placeholder="Contenido" requireds><?php if(isset($_REQUEST['ma'])){echo $mplan['texto'];} ?></textarea><br><br>
    <textarea  name="ejercicios" id="ww" placeholder="Ejercicios" requireds><?php if(isset($_REQUEST['ma'])){echo $mplan['ejercicios'];} ?></textarea><br><br>

    <input type="date" name="fe" placeholder="Fecha de entrega" <?php if(isset($_REQUEST['ma'])){ echo "value='".$mplan['fechaentrega']."'";} ?> required><br><br>

    <?php if(isset($_REQUEST['ma'])){ echo "<input type='hidden' name='modificar' value='".$_REQUEST['ma']."'>";} ?>   
    <input type="submit" <?php if(isset($_REQUEST['ma'])){ echo "value='Guardar'";}else{echo "value='Agregar'";} ?>> 

</form>


<?php
if($n>0){
    do{
        echo "<article class='plan'>";
        echo "<h1>".$aplan['titulo']."</h1><br>";
        echo "<a style=' color: blue; margin-right: 10px; font-size: 20px;' href='plan.php?ma=".$aplan['idplan']."'><i class='fa fa-edit'></i></a>";
        echo "<a style=' color: blue; font-size: 20px;' href=\"javascript:preguntar('".$aplan['idplan']."')\"><i class='fa fa-trash'></i></a>";
        echo "<p>".$aplan['texto']."</p";
        echo "<div><h1 style='font-size:20px;'> Ejercicios </h1></div>";
        echo "<p>".$aplan['ejercicios']."</p";
        echo "fecha: ".$aplan['fecha']." fecha de entrega: ".$aplan['fechaentrega']."<br>";
        echo "</article>";

}while($aplan=mysqli_fetch_assoc($queryplan));
}else{
echo "No hay actividades en esta clase";
}

?>



<script>
function preguntar(valor){
eliminar=confirm("Estas de acuerdo de eliminar esta clase");
if(eliminar)
window.location.href="plan.php?ea="+valor;
}
</script>




<?php include('footer.php'); ?>
