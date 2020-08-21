<?php

require('conect.php');

 if(isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])){
    $_SESSION['clave']=$_REQUEST['clave'];
  }



//tiempo de examen capitulo
if(isset($_REQUEST['clavef'])){
$ext=$_POST['ext']; 
$clave=$_POST['clavef'];
$idc=$_POST['idc'];
echo $idc; 
$consulta=mysqli_query($link,"UPDATE capitulo SET timex = '$ext' WHERE idcapitulo = '$idc' AND clave = '$clave'");
if(!$consulta){
  echo "no ok w";
}else{
  echo "ok w";
}
} 



//tiempo de examen curso
if(isset($_REQUEST['clavw'])){
$ext=$_POST['ext']; 
$cl=$_POST['clavw'];
$consulta=mysqli_query($link,"UPDATE clase SET timex = '$ext' WHERE clave = '$cl'");
if(!$consulta){
  echo "no ok w";
}else{
  echo "ok w";
}
} 

//tiempo de entrega tarea 
if(isset($_REQUEST['claveff'])){
$cl=$_POST['claveff'];
$tm=$_POST['extff'];
$consulta=mysqli_query($link,"UPDATE clase SET time = '$tm' WHERE clave = '$cl'");
if(!$consulta){
  echo "no ok w";
}else{
  echo "ok w";
}
} 

//insert capitulo
if(isset($_REQUEST['clavew'])){
$clave=$_POST['clavew'];

$consulta=mysqli_query($link,"INSERT INTO capitulo VALUES(NULL, 'Edite el nombre del capitulo', 'Edite la descripcion', '$clave','Edite la tarea','2020-08-18 12:26:31')");
if(!$consulta){
  echo "no okewewe";
}else{
  echo "ok refresh CAPITULO";
}

} 



//refresh capitulo
if(isset($_REQUEST['texto'])){
$id=$_POST['id'];
$texto=$_POST['texto'];
$texto = mysqli_real_escape_string($link, $texto); 
$columna=$_POST['columna'];
$consulta=mysqli_query($link,"UPDATE capitulo SET $columna='$texto' WHERE idcapitulo =$id");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok chp";
}
}

//refresh clase
if(isset($_REQUEST['idclase'])){
$id=$_POST['idclase'];
$texto=$_POST['textoc'];
$texto = mysqli_real_escape_string($link, $texto); 
$columna=$_POST['columnac'];
$consulta=mysqli_query($link,"UPDATE clase SET $columna='$texto' WHERE idclase =$id");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok clase";
}
}

//insert seccion
if(isset($_REQUEST['clavewws'])){
$clave=$_POST['clavewws'];
$idcapitulo=$_POST['id'];
$consulta=mysqli_query($link,"INSERT INTO secciones VALUES(NULL, 'Edite el nombre de la seccion', 'Edite el contenido', '$idcapitulo', 'Edite tarea', '$clave', '2021-05-11 19:30:50')");
if(!$consulta && !$consulta){
  echo "no okewewe";
}else{
  echo "ok seccion creada";
}

}

//refresh seccion
if(isset($_REQUEST['textow1'])){
$id=$_POST['idw1'];
$texto=$_POST['textow1'];
$texto = mysqli_real_escape_string($link, $texto); 
$columna=$_POST['columnaw1'];
$consulta=mysqli_query($link,"UPDATE secciones SET $columna='$texto' WHERE idseccion =$id");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok seccion refresh";
}
}


//delete capitulo
if(isset($_REQUEST['ideletew'])){
$id=$_POST['ideletew'];
$consulta=mysqli_query($link, "DELETE FROM capitulo WHERE idcapitulo=$id");
$consulta=mysqli_query($link, "DELETE FROM secciones WHERE clavew=$id");
$consulta=mysqli_query($link, "DELETE FROM tareas WHERE clavew=$id");
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok delete CAPITULO";
}

}

//delete capitulo
if(isset($_REQUEST['ideleteww'])){
$id=$_POST['ideleteww'];
$consulta=mysqli_query($link, "DELETE FROM secciones WHERE idseccion=$id");
$consulta=mysqli_query($link, "DELETE FROM tareas WHERE idplan = $id");
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok delete seccion";
}

}


//delete archivos 
if(isset($_REQUEST['ideletewww'])){
$ff=$_REQUEST['ideletewww'];
$n=$_REQUEST['name'];
$consulta = mysqli_query($link,"DELETE FROM archivos WHERE idarchivo='$ff'");
unlink('archivosclase/'.$ff.$n);
if(!$consulta){
  echo "no ok";
}else{
  echo "ok delete seccion";
}

}

//upload.php

if(isset($_FILES["file"])){
//$na=$_FILES['file'];
$clave=$_POST['claves'];
$user=$_POST['user'];
//echo $user;
$na=$_FILES['file']['name'];echo $na;
$tipo=$_FILES['file']['type'];
$t=$_FILES['file']['size'];
$consulta=mysqli_query($link,"INSERT INTO archivos VALUES(NULL, '$na','$tipo','$t','$clave','$user')");
$idarchivo=mysqli_insert_id($link);
copy($_FILES['file']['tmp_name'],"archivosclase/".$idarchivo.$na);
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}

}
