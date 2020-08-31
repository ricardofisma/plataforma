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


date_default_timezone_set("America/Lima");
function get_format($df){
    $str = '';
    $str .= ($df->invert == 1) ? '  ' : '';
    if ($df->y > 0) {
        $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
    } if ($df->m > 0) {
        $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
    } if ($df->d > 0) {
        $str .= ($df->d > 1) ? $df->d . ' Dias ' : $df->d . ' Dia ';
    } if ($df->h > 0) {
        $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
    } if ($df->i > 0) {
        $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
    } if ($df->s > 0) {
        $str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
    }
    echo $str;
}

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



<?php


$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

$queryarchivos=mysqli_query($link,"SELECT * FROM archivos WHERE clave='".$_SESSION['clave']."'");
$numarchivos=mysqli_num_rows($queryarchivos);
$todoslosarchivo=mysqli_fetch_assoc($queryarchivos);

//   echo "<article>";
echo "<div style= 'display:flex;width:100%;flex-wrap:wrap;align-items: center;justify-content:center;font-size:15px'>";
echo "<div style='margin:auto;width:90%;padding:5px;text-align:center;border-radius:5px;font-size:2em;'>ARCHIVOS DEL CURSO</div>";
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

echo "<div style='margin:auto;width:90%;padding:5px;text-align:center;border-radius:5px;margin-top:1em;font-size:2em'>CONTENIDO DEL CURSO</div>";

if($nw>0){
  $i=1;
  do{
    echo "<article style='margin-bottom:50px;padding:5px;'>";
    if($w['tipo']=='docente'){  
      echo "<button style='border:none;border-radius:5px;padding:5px;;cursor:pointer' id='deletew' data-idw='".$ww['idcapitulo']."'><span class='fa fa-trash'></span></button>";
      
      echo "<button id='".$i.$i.$i.$i.$i.$i.$i.$i."w' style='border:none;padding:5px;border-radius:5px;text-align:left;cursor:pointer;'>Capitulo ".$i.": </button>
      <input style='display:inline-block;background:rgb(255,255,255);padding:5px;border:none;width:350px;' id='cpt' data-c1 = '".$ww['idcapitulo']."' contenteditable value='".$ww['nombre']."'</input>";
    }
    $capitulo=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."' AND idcapitulo='".$ww['idcapitulo']."'");
    $capitulow=mysqli_fetch_assoc($capitulo);

        if($w['tipo']=='docente'){  
    echo "<a href='examen.php?idcapitulo=".$ww['idcapitulo']."&cap=".$i."' style='float:right;text-align:center;width:100px;border-radius:3px;background:rgb(90,7,255);border:none;cursor:pointer;text-decoration:none;color:white;padding:2px;'>Examen ".($i)."</a>";
        }else{
          echo "<a href='examen.php?idcapitulo=".$ww['idcapitulo']."&cap=".$i."' class='".$i."' style='float:right;text-align:center;border-radius:3px;background:rgb(90,7,255);border:none;cursor:pointer;text-decoration:none;color:white;padding:3px;'>Examen ".($i)." (Duración: ".$capitulow['timex'].")</a>";
        }

?>
<script type="text/javascript">
    $('.<?php echo$i?>').on('click', function () {
        return confirm('Está seguro de dar el examen?, este examen culmina en  <?php echo date('H', strtotime($capitulow['timex']))?> horas y <?php echo date('i', strtotime($capitulow['timex']))?> minutos');
    });
</script>
<?php



 if($w['tipo']=='docente'){  
   echo "<div style='float:right;text-align:center;;border-radius:2px;background:rgb(80,250,255);border:none;padding:2px;'>Tiempo de examen: <input style='border:none ' type=time id='ext' data-tt='".$ww['idcapitulo']."' value='".$capitulow['timex']."'></div>";
 }
    echo "<button id='".$i.$i.$i.$i.$i.$i.$i.$i."w' style='border:none;padding:5px;background:rgb(10,100,100);color:white;border-radius:5px;text-align:left;cursor:pointer;'>Capitulo ".$i.": ".$ww['nombre']." <span class='icon-ff'></span></button>";
  
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
 
      echo "<textarea  style='background:rgb(200,255,100);color:black;border-radius:5px;padding:5px;cursor:pointer;color:black;border:none;height:50px;' id='cc1' data-c1 = '".$ww['idcapitulo']."' contenteditable>".$ww['descripcion']."</textarea>";
    }
    echo "<div style='background:rgb(200,255,250);border-radius:5px;padding:5px'>".$ww['descripcion']."</div>";
    
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

      echo "<button id='".$ww1['idseccion']."7' style='margin-left:35px;border:none;padding:5px;margin:1px;border-radius:5px; text-align:left;cursor:pointer;'>Sección ".$j.":
      <div style='display:inline-block;background:rgb(10,100,80);color:white;;padding:5px;border-radius:5px;' id='wsec' data-c1 = '".$ww1['idseccion']."' contenteditable>".$ww1['nombre']."</div></button>";
      echo "<a id='".$ww1['idseccion']."7' href='secciones.php?clavezz=".$ww1['idseccion']."&clavez=".$ww['idcapitulo']."' style='float:right; margin-left:35px;border:none;padding:5px;background:rgb(210,250,250);margin:1px;border-radius:5px;  text-align:left;cursor:pointer;'>
      Editar la sección ".$j."--".$ww['idcapitulo']."</a>";
    }
    echo "<button id='".$ww1['idseccion']."7' style='display:block;margin:auto;border:none;padding:5px;background:rgb(200,150,210);border-radius:5px 5px 0px 0px; text-align:center;cursor:pointer;'>Sección ".$j.": ".$ww1['nombre']."
    <span class='icon-ff'></span></button>";

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
        $(document).ready(function() {
            $('.<?php echo $ww1['idseccion']?>').richText();
        });
        </script>


        <script>
        $(document).ready(function() {
            $('.<?php echo $ww1['idseccion'].$ww1['idseccion']?>').richText();
        });
        </script>

        <?php

