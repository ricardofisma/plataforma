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

$estudian=mysqli_query($link,"SELECT * FROM misclases, usuario WHERE misclases.usuario=usuario.email  AND misclases.clave ='".$_SESSION['clave']."'");   
$estudiant=mysqli_fetch_assoc($estudian);
$nm=mysqli_num_rows($estudian);

$nsesion=mysqli_query($link,"SELECT * FROM secciones WHERE clavew ='".$_SESSION['clavew']."'");   
$nsesionw=mysqli_fetch_assoc($nsesion);
$ns=mysqli_num_rows($nsesion);
echo $ns;
?>



<title>Calificaciones</title>

<?php include('first.php'); ?><?php include('margin.php'); ?>

<?php
$con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
$wew=mysqli_fetch_assoc($con);
?>
<article>

<h1 >Calificaciones del curso de <?php echo $wew['nombre']?></h1> 

<?php
if($w['tipo']=='docente'){
    ?>




<div style= "display:flex;width:100%;flex-wrap:wrap;align-items: center;  justify-content: center;">
<?php
if($nm>0){
    do{
        echo "<div style='text-align: center;width:250px;border-radius:10px;position:relative;margin:5px;background-color: rgb(31, 100, 90);box-shadow:0px 0px 2px 0px rgba(0,0,0,.75);'>";
        echo "<div class='wrapper' style='margin:5px auto;' ><img src= 'archivos/".$estudiant['usuario']."".$estudiant['foto']."' onerror=this.src='foto.png'></div>";
        echo "<h1 style='border-radius:0px 0px 0px 0px;margin-bottom:5px;background:rgb(200,255,0);font-size:19px;'>" .$estudiant['nombre']. "</h1>";
        $promedio=mysqli_fetch_assoc(mysqli_query($link,"SELECT sum(evaluacion)/$ns as promedio FROM tareas WHERE clave='".$_SESSION['clave']."' AND usuario='".$estudiant['email']."'"));
      //  echo $promedio['promedio'];
      echo "<h1 style='border-radius:0px 0px 5px 5px;background:rgb(200,0,255);font-size:19px;'>" .round($promedio['promedio'],3). "</h1>";
        echo "</div>";

    }while($estudiant=mysqli_fetch_assoc($estudian));
}else{
    echo "No hay inscritos";
}
}else{
    $cal=mysqli_query($link,"SELECT * FROM secciones WHERE secciones.clave ='".$_SESSION['clave']."'");   
    $acal=mysqli_fetch_assoc($cal);
    $ncal=mysqli_num_rows($cal);
  //  echo $ncal;
 //   echo $_SESSION['clave'];
  //  echo $_SESSION['user']."<br><br><br><br><br>";
    ?>
<table border="1">
<tr>
<th>Número</th>
<th>Tarea</th>
<th>idtarea</th>
<th>Calificacion2</th>
<th>Entregar tarea</th>
</tr>

<?php
if($ncal>0){
    $i=1;
    $suma=0;
    do{
        echo "<tr><td>$".($i)."$</td>";
         echo "<td><button id='".$acal['idseccion']."7'>Ver tarea</button> <div style=display:none; id='".$acal['idseccion']."'>".$acal['tarea']."</div></td>";
        echo "<td>" .$acal['clavew']. "</td>";

               ?>
<script>
var button = document.getElementById('<?php echo $acal['idseccion']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $acal['idseccion']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
        <?php
        
        $not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idplan ='".$acal['idseccion']."'");   
        $notw=mysqli_fetch_assoc($not);
        $nnot=mysqli_num_rows($not);
        if($notw['evaluacion']!=""){
            $j=1;
            echo "<td>\(".$notw['evaluacion']."\)</td>";
            $j++;
            $suma+=$notw['evaluacion'];
        }elseif($nnot>0){ 
            echo "<td style='color:rgb(200,0,100);'>Tarea aún no evaluada</td>";
            echo "<td><a style='text-decoration:none;color:rgb(255,100,100);' href='sesion.php?claveww=".$acal['idseccion']."'>Modificar</a></td></tr>";
        }else{
            echo "<td>Tarea no entregada</td>";
            echo "<td><a style='text-decoration:none;color:rgb(10,105,10)' href='sesion.php?claveww=".$acal['idseccion']."'>Entregar</a></td></tr>";
        }

        // if($acal['evaluacion']!=""){
        //    echo "<td>" .$acal['evaluacion']. "</td></tr>";
        //   $i++;
        //  $suma+=$acal['evaluacion'];
        // }else{
        //    echo "<tr><td> No evaluada</td></tr>";
        // }
       $i++;
    }while($acal=mysqli_fetch_assoc($cal));
echo "<tr><td colspan=3> Promedio: \(\\frac{".$suma."}{".($i-1)."}=".round($suma/($i-1),3)."\)</td></tr>";
}else{
    echo "<tr><td colspan=3>No hay tareas entregadas</td></tr>";
}
?>
<div>

<?php 
}
?>
</table>



<?php include "footer.php"; ?>
