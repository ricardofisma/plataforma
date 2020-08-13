<?php

require('conect.php');

 if(isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])){
    $_SESSION['clave']=$_REQUEST['clave'];
  }


//insert capitulo
if(isset($_REQUEST['clavew'])){
$clave=$_POST['clavew'];

$consulta=mysqli_query($link,"INSERT INTO capitulo VALUES(NULL, 'Edite el nombre del capitulo', 'Edite la descripcion', '$clave','Edite la tarea')");
if(!$consulta && !$consulta){
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
  echo "ok";
}
}

//insert seccion
if(isset($_REQUEST['clavewws'])){
$clave=$_POST['clavewws'];
$idcapitulo=$_POST['id'];
$consulta=mysqli_query($link,"INSERT INTO secciones VALUES(NULL, 'Edite el nombre de la seccion', 'Edite el contenido', '$idcapitulo', 'Edite tarea', '$clave')");
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
