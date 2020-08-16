<?php

require('conect.php');


if(isset($_REQUEST['userr'])){
$cc=$_POST['clavecurso'];
$cp=$_POST['clavepreg'];
$cpw=$_POST['clavepregw'];
$user=$_POST['userr'];

$conz= mysqli_query($link,"SELECT * FROM respuestas WHERE clavepregunta='$cpw' AND usuario='$user'");
$zz=mysqli_fetch_assoc($conz);
$nw=mysqli_num_rows($conz);

$conz2= mysqli_query($link,"SELECT * FROM preguntas WHERE clavepregunta='$cpw'");
$zz2=mysqli_fetch_assoc($conz2);
$nw2=mysqli_num_rows($conz2);

if($nw!==$nw2){ 
$consulta=mysqli_query($link,"DELETE FROM respuestas WHERE clavepregunta='$cpw' AND usuario='$user'");
$consulta=mysqli_query($link, "INSERT INTO respuestas (idrespuestas, usuario, clavecurso, clavepregunta,  idalternativa, respuesta, escritanota, idcpt) SELECT NULL, '$user', '$cc', '$cpw',  idalternativa, respuesta, NULL, idcapitulo FROM preguntas WHERE clavepregunta='$cpw'");
$consulta=mysqli_query($link,"UPDATE respuestas SET respuesta= 'correcta' WHERE idalternativa='$cp' AND usuario='$user'");
if(!$consulta){
  echo "no ok alt";
}else{
  echo "ok insert ALT";
}
}else{
$consulta=mysqli_query($link,"UPDATE respuestas SET respuesta= 'incorrecta' WHERE clavepregunta='$cpw' AND usuario='$user'");
$consultaw=mysqli_query($link,"UPDATE respuestas SET respuesta= 'correcta' WHERE idalternativa='$cp' AND usuario='$user'");
if(!$consulta && !$consultaw){
  echo "no ok";
}else{
  echo "ok refreshw";
}
}

}



if(isset($_REQUEST['userrw'])){
  
  
  $cc=$_POST['clavecursow'];
$cp=$_POST['clavepregw'];
$text=$_POST['x3w'];
$user=$_POST['userrw'];
$idcpt=$_POST['idcpt'];

$conzw= mysqli_query($link,"SELECT * FROM respuestas WHERE clavepregunta='$cp' AND usuario='$user'  AND idcpt='$idcpt'");
$nww=mysqli_num_rows($conzw);
$zzw=mysqli_fetch_assoc($conzw);
echo $nww;   
if($nww==0){ 
$consulta=mysqli_query($link, "INSERT INTO respuestas VALUES(NULL, '$user','$cc', '$cp', '0', '$text', NULL, '$idcpt')");
if(!$consulta && !$consulta){
  echo "no okwww";
}else{
  echo "ok insert";
}

}else{
$consulta=mysqli_query($link,"UPDATE respuestas SET respuesta= '$text' WHERE clavepregunta='$cp' AND usuario='$user'  AND idcpt='$idcpt'");
if(!$consulta && !$consulta){
  echo "no okewewe";
}else{
  echo "ok refreshwwwwwwww";
}

}


}





//nota
if(isset($_REQUEST['ids'])){
  
  
$text=$_POST['x3'];
$ids=$_POST['ids'];


$consulta=mysqli_query($link,"UPDATE tareas SET evaluacion = '$text' WHERE idtarea = '$ids'");// AND usuario='$user'  AND idcpt='$idcpt'");
if(!$consulta && !$consulta){
  echo "no okewewe";
}else{
  echo "ok refreshwwwwwwww";
}



}



if(isset($_REQUEST['xww'])){
$user=$_POST['userww'];
$cp=$_POST['clavepregw'];
$nota=$_POST['xww'];

$consulta=mysqli_query($link,"UPDATE respuestas SET escritanota= '$nota' WHERE idrespuestas='$cp' AND usuario='$user'");
if(!$consulta && !$consulta){
  echo "no okewewe";
}else{
  echo "ok refresh nota";
  echo $cp;
}



}
