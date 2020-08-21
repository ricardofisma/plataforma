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


if($w['tipo']=='docente'){


echo "</article>";

echo "<h1 >Calificaciones del curso ".$wew['nombre']."</h1>";

    echo "<div style= 'display:flex;width:100%;flex-wrap:wrap;align-items: center;  justify-content: center;'>";
if($nm>0){
    do{
//datos
echo "<div  class='imagen' style='text-align:center;width:70%;border-radius:10px;margin:5px;background-color: rgb(10, 100, 90)'>";                                        //1

echo "<div class='wrapper' style='margin:5px auto;' ><img src= 'archivos/".$estudiant['usuario']."".$estudiant['foto']."' onerror=this.src='foto.png'></div>";
echo "<h1 style='border-radius:2px;margin-bottom:5px;width:70%;margin:auto;;background:rgb(250,255,255);font-size:19px;'>" .$estudiant['nombre']. "</h1>";

//examen general

echo "<div  class='imagen' style='display:block;margin:3px auto;text-align:center;width:70%;border-radius:10px;;background-color: rgb(310, 100, 200)'>";  // ff


////////////////////////////////////////////////////////////notas 



$con=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
$ncap=mysqli_num_rows($con);
$cap=mysqli_fetch_assoc($con);

////////curso
echo "<div style='background:rgb(100,100,200);'>Examen del curso</div>";

$rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$estudiant['idusuario']."' AND idcapitulo='cpt')");
$row = mysqli_fetch_assoc($rw);
$sum = $row['sum'];
//
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt='cpt'");
$roww = mysqli_fetch_assoc($rww); 

$sumw = $roww['sumw'];
$ggg=$sumw+$sum;

echo "Alternativas: ".$sum." -- ";
echo "Escrito: ".$sumw;

echo "<div style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(100,100,100);'><p>Total ".$ggg." puntos </p></div>";

$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."'  AND idcpt='cpt'");
$escritow = mysqli_fetch_assoc($escrito); 
$nescr=mysqli_num_rows($escrito);

if ($nescr>0) {
do{
    $max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idpregunta='".$escritow['clavepregunta']."'");
    $maxx = mysqli_fetch_assoc($max);
    echo "<div style='display:inline-block'>
    <div style='color:rgb(200,255,255);background:rgb(0,10,90);width:30px;display:inline-block;border-radius:5px;' id='fff' data-fffff='".$escritow['idrespuestas']."' data-user='".$escritow['usuario']."' contenteditable>".$escritow['escritanota']."</div>
    (Puntos max: ".$maxx['calificativo'].")</div>";
    echo "<div style='background:rgb(255,255,225); border-radius:0.2em;;margin:5px; padding:5px;'>".$escritow['respuesta']."".$escritow['clavepregunta']."</div>";
}while($escritow = mysqli_fetch_assoc($escrito));
}else{ 
    echo "<div style='color:rgb(200,10,10);'>No hay preguntas escritas</div>";
}
/////////curso


if($ncap>0){
    do{
//        echo "<div style='background:rgb(100,10,100);width:95%;margin:auto;'>";
        
echo "<div style='background:rgb(100,10,200);'>Examen de ".$cap['nombre']." ".$cap['idcapitulo']."</div>";
//
$rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$estudiant['idusuario']."' AND idcpt='".$cap['idcapitulo']."')");
$row = mysqli_fetch_assoc($rw);
$sum = $row['sum'];
//
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt='".$cap['idcapitulo']."'");
$roww = mysqli_fetch_assoc($rww); 

$sumw = $roww['sumw'];
$ggg=$sumw+$sum;

echo "Alternativas: ".$sum." -- ";
echo "Escrito: ".$sumw;

echo "<div style='margin:5px auto;width:90%;color:rgb(255,255,255);text-align:center;background:rgb(100,100,100);'><p>Total ".$ggg." puntos </p></div>";

$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt=".$cap['idcapitulo']."");
$escritow = mysqli_fetch_assoc($escrito); 
$nescr=mysqli_num_rows($escrito);


if ($nescr>0) {
    do{
        
        $max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idpregunta='".$escritow['clavepregunta']."'");
        $maxx = mysqli_fetch_assoc($max); 
        
        echo "<div style='display:inline-block;'><div style='color:rgb(200,200,200);background:rgb(0,10,90);width:30px;display:inline-block;border-radius:5px;' id='fff' data-fffff='".$escritow['idrespuestas']."' data-user='".$escritow['usuario']."' contenteditable>".$escritow['escritanota']."</div>   (Puntos max: ".$maxx['calificativo'].")</div>";
        echo "<div style='background:rgb(255,255,225); border-radius:0.2em;;margin:5px; padding:5px;'>".$escritow['respuesta']."</div>";
        //        echo "</div>";
    }while($escritow = mysqli_fetch_assoc($escrito));
    
    
}else{ 
    echo "<div style='color:rgb(200,10,10);'>No hay preguntas escritas</div>";
}


////////////////////////////////////////////////////////////



}while($cap=mysqli_fetch_assoc($con));



}else{
    echo "No capitulos";
}



