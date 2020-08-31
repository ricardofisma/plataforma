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
  

  
  if(isset($_REQUEST['clave']) && !empty($_REQUEST['clave'])){
    $_SESSION['clave']=$_REQUEST['clave'];
  }





if(isset($_REQUEST['subir']) && !empty($_REQUEST['subir'])){
$clave=$_SESSION['clave'];
$user=$_SESSION['user'];
$na=$_FILES['archivo']['name'];
$tipo=$_FILES['archivo']['type'];
$t=$_FILES['archivo']['size'];
mysqli_query($link,"INSERT INTO archivos VALUES(NULL, '$na','$tipo','$t','$clave','$user')");
$idarchivo=mysqli_insert_id($link);
copy($_FILES['archivo']['tmp_name'],"archivosclase/".$idarchivo.$na);
}


if(isset($_REQUEST['eliminararchivos'])){
    mysqli_query($link,"DELETE FROM archivos WHERE idarchivo=".$_REQUEST['eliminararchivos']);
    header("Location:archivos.php");
}

    ?>

<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

                <script>
                        CKEDITOR.replace( 'editor' );
                </script>


<script src="jquery-3.0.0.min.js"></script>



<script>


$(document).ready(function(){
function obtener_capitulos(){
$.ajax({
url:"mostrar_capitulos.php",
method:"POST", 
success:function(data){
$("#resultadocapitulo").html(data)
}
})
}
obtener_capitulos();

//INSERTAR CAPITULOS
$(document).on("click", "#addcapitulos", function(){
var clave="<?php echo $_SESSION['clave']?>";
//   alert(clave);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{clavew:clave},
success:function(data){ 
obtener_capitulos();
//   alert(data);
}
})
})
 
//INSERTAR secciones
$(document).on("click", "#addsecciones", function(){
var claves="<?php echo $_SESSION['clave']?>";
var id=$(this).data("c1");
//   alert(id);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{clavewws:claves, id:id},
success:function(data){ 
obtener_capitulos();
//   alert(data);
}})})


//ACTUALIZAR tarea clase
function actualizar_clase(id,texto,columna){
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{idclase: id, textoc: texto, columnac: columna},
success:function(data){ 
obtener_capitulos();
//alert(data);
}})}
$(document).on("blur", "#clase", function(){
var id=$(this).data("c1");
var x1=$(this).val();
//alert(x1);
actualizar_clase(id, x1,"tarea")
}) 

//ACTUALIZAR capitulo
function actualizar_datos(id,texto,columna){
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{id: id, texto: texto, columna: columna},
success:function(data){
obtener_capitulos();
//alert(data);
}})}
//ACTUALIZAR nombre capitulo
$(document).on("blur", "#cpt", function(){
var id=$(this).data("c1");
var x1=$(this).val();
actualizar_datos(id, x1,"nombre")
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



//ACTUALIZAR seccion
function actualizar_datosww(id,texto,columna){
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{idw1: id, textow1: texto, columnaw1: columna},
success:function(data){
obtener_capitulos();
//alert(data);
}})}
//ACTUALIZAR titulo seccion
$(document).on("blur", "#wsec", function(){
var id=$(this).data("c1");
var x1=$(this).text();
//alert(x1);
//alert(id);
actualizar_datosww(id, x1,"nombre")
})
//
//ACTUALIZAR contenido de seccion
$(document).on("blur", "#wtexto", function(){
var id=$(this).data("c1");
var x1=$(this).val();
//alert(x1);
//alert(id);
actualizar_datosww(id, x1,"texto")
})
//ACTUALIZAR tarea de seccion
$(document).on("blur", "#sec_tarea", function(){
var id=$(this).data("c1");
var x1=$(this).val();
//alert(x1);
//alert(id);
actualizar_datosww(id, x1,"tarea")
})
//ACTUALIZAR fecha
$(document).on("change", "#time", function(){
var id=$(this).data("ttt");
var x1=$(this).val();
//alert(x1);
//alert(id);
actualizar_datosww(id, x1,"time")
})

//archivos insert.
$(document).on("change", "#imagew", function() {
    var data = new FormData();
    var claves="<?php echo $_SESSION['clave']?>";
    var user="<?php echo $_SESSION['user']?>";
    data.append('file', $('#imagew')[0].files[0]);
    data.append('claves',claves);
    data.append('user',user);
  //  alert(data);

$.ajax({
        type: 'post',
        url: "datos_capitulos.php",
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
        obtener_capitulos();
//        alert(data);
        }
    });
});

//INSERTAR archivos secciones
$(document).on("click", "#send", function(){
var claves="<?php echo $_SESSION['clave']?>";

var id=$(this).data("c1");
//  alert(id);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{clavews:claves, id:id},
success:function(data){ 
obtener_capitulos();
//   alert(data);
}})})

