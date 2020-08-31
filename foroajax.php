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


if(isset($_REQUEST['idwel'])){
    $u=$_POST['idwel'];
   $consulta= mysqli_query($link, "DELETE FROM temas WHERE idtema='$u'");
    if(!$consulta){
  echo "no ok w";
}else{
  echo "ok w";
}

}

if(isset($_REQUEST['clavew'])){
    $u=$_POST['user'];
    $c=$_POST['clavew'];
    $t=$_POST['x1'];
    $t = mysqli_real_escape_string($link, $t); 
$consulta=mysqli_query($link, "INSERT INTO temas VALUES(NULL, '$c','$u','Editar tema', NULL,'Editar link', 'block')");
if(!$consulta){
  echo "no ok w";
}else{
  echo "ok w";
}
}

//refresh tema
if(isset($_REQUEST['textow'])){
$id=$_POST['idw'];
$texto=$_POST['textow'];
$texto = mysqli_real_escape_string($link, $texto); 
$columna=$_POST['columnaw'];
$consulta=mysqli_query($link,"UPDATE temas SET $columna='$texto' WHERE idtema ='$id'" );
if(!$consulta){
  echo "no ok";
}else{
  echo "ok seccion refresh";
}
}


$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);

$qtemas=mysqli_query($link,"SELECT * FROM temas WHERE clave='".$_SESSION['clave']."'");// ORDER BY fecha DESC");
$ntemas=mysqli_num_rows($qtemas);
$arraytemas=mysqli_fetch_assoc($qtemas);

?>


<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>



<title>Foro de discución</title>

<?php
$con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
    $wew=mysqli_fetch_assoc($con);
    ?>


<h1 style=' display:flex;    width:90%;margin:auto;
padding:5px; flex-wrap:wrap;
    align-items: center;  justify-content: center;'>Foro del curso de <?php echo $wew['nombre']?></h1> 

<?php
if($w['tipo']=='docente'){
  ?>



<button style=' display:flex; margin:auto;   width:90%;
padding:5px; flex-wrap:wrap;
    align-items: center;  justify-content: center;' id="foroww">Agregar tema y editar</button>



<?php
}
if($ntemas>0){
//  $i=1;
  do{
    //     echo "Tema:" .$i."<br>"; 
    if($w['tipo']=='docente'){

    echo "<div style='border:0px solid;padding:0px;width:90%;margin:auto; margin-top:20px'>";
    echo" <button style='background:rgb(255,210,210);border:none;border-radius:5px;padding:5px;cursor:pointer;margin:5px' id='showw' data-id='".$arraytemas['idtema']."' data-sw='none'>Hide</button>";
    echo "<button style='background:rgb(255,210,210);border:none;border-radius:5px;padding:5px;;cursor:pointer;margin:5px' id='showw' data-id='".$arraytemas['idtema']."' data-sw='block'>Show</button>";
    echo "</div>";
    }    
    echo "<div style='border:1px solid;padding:5px;width:90%;display:".$arraytemas['mosesc'].";margin:auto'>";
    if($arraytemas['file']=='Editar link'){
      ECHO "<iframe src='https://www.youtube.com/embed/zoGqt6ObPC8' style='align:center;display:block;width:95%;margin:auto; height:300px;border-radius:3px;' frameborder='0' allowfullscreen='allowfullscreen'>wwwww</iframe>";
      }else{
      ECHO "<iframe src='".$arraytemas['file']."' style='align:center;display:block;width:100%;height:300px;border-radius:3px;' frameborder='0' allowfullscreen='allowfullscreen'>ww</iframe>";
    }
     if($w['tipo']=='docente'){
     echo "<article class='plan' style='padding:5px;text-align:center;' contenteditable id='link' data-id='".$arraytemas['idtema']."'>".$arraytemas['file']."</article>";
     }
     echo "<article class='plan' style='padding:5px;text-align:center;' contenteditable id='www' data-id='".$arraytemas['idtema']."'>".$arraytemas['tema']."</article>";
     echo " [ <span>Fecha: </span>".$arraytemas['fecha']." ]";
     if($w['tipo']=='docente'){
echo " <a style='cursor:pointer;color:red;' id='del' data-id='".$arraytemas['idtema']."'> -Eliminar tema-</a>";
}
echo "[<a href='comentarforo.php?idtema=".$arraytemas['idtema']."'> Comentar</a> ]";
$cc=mysqli_num_rows(mysqli_query($link,"SELECT * FROM comentarios WHERE idtema=".$arraytemas['idtema']));
echo "[ ".$cc." comentarios ]";
echo "</div>";
//$i++;
}while($arraytemas=mysqli_fetch_assoc($qtemas));
}else{
echo "No hay temas";
}
?>