echo "</div>";                                                                                                                                           // ff






//tarea


    $cal=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");   
    $acal=mysqli_fetch_assoc($cal);
    $ncal=mysqli_num_rows($cal);
    $caw=mysqli_query($link,"SELECT * FROM tareas WHERE clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."' AND idcapitulo='idc'  AND idseccion='ids'");   
    $acaw=mysqli_fetch_assoc($caw);
    $ncaw=mysqli_num_rows($caw);
    

 

////////////////////////////TAREA CURSO

echo "<div style='display:block;margin:3px auto;text-align:center;width:70%;border-radius:10px;;background-color: rgb(255, 210, 185)'>";                       //3

        echo "<div>Tarea DEL CURSO</div>"; 
        echo "<button id='".$acaw['idseccion']."7'>Ver tarea</button>";
        echo "<div style=display:none; id='".$acaw['idseccion']."'>".$acal['tarea']."</div>";
        ?>
<script>
var button = document.getElementById('<?php echo $acaw['idseccion']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $acaw['idseccion']?>');
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
            
            echo "<div>".$notw['evaluacion']."</div>";
            
        }elseif($nnot>0){ 
            echo "<div style='background:rgb(200,200,100);width:300px;margin:auto;' id='nota' data-nota='".$notw['idtarea']."' contenteditable>".$notw['evaluacion']."</div>";    
            echo "<div style='color:rgb(200,0,100);'>Tarea aún no evaluada</div>";
            echo "<div><a style='text-decoration:none;color:rgb(255,100,100);' href='updatetarea.php?claveww=".$acaw['idseccion']."'>Modificar</a></div>";
        }else{
            echo "<div style='background:rgb(200,200,100);width:300px;margin:auto;' id='nota' data-nota='".$notw['idtarea']."' contenteditable>".$notw['evaluacion']."</div>";    
            echo "<div><a style='text-decoration:none;color:rgb(255,100,100);' href='sesion.php?claveww=".$acaw['idseccion']."'>Entregar</a></div>";
            echo "<div>Suba su archivo</div>";
        
        }
            echo "</div>";      

////////////////////////////TAREA CURSO

echo "<div  class='imagen' style='display:block;margin:3px auto;text-align:center;width:70%;border-radius:10px;;background-color: rgb(255, 250, 255)'>";                       //3

$cal=mysqli_query($link,"SELECT * FROM secciones WHERE clave ='".$_SESSION['clave']."'");   
$acal=mysqli_fetch_assoc($cal);
$ncal=mysqli_num_rows($cal);

if($ncal>0){
    $i=1;
    $suma=0;
    do{
        //
        echo "<div  class='imagen' style='display:block;margin:3px auto;text-align:center;width:70%;border-radius:10px;;background-color: rgb(200, 200, 200)'>";               //5
        echo "<div>Tarea ".($i)."</div>";
        echo "<button id='".$acal['idseccion'].$estudiant['email']."7'>Ver tarea encargada</button>";
         echo "<div style='display:none;' id='".$acal['idseccion'].$estudiant['email']."'>".$acal['tarea']."</div>";
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
echo "</div>";                                                                                                                                                                //5

$not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$estudiant['usuario']."' AND idseccion ='".$acal['idseccion']."'");   
$notw=mysqli_fetch_assoc($not);

$nnot=mysqli_num_rows($not);
if($notw['evaluacion']!=""){
    echo "<div style=display:; id='".$i."zz'>".$notw['texto']."</div>";   
            $j=1;
echo "<div style='background:rgb(200,200,100);width:300px;margin:auto;' id='nota' data-nota='".$notw['idtarea']."' contenteditable>".$notw['evaluacion']."</div>";    
echo "<div style='padding:3px;background:rgb(255,200,200);width:200px;margin:auto;'><a style=' color: rgb(50,5,70); margin: 10px;text-decoration:none' target='_blank' href='archivostarea/".$acal['idseccion']."_".$notw['archivo']."'>Descargar archivo</a></div>";    
            $j++;
            $suma+=$notw['evaluacion'];
   
//             echo "<button id='".$i."z'>Ver</button>"; 
    //echo "<div >".$acal['tarea']."</div>";   
            }elseif($nnot>0){
    echo "<button id='".$i."z'>Ver tarea entregada</button>"; 
    echo "<div style=display:none; id='".$i."zz'>".$notw['texto']."</div>";    
echo "<div style='padding:3px;background:rgb(255,200,200);width:200px;margin:auto;'><a style=' color: rgb(50,5,70); margin: 10px;text-decoration:none' target='_blank' href='archivostarea/".$acal['idseccion']."_".$notw['archivo']."'>Descargar archivo</a></div>";    

echo "<div style='background:rgb(200,200,100);width:300px;margin:auto;' id='nota' data-nota='".$notw['idtarea']."' contenteditable>".$notw['evaluacion']."</div>";    
    echo "<div style='color:rgb(200,0,100);'>No evaluada</div>";
//echo "<div style='background:rgb(200,200,100);width:300px;margin:auto ;' contenteditable>".$notw['evaluacion']."</div>";    
//      echo "<input style='width:38px' type='text' name='nota' placeholder='nota' >";
    
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

    

}else{
    echo "No entregada";
}
$i++;
}while($acal=mysqli_fetch_assoc($cal));

