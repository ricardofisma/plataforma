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
if(isset($_REQUEST['idtema'])){
    $_SESSION['tema']=$_REQUEST['idtema'];
}
$qtemas=mysqli_query($link,"SELECT * FROM temas WHERE idtema='".$_SESSION['tema']."' ORDER BY fecha ASC");
$ntemas=mysqli_num_rows($qtemas);
$arraytemas=mysqli_fetch_assoc($qtemas);

?>
<?php include('first.php'); ?><?php include('margin.php'); ?>


<script src="jquery-3.0.0.min.js"></script>

<h1 style=' display:flex;    width:90%; margin:;
padding:5px; flex-wrap:wrap;
    align-items: center;  justify-content: center;margin:auto'>Tema actual</h1>

<article class='plan' style=' display:flex;width:90%;padding:5px; flex-wrap:wrap;align-items: center;  justify-content: center'>
<?php echo $arraytemas['tema']; ?>

<?php
    if($arraytemas['file']=='Editar link'){
      ECHO "<iframe src='https://www.youtube.com/embed/zoGqt6ObPC8' style='align:center;display:block;width:95%;margin:auto; height:300px;border-radius:3px;' frameborder='0' allowfullscreen='allowfullscreen'>wwwww</iframe>";
      }else{
        ECHO "<iframe src='".$arraytemas['file']."' style='align:center;display:block;width:100%;height:300px;border-radius:3px;' frameborder='0' allowfullscreen='allowfullscreen'>ww</iframe>";
    }
    ?>
    <h2 style=' display:flex;width:90%;padding:5px; flex-wrap:wrap;align-items: center;justify-content: center;margin:auto'>Ingrese su comentario acerca de este tema</h2>

      <textarea name="comentario" id="comentar" cols="30" rows="3" placeholder="Nuevo comentario"></textarea><br>

    </article>




<script>

$(document).ready(function(){
setInterval(obtener_comentarforo, 10000);
function obtener_comentarforo(){
$.ajax({
url:"comentarforoajax.php",
method:"POST", 
success:function(data){
$("#comentarforo").html(data)
}
})
}


obtener_comentarforo();

//INSERTAR foro
$(document).on("blur", "#comentar", function(){
var clave="<?php echo $_SESSION['clave']?>";
var user="<?php echo $_SESSION['user']?>";
var x1=$(this).val();
$(this).val('');

//   alert(clave);
//   alert(user);
//   alert(x1);
$.ajax({
url:"comentarforoajax.php",
method:"post",
data:{clavew:clave,user:user,x1:x1},
success:function(data){ 
// var audio = new Audio('beep.mp3');
//                audio.play();
obtener_comentarforo();
//   alert(data);
}
})
})
 



//ACTUALIZAR capitulo
function actualizar_datos(id,texto,columna){
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{id: id, texto: texto, columna: columna},
success:function(data){
obtener_comentarforo();
//alert(data);
}})}
//ACTUALIZAR nombre capitulo
$(document).on("blur", "#cpt", function(){
var id=$(this).data("c1");
var x1=$(this).val();
obtener_foro(id, x1,"nombre")
}) 
//ACTUALIZAR descr capitulo
$(document).on("blur", "#cc1", function(){
var id=$(this).data("c1");
var x=$(this).val();
var x1 = x.replace('https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/');
//alert(x1);
//alert(id);
actualizar_datos(id, x1,"descripcion")
})


//ACTUALIZAR foro
function actualizar_datosww(id,texto,columna){
$.ajax({
url:"foroajax.php",
method:"post",
data:{idw: id, textow: texto, columnaw: columna},
success:function(data){
obtener_foro();
alert(data);
}})}
//ACTUALIZAR titulo seccion
$(document).on("blur", "#www", function(){
var id=$(this).data("id");
var x1=$(this).text();
alert(x1);
alert(id);
actualizar_datosww(id, x1,"tema")
})


//ELIMINAR archivos
$(document).on("click", "#delete", function(){
if(confirm("Esta seguro de eliminar esta fila")){
var idw=$(this).data("id");
//alert(idw);
$.ajax({ 
url:"comentarforoajax.php",
method:"post",
data:{id:idw},
success:function(data){
obtener_comentarforo();
//alert(data);
}
})
};
})


});

</script>


<div id ="comentarforo"></div>





<?php include('footer.php');?>
 
 