//         echo "<a style='cursor: pointer;;text-decoration: none;color:white;' href='secciones.php?clavew=".$ww['idcapitulo']."&clave=".$_SESSION['clave']."'>Agregar seccion".$a['idcapitulo']."</a>" ;
         if($w['tipo']=='docente'){  
//           echo "<textarea  class='".$ww1['idseccion']."' style='margin:auto;width:100%;background:rgb(20,70,25);color:white;padding:5px;color:white;border:none;' id='wtexto' data-c1 = '".$ww1['idseccion']."' contenteditable>".$ww1['texto']."</textarea>";
    }
         echo "<div style='margin:auto;width:99%;background:rgb(200,200,250);padding:5px;border-radius:5px;'>".$ww1['texto']."</div>";
         echo "<div style='margin:auto;width:300px;border:.05em solid;;padding:1px;text-align:center;border-radius:10px 10px 0px 0px;margin-top:50px;'>Tarea de la sección ".$j." del capitulo ".$i."</div>";
if($w['tipo']=='docente'){  
//  echo "<textarea class='".$ww1['idseccion'].$ww1['idseccion']."' style='border:none;border-radius:3px;margin:auto;width:100%;background:rgb(215,210,255);color:black;padding:5px;' id='sec_tarea' data-c1 = '".$ww1['idseccion']."' contenteditable>".$ww1['tarea']."</textarea>";
}
echo "<div style='margin:auto;width:99%;background:rgb(255,215,215);padding:5px;border-radius:5px;'>".$ww1['tarea']."</div>";
echo "<div style='margin:auto;width:90%;border:.05em solid;margin-bottom:5px;padding:5px;border-radius:0px 0px 10px 10px;text-align:center;'>";
$not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idseccion ='".$ww1['idseccion']."'  AND clave ='".$_SESSION['clave']."'");   
$notw=mysqli_fetch_assoc($not);
$nnot=mysqli_num_rows($not);
 if($w['tipo']=='docente'){  
echo "Fecha de entrega: <input type='datetime' name='ff' id='time' value='".$ww1['time']."' data-ttt='".$ww1['idseccion']."'><br>";
 }
