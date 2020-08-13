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


echo $_SESSION['idcapitulo'];


$conw=mysqli_query($link,"SELECT * FROM examen WHERE clavecurso='".$_SESSION['clave']."' AND idcapitulo='".$_SESSION['idcapitulo']."'");
$nw=mysqli_num_rows($conw);
$ww=mysqli_fetch_assoc($conw);

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

echo "<article style='background:rgb(0,150,150);'>";

 echo "<h1 style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(10,0,50);'>Examen</h1>";

if($nw>0){
  $i=1;

do{
  echo "<div style='background:rgb(50,70,70);border-radius:5px;margin-bottom:20px;padding:5px;color:white;'>";
if($w['tipo']=='docente'){
echo "<div >";
echo "<button style='border:none;border-radius:5px;padding:5px;;cursor:pointer' id='delete' data-id='".$ww['idpregunta']."'><span class='fa fa-trash'></span></button>";
echo "</div>";

echo "<div style='color:rgb(205,100,100);font-size:20px;display:inline-block;margin-right:5px;'>Pregunta ".$i." -</div><div style='display:inline-block;cursor:pointer;'><span id='cc2' data-c2='".$ww['idpregunta']."' data-idcapitulo='".$ww['idcapitulo']."' contenteditable>".$ww['calificativo']."</span>   Puntos</div>";
echo "<div style='background:rgb(0,30,30);border-radius:5px;margin:3px;padding:5px;cursor:pointer' id='cc1' data-c1='".$ww['idpregunta']."' contenteditable>".$ww['pregunta']."</div>";

echo "<div id='cc3' data-c3='".$ww['idpregunta']."' style='color:rgb(205,100,0);'>".$ww['tipo']."</div>";

echo "<div>";
echo" <button style='background:rgb(255,210,210);border:none;border-radius:5px;padding:5px;cursor:pointer;margin:5px' id='esc' data-escrita='".$ww['idpregunta']."'>escrita</button>";
echo "<button style='background:rgb(255,210,210);border:none;border-radius:5px;padding:5px;;cursor:pointer;margin:5px' id='alt' data-alternativa='".$ww['idpregunta']."'>alternativa</button>";
echo "</div>";
}else{
echo "<div style='color:rgb(205,100,100);font-size:20px;display:inline-block;margin-right:5px;'>Pregunta ".$i." -</div><div style='display:inline-block;cursor:pointer;'><span id='cc2' data-c2='".$ww['idpregunta']."' contenteditable>".$ww['calificativo']."</span>   Puntos</div>";
echo "<div style='background:rgb(0,30,30);border-radius:5px;margin:3px;padding:5px' id='cc1' data-c1='".$ww['idpregunta']."'>".$ww['pregunta']."</div>";
  
}
$i++;


$conw1=mysqli_query($link,"SELECT * FROM preguntas WHERE clavepregunta='".$ww['idpregunta']."'");
$ww1=mysqli_fetch_assoc($conw1);
$nw1=mysqli_num_rows($conw1);

//$conw1=mysqli_query($link,"SELECT * FROM  preguntas, respuestas WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.clavepregunta='3' AND preguntas.rpta=respuestas.respuesta");

if($ww['tipo']=='alternativa'){
  if($nw1>0){
    $j=1;
    
    do{
      if($w['tipo']=='docente'){
        if($ww1['rpta']=='correcta'){
          echo "<div style='width:100%'>";
     echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>";
     echo "<button style='background:rgb(5,10,50);color:white;border:none;border-radius:5px;padding:5px;cursor:pointer' id='deletealtr' data-idaltr='".$ww1['idalternativa']."'> <span class='fa fa-trash'></span></button>";
     echo "<div style='background:rgb(30,20,50);color:white;border:none;border-radius:5px;padding:5px;margin:3px;width:95%;display:inline-block;cursor:pointer' id='alternativaww' data-altww='".$ww1['idalternativa']."' data-altw='".$ww1['idalternativa']."' contenteditable>".$ww1['alternativa']."</div>";
     echo "</div>";
    }else{
      
      echo "<div style='width:100%'>";
      echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
    echo "<button style='background:rgb(5,10,50);color:white;border:none;border-radius:5px;padding:5px;;cursor:pointer' id='deletealtr' data-idaltr='".$ww1['idalternativa']."'><span class='fa fa-trash'></span></button>";
    echo "<div style='background:rgb(25,10,100);border:none;border-radius:5px;padding:5px;margin:2px;width:95%;display:inline-block;cursor:pointer' id='alternativa' data-alt='".$ww1['idalternativa']."' data-altw='".$ww1['clavepregunta']."'>".$ww1['alternativa']."</div>";
    echo "</div>";
    
  }

}else{
  
  $conwzz=mysqli_query($link,"SELECT * FROM respuestas WHERE idalternativa='".$ww1['idalternativa']."' AND usuario='".$_SESSION['user']."'");
  $wwz=mysqli_fetch_assoc($conwzz);
  $nwz=mysqli_num_rows($conwzz);
  if($nwz==0){
  echo "<div style='width:100%'>";
    echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
    echo "<div style='background:rgb(25,10,150);border:none;border-radius:5px;padding:5px;margin:2px;width:95%;display:inline-block;cursor:pointer' id='addresp' data-altresp='".$ww1['idalternativa']."' data-altwresp='".$ww1['clavepregunta']."'>
    ".$ww1['alternativa']."".$ww1['idalternativa']."  ".$ww1['clavepregunta']."".$wwz['respuesta']." ".$wwz['idalternativa']."</div>";
    echo "</div>";
  }else{

    do{

    if($wwz['respuesta']=='correcta'){
      echo "<div style='width:100%'>";
      echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
    echo "<div style='background:rgb(25,10,50);border:none;border-radius:5px;padding:5px;margin:2px;width:95%;display:inline-block;cursor:pointer' id='addresp' data-altresp='".$ww1['idalternativa']."' data-altwresp='".$ww1['clavepregunta']."'>
    ".$ww1['alternativa']."".$ww1['idalternativa']."  ".$ww1['clavepregunta']."".$wwz['respuesta']." ".$wwz['idalternativa']."</div>";
    echo "</div>";
  }else{
    echo "<div style='width:100%'>";
    echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
    echo "<div style='background:rgb(25,10,100);border:none;border-radius:5px;padding:5px;margin:2px;width:95%;display:inline-block;cursor:pointer' id='addresp' data-altresp='".$ww1['idalternativa']."' data-altwresp='".$ww1['clavepregunta']."'>
  ".$ww1['alternativa']."".$ww1['idalternativa']."  ".$ww1['clavepregunta']."".$wwz['respuesta']." ".$wwz['idalternativa']."</div>";
  echo "</div>";   
}

}while($wwz=mysqli_fetch_assoc($conwzz));

}

}

$j++;
}while($ww1=mysqli_fetch_assoc($conw1));  


}else{
  //    echo "<div style='background:rgb(78,0,200);color:white;border:none;border-radius:5px;padding:5px;margin:2px;width:95%;'> No hay aún alternativas</div>";
}
if($ww['tipo']=='alternativa'){
  if($w['tipo']=='docente'){
    echo "<button style='background:rgb(10,200,100);color:white;border:none;border-radius:5px;padding:7px;cursor:pointer;margin:5px;' id='altr'  data-idpregunta='".$ww['idpregunta']."'>Agregar alternativa</button>";
  }  
}  
}else{
  if($w['tipo']=='estudiante'){
    echo "<div style='background:rgb(520,200,10);border-radius:5px;margin:3px;padding:5px;' id='ccc' data-cc='".$ww['idpregunta']."' contenteditable>".$ww['rptaescrita']."</div>";
  }
}
//echo $_SESSION['user'];
//echo $_SESSION['clave'];

$escrita=mysqli_query($link,"SELECT * FROM respuestas WHERE idalternativa='0' AND usuario='".$_SESSION['user']."' AND clavecurso='".$_SESSION['clave']."'");
$escritaw=mysqli_fetch_assoc($escrita);
$nescrita=mysqli_num_rows($escrita);

//if ($escritaw['idaltenativa']==0){

  
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
  
  

}while($ww=mysqli_fetch_assoc($conw));
}else{
  //echo "<tr><td> No hay preguntaswww creadas</td></tr>";
  //echo "<div ><button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;' id='add'>Agregar pregunta</button></div>";
}
if($w['tipo']=='docente'){

  echo "<div ><button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;' id='add' data-idcapitulo='".$_SESSION['idcapitulo']."'>Agregar pregunta</button></div>";
  $fila=mysqli_query($link,"SELECT SUM(calificativo) AS suma FROM  examen WHERE clavecurso='".$_SESSION['clave']."' AND idcapitulo='".$_SESSION['idcapitulo']."'");
  $filaw = mysqli_fetch_assoc($fila); 
  $suma=$filaw['suma'];
  echo "<div style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(100,0,100);'><p>".$suma." puntos examen</p></div>";
  
}else{

  
 
  
  $rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM  examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$_SESSION['user']."' AND idcapitulo='".$_SESSION['idcapitulo']."')");
  $row = mysqli_fetch_assoc($rw); 
  $sum = $row['sum'];
  
  $rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$_SESSION['user']."'");
  $roww = mysqli_fetch_assoc($rww); 
  $sumw = $roww['sumw'];
  $ggg=$sumw+$sum;
  //echo $_SESSION['clave'];
  echo "Escritas: ".$sumw."--";
  echo "Alternativas: ".$sum;

  echo "<div style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(100,200,100);'><p>Total ".$ggg." puntos </p></div>";

}
echo "</article>";










//echo "<article style='background:rgb(0,150,150);'>";


//echo "<h1 style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(10,0,50);'><p>Tarea</h1>";
//echo "<textarea style='background:rgb(250,255,250);color:white;border-radius:5px;margin:3px;padding:5px;cursor:pointer; width:70%;dispaly:block ; margin:auto;' id='tareachapter' data-tch='".$ww['idpregunta']."' contenteditable>".$ww['pregunta']."</textarea>";


//echo "</article>";
?>
