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


//   echo $_SESSION['idcpt']."--";
//   echo $_SESSION['idsec'];
?>

<title>Inicio</title>

<?php

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

?>


<script type="text/javascript"
src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({ "fast-preview": {disabled:true},TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {preview: "none", inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>



<link rel="stylesheet" href="./richtext.min.css">
<script type="text/javascript" src="./jquery.richtext.js"></script>


<article>
  <?php



//refresh seccion
if(isset($_REQUEST['texto'])){
  $id=$_POST['id'];
$texto=$_POST['texto'];
$texto = mysqli_real_escape_string($link, $texto); 
$columna=$_POST['columna'];
$consulta=mysqli_query($link,"UPDATE secciones SET $columna='$texto' WHERE idseccion =$id");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok seccionww refresh";
}
}


$conw1=mysqli_query($link,"SELECT * FROM secciones WHERE clavew='".$_SESSION['idsec']."' AND idseccion='".$_SESSION['idcpt']."'");
$ww1=mysqli_fetch_assoc($conw1);
$nw1=mysqli_num_rows($conw1);

//   echo "<button style='margin-left:35px;border:none;padding:5px;background:rgb(110,100,100);margin:1px;border-radius:5px;color:rgb(255,255,255);cursor:pointer;display:inline-block;'>Sección 1</button>";

echo "<div style='display:inline-block;background:rgb(10,100,80);color:white;;padding:5px;border-radius:5px;' id='w77777' data-fff = '".$ww1['idseccion']."' contenteditable>".$ww1['nombre']."</div>";

echo "<textarea style='margin:auto;width:90%;background:rgb(200,50,25);padding:5px' id='rrr' data-wwtexto = '".$ww1['idseccion']."' contenteditable>".$ww1['texto']."</textarea>";

echo "<div style='margin:auto;width:85%;margin-bottom:5px;padding:5px;text-align:center;'></div>";
echo "<div style='margin:auto;width:85%;margin-bottom:5px;padding:5px;text-align:center;'>Tarea</div>";
echo "<textarea style='margin:auto;width:90%;background:rgb(255,255,255);padding:5px;' id='r777' data-www77 = '".$ww1['idseccion']."' contenteditable>".$ww1['tarea']."</textarea>";



$not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idseccion ='".$ww1['idseccion']."'");   
$notw=mysqli_fetch_assoc($not);
$nnot=mysqli_num_rows($not);

echo "<div style='margin:auto;width:85%;background:rgb(100,100,100);margin-bottom:5px;padding:5px;'>";//////////////////////////////////////////////////////////////////////////////////////////////////////
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
        
        echo "</div>";///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        ?>
        </article>

     <script>
        $(document).ready(function() {
          $('#rrr').richText();
        });
        </script> 


     <script>
        $(document).ready(function() {
          $('#r777').richText();
        });
        </script> 
