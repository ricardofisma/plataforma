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

  if(isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])){
    $_SESSION['clave']=$_REQUEST['clave'];
  }

//echo $_SESSION['clave'];


?>

<script type="text/javascript"
src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({ "fast-preview": {disabled:true},TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {preview: "none", inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>





<?php


$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

$queryarchivos=mysqli_query($link,"SELECT * FROM archivos WHERE clave='".$_SESSION['clave']."'");
$numarchivos=mysqli_num_rows($queryarchivos);
$todoslosarchivo=mysqli_fetch_assoc($queryarchivos);

//   echo "<article>";
echo "<div style= 'display:flex;width:100%;flex-wrap:wrap;align-items: center;justify-content:center;font-size:15px'>";
echo "<div style='margin:auto;width:90%;background:rgb(20,50,5);padding:5px;text-align:center;color:white;border-radius:5px;'>ARCHIVOS DEL CURSO</div>";
if($numarchivos>0){
    do{
        echo "<div style='text-align: center;background:rgb(70,100,100);width:280px;border-radius:10px;position:relative;margin:5px;box-shadow:0px 0px 5px 0px rgba(0,0,0,.75);'>";
 //   echo "<h1> ".$todoslosarchivo['idarchivo']." </h1>";
    echo "<p style='text-align:center;color:white;'> ".$todoslosarchivo['nombre']." </p>";
    echo "<p> ".$todoslosarchivo['tipo']."</p>";
    echo "<p> ".round($todoslosarchivo['tamanio']/1024,3)." KB </p>";
    echo "<p><a style='text-decoration:none;color:white;' target='_blank' href='archivosclase/".$todoslosarchivo['idarchivo'].$todoslosarchivo['nombre']."' > Ver </a></p>";
    if($w['tipo']=='docente'){  
    echo "<button style='margin:5px;border:none;border-radius:5px;' id='deletearchivos' data-ff='".$todoslosarchivo['idarchivo']."' data-name='".$todoslosarchivo['nombre']."'> Eliminar </button>";
    }
    echo "</div>"; 
}while($todoslosarchivo=mysqli_fetch_assoc($queryarchivos));
}else{
  echo "<br>No hay archivos del curso";
}

echo "</div>";
echo "<input id='imagew' type='file' style='display:none'></input>";  
    if($w['tipo']=='docente'){  

      echo "<a style='cursor:pointer;background:rgb(155,155,255);padding:5px;border-radius:5px;margin:5px auto;display:block;width:300px;text-align:center;' onclick='fileUpload()'>Cargar archivos </a>";
    }
      ?>
<script>
function fileUpload() {
    $("#imagew").click();
}
</script>

    <?php

//echo "</article>";


$con=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con);

$conw=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
$nw=mysqli_num_rows($conw);
$ww=mysqli_fetch_assoc($conw);


$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);
?>







  
  <style>
    .icon-up:before {
    content: "\25B2";
}

.icon-ff:before {
    content: "\21D5";
  }
</style>



  <?php
$conw=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
$nw=mysqli_num_rows($conw);
$ww=mysqli_fetch_assoc($conw);

echo "<div style='margin:auto;width:90%;background:rgb(20,50,5);padding:5px;text-align:center;color:white;border-radius:5px;'>CONTENIDO DEL CURSO</div>";

if($nw>0){
  $i=1;
  do{
    echo "<article style='margin:10px auto;padding:5px;background:rgb(100,200,200);'>";
    if($w['tipo']=='docente'){  
      echo "<button style='border:none;border-radius:5px;padding:5px;;cursor:pointer' id='deletew' data-idw='".$ww['idcapitulo']."'><span class='fa fa-trash'></span></button>";
      
      echo "<button id='".$i.$i.$i.$i.$i.$i.$i.$i."w' style='border:none;padding:5px;background:rgb(50,100,50);border-radius:5px;text-align:left;color:rgb(255,255,255);cursor:pointer;'>Capitulo ".$i.": </button>
      <input style='display:inline-block;background:rgb(255,255,255);padding:5px;border:none;width:350px;' id='cpt' data-c1 = '".$ww['idcapitulo']."' contenteditable value='".$ww['nombre']."'</input>";
    }
    echo "<a href='examen.php?idcapitulo=".$ww['idcapitulo']."&cap=".$i."' style='float:right;text-align:center;width:100px;border-radius:3px;background:rgb(20,7,20);border:none;cursor:pointer;text-decoration:none;color:white;padding:3px;'>Examen ".($i)."</a>";
    echo "<button id='".$i.$i.$i.$i.$i.$i.$i.$i."w' style='border:none;padding:5px;background:rgb(50,100,50);border-radius:5px;text-align:left;color:rgb(255,255,255);cursor:pointer;'>Capitulo ".$i.": ".$ww['nombre']." <span class='icon-ff'></span></button>";
  
    echo "<div style='display:;' id='".$i.$i.$i.$i.$i.$i.$i.$i."z'>";
    
    ?>     
<script>
  var button = document.getElementById('<?php echo $i.$i.$i.$i.$i.$i.$i.$i."w"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $i.$i.$i.$i.$i.$i.$i.$i."z"?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
      }
      else {
        div.style.display = 'block';
      }
    };
  </script>
        <?php
    if($w['tipo']=='docente'){  
      echo "<textarea style='background:rgb(200,155,100);color:black;border-radius:5px;padding:5px;cursor:pointer' id='cc1' data-c1 = '".$ww['idcapitulo']."' contenteditable>".$ww['descripcion']."</textarea>";
    }
    echo "<div style='background:rgb(200,255,250);border-radius:5px;margin:3px;padding:5px'>".$ww['descripcion']."</div>";
    
    $i++;
    
    $conw1=mysqli_query($link,"SELECT * FROM secciones WHERE clavew='".$ww['idcapitulo']."'");
    $ww1=mysqli_fetch_assoc($conw1);
    $nw1=mysqli_num_rows($conw1);
      
      
      if($nw1>0){
  $j=1;
  do{
    echo "<article style='margin:10px 0px 10px;width:100%;border-radius:10px;padding:3px'>";                                                                                                                             //ww      
    if($w['tipo']=='docente'){  
      echo "<button style='border:none;border-radius:5px;padding:5px;;cursor:pointer;background:rgb(200,25,20);' id='deleteww' data-idw='".$ww1['idseccion']."'><span class='fa fa-trash'></span></button>";

      echo "<button id='".$ww1['idseccion']."7' style='margin-left:35px;border:none;padding:5px;background:rgb(110,100,100);margin:1px;border-radius:5px; text-align:left;color:rgb(255,255,255);cursor:pointer;'>Sección ".$j.":
      <div style='display:inline-block;background:rgb(10,100,80);color:white;;padding:5px;border-radius:5px;' id='wsec' data-c1 = '".$ww1['idseccion']."' contenteditable>".$ww1['nombre']."</div></button>";
    }
    echo "<button id='".$ww1['idseccion']."7' style='margin-left:35px;border:none;padding:5px;background:rgb(110,100,100);margin:1px;border-radius:5px; text-align:left;color:rgb(255,255,255);cursor:pointer;'>Sección ".$j.": ".$ww1['nombre']."
<span class='icon-ff'></span></button><br>";

echo "<div style='display:;' id='".$ww1['idseccion']."'>"; 

  ?>     
<script>
var button = document.getElementById('<?php echo $ww1['idseccion']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $ww1['idseccion']?>');
    var divw = document.getElementById('<?php echo $ww1['idseccion']?>"77"');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
      }
      else {
        div.style.display = 'block';
        divw.style.display = 'none';
    }
  };
</script>
<script>
  function getDocHeight(doc) {
    doc = doc || document;
    // stackoverflow.com/questions/1145850/
    var body = doc.body, html = doc.documentElement;
    var height = Math.max( body.scrollHeight, body.offsetHeight, 
    html.clientHeight, html.scrollHeight, html.offsetHeight );
    return height;
}

function setIframeHeight(id) {
  var ifrm = document.getElementById(id);
    var doc = ifrm.contentDocument? ifrm.contentDocument: 
        ifrm.contentWindow.document;
    ifrm.style.visibility = 'hidden';
    ifrm.style.height = "10px"; // reset to minimal height ...
    // IE opt. for bing/msn needs a bit added or scrollbar appears
    ifrm.style.height = getDocHeight( doc ) + 4 + "px";
    ifrm.style.visibility = 'visible';
  }
</script>
        <?php
//         echo "<a style='cursor: pointer;;text-decoration: none;color:white;' href='secciones.php?clavew=".$ww['idcapitulo']."&clave=".$_SESSION['clave']."'>Agregar seccion".$a['idcapitulo']."</a>" ;
         if($w['tipo']=='docente'){  
           echo "<textarea style='margin:auto;width:100%;background:rgb(20,70,25);color:white;padding:5px' id='wtexto' data-c1 = '".$ww1['idseccion']."' contenteditable>".$ww1['texto']."</textarea>";
    }
         echo "<div style='margin:auto;width:99%;background:rgb(200,70,250);padding:5px;border-radius:5px;'>".$ww1['texto']."</div>";
         echo "<div style='margin:auto;width:200px;background:rgb(200,0,5);padding:5px;text-align:center;border-radius:3px;'>Tarea</div>";
if($w['tipo']=='docente'){  
  echo "<textarea style='margin:auto;width:100%;background:rgb(25,25,255);color:white;padding:5px;' id='sec_tarea' data-c1 = '".$ww1['idseccion']."' contenteditable>".$ww1['tarea']."</textarea>";
}
echo "<div style='margin:auto;width:99%;background:rgb(255,255,255);padding:5px;border-radius:5px;'>".$ww1['tarea']."</div>";
echo "<div style='margin:auto;width:90%;background:rgb(100,100,200);margin-bottom:5px;padding:5px;'>";
$not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idplan ='".$ww1['idseccion']."'");   
$notw=mysqli_fetch_assoc($not);
$nnot=mysqli_num_rows($not);

if($notw['evaluacion']!=""){
  echo "Calificación: ".$notw['evaluacion'];
        }elseif($nnot>0){ 
          echo "Tarea aún no evaluada - ";
          echo "<a style='text-decoration:none;color:rgb(255,100,100);' href='sesion.php?claveww=".$ww1['idseccion']."'>Modificar</a>";
        }else{
          echo "Tarea no entregada - ";
          echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='sesion.php?claveww=".$ww1['idseccion']."'>Entregar</a>";
        }
        echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='calificaciones.php'> - Resumen del  curso</a>";
        
        echo "</div>";
        echo "</div>";
        echo "</article>";                                                                                                                    //ww     
        
        //     echo "<div style='margin:auto;width:80%;background:rgb(10,100,100)'>" .$ww1['idseccion']. "</div>";
        $j++;
        
      }while($ww1=mysqli_fetch_assoc($conw1));  

    }else{
      echo "<tr><td> No hay secciones creadas</td></tr>";
    }
    if($w['tipo']=='docente'){  
    echo "<div ><button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;' id='addsecciones' data-c1 = '".$ww['idcapitulo']."'>Agregar sección</button></div>";
  }
  echo "</div>";
  echo "</article>";
  
}while($ww=mysqli_fetch_assoc($conw));  
}else{
  echo "<br><div style='text-align:center;'>No hay contenido creado</div>";
}

