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




date_default_timezone_set("America/Lima");

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);


if($_REQUEST['idcapitulo']='cpt' && $w['tipo']=='estudiante'){
  $conw=mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_SESSION['clave']."'");
$nw=mysqli_num_rows($conw);
$ww=mysqli_fetch_assoc($conw);
//var_dump($ww);

}else{
  $conw=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'  AND idcapitulo='".$_SESSION['idcapitulo']."'");
  $nw=mysqli_num_rows($conw);
  $ww=mysqli_fetch_assoc($conw);
//  var_dump($ww);
}

$hour=date('H', strtotime($ww['timex']));
$min=date('i', strtotime($ww['timex']));
//echo $hour."<br>";
//echo $min."<br>";
//
//echo $_SESSION['clave']."<br>";
//echo $_SESSION['user']."<br>";
//echo $_SESSION['cap']."<br>";
//echo date_format(new DateTime('now +'.$hour.' hours +'.$min.' minutes'), 'd-m-Y H:i:s')."<br>";
//echo date_format(new DateTime('now +0 hours +0 minutes'), 'd-m-Y H:i:s')."<br>";
//echo $_SESSION['idcapitulo']."<br>";
//
//
//
//echo $_SESSION['idcapitulo'];


$conw=mysqli_query($link,"SELECT * FROM examen WHERE clavecurso='".$_SESSION['clave']."' AND idcapitulo='".$_SESSION['idcapitulo']."'");
$nw=mysqli_num_rows($conw);
$ww=mysqli_fetch_assoc($conw);



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

$rr=mysqli_query($link,"SELECT * FROM respuestas WHERE clavecurso='".$_SESSION['clave']."' AND idcpt='".$ww['idcapitulo']."' AND usuario='".$_SESSION['user']."' AND clavepregunta='Cap: ".$_SESSION['cap']."'");
$nrr=mysqli_num_rows($rr);
$rrw=mysqli_fetch_assoc($rr);


if($_REQUEST['idcapitulo']=$_SESSION['idcapitulo'] && $w['tipo']=='estudiante'){
$claves=$_SESSION['clave'];
$user=$_SESSION['user'];
$cap=$_SESSION['cap'];
$idw=date_format(new DateTime('now +'.$hour.' hours +'.$min.' minutes'), 'd-m-Y H:i:s');
$idc=$_SESSION['idcapitulo'];
$cnota=mysqli_query($link,"SELECT * FROM  respuestas WHERE usuario='$user' AND clavecurso='$claves' AND idalternativa='inicio' AND respuesta='inicio' AND idcpt='$idc' AND clavepregunta='Cap: ".$_SESSION['cap']."' AND escritanota='".$rrw['escritanota']."'");
  $nnota=mysqli_num_rows($cnota);
  echo $nnota;
if($nnota>0){
//echo "<script>alert('Dato ya incluidoww')</script>";
}else{
  $consulta=mysqli_query($link,"INSERT INTO respuestas VALUES(NULL, '$user', '$claves', 'Cap: $cap', 'inicio','inicio', '$idw ','$idc')");
  if(!$consulta){
//echo "<script>alert('No ok')</script>";
  }else{    
//echo "<script>alert('Ok')</script>";
header('Location: '.$_SERVER['PHP_SELF']);  
  }

}
}



//$cnota=mysqli_query($link,"SELECT * FROM  respuestas WHERE usuario='$user' AND clavecurso='$claves' AND idalternativa='inicio' AND respuesta='inicio' AND idcpt='$idc' AND clavepregunta='Cap: ".$_SESSION['cap']."' AND escritanota='".$rrw['escritanota']."'");
//$rrwww=mysqli_fetch_assoc($cnota);
//var_dump($rrwww);
//echo $_SESSION['clave']."<br>";
//echo $ww['idcapitulo']."<br>";
//echo $_SESSION['user']."<br>";

$strStart = $rrw['escritanota'];
$datei = new DateTime("now");
$datef = new DateTime($strStart);

$d1=date_format($datei, 'd-m-Y H:i:s')."<br>";
$d2=date_format($datef, 'Y-m-d H:i:s')."<br>";
echo $d1;
echo $strStart;


