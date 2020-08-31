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


$estudian=mysqli_query($link,"SELECT * FROM misclases, usuario WHERE misclases.usuario=usuario.idusuario  AND misclases.clave ='".$_SESSION['clave']."'");   
$estudiant=mysqli_fetch_assoc($estudian);
$nm=mysqli_num_rows($estudian);

$nsesion=mysqli_query($link,"SELECT * FROM secciones WHERE clave ='".$_SESSION['clave']."'");   
$nsesionw=mysqli_fetch_assoc($nsesion);
$ns=mysqli_num_rows($nsesion);

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);





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

if(isset($_REQUEST['notas'])){
    $id = $_REQUEST['id'];
    $est = $_REQUEST['est'];
    $nota = $_REQUEST['nota'];
    mysqli_query($link, "UPDATE  tareas SET evaluacion='$nota' WHERE idplan='$id' AND usuario='$est'");
}            

$con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
$wew=mysqli_fetch_assoc($con);





echo "<h1 style='text-align: center;'>Calificaciones del curso ".$wew['nombre']."</h1>";

//if($w['tipo']=='docente'){




    if($nm>0){
        do{
            
            
            echo "<div class='wrapper' style='margin:5px auto;' ><img src= 'archivos/".$estudiant['usuario']."".$estudiant['foto']."' onerror=this.src='foto.png'></div>";
            echo "<h1 style='border-radius:2px;margin-bottom:5px;width:70%;margin:auto;;background:rgb(250,225,255);font-size:19px;text-align: center'>" .$estudiant['nombre']. "</h1>";
            
            //echo "<div  class='imagen' style='display:block;;margin: auto;text-align:center;width:70%;border-radius:10px;margin:5px;border:3px solid;'>";///////////////////////////////////////////////////wwwwwwwwwwwwwwwwwwwwwwwwwwww
            
//examen general


echo "<div style='margin:5px auto;width:90%;;text-align:center;font-size:30px'><p>EXÁMENES</p></div>";


//notas 


$con=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
$ncap=mysqli_num_rows($con);
$cap=mysqli_fetch_assoc($con);

////////curso ex

echo "<div style='border:0.1em solid;border-radius:10px;padding:3px;margin:10px auto;text-align:center;width:90%;'>";///////////////////////////////////////////////////////uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu
echo "<div style='padding:3px;margin:auto;text-align:center;width:90%;font-weight:bold'>Examen general</div>";

$rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$estudiant['idusuario']."' AND idcapitulo='cpt')");
$row = mysqli_fetch_assoc($rw);
$sum = $row['sum'];
//
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt='cpt'");
$roww = mysqli_fetch_assoc($rww); 

$sumw = $roww['sumw'];
$wggg=$sumw+$sum;

$max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idcapitulo='cpt'");
$maxx = mysqli_fetch_assoc($max); 
$maxn=mysqli_num_rows($max);

echo "<div style='margin:5px auto;width:90%;color:rgb(75,75,750);text-align:center'><p>Alternativas: ".$sum." -- Escrito: " ;if($maxn>0){if($sumw==''){echo "No calificó aun";}else{echo $sumw;};}else{echo 'No hay preguntas con respuestas escritas';}; echo "</p></div>";
//echo $maxn;
//echo $cap['idcapitulo'];
//echo "<div style='margin:5px auto;width:90%;color:rgb(70,75,75);text-align:center'><p>Alternativas: ".$sum." -- Escrito: ".$sumw."</p></div>";

echo "<div style='margin:5px auto;width:90%;;text-align:center;font-weight: bold'><p>Total ".$wggg." puntos en el examen general </p></div>";

$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."'  AND idcpt='cpt'");
$escritow = mysqli_fetch_assoc($escrito); 
$nescr=mysqli_num_rows($escrito);

if ($nescr>0) {
do{
    $max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idpregunta='".$escritow['clavepregunta']."'");
    $maxx = mysqli_fetch_assoc($max);
    echo "<div style='display:inline-block'>
    <div style='border:0.1em solid;padding:3px;;width:30px;display:inline-block;border-radius:5px;' id='fff' data-fffff='".$escritow['idrespuestas']."' data-user='".$escritow['usuario']."' contenteditable>".$escritow['escritanota']."</div>
    (Puntos max: ".$maxx['calificativo'].")</div>";
    echo "<div style='background:rgb(100,200,200); border-radius:0.2em;;margin:5px; padding:5px;'>".$escritow['respuesta']."</div>";
}while($escritow = mysqli_fetch_assoc($escrito));
}else{ 
    echo "<div style='color:rgb(70,80,10);'>No hay preguntas escritas</div>";
}
echo "</div>";/////////////////////////////////////////////////////////////////////////uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu

