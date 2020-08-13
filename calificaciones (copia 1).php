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












// echo $_SESSION['clave'];

$estudian=mysqli_query($link,"SELECT * FROM misclases, usuario WHERE misclases.usuario=usuario.email  AND misclases.clave ='".$_SESSION['clave']."'");   
$estudiant=mysqli_fetch_assoc($estudian);
$nm=mysqli_num_rows($estudian);

$nsesion=mysqli_query($link,"SELECT * FROM secciones WHERE clavew ='".$_SESSION['clavew']."'");   
$nsesionw=mysqli_fetch_assoc($nsesion);
$ns=mysqli_num_rows($nsesion);
//  echo $ns;
?>





<script src="jquery-3.0.0.min.js"></script>
<script>
$(document).ready(function(){
function mostrar_datos(){
$.ajax({
url:"calificacionesajax.php",
method:"POST", 
success:function(data){
  $("#resultado").html(data)
}
})
}
mostrar_datos();


//INSERTAR y actualizar DATOS respuestas escrita
$(document).on("blur", "#fff", function(){
var user=$(this).data("user");
var clavepregunta=$(this).data("fffff");
var x3=$(this).text();
//alert(clavepregunta);
$.ajax({
url:"sendrespuestas.php",
method:"post",
data:{clavepregw:clavepregunta,xww:x3,userww: user},
success:function(data){
mostrar_datos();
//alert(data);
}
})
})


});
</script>

<article style="background:rgb(0,150,150);">
<div id ="resultado"></div>
</article>



<title>Calificaciones</title>

<?php include('first.php'); ?><?php include('margin.php'); ?>





<?php



if(isset($_REQUEST['notas'])){
    $id = $_REQUEST['id'];
    $est = $_REQUEST['est'];
    $nota = $_REQUEST['nota'];
    mysqli_query($link, "UPDATE  tareas SET evaluacion='$nota' WHERE idplan='$id' AND usuario='$est'");
}            

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
        echo "<table border='1'>";
echo "<tr text-align:center>";
echo "<th colspan=6>";

echo "<div  class='imagen' style='text-align: center;width:250px;border-radius:10px;position:relative;margin:5px;background-color: rgb(31, 100, 90);box-shadow:0px 0px 2px 0px rgba(0,0,0,.75);'>";
        echo "<div class='wrapper' style='margin:5px auto;' ><img src= 'archivos/".$estudiant['usuario']."".$estudiant['foto']."' onerror=this.src='foto.png'></div>";
        echo "<h1 style='border-radius:0px 0px 10px 10px;margin-bottom:5px;background:rgb(250,255,255);font-size:19px;'>" .$estudiant['nombre']. "</h1>";

$rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM  examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$estudiant['email']."')");
$row = mysqli_fetch_assoc($rw); 
$sum = $row['sum'];
  
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['email']."'");
$roww = mysqli_fetch_assoc($rww); 
$sumw = $roww['sumw'];
$ggg=$sumw+$sum;
//echo $_SESSION['clave'];
echo "Escrito: ".$sumw."--";
echo "Alternativas: ".$sum;
echo "<div style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(100,100,100);'><p>Total ".$ggg." puntos </p></div>";

$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['email']."'");
$escritow = mysqli_fetch_assoc($escrito); 
$nescr=mysqli_num_rows($escrito);
if ($nescr>0) {
do{
echo "<div style='background:rgb(11,14,225) ;margin:5px; padding:5px;'>".$escritow['respuesta']."".$escritow['idrespuestas']."</div>";
echo "<div style='display:inline-block;cursor:pointer;'><span id='cccnota' data-c2='".$escritow['idrespuestas']."' contenteditable>".$escritow['escritanota']."</span>   Puntos</div>";
}while($escritow = mysqli_fetch_assoc($escrito));
}else{ 
    echo "No hay preguntas escritas";
    }

        // echo "<h1 style='border-radius:0px 0px 0px 0px;margin-bottom:5px;background:rgb(250,255,250);font-size:19px;'>" .$estudiant['email']. "</h1>";
       // $promedio=mysqli_fetch_assoc(mysqli_query($link,"SELECT sum(evaluacion)/$ns as promedio FROM tareas WHERE clave='".$_SESSION['clave']."' AND usuario='".$estudiant['email']."'"));
      //  echo $promedio['promedio'];
      //echo "<h1 style='border-radius:0px 0px 5px 5px;background:rgb(200,0,255);font-size:19px;'>" .round($promedio['promedio'],3). "</h1>";
        echo "</div>";
        