//Agregar sección
$(document).on("click", "#addsecciones", function(){
var claves="<?php echo $_SESSION['clave']?>";
var id=$(this).data("c1");
//  alert(id);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{clavews:claves, id:id},
success:function(data){ 
obtener_capitulos();
//   alert(data);
}})
})

//Agregar inicio tiempo examen
$(document).on("click", "#empezar", function(){
  var claves="<?php echo $_SESSION['clave']?>";
    var user="<?php echo $_SESSION['user']?>";
var cap=$(this).data("cpt");
var idw=$(this).data("tiempo");
var idc=$(this).data("idc");
//var name=$(this).data("name");
alert(idw);
//   alert(idc);
//   alert(cap);
//      alert(claves);
//   alert(user);
$.ajax({ 
url:"datos_capitulos.php",
method:"post",
data:{clavee:claves,user:user,cap:cap, idw:idw, idc:idc},
success:function(data){
obtener_capitulos();
   alert(data);
}
})
})



//insert tiempo de examen capitulo
$(document).on("blur", "#ext", function(){
var clavef="<?php echo $_SESSION['clave']?>";
var idc=$(this).data('tt');//alert(clavef);
var ext=$(this).val();
//alert(ext);
//alert(idc);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{clavef:clavef,ext:ext,idc:idc},
success:function(data){
obtener_capitulos();
//alert(data);
}
})
})

//insert tiempo de examen curso
$(document).on("blur", "#extww", function(){
var clavw="<?php echo $_SESSION['clave']?>";
var ext=$(this).val();
//alert(clavw);
//alert(ext);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{clavw:clavw,ext:ext},
success:function(data){
obtener_capitulos();
//   alert(data);
}
})
})



//insert tiempo entrega tarea
$(document).on("blur", "#extt", function(){
var claveff="<?php echo $_SESSION['clave']?>";
var extff=$(this).val();
//alert(extff);
//alert(claveff);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{claveff:claveff,extff:extff},
success:function(data){
obtener_capitulos();
//   alert(data);
}
})
})

//ELIMINAR capitulo
$(document).on("click", "#deletew", function(){
if(confirm("Esta seguro de eliminar esta fila")){
var idw=$(this).data("idw");
//alert(idw);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{ideletew:idw},
success:function(data){
obtener_capitulos();
//alert(data);
}
})
};
})
  


//ELIMINAR seccionw
$(document).on("click", "#deleteww", function(){
if(confirm("Esta seguro de eliminar esta fila")){
var idw=$(this).data("idw");
//alert(idw);
$.ajax({
url:"datos_capitulos.php",
method:"post",
data:{ideleteww:idw},
success:function(data){
obtener_capitulos();
//alert(data);
}
})
};
})



//ELIMINAR archivos
$(document).on("click", "#deletearchivos", function(){
if(confirm("Esta seguro de eliminar esta fila")){
var idw=$(this).data("ff");
var name=$(this).data("name");
//   alert(idw);
//   alert(name);
$.ajax({ 
url:"datos_capitulos.php",
method:"post",
data:{ideletewww:idw, name:name},
success:function(data){
obtener_capitulos();
//alert(data);
}
})
};
})



});

</script>


<div id ="resultadocapitulo"></div>




<title>Capítulos</title>


<?php include('first.php');?><?php include('margin.php'); ?>










<!--

<article>

    <style media="screen">
        #sprite {
            width: 500px;
            height: 500px;
            border:1px solid;
            margin:auto;
            position: relative;
            overflow: hidden;
          }
          </style>

    <div id="spritew" style='height:500px'></div>
    <script src="sprites/dist/spritz.js"></script>

    <script>

        let sprite = Spritz('#spritew', {
            picture: { srcset: 'sprites/test/spritesheets/singlerow/zz.jpg',  media: '(min-width: 1200px)',  width:3900, height:1415},
            steps: 18,
            rows: 3
        }).flip().fps(5).playback()
    </script>


    <div id="sprites" style='height:500px;'></div>

    <script>
        let sprites = Spritz('#sprites', {
            picture: { srcset: 'sprites/test/spritesheets/singlerow/creature360.jpg', media: '(min-width: 10px)', width: 6450, height:3100},
            steps: 18,
            rows: 4
        }).flip().playback().fps(5)
    </script>



    <div id="spriteww" style='height:500px;'></div>
    <script>
    Spritz('#spriteww', {
          picture: { srcset: 'sprites/test/spritesheets/singlerow/walking-man.jpg' },
                steps: 8
            }).flip().fps(5).play()
    </script>


          </article>
-->

<?php include('footer.php'); ?>




