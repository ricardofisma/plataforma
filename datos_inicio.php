<?php
require('conect.php');

//insert curso
if(isset($_REQUEST['clavecurso'])){

    $str= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $cad="";
    for($i=0;$i<11;$i++){
      $cad .=substr($str,rand(0,62),1);
    }
$user=$_POST['clavecurso'];
$categoria=$_POST['clavvcategoria']; 
echo $user;
$consulta=mysqli_query($link,"INSERT INTO clase VALUES(NULL, 'Nombre','$cad', '$user', NULL, 'foto' , '250', 'Descripción', 'Link video', '$categoria','Edite la tarea del curso', NULL, NULL)");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}
}

//insert categoria
if(isset($_REQUEST['clavewc'])){

    $str= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $cad="";
    for($i=0;$i<11;$i++){
      $cad .=substr($str,rand(0,62),1);
    }
$user=$_POST['clavewc'];
$consulta=mysqli_query($link,"INSERT INTO categoria VALUES(NULL, 'Nombre','Descripcion','rgb(10,10,100)' , '$cad', '$user')");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}
}
 

//actualizar clase foto perfil
 if(isset($_REQUEST['image']))
 {
 $nombre=$_FILES['image']['name'];
echo $nombre;
  $identificador=$_POST["image_id"];
$query = mysqli_query($link,"UPDATE clase SET foto='$nombre' WHERE idclase =$identificador");
$idarchivo=mysqli_insert_id($link);
copy($_FILES['image']['tmp_name'],"archivos/".$identificador.$nombre);
 if(!$query){
  echo "no ok";
}else{
  echo "ok";
}
}

//actualizar clase foto
 if(isset($_REQUEST['action']))
 {
 $nombre=$_FILES['image']['name'];
echo $nombre;
  $identificador=$_POST["image_id"];
  $idcurso=$_POST["wimage_id"];
$query = mysqli_query($link,"UPDATE clase SET foto='$nombre' WHERE idclase =$identificador");
$idarchivo=mysqli_insert_id($link);
copy($_FILES['image']['tmp_name'],"archivoscrearclase/".$idcurso."_".$identificador."_".$nombre);
 if(!$query){
  echo "no ok";
}else{
  echo "ok";
}
}


//refresh categoria
if(isset($_REQUEST['wtextt'])){
$id=$_POST['widd'];
$text=$_POST['wtextt'];
$text = mysqli_real_escape_string($link, $text); 
$columna=$_POST['wcolumnn'];
$consulta=mysqli_query($link,"UPDATE categoria SET $columna='$text' WHERE id =$id");
if(!$consulta){
  echo "wwzzz";
}else{
  echo "zzz";
}
}



//refresh cursos
if(isset($_REQUEST['text'])){
$id=$_POST['id'];
$text=$_POST['text'];
$text = mysqli_real_escape_string($link, $text); 
$columna=$_POST['column'];
$consulta=mysqli_query($link,"UPDATE clase SET $columna='$text' WHERE idclase =$id");
$consulta=mysqli_query($link,"UPDATE misclases SET $columna='$text' WHERE curso =$id");
mysqli_query($link, "UPDATE land SET  archivo = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
if(!$consulta){
  echo "ww";
}else{
  echo "zzz";
}
}


//delete categoria
if(isset($_REQUEST['delet'])){
  $id=$_POST['delet'];
  echo $id;
$wr=mysqli_query($link,"SELECT * FROM clase WHERE idclase='$id'");
//$wr=mysqli_num_rows($wr);
$wrw=mysqli_fetch_assoc($wr);

$consulta=mysqli_query($link, "DELETE FROM categoria WHERE id='$id'");
$consulta=mysqli_query($link, "DELETE FROM clase WHERE categoria='$id'");
$consulta=mysqli_query($link, "DELETE FROM misclases WHERE categoria='$id'");
//array_map('unlink', glob('archivoscrearclase/'.$id.'*'));
    array_map('unlink', glob("archivoscrearclase/".$id."_*"));
//unlink('archivoscrearclase/'.$id.'_*');
//$consulta=mysqli_query($link, "DELETE FROM secciones WHERE clavew=$id");
//$consulta=mysqli_query($link, "DELETE FROM tareas WHERE clavew=$id");
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok delete";
}
 
}


//delete curso
if(isset($_REQUEST['deletw'])){
  $id=$_POST['deletw'];
  $idc=$_POST['idc'];
$wr=mysqli_query($link,"SELECT * FROM clase WHERE idclase='$id'");
//$wr=mysqli_num_rows($wr);
$wrw=mysqli_fetch_assoc($wr);
  echo $wrw['foto'];
//$consulta=mysqli_query($link, "DELETE FROM categoria WHERE clavv='$id'");
$consulta=mysqli_query($link, "DELETE FROM clase WHERE idclase='$id'");
unlink('archivoscrearclase/'.$idc."_".$id."_".$wrw['foto']);
//$consulta=mysqli_query($link, "DELETE FROM secciones WHERE clavew=$id");
//$consulta=mysqli_query($link, "DELETE FROM tareas WHERE clavew=$id");
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok deletecurso";
}

}