/////////curso ex




$sumae=0;
$i=1;

if($ncap>0){
    do{
        echo "<div style='border:0.1em solid;;border-radius:10px;padding:10px;margin:5px auto;text-align:center;width:90%;'>";///////////////////////////////////////////////////////7777777777777777777777777777777777777
        echo "<div style='font-weight:bold;border-radius:10px;text-align:center;width:100%;'>Examen ".$i." de ".$cap['nombre']."</div>";
$rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$estudiant['idusuario']."' AND idcpt='".$cap['idcapitulo']."')");
$row = mysqli_fetch_assoc($rw);
$sum = $row['sum'];
//
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt='".$cap['idcapitulo']."'");
$roww = mysqli_fetch_assoc($rww); 

$sumw = $roww['sumw'];
$ggg=$sumw+$sum;

$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt=".$cap['idcapitulo']."");
$escritow = mysqli_fetch_assoc($escrito); 
$nescr=mysqli_num_rows($escrito);
//var_dump($escritow);

$max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idcapitulo='".$cap['idcapitulo']."'");
$maxx = mysqli_fetch_assoc($max); 
$maxn=mysqli_num_rows($max);

echo "<div style='margin:5px auto;width:90%;color:rgb(75,75,750);text-align:center'><p>Alternativas: ".$sum." -- Escrito: " ;if($maxn>0){if($sumw==''){echo "No calificó     aún";}else{echo $sumw;};}else{echo 'No hay preguntas con respuestas escritas';}; echo "</p></div>";
//echo $maxn;
//echo $cap['idcapitulo'];
echo "<div style='font-weight: bold;margin:5px auto;width:90%;text-align:center'><p>Total ".$ggg." puntos en el examen ".$i."</p></div>";



if ($nescr>0) {
    do{
                
        echo "<div style='display:inline-block;'><div style='border:.05em solid;;padding: 3px;width:30px;display:inline-block;border-radius:5px;' id='fff' data-fffff='".$escritow['idrespuestas']."' data-user='".$escritow['usuario']."' contenteditable>".$escritow['escritanota']."</div>   (Puntos max: ".$maxx['calificativo'].")</div>";
        echo "<div style='background:rgb(100,200,200);; border-radius:0.2em;;margin:5px; padding:5px;'>".$escritow['respuesta']."</div>";
    }while($escritow = mysqli_fetch_assoc($escrito));
    
    
    
}else{ 
//    echo "<div style='color:rgb(200,10,10);'>No hay preguntas escritas</div>";
}
$sumae+=$ggg;



$i++;

echo "</div>";///////////////////////////////////////////////////////////////7777777777777777777777777777777777777777777777777777

}while($cap=mysqli_fetch_assoc($con));

echo "<div style='text-align:center;;font-weight: bold'> Promedio exámenes: ".($sumae+$wggg)."/".($i)."=".round(($sumae+$wggg)/($i),3)."</div>";
$cce=round(($sumae+$wggg)/($i),3);
//echo $cc;
}else{
    echo "No capitulos";
}














//tarea

    $cal=mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_SESSION['clave']."'");   
    $acal=mysqli_fetch_assoc($cal);
    $ncal=mysqli_num_rows($cal);

    $caw=mysqli_query($link,"SELECT * FROM tareas WHERE clave='".$_SESSION['clave']."' AND usuario='".$estudiant['usuario']."' AND idcapitulo='idc'  AND idseccion='ids'");   
    $acaw=mysqli_fetch_assoc($caw);
    //var_dump($acaw);
     $ncaw=mysqli_num_rows($caw);



     
//TAREA CURSO
     
     echo "<div style='margin:5px auto;width:90%;;text-align:center;font-size:30px'>TAREAS</div>";   
   
     echo "<div style='border:0.1em solid;;border-radius:10px;font-weight:bold;margin:5px auto;text-align:center;width:90%;'>"; //////////////////////////////////////////////////////fffffffffffffffffffffffffffffffffffffffffffff
     echo "<div>TAREA DEL CURSO</div>"; 
     echo "<button style='display:block;margin:auto;'  id='".$estudiant['usuario']."w'>Ver tarea encargada</button>";
     echo "<div style=display:none; id='".$estudiant['usuario']."'>".$acal['tarea']."</div><hr>";

     
     ?>

