<?php

require('conect.php');



if(isset($_REQUEST['id'])){
$id=$_POST['id'];
$consulta=mysqli_query($link, "DELETE FROM preguntas WHERE idalternativa=$id");
//mysqli_query($link, "DELETE FROM preguntas WHERE clavepregunta=$id");
//mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
if(!$consulta){
  echo "no ok";
}else{
  echo "ok";
}

}
