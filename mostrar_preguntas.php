<script type="text/javascript"
src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>

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


//echo $_SESSION['clave'];
//echo $_SESSION['clavew'];



//echo $ww['idpregunta'];

$conww1=mysqli_query($link,"SELECT * FROM preguntas");
$www=mysqli_fetch_assoc($conww1);
$nww1=mysqli_num_rows($conww1);

  if($nww1>0){
  //$j=1;
    
    do{
      echo "<div style='background:rgb(250,200,100);border-radius:5px;margin:3px;padding:5px;' id='cww' data-altwww='".$www['idalternativa']."' contenteditable>".$www['alternativa']."</div>";
  //$j++;
    }while($www=mysqli_fetch_assoc($conww1));  
  }else{
    echo "No hay aún alternativas";
  }
  
  

echo "<div style='background:rgb(100,10,100);padding:5px;border-radius:5px;'>";
echo  "<div style='background:rgb(225,220,210);border:none;border-radius:5px;padding:5px;margin:5px;' placeholder='Escriba su pregunta' id='clavepregunta' contenteditable></div>";
echo  "<div><button id='addw' data-idpreg='".$_SESSION['clavew']."'>Agregar alternativa</button></div>";
echo "</div>";

echo "</div>";


?>