echo "<div> Promedio: \(\\frac{".$suma."}{".($i-1)."}=".round($suma/($i-1),3)."\)</div>";

}else{
    echo "No hay clases creadas";
}

echo "</div>";                                                                                                                                                                  //3
//






echo "</div>";                                                                                                                                                                  //1





}while($estudiant=mysqli_fetch_assoc($estudian));

}else{
    echo "No hay inscritos";
}
echo "</article>";














}else{//estudiante
    
    
    $con=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
    $ncap=mysqli_num_rows($con);
    $cap=mysqli_fetch_assoc($con);
    echo "<article class='imagen' style='text-align:center;width:70%;border-radius:10px;margin:5px;background-color: rgb(255, 200,200);margin:auto;>";
////////curso
echo "<div style='background:rgb(255,255,105); border-radius:0.2em;;margin:auto; padding:5px;width:100%;'>Examen del curso</div>";

$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."'  AND idcpt='cpt'");
$escritow = mysqli_fetch_assoc($escrito); 
$nescr=mysqli_num_rows($escrito);

if ($nescr>0) {
do{
    echo "<div style='background:rgb(255,255,225); border-radius:0.2em;;margin:5px; padding:5px;'>".$escritow['respuesta']."</div>";
    
    $max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idpregunta='".$escritow['clavepregunta']."'");
    $maxx = mysqli_fetch_assoc($max); 
    
    echo "<div style='display:inline-block;background:rgb(0,10,90);border-radius:5px;color:white;padding:3px;'>".$escritow['escritanota']." (Puntos max: ".$maxx['calificativo'].")</div>";
}while($escritow = mysqli_fetch_assoc($escrito));
}else{ 
    echo "<div style='color:rgb(200,200,200);'>Este examen no contiene preguntas escritas</div>";
}

$rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$estudiant['idusuario']."' AND idcapitulo='cpt')");
$row = mysqli_fetch_assoc($rw);
$sum = $row['sum'];
//
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt='cpt'");
$roww = mysqli_fetch_assoc($rww); 

$sumw = $roww['sumw'];
$ggg=$sumw+$sum;

echo "<br><span style='margin:5px auto;width:90%;color:rgb(255,255,25);'>Escrito: ".$sumw." -- Alternativas: ".$sum."</span>";