if ($datef < $datei){
  echo "<div style='margin:5px auto;width:90%;color:black;text-align:center;background:rgb(100,200,100);'>";
  echo "El examen culminó hace ";
  echo "<a style='text-decoration:none;color:rgb(25,25,25)'>".get_format( $datei->diff($datef))."</a>";
echo "</div>";
}else{
  echo "<div style='border-radius:10px;margin:auto;width:90%;color:black;text-align:center;background:rgb(20,200,155);padding:5px;color:white'>";
  echo "<a style='text-decoration:none;'>Tiene hasta : ".date_format($datef, 'H:i:s').". Faltan: </a>";
  //  echo "<a style='text-decoration:none;'>".get_format( $datei->diff($datef))."</a>";
  echo "<div style='margin:auto;width:50%;' class='example' data-date='".date_format($datef, 'Y-m-d H:i:s')."'></div>";
  echo "No es necesario registrar su examen, el examen se actualiza constantemente";
  echo "</div>";
  
//////////////////////////////////////////////////////////////////////////

?>

<script type="text/javascript" src="TimeCircles.js"></script>
<link href="TimeCircles.css" rel="stylesheet">    

<script>
$(".example").TimeCircles(); 
//   (function(){"use strict";
//   
//   var secondsSpentElement = document.getElementById("seconds-spent");
//   var millisecondsSpentElement = document.getElementById("milliseconds-spent");
//   
//   requestAnimationFrame(function updateTimeSpent(){
//       var timeNow = performance.now();
//       
//       secondsSpentElement.value = round(timeNow/1000);
//       millisecondsSpentElement.value = round(timeNow);
//       
//       requestAnimationFrame(updateTimeSpent);
//   });
//   var performance = window.performance, round = Math.round;
//   })();

//   Seconds spent on page:&nbsp; <input id="seconds-spent" size="6" readonly="" /><br />
//   Milliseconds spent here: <input id="milliseconds-spent" size="6" readonly="" />

</script>




<?php 
$capitulo=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."' AND idcapitulo='".$_SESSION['idcapitulo']."'");
$capitulow=mysqli_fetch_assoc($capitulo);
echo "<div style='border-radius:10px;margin:5px auto;width:90%;color:black;text-align:center;background:rgb(200,200,155);padding:5px;'>";
 echo "Tiempo de examen: ".$capitulow['timex'];
 echo "</div>";

 

echo "<article style='background:rgb(0,150,150)'>";

echo "<h1 style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(10,0,50);padding:5px'>";
if($_SESSION['cap']=='cpt'){                                                                                         
echo "Examen general del curso";
}else{
echo "Examen del capítulo ".$_SESSION['cap'];
}
echo  "</h1>";