if($notw['evaluacion']!=""){
  echo "Calificación: ".$notw['evaluacion'];
        }elseif($nnot>0){ 
          echo "Tarea aún no evaluada - ";
          echo "<a style='text-decoration:none;color:rgb(255,100,100);' href='sendtarea.php?idcpt=".$ww['idcapitulo']."&idsec=".$ww1['idseccion']."'>Modificar</a>";
        }else{
          echo "Tarea no entregada - ";

          $strStart = $ww1['time'];
          $datew = new DateTime($strStart);
          $dateww = new DateTime("now");
          
          //echo date_format($dateww, 'd-m-Y H:i:s')."<br>";
          
          if ($datew > $dateww){
            echo "<a style='text-decoration:none;color:rgb(25,25,255)' href='sendtarea.php?idcpt=".$ww['idcapitulo']."&idsec=".$ww1['idseccion']."'>Entregar hasta: ".date_format($datew, 'd-m-Y H:i:s').". Faltan: </a>";
            echo "<a style='text-decoration:none;color:rgb(25,25,255)' href='sendtarea.php?idcpt=".$ww['idcapitulo']."&idsec=".$ww1['idseccion']."'>".get_format( $datew->diff($dateww))."</a>";

}else{
echo "Culminó el periodo de entrega hace ";
echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='sendtarea.php?idcpt=".$ww['idcapitulo']."&idsec=".$ww1['idseccion']."'>".get_format( $datew->diff($dateww))."</a>";
            
}
        }
        echo "<a style='text-decoration:none;color:rgb(255,90,255)' href='calificaciones.php'> - Tus calificaciones</a>";
        
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
if($w['tipo']=='docente'){  
  echo "<br><div style='text-align:center;'>Adicione tarea del curso</div>";
echo "<textarea style='display:block;margin:auto;width:90%;background:rgb(210,215,215);padding:5px;color:black;border:none;' id='clase' data-c1 = '".$clasew['idclase']."' contenteditable>".$clasew['tarea']."</textarea>";
       
   echo "<div style='text-align:center;width:500px;border-radius:3px;background:rgb(20,90,20);border:none;color:white;padding:2px;margin:auto;'>Entregar hasta: 
   <input style='border:none;width:150px ' type=datetime id='extt' data-tt='".$ww['idcapitulo']."' value='".$clasew['time']."'></div>";
   
   echo "<div style='display:block;margin:auto;width:90%;background:rgb(255,205,255);padding:5px;color:black;border:none; color:black;border-radius:10px' id='sec_tarea' data-c1 = '".$clasew['idclase']."'>".$clasew['tarea']."</div>";
   
   echo "<div style='text-align:center;width:300px;border-radius:3px;background:rgb(20,70,20);border:none;color:white;padding:2px; margin:auto;'>Tiempo de examen: 
   <input style='border:none ' type=time id='extww' data-tt='".$ww['idcapitulo']."' value='".$clasew['timex']."'></div>";

  
}else{ 
           echo "<div style='margin:auto;width:200px;background:rgb(200,80,85);padding:1px;text-align:center;border-radius:10px 10px 0px 0px;'>Tarea general</div>";
     
  echo "<div style='display:block;margin:auto;width:90%;background:rgb(255,75,255);padding:5px;color:black;border:none; color:white;border-radius:10px' id='sec_tarea' data-c1 = '".$clasew['idclase']."'>".$clasew['tarea']."</div>";
  

$rrnot=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idseccion ='ids' AND clave ='".$_SESSION['clave']."'");   
$rrnotw=mysqli_fetch_assoc($rrnot);
$rrnnot=mysqli_num_rows($rrnot);

$rrwnot=mysqli_query($link,"SELECT * FROM clase WHERE clave ='".$_SESSION['clave']."'");   
$rrwnotw=mysqli_fetch_assoc($rrwnot);
//echo $rrwnotw['time']."wwwwwwwwww";
//echo $_SESSION['clave'];
//var_dump($rrwnotw);

$strStart = $rrwnotw['time'];
$datew = new DateTime($strStart);
$dateww = new DateTime("now");

echo "<div style='margin:auto;border-radius:0px 0px 10px 10px;width:80%;background:rgb(255,10,70);margin-bottom:5px;padding:5px;text-align:center;'>";
if($rrnotw['evaluacion']!=""){
  echo "Calificación: ".$rrnotw['evaluacion'];
        }elseif($rrnnot>0){ 
          echo "Tarea aún no evaluada - ";
          echo "<a style='text-decoration:none;color:rgb(255,200,200);' href='sendtarea.php?idcpt=idc&idsec=ids'>Modificar hasta:</a>";
          echo "<a style='text-decoration:none;color:rgb(255,225,255)'>".date_format($datew, 'd-m-Y H:i:s').". Faltan: </a>";
          echo "<a style='text-decoration:none;color:rgb(255,55,255)'>".get_format( $datew->diff($dateww))."</a>";
          
        }else{
          echo "Tarea no entregada - ";
          
          if ($datew > $dateww){
            echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='sendtarea.php?idcpt=idc&idsec=ids'>Entregar hasta: ".date_format($datew, 'd-m-Y H:i:s').". Faltan: </a>";
            echo "<a style='text-decoration:none;color:rgb(255,25,255)'>".get_format( $datew->diff($dateww))."</a>";
            
          }else{
            echo "Culminó el periodo de entrega hace ";
            echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='sendtarea.php?idcpt=".$ww['idcapitulo']."&idsec=".$ww1['idseccion']."'>".get_format( $datew->diff($dateww))."</a>";
            
          }
        }
        echo "</div>";

        
      }

        
        
echo "<a style='text-decoration:none;color:rgb(255,255,255);background:rgb(25,10,70)' class='www' href='examen.php'><div style='margin:5px auto;border-radius:5px;width:300px;background:rgb(25,10,70);margin-bottom:5px;padding:5px;text-align:center;'>Examen general, tiempo de examen ".$clasew['timex']."</div></a>";
?>
<script type="text/javascript">
    $('.www').on('click', function () {
        return confirm('Está seguro de dar el examen?, este examen culmina en  <?php echo date('H', strtotime($clasew['timex']))?> horas y <?php echo date('i', strtotime($clasew['timex']))?> minutos');
    });
</script>