echo "<div style='margin:5px auto;width:90%;color:rgb(255,150,200);text-align:center;background:rgb(100,100,100);'><p>Total ".$ggg." puntos </p></div>";
/////////curso


 
if($ncap>0){
    $i=1;
    do{
        echo "<div style='background:rgb(100,200,200);width:100%;margin:auto; padding:5px;display:block;border-radius:3px;'>";          /////////////
echo "<div style='background:rgb(255,255,105); border-radius:0.2em;;margin:auto; padding:5px;width:100%;'>Examen de ".$cap['nombre']." (Capitulo ".$i.")</div>";
//

$i++;
$escrito=mysqli_query($link,"SELECT * FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$_SESSION['user']."' AND idcpt='".$cap['idcapitulo']."'");
$escritow = mysqli_fetch_assoc($escrito); 
$nescr=mysqli_num_rows($escrito);


if ($nescr>0) {
    do{
        echo "<div style='background:rgb(255,255,255); border-radius:0.2em;margin:5px; padding:5px;'>".$escritow['respuesta']."</div>";
        
        $max=mysqli_query($link,"SELECT * FROM  examen WHERE  tipo = 'escrita' AND idpregunta='".$escritow['clavepregunta']."'");
        $maxx = mysqli_fetch_assoc($max); 
            echo "<div style='display:inline-block;background:rgb(0,10,90);border-radius:5px;color:white;padding:3px;'>".$escritow['escritanota']." (Puntos max: ".$maxx['calificativo'].")</div>";
        }while($escritow = mysqli_fetch_assoc($escrito));
        
        
    }else{ 
        echo "<div style='color:rgb(200,200,200);'>Este examen no contiene preguntas escritas ".$cap['idcapitulo']."--".$estudiant['idusuario']."--".$_SESSION['clave']."</div>";
    }
    
    $rw=mysqli_query($link,"SELECT SUM(calificativo) AS sum FROM examen WHERE idpregunta IN (SELECT preguntas.clavepregunta FROM  preguntas, respuestas 
WHERE preguntas.idalternativa=respuestas.idalternativa AND preguntas.rpta=respuestas.respuesta AND usuario='".$estudiant['idusuario']."' AND idcpt='".$cap['idcapitulo']."')");
$row = mysqli_fetch_assoc($rw);
$sum = $row['sum'];
//
$rww=mysqli_query($link,"SELECT SUM(escritanota) AS sumw FROM  respuestas WHERE  idalternativa = '0' AND clavecurso ='".$_SESSION['clave']."' AND usuario ='".$estudiant['idusuario']."' AND idcpt='".$cap['idcapitulo']."'");
$roww = mysqli_fetch_assoc($rww); 

$sumw = $roww['sumw'];
$ggg=$sumw+$sum;

echo "<br><span style='margin:5px auto;width:90%;color:rgb(255,255,25);'>Escrito: ".$sumw." -- Alternativas: ".$sum."</span>";

echo "<div style='margin:5px auto;width:90%;color:rgb(255,150,200);text-align:center;background:rgb(100,100,100);'><p>Total ".$ggg." puntos </p></div>";

echo "</div><br>";
////////////////////////////////////////////////////////////



}while($cap=mysqli_fetch_assoc($con));



}else{
    echo "No capitulos";
}

  echo "</article>";  

























































    $calr=mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_SESSION['clave']."'");   
    $acalr=mysqli_fetch_assoc($calr);
    $ncalr=mysqli_num_rows($calr);


    $caw=mysqli_query($link,"SELECT * FROM tareas WHERE clave='".$_SESSION['clave']."' AND usuario='".$_SESSION['user']."' AND idcapitulo='idc'  AND idseccion='ids'");   
    $acaw=mysqli_fetch_assoc($caw);
    $ncaw=mysqli_num_rows($caw);
    

   

ECHO "<article class='imagen' style='display:block;margin:3px auto;text-align:center;width:70%;border-radius:10px;'>";






////////////////////////////TAREA CURSO

echo "<div style='display:block;margin:3px auto;text-align:center;width:70%;border-radius:10px;;background-color: rgb(255, 210, 185)'>";                       //3

        echo "<div>TAREA DEL CURSO</div>"; 
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
            
            echo "<div>".$notw['evaluacion']."</div>";
          
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
            echo "</div>";      

////////////////////////////TAREA CURSO




            
    $cal=mysqli_query($link,"SELECT * FROM secciones WHERE secciones.clave ='".$_SESSION['clave']."' ORDER BY clavew ASC");   
    $acal=mysqli_fetch_assoc($cal);
    $ncal=mysqli_num_rows($cal);

if($ncal>0){
    $i=1;
    $suma=0;
    do{
        //tarea
        
        echo "<div style='display:block;margin:3px auto;text-align:center;width:70%;border-radius:10px;;background-color: rgb(255, 210, 185)'>";                       //3
        
        echo "<div>Tarea ".($i)."</div>"; 
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
            echo "<div> Nota: ".$notw['evaluacion']."</div>";
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
                echo "<div><a style='text-decoration:none;color:rgb(255,100,100);dispaly:block;' href='sendtarea.php?idcpt=".$acal['clavew']."&idsec=".$acal['idseccion']."'>Entregar</a></div>";
            }else{
                echo "Culminó fecha de entrega de la tarea";    
            }
            //            echo "<textarea style='color:rgb(10,105,10)'>Escriba su tarea</textarea>";
//            echo "<div>Suba su archivo</div>";
        }
        
        $i++;
        echo "</div>";         
    }while($acal=mysqli_fetch_assoc($cal));
    echo "<div> Promedio: ".$suma."/".($i-1)."=".round($suma/($i-1),3)."</div>";
}else{
    echo "<div >No hay tareas entregadas</div>";
} 
?>
</div>

<?php 
}
?>

</article>