if($nw>0){                                                                                                                        //iff//preguntas
  $i=1;

do{                                                                                                                              //do1

  echo "<div style='background:rgb(50,70,70);border-radius:5px;margin-bottom:20px;padding:5px;color:white;'>";

if($w['tipo']=='docente'){

echo "<button style='border:none;border-radius:5px;padding:5px;;cursor:pointer;display:inline-block;margin-right:5px;' id='delete' data-id='".$ww['idpregunta']."'><span class='fa fa-trash'></span></button>";
echo "<div style='color:rgb(205,100,100);font-size:20px;display:inline-block;margin-right:5px'>Pregunta ".$i." -
<div style='display:inline-block;cursor:pointer;'><span id='cc2' data-c2='".$ww['idpregunta']."' data-idcapitulo='".$ww['idcapitulo']."' contenteditable>".$ww['calificativo']."</span>   Puntos
</div></div>";
echo "<div style='background:rgb(50,30,50);border-radius:5px;padding:5px;cursor:pointer' id='cc1' data-c1='".$ww['idpregunta']."' contenteditable>".$ww['pregunta']."</div>";
echo "<div id='cc3' data-c3='".$ww['idpregunta']."' style='color:rgb(205,100,0);'>".$ww['tipo']."</div>";
echo "<div>";
echo" <button style='background:rgb(255,210,210);border:none;border-radius:5px;padding:5px;cursor:pointer;margin:5px' id='esc' data-escrita='".$ww['idpregunta']."'>escrita</button>";
echo "<button style='background:rgb(255,210,210);border:none;border-radius:5px;padding:5px;;cursor:pointer;margin:5px' id='alt' data-alternativa='".$ww['idpregunta']."'>alternativa</button>";
echo "</div>";

}else{

echo "<div style='color:rgb(205,100,100);font-size:20px;display:inline-block;margin-right:5px;padding:3px'>Pregunta ".$i." -</div><div style='display:inline-block;'><span   >".$ww['calificativo']."</span>   Puntos</div>";
echo "<div style='background:rgb(50,30,50);border-radius:5px;padding:5px'>".$ww['pregunta']."</div>";
  
}
$i++;




//////////////////////////////////////////////////////////////



if($ww['tipo']=='alternativa'){                                                                                                                               //iff3 alternativas
  
  $conw1=mysqli_query($link,"SELECT * FROM preguntas WHERE clavepregunta='".$ww['idpregunta']."'");
  $ww1=mysqli_fetch_assoc($conw1);
  $nw1=mysqli_num_rows($conw1);
  
  if($nw1>0){                                                                                                        //if ------------

    $j=1;
    
    do{                                                                                                                                 //do3
      if($w['tipo']=='docente'){

        if($ww1['rpta']=='correcta'){
          echo "<div style='width:100%'>";
          echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>";
          echo "<button style='background:rgb(50,10,50);color:white;border:none;border-radius:5px;padding:5px;cursor:pointer'
           id='deletealtr' data-idaltr='".$ww1['idalternativa']."'> <span class='fa fa-trash'></span></button>";
          echo "<div style='background:rgb(30,200,50);color:white;border:none;border-radius:5px;padding:5px;width:95%;margin:3px;display:inline-block;cursor:pointer;color:black;'
           id='alternativaww' data-altww='".$ww1['idalternativa']."' data-altw='".$ww1['idalternativa']."' contenteditable>".$ww1['alternativa']."</div>";
     echo "</div>";
    }else{
      echo "<div style='width:100%'>";
      echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
      echo "<button style='background:rgb(50,10,50);color:white;border:none;border-radius:5px;padding:5px;;cursor:pointer' id='deletealtr' data-idaltr='".$ww1['idalternativa']."'><span class='fa fa-trash'></span></button>";
      echo "<div style='background:rgb(25,100,100);border:none;border-radius:5px;padding:5px;margin:2px;width:95%;display:inline-block;cursor:pointer'
       id='alternativa' data-alt='".$ww1['idalternativa']."' data-altw='".$ww1['clavepregunta']."'>".$ww1['alternativa']."</div>";
      echo "</div>";
  }


}else{//------------------------1
   

  $conwzz=mysqli_query($link,"SELECT * FROM respuestas WHERE idalternativa='".$ww1['idalternativa']."' AND usuario='".$_SESSION['user']."'  AND idcpt='".$_SESSION['idcapitulo']."'");
  $wwz=mysqli_fetch_assoc($conwzz);
  $nwz=mysqli_num_rows($conwzz);

  if($nwz==0){

  echo "<div style='width:100%'>";
  //echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
    echo "<div style='background:rgb(25,100,150);border-radius:5px;padding:5px;margin:2px 0px 2px;width:100%;display:inline-block;cursor:pointer'
     id='addresp' data-altresp='".$ww1['idalternativa']."' data-altwresp='".$ww1['clavepregunta']."'>
    ".$j. ". ".$ww1['alternativa']."</div>";
    echo "</div>";

  }else{

    do{                 
    if($wwz['respuesta']=='correcta'){
      echo "<div style='width:100%'>";
    //  echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
    echo "<div style='background:rgb(255,70,90);border-radius:5px;margin:2px 0px 2px;padding:5px;width:100%;display:inline-block;cursor:pointer; color:white;'
     id='addresp' data-altresp='".$ww1['idalternativa']."' data-altwresp='".$ww1['clavepregunta']."'>
    ".$j. ".  ".$ww1['alternativa']."</div>";
    echo "</div>";
  }else{
    echo "<div style='width:100%'>";
 //    echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
    echo "<div style='background:rgb(255,180,75);border-radius:5px;padding:5px;margin:2px 0px 2px;width:100%;display:inline-block;cursor:pointer; color:black;'
     id='addresp' data-altresp='".$ww1['idalternativa']."' data-altwresp='".$ww1['clavepregunta']."'>
  ".$j. ".  ".$ww1['alternativa']." </div>";
  echo "</div>";   
}
}while($wwz=mysqli_fetch_assoc($conwzz));

}


}//------------------------

$j++;    

}while($ww1=mysqli_fetch_assoc($conw1));                                                                                                   //do3


}else{                                                                                                                                     //if ------------

//echo "<div style='background:rgb(78,0,200);color:white;border:none;border-radius:5px;padding:5px;margin:2px;width:95%;'> No hay aún alternativas</div>";
}


if($ww['tipo']=='alternativa'){

  if($w['tipo']=='docente'){
    echo "<button style='background:rgb(10,200,100);color:white;border:none;border-radius:5px;padding:7px;cursor:pointer;margin:5px;'
     id='altr'  data-idpregunta='".$ww['idpregunta']."' data-idcpt='".$_SESSION['idcapitulo']."'>Agregar alternativa</button>";
  }  
}  

 






}else{                                                                                                                                      //iff3 alernativas 
  

  if($w['tipo']=='estudiante'){


    
    
    $escrita=mysqli_query($link,"SELECT * FROM respuestas WHERE idalternativa='0' AND usuario='".$_SESSION['user']."' AND clavecurso='".$_SESSION['clave']."' AND idcpt='".$_SESSION['idcapitulo']."' AND clavepregunta ='".$ww['idpregunta']."'");
    $escritaw=mysqli_fetch_assoc($escrita);
    $nescrita=mysqli_num_rows($escrita);
    echo "<div style='background:rgb(255,255,255);color:black;border-radius:5px;margin:3px;padding:5px;' id='ccc' data-cc='".$ww['idpregunta']."' data-idcpt='".$_SESSION['idcapitulo']."' contenteditable>".$escritaw['respuesta']."</div>";



}

}




//////////////////////////////////////////////////////////////



  $cnota=mysqli_query($link,"SELECT * FROM  preguntas, respuestas WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.clavepregunta='".$ww['idpregunta']."' AND preguntas.rpta=respuestas.respuesta AND usuario='".$_SESSION['user']."'");
  $nota=mysqli_fetch_assoc($cnota);
  $nnota=mysqli_num_rows($cnota);

if($w['tipo']=='estudiante'){
  
  if($nnota==1){
    $cpunto=mysqli_query($link,"SELECT * FROM  examen, respuestas WHERE idpregunta='".$ww['idpregunta']."'");
    $punto=mysqli_fetch_assoc($cpunto);
    $gg=$punto['calificativo'];
    echo $gg;
  }else{
    $gg=0;
    echo $gg;
  }
  
}


echo "</div>";
  
  



}while($ww=mysqli_fetch_assoc($conw));                                                                                              //do1


}else{                                                                                                                              //iff//
//
}