<script>
var button = document.getElementById('<?php echo $estudiant['usuario']."w"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $estudiant['usuario']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>


        <?php

        if($ncaw>0){
        if($acaw['evaluacion']!=""){
            
            echo "<div style=display:; id='".$i."zz'>".$acaw['texto']."</div>";   
            $j=1;
            echo "<div style='background:rgb(200,200,100);border:1px solid;display:inline-block;border-radius:5px;padding:3px;width:30px;margin:auto;' id='nota' data-nota='".$acaw['idtarea']."' contenteditable>".$acaw['evaluacion']."</div>";    
            echo "<div style='padding:3px;background:rgb(255,200,200);width:200px;margin:auto;'><a style=' color: rgb(50,5,70); margin: 10px;text-decoration:none' target='_blank' href='archivostarea/".$acaw['idseccion']."_".$acaw['archivo']."'>Descargar archivo</a></div>";    

            $wwt=$acaw['evaluacion'];
            
        }elseif($ncaw>0){
            echo "<div style=display:none; id='".$i."zz'>".$acaw['texto']."</div>";    
            echo "<div style='padding:3px;background:rgb(255,200,200);width:200px;margin:auto;'><a style=' color: rgb(50,5,70); margin: 10px;text-decoration:none' target='_blank' href='archivostarea/".$acaw['idseccion']."_".$acaw['archivo']."'>Descargar archivo</a></div>";    
    
    echo "<div style='background:rgb(200,200,100);border:1px solid;display:inline-block;border-radius:5px;padding:3px;width:30px;margin:auto;' id='nota' data-nota='".$acaw['idtarea']."' contenteditable>".$acaw['evaluacion']."</div>";    
    
    echo "<div style='width:100px;border:1px solid;border-radius:5px;margin:auto'>No evaluada</div>";
}else{
    echo "No entregada";
}
}else{
    echo "No entregó tarea";
}
echo "</div>";      /////////////////////////////////////////////////////////////////////////////fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff


//TAREA CURSO



    
$cal=mysqli_query($link,"SELECT * FROM secciones WHERE clave ='".$_SESSION['clave']."'");   
$acal=mysqli_fetch_assoc($cal);
$ncal=mysqli_num_rows($cal);

if($ncal>0){
    $i=1;
    $suma=0;
    do{
        //
        echo "<div  class='imagen' style='display:block;margin:3px auto;text-align:center;width:90%;border-radius:10px;border:1px solid;padding:5px;'>"; ///////////////////////////////////////////////////gggggggggggggggggggggggggggggggggggggggggggggggg

        echo "<div style='font-weight:bold'>Tarea ".($i)."</div>";
        echo "<button style='display:block;margin:auto;' id='".$acal['idseccion'].$estudiant['email']."7'>Ver tarea encargada</button>";
         echo "<div style='display:none;' id='".$acal['idseccion'].$estudiant['email']."'>".$acal['tarea']."</div><hr>";
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
     //5

$not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$estudiant['usuario']."' AND idseccion ='".$acal['idseccion']."'");   
$notw=mysqli_fetch_assoc($not);

$nnot=mysqli_num_rows($not);
if($notw['evaluacion']!=""){
    
    echo "<div style=display:; id='".$i."zz'>".$notw['texto']."</div>";   
            $j=1;
            
            echo "<div style='background:rgb(200,200,100);border:1px solid;display:inline-block;border-radius:5px;padding:3px;width:30px;margin:auto;' id='nota' data-nota='".$notw['idtarea']."' contenteditable>".$notw['evaluacion']."</div>";    
            echo "<div style='padding:3px;background:rgb(255,200,200);width:200px;margin:auto;'><a style=' color: rgb(50,5,70); margin: 10px;text-decoration:none' target='_blank' href='archivostarea/".$acal['idseccion']."_".$notw['archivo']."'>Descargar archivo</a></div>";    
            $j++;
            $suma+=$notw['evaluacion'];

        }elseif($nnot>0){
//    echo "<button id='".$i."z'>Ver tarea entregada</button>"; 
    echo "<div style=display:; id='".$i."zz'>".$notw['texto']."</div>";    
    echo "<div style='padding:3px;background:rgb(255,200,200);width:200px;margin:auto;'><a style=' color: rgb(50,5,70); margin: 10px;text-decoration:none' target='_blank' href='archivostarea/".$acal['idseccion']."_".$notw['archivo']."'>Descargar archivo</a></div>";    
    
    echo "<div style='background:rgb(200,200,100);border:1px solid;display:inline-block;border-radius:5px;padding:3px;width:30px;margin:auto;' id='nota' data-nota='".$notw['idtarea']."' contenteditable>".$notw['evaluacion']."</div>";    
    
    echo "<div style='width:100px;border-radius:5px;margin:auto'>No evaluada</div>";
    
?>




<?php 

}else{
    echo "No entregada";
}

echo "</div>";     ////////////////////////////////////////////////////////////////////////ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
$i++;
}while($acal=mysqli_fetch_assoc($cal));

echo "<div style='text-align:center;'> Promedio tareas: ".($suma+$wwt)."/".($i-1)."=".round(($suma+$wwt)/($i-1),3)."</div>";
$cct=round(($suma+$wwt)/($i-1),3);
}else{
    echo "No hay clases creadas";
}

