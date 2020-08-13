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

?>

<title>Inicio</title>

<?php

//if(isset($_REQUEST['e'])){
//mysqli_query($link, "DELETE FROM secciones WHERE idseccion=".$_REQUEST['e']);
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['calvew']."'");
//
//}
//
$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);
?>



<article>

  <?php

//echo $_SESSION['clavew'];
$conw1=mysqli_query($link,"SELECT * FROM secciones WHERE clavew='".$_SESSION['clavew']."'");
$ww1=mysqli_fetch_assoc($conw1);
$nw1=mysqli_num_rows($conw1);

      
  if($nw1>0){
  $j=1;
  do{
    echo "<button style='border:none;border-radius:5px;padding:5px;cursor:pointer' id='deletew' data-idw='".$ww1['idseccion']."'><span class='fa fa-trash'></span></button>";
    echo "<button id='".$ww1['idseccion']."7' style='margin-left:35px;border:none;padding:5px;background:rgb(110,100,100);margin:1px;border-radius:5px;color:rgb(255,255,255);cursor:pointer;display:inline-block;'>Sección ".$j.":</button>";
    echo "<div style='display:inline-block;background:rgb(10,100,80);color:white;;padding:5px;border-radius:5px;' id='www' data-wwt = '".$ww1['idseccion']."' contenteditable>".$ww1['nombre']."</div><br>";
    echo "<div style='display:;' id='".$ww1['idseccion']."'>";
  ?>     
<script>
var button = document.getElementById('<?php echo $ww1['idseccion']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $ww1['idseccion']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
        <?php
echo "<div style='margin:auto;width:90%;background:rgb(200,50,25);padding:5px' id='rrr' data-wwtexto = '".$ww1['idseccion']."' contenteditable>".$ww1['texto']."</div>";
echo "<div style='margin:auto;width:90%;background:rgb(200,100,5);padding:5px'>Tareas</div>";
echo "<div style='margin:auto;width:90%;background:rgb(255,255,255);padding:5px;' id='sec_tarea' data-c1www = '".$ww1['idseccion']."' contenteditable>".$ww1['tarea']."</div>";
   echo "<div style='margin:auto;width:85%;background:rgb(100,100,100);margin-bottom:5px;padding:5px;'>";
    $not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idplan ='".$ww1['idseccion']."'");   
        $notw=mysqli_fetch_assoc($not);
        $nnot=mysqli_num_rows($not);

        if($notw['evaluacion']!=""){
          echo "Calificación: \(".$notw['evaluacion']."\)";
        }elseif($nnot>0){ 
            echo "Tarea aún no evaluada - ";
            echo "<a style='text-decoration:none;color:rgb(255,100,100);' href='sesion.php?claveww=".$ww1['idseccion']."'>Modificar</a>";
        }else{
          echo "Tarea no entregada - ";
            echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='sesion.php?claveww=".$ww1['idseccion']."'>Entregar</a>";
        }
        echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='calificaciones.php'> - Resumen de ".$ww1['idseccion']."</a>";
        
        echo "</div>";
        echo "</div>";

        $j++;
      
    }while($ww1=mysqli_fetch_assoc($conw1));  
  }else{
    echo "<tr><td> No hay secciones creadas</td></tr>";
  }
  
  echo "</div>";
    echo "</article>";
  

?>




</article>