if($w['tipo']=='docente'){  
  
  echo "<article style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;'>";
  echo "<div ><button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;cursor:pointer;' id='addcapitulos'>Agregar capítulo</button></div>";
  echo "</article>"; 

  
}



$clase=mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_SESSION['clave']."'")     ;
$clasew=mysqli_fetch_assoc($clase);
//if($w['tipo']=='docente'){  
  echo "<br><div style='text-align:center;'>Adicione tarea del curso</div>";
echo "<textarea style='display:block;margin:auto;width:90%;background:rgb(255,225,255);padding:5px;' id='sec_tarea' data-c1 = '".$clasew['tarea']."' contenteditable>".$clasew['tarea']."</textarea>";
//}else{
echo "<div style='display:block;margin:auto;width:90%;background:rgb(255,225,255);padding:5px;'>".$clasew['tarea']."</div>";
  echo "<br><div style='text-align:center;'>Adicione su tarea del curso</div>";
echo "<textarea style='display:block;margin:auto;width:90%;background:rgb(255,225,255);padding:5px;' id='sec_tarea' data-c1 = '".$clasew['tarea']."' contenteditable>".$clasew['tarea']."</textarea>";

    echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='examen.php'><div style='margin:5px auto;border-radius:5px;width:200px;background:rgb(255,10,70);margin-bottom:5px;padding:5px;text-align:center;'>Examen general</div></a>";

//<li>  <a href="examen.php"><span class="fa fa-users icon-menu"></span>Examen y tarea</a></li>
//}
?>