echo "<div style='text-align:center;'> Promedio total: (".$cce."+".$cct.")/2=".($cce+$cct)."/2=".round(($cce+$cct)/2,3)."</div>";








//echo "</div>"; ////////////////////////////////////////////////////////////////////////wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
}while($estudiant=mysqli_fetch_assoc($estudian));

}else{
    echo "No hay inscritos";
    
}






















//}else{//estudiante
    


////////////////////////////EXAMEN


    
    $con=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
    $ncap=mysqli_num_rows($con);
    $cap=mysqli_fetch_assoc($con);


    
////////curso

echo "<div style='margin:5px auto;width:90%;;text-align:center;font-size:30px'><p>EXÁMENES</p></div>";

//echo "<div>";
$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$_SESSION['user']."'  AND idcpt='cpt'");
$escritow = mysqli_fetch_assoc($escrito);
$nescr=mysqli_num_rows($escrito);

echo "<div style='border:0.1em solid;; border-radius:0.2em;;margin:auto; padding:5px;width:90%;text-align :center;'>";///////////////////////////////////////////////////////////
echo "<div style='; border-radius:0.2em;;margin:auto; padding:5px;width:90%;text-align :center;font-weight:bold;'>Examen del curso</div>";
if ($nescr>0) {
do{
    echo "<div style='background:rgb(85,75,255); border-radius:0.2em; padding:3px;'>".$escritow['respuesta']."</div>";
    
    $max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idpregunta='".$escritow['clavepregunta']."'");
    $maxx = mysqli_fetch_assoc($max); 
    
    echo "<div style='display:inline-block;background:rgb(0,10,90);border-radius:0px 0px 5px 5px;color:white;padding:3px;margin-bottom:3px'>".$escritow['escritanota']." (Puntos max: ".$maxx['calificativo'].")</div>";
}while($escritow = mysqli_fetch_assoc($escrito));
}else{ 
    echo "<div style='color:rgb(20,20,20);'>Este examen no contiene preguntas escritas</div>";
}

$rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$_SESSION['user']."' AND idcapitulo='cpt')");
$row = mysqli_fetch_assoc($rw);
$sum = $row['sum'];
//echo "<pre>";
//var_dump($rw);
//echo "</pre>";
//
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$_SESSION['user']."' AND idcpt='cpt'");
$roww = mysqli_fetch_assoc($rww); 

$sumw = $roww['sumw'];
$ggg7=$sumw+$sum;

$max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idcapitulo='cpt'");
$maxx = mysqli_fetch_assoc($max); 
$maxn=mysqli_num_rows($max);

echo "<div style='margin:5px auto;width:90%;color:rgb(85,75,255);text-align:center'><p>Alternativas: ".$sum." -- Escrito: " ;if($maxn>0){if($sumw==''){echo "No respondiste las preguntas escritas";}else{echo $sumw;};}else{echo 'No hay preguntas con respuestas escritas';}; echo "</p></div>";

//echo "<span style='margin:5px auto;width:90%;color:rgb(55,25,25);display:block ;'>Escrito: ".$sumw." -- Alternativas: ".$sum."</span>";

echo "<div style='margin:5px auto;width:90%;color:rgb(255,10,200);text-align:center'>Total ".$ggg7." puntos </div>";

echo "</div>";
/////////curso


 
$ssw=0;
$i=1;