if($w['tipo']=='docente'){

  echo "<button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;margin:auto;display:block;' id='add' data-idcapitulo='".$_SESSION['idcapitulo']."'>Agregar pregunta</button>";
  $fila=mysqli_query($link,"SELECT SUM(calificativo) AS suma FROM  examen WHERE clavecurso='".$_SESSION['clave']."' AND idcapitulo='".$_SESSION['idcapitulo']."'");
  $filaw = mysqli_fetch_assoc($fila); 
  $suma=$filaw['suma'];
  echo "<div style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(100,0,100);'><p>".$suma." puntos examen</p></div>";
  
}else{
 
  $rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM  examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$_SESSION['user']."' AND idcapitulo='".$_SESSION['idcapitulo']."')");
  $row = mysqli_fetch_assoc($rw); 
  $sum = $row['sum'];
  
  $rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$_SESSION['user']."'  AND idcpt ='".$_SESSION['idcapitulo']."'");
  $roww = mysqli_fetch_assoc($rww); 
  $sumw = $roww['sumw'];
  $ggg=$sumw+$sum;
  //echo $_SESSION['clave'];
  echo "Alternativas: ".$sum."--";
  echo "Escritas: ".$sumw;

  echo "<div style='margin:5px auto;width:90%;color:black;text-align:center;background:rgb(100,200,100);'><p>Total ".$ggg." puntos </p></div>";

}






echo "</article>";




}







//echo "<article style='background:rgb(0,150,150);'>";


//echo "<h1 style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(10,0,50);'><p>Tarea</h1>";
//echo "<textarea style='background:rgb(250,255,250);color:white;border-radius:5px;margin:3px;padding:5px;cursor:pointer; width:70%;dispaly:block ; margin:auto;' id='tareachapter' data-tch='".$ww['idpregunta']."' contenteditable>".$ww['pregunta']."</textarea>";


//echo "</article>";
?>