echo "</th>";
echo "</tr>";



$cal=mysqli_query($link,"SELECT * FROM secciones WHERE clave ='".$_SESSION['clave']."'");   
$acal=mysqli_fetch_assoc($cal);
$ncal=mysqli_num_rows($cal);
  //  echo $ncal;
 //   echo $_SESSION['clave'];
  //  echo $_SESSION['user']."<br><br><br><br><br>";
    ?>

<th colspan=6><?php echo $estudiant['nombre']?></th>
</tr>

<tr>
<th>$\text{N}^\circ$</th>
<th>Tarea</th>
<!--
<th>idtarea</th>
-->
<th>Tarea</th>
<th>Evaluación</th>
<th>Entregada</th>
</tr>

<?php
if($ncal>0){
    $i=1;
    $suma=0;
    do{
        echo "<tr><td>$".($i)."$</td>";
         echo "<td><button id='".$acal['idseccion'].$estudiant['email']."7'>Tarea</button> <div style=display:none; id='".$acal['idseccion'].$estudiant['email']."'>".$acal['tarea']."</div></td>";
//        echo "<td>" .$acal['idseccion']. "</td>";

?>
<script>
var button = document.getElementById('<?php echo $acal['idseccion'].$estudiant['email']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $acal['idseccion'].$estudiant['email']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
<?php
        
        $not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$estudiant['email']."' AND idplan ='".$acal['idseccion']."'");   
        $notw=mysqli_fetch_assoc($not);
        $nnot=mysqli_num_rows($not);
        if($notw['evaluacion']!=""){
            $j=1;
            echo "<td>\(".$notw['evaluacion']."\)</td>";
                      echo "<td>";
            
            echo "<form action='calificaciones.php?id=".$acal['idseccion']."&est=".$estudiant['email']."' method='post'>";
            echo "<input style='width:38px' type='text' name='nota' placeholder='nota' required>";
            echo "<input type='submit' value='Actualizar' name='notas'>";
            echo "</form>";

            echo "</td>";
            $j++;
            $suma+=$notw['evaluacion'];

            
echo "<td><button id='".$i."w'>Ver</button> <div style=display:none; id='".$i."ww'>".$notw['texto']."</div></td>";
?>
<script>
var button = document.getElementById('<?php echo $i."w"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $i."ww"?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
<?php
       


        }elseif($nnot>0){ 
            echo "<td style='color:rgb(200,0,100);'>No evaluada</td>";
            
            echo "<td>";
            
echo "<form action='calificaciones.php?id=".$acal['idseccion']."&est=".$estudiant['email']."' method='post'>";
echo "<input style='width:38px' type='text' name='nota' placeholder='nota' required>";
echo "<input type='submit' value='calificar' name='notas'>";
echo "</form>";

echo "<td><button id='".$i."z'>Ver</button> <div style=display:none; id='".$i."zz'>".$notw['texto']."</div></td>";
?>
<script>
var button = document.getElementById('<?php echo $i."z"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $i."zz"?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
<?php
       


echo "</td></tr>";


        }else{
            echo "<td>No entregada</td>";
            //echo "<td><a style='text-decoration:none;color:rgb(10,105,10)' href='sesion.php?claveww=".$acal['idseccion']."'>Entregar</a></td></tr>";
        }


       $i++;
    }while($acal=mysqli_fetch_assoc($cal));
echo "<tr><td colspan=3> Promedio: \(\\frac{".$suma."}{".($i-1)."}=".round($suma/($i-1),3)."\)</td></tr>";
}else{
    echo "<tr><td colspan=3>No hay tareas entregadas</td></tr>";
}
?>


<?php

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