if($ncap>0){
    do{
        echo "<div style='width:90;border:.1em solid;;width:90%;margin:0.5em auto; padding:5px;display:block;border-radius:3px;text-align :center;'>"; ////////////////////////////////////////////////////////////////////////////////////fffffffffffffffffffffffffffffffffffffffffffffffffffffff

        echo "<div style='font-weight:bold;border-radius:0.2em; padding:5px;width:100%;'>Examen de ".$cap['nombre']." (Capitulo ".$i.")</div>";
//

$i++;
$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$_SESSION['user']."' AND idcpt='".$cap['idcapitulo']."'");
$escritow = mysqli_fetch_assoc($escrito); 
$nescr=mysqli_num_rows($escrito);


if ($nescr>0) {
    do{
        echo "<div style='background:rgb(85,75,255); border-radius:0.2em; padding:5px;'>".$escritow['respuesta']."</div>";
        
        $max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idpregunta='".$escritow['clavepregunta']."'");
        $maxx = mysqli_fetch_assoc($max); 
            echo "<div style='display:inline-block;background:rgb(0,10,90);border-radius:0px 0px 5px 5px;color:white;padding:3px;margin-bottom:3px'>".$escritow['escritanota']." (Puntos max: ".$maxx['calificativo'].")</div>";
        }while($escritow = mysqli_fetch_assoc($escrito));
        
        
    }else{ 
        echo "<div>Este examen no contiene preguntas escritas</div>";
    }
    
    $rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$_SESSION['user']."' AND idcpt='".$cap['idcapitulo']."')");
$row = mysqli_fetch_assoc($rw);
$sum = $row['sum'];
//
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$_SESSION['user']."' AND idcpt='".$cap['idcapitulo']."'");
$roww = mysqli_fetch_assoc($rww); 

$sumw = $roww['sumw'];
$ggwww=$sumw+$sum;


$max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idcapitulo='".$cap['idcapitulo']."'");
$maxx = mysqli_fetch_assoc($max); 
$maxn=mysqli_num_rows($max);

echo "<div style='margin:5px auto;width:90%;color:rgb(75,75,750);text-align:center'><p>Alternativas: ".$sum." -- Escrito: " ;if($maxn>0){if($sumw==''){echo "No respondiste las preguntas escritas";}else{echo $sumw;};}else{echo 'No hay preguntas con respuestas escritas';}; echo "</p></div>";

//echo "<div style='margin:5px auto;width:90%;color:rgb(25,25,255);'>Escrito: ".$sumw." -- Alternativas: ".$sum."</div>";

echo "<div style='width:100%;color:rgb(255,10,200);text-align:center'>Total ".$ggwww." puntos </div>";
$ssw+=$ggwww; 

echo "</div>"; ////////////////////////////////////////////////////////////ffffffffffffffffffffffffffffffffffffffffffffffffffffffff

//echo $ssw;

}while($cap=mysqli_fetch_assoc($con));
    echo "<div style='text-align :center'> Promedio examenes: ".($ssw+$ggg7)."/".($i-1)."=".round(($ssw+$ggg7)/($i-1),3)."</div>";


}else{
    echo "No capitulos";
}




echo "<div style='margin:5px auto;width:90%;;text-align:center;font-size:30px'>TAREAS</div>";


