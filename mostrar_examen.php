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


//echo $_SESSION['idcapitulo'];


$conw=mysqli_query($link,"SELECT * FROM examen WHERE clavecurso='".$_SESSION['clave']."' AND idcapitulo='".$_SESSION['idcapitulo']."'");
$nw=mysqli_num_rows($conw);
$ww=mysqli_fetch_assoc($conw);

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

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
echo "<div style='background:rgb(0,30,30);border-radius:5px;padding:5px;cursor:pointer' id='cc1' data-c1='".$ww['idpregunta']."' contenteditable>".$ww['pregunta']."</div>";
echo "<div id='cc3' data-c3='".$ww['idpregunta']."' style='color:rgb(205,100,0);'>".$ww['tipo']."</div>";
echo "<div>";
echo" <button style='background:rgb(255,210,210);border:none;border-radius:5px;padding:5px;cursor:pointer;margin:5px' id='esc' data-escrita='".$ww['idpregunta']."'>escrita</button>";
echo "<button style='background:rgb(255,210,210);border:none;border-radius:5px;padding:5px;;cursor:pointer;margin:5px' id='alt' data-alternativa='".$ww['idpregunta']."'>alternativa</button>";
echo "</div>";

}else{

echo "<div style='color:rgb(205,100,100);font-size:20px;display:inline-block;margin-right:5px;padding:3px'>Pregunta ".$i." -</div><div style='display:inline-block;'><span   >".$ww['calificativo']."</span>   Puntos</div>";
echo "<div style='background:rgb(0,30,30);border-radius:5px;padding:5px'>".$ww['pregunta']."</div>";
  
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
          echo "<button style='background:rgb(5,10,50);color:white;border:none;border-radius:5px;padding:5px;cursor:pointer'
           id='deletealtr' data-idaltr='".$ww1['idalternativa']."'> <span class='fa fa-trash'></span></button>";
          echo "<div style='background:rgb(30,200,50);color:white;border:none;border-radius:5px;padding:5px;width:95%;margin:3px;display:inline-block;cursor:pointer;color:black;'
           id='alternativaww' data-altww='".$ww1['idalternativa']."' data-altw='".$ww1['idalternativa']."' contenteditable>".$ww1['alternativa']."</div>";
     echo "</div>";
    }else{
      echo "<div style='width:100%'>";
      echo "<div style=';display:inline-block;width:20px;'>".$j. ".  </div>"; 
      echo "<button style='background:rgb(5,10,50);color:white;border:none;border-radius:5px;padding:5px;;cursor:pointer' id='deletealtr' data-idaltr='".$ww1['idalternativa']."'><span class='fa fa-trash'></span></button>";
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
    echo "<div style='background:rgb(520,200,10);border-radius:5px;margin:3px;padding:5px;' id='ccc' data-cc='".$ww['idpregunta']."' data-idcpt='".$_SESSION['idcapitulo']."' contenteditable>".$escritaw['respuesta']."</div>";



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










//echo "<article style='background:rgb(0,150,150);'>";


//echo "<h1 style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(10,0,50);'><p>Tarea</h1>";
//echo "<textarea style='background:rgb(250,255,250);color:white;border-radius:5px;margin:3px;padding:5px;cursor:pointer; width:70%;dispaly:block ; margin:auto;' id='tareachapter' data-tch='".$ww['idpregunta']."' contenteditable>".$ww['pregunta']."</textarea>";


//echo "</article>";
?>