////////////////////////////TAREA

    $calr=mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_SESSION['clave']."'");   
    $acalr=mysqli_fetch_assoc($calr);
    $ncalr=mysqli_num_rows($calr);

    $caw=mysqli_query($link,"SELECT * FROM tareas WHERE clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."' AND idcapitulo='idc'  AND idseccion='ids'");   
    $acaw=mysqli_fetch_assoc($caw);
    $ncaw=mysqli_num_rows($caw);



////////////////////////////TAREA CURSO

echo "<div style='display:block;margin:3px auto;text-align:center;width:95%;border-radius:10px;;border : 0.1em solid'>"; //////////////////////////////////////////////////////////ggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
        echo "<div style='font-weight:bold;' >TAREA DEL CURSO</div>"; 
        echo "<button  style='display:block; margin: auto'  id='".$acalr['idclase']."W'>Ver tarea</button>";
        echo "<div style=display:none; id='".$acalr['idclase']."'>".$acalr['tarea']."</div>";
        ?>
<script>
var button = document.getElementById('<?php echo $acalr['idclase']."W"?>'); 
button.onclick = function() {
    var div = document.getElementById('<?php echo $acalr['idclase']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
        <?php
        
        $not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idseccion ='".$acaw['idseccion']."'");   
        $notw=mysqli_fetch_assoc($not);
        $nnot=mysqli_num_rows($not);
        if($notw['evaluacion']!=""){
            
            echo "<div style='font-weight:bold;color:rgb(10,200,100);'>Nota: ".$notw['evaluacion']."</div>";
          $fgg=$notw['evaluacion'];
        }elseif($nnot>0){ 

          $strStartz = $acalr['time'];
          $datewz = new DateTime($strStartz);
   //       echo date_format(new DateTime("now"), 'd-m-Y H:i:s')."<br>";

        if ($datewz > new DateTime("now")){
            echo "<div style='color:rgb(200,0,100);'>Tarea aún no evaluada</div>";
            echo "<div><a style='text-decoration:none;color:rgb(255,100,100);' href='sendtarea.php?idcpt=idc&idsec=ids'>Modificar</a></div>";
        }else{
            echo "<br>Culminó fecha de entrega de la tarea";   
        }

        }else{

            if ($datewz > new DateTime("now")){
                echo "<div><a style='text-decoration:none;color:rgb(255,100,100);' href='sendtarea.php?idcpt=idc&idsec=ids'>Entregar</a></div>";
                echo "<div>Suba su archivo</div>";
            }else{
                echo "<br>Culminó fecha de entrega de la tarea";   
            }

        }
            echo "</div>"; ////////////////////////////////////////////////////////////////////////////ggggggggggggggggggggggggggggggggggggggggggggggggggg      

////////////////////////////TAREA CURSO




            
    $cal=mysqli_query($link,"SELECT * FROM secciones WHERE secciones.clave ='".$_SESSION['clave']."' ORDER BY clavew ASC");   
    $acal=mysqli_fetch_assoc($cal);
    $ncal=mysqli_num_rows($cal);

if($ncal>0){
    $i=1;
    $suma=0;
    do{
        //tarea
        
        echo "<div style='display:block;margin:3px auto;text-align:center;width:95%;border-radius:10px;border:0.1em solid;'>"; ////////////////////////////////////////////////////////
        
        echo "<div style='font-weight:bold;'>Tarea ".($i)."</div>"; 
        echo "<button style='display:block; margin: auto' id='".$acal['idseccion']."7'>Ver tarea</button>";
        echo "<div style=display:none; id='".$acal['idseccion']."'>".$acal['tarea']."</div>";   
        
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
        
        $not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idseccion ='".$acal['idseccion']."'");   
        $notw=mysqli_fetch_assoc($not);
        $nnot=mysqli_num_rows($not);
          $strStart = $acal['time'];
          $datew = new DateTime($strStart);

        if($notw['evaluacion']!=""){
            $j=1;
            echo "<div style='color:rgb(0,0,255);'>Tarea evaluada</div>";
            echo "<div style='font-weight:bold;color:rgb(10,200,100)'> Nota: ".$notw['evaluacion']."</div>";
            $j++;
            $suma+=$notw['evaluacion'];
        }elseif($nnot>0){ 

//          $dateww = new DateTime("now");
          
//          echo date_format($dateww, 'd-m-Y H:i:s')."--------------------<br>";
if ($datew > new DateTime("now")){
    echo "<div style='color:rgb(0,0,100);'>Tarea aún no evaluada</div>";
    echo "<div><a style='text-decoration:none;color:rgb(255,00,100)display:block;;'  href='sendtarea.php?idcpt=".$acal['clavew']."&idsec=".$acal['idseccion']."'>Modificar</a></div>";
}else{
    echo "Culminó fecha de entrega de la tarea";    
}
            
        
        }else{

            if ($datew > new DateTime("now")){
                echo "<div><a style='text-decoration:none;color:rgb(255,100,100);display:block;' href='sendtarea.php?idcpt=".$acal['clavew']."&idsec=".$acal['idseccion']."'>Entregar</a></div>";
            }else{ 
                echo "Culminó fecha de entrega de la tarea";    
            }
            //            echo "<textarea style='color:rgb(10,105,10)'>Escriba su tarea</textarea>";
//            echo "<div>Suba su archivo</div>";
        }
        echo "</div>";         ////////////////////////////////////////////////////////
        
        $i++;


    }while($acal=mysqli_fetch_assoc($cal));
    echo "<div style='text-align :center'> Promedio tareas: ".($suma+$fgg)."/".($i-1)."=".round(($suma+$fgg)/($i-1),3)."</div>";
}else{
    echo "<div>No hay tareas entregadas</div>";
} 
?>
</div>

<?php 
//}
?>

