<?php
require('conect.php');
session_start();
if(isset($_REQUEST['correo']) && !empty($_REQUEST['correo'])){
	$u=$_POST['correo'];
    $p=$_POST['pass'];
	$esta=mysqli_query($link,"SELECT * FROM usuario WHERE  passw='$p' AND email='$u'");
	$nesta=mysqli_num_rows($esta);
	$estaw=mysqli_fetch_assoc($esta);
	if($nesta==1){
		//		echo "<script> alert('".$estaw['idusuario']."')</script>";
		$_SESSION['user']=$estaw['idusuario'];
		header("Location:inicio.php");
}else{
	echo "<script> alert('Email o contraseña incorrecto')</script>";
}
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_REQUEST['nombreww']) && !empty($_REQUEST['nombreww'])){
//	$str= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
//    $u="";
//    for($i=0;$i<11;$i++){
//        $u .=substr($str,rand(0,62),1);
//    }
	$p=$_REQUEST['password'];
	$c=$_REQUEST['correoww'];
	$n=$_REQUEST['nombreww'];
    $t=$_REQUEST['tipo'];
	
	if (str_word_count($n) > 2 && str_word_count($n) < 6) {
		if (filter_var($c, FILTER_VALIDATE_EMAIL)) {
			$ff=mysqli_num_rows(mysqli_query($link, "SELECT * FROM usuario WHERE email='".$c."'"));
			if($ff>0){
				echo "<script> alert('Email ya esta registrado')</script>";
			}else{
				mysqli_query($link,"INSERT INTO usuario VALUES (NULL,'$p','$n',NULL,'$t','$c', 'enviado')");
//				copy($_FILES['picture']['tmp_name'],"archivos/".$u.$f);




	$registro=mysqli_query($link,"SELECT * FROM usuario WHERE email='$c'");
	$nregistro=mysqli_num_rows($registro);
	$registrow=mysqli_fetch_assoc($registro);

$_SESSION['user']=$registrow['idusuario'];
		header("Location:inicio.php");
			}
		} else {
			echo("<script> alert('Formato de email incorrecto')</script>");
		}
	} else {
		echo("<script> alert('Especifique dos apellidos y un nombre como minimo y como máximo cinco palabras')</script>");
	}
}


?>






<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="w.ico">

<script type="text/javascript" src="jsxgraphcore.js"></script>


<script type="text/javascript"
src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>
<!--

-->







<div id="ff">
<form action="index.php" method="post" class="sesion">
<img src="ww2.svg" style="width:80px" alt="">
<div id="cerrar"><a href="javascript:cerrar()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
<input style="width:20em;" type="text" name="correo" autofocus="autofocus" placeholder="Correo" required>
<input style="width:20em;" type="password" name="pass" placeholder="Contraseña" required>
<input style="width:18em;background:rgb(30,0,20);color:white;font-family:Georgia;font-size:15px;cursor:pointer;" class="button" type="submit" value="Iniciar sesión">
</form>  
</div>

<style>
#ff{
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.9);
  z-index: 999;
}
.sesion{
width:300px;
position:absolute;
z-index: 9999;
padding:18px;
border-radius:15px;
position:absolute;
top:50%;
left:50%;
 z-index: 999;
text-align: center;
background-color: rgb(250,220,180);
transform:translate(-50%,-50%);
} 

input{
display:block;
border:none;
padding:5px;
border-radius:5px;
margin:1em auto;
}

#cerrar{
	right:5px;
	top:5px;
	font-size:20px;
	color:black;
	cursor:pointer;
	position:absolute;
}
#cerrar a i {
color:black;
}

</style>

<script>
function abrir(){
	document.getElementById("ff").style.display="block";
	document.getElementById("fff").style.display="none"
}

function cerrar(){
document.getElementById("ff").style.display="none"
}
</script>












<style>
  @import url(font-awesome.min.css);
.social-icon{
  font-size:3em;
}
body {
  margin: 0;
  margin-top:45px;
  background-color: #fff;
#  font-family:serif;
}

@media screen and (max-width:800px){
}

#navbar {
  overflow: hidden;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 9999;

}

#navbar a {
  background: rgb(250,100,100);
float: right;
  display: block;
  color: white;
  text-align: center;
  padding: 10px;
  font-weight:bold;
  text-decoration: none;
  font-size: 17px;
margin-left:3px;
border-radius:8px 1px 8px 1px ;
}

#navbar a:hover {
  background: rgba(250,100,0,0.9);
 # color: black;
}

.main {
  padding: 16px;
  margin-top: 30px;
  height: 1500px; /* Used in this example to enable scrolling */
}
</style>

<div id="navbar">
<a href="javascript:open()">Regístrese</a>
<a href="javascript:abrir()">Iniciar sesión</a>
</div>



<script>
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
}
</script>








<div id="fff"><a href="javascript:close()"></a>
	
<form action="index.php" method="post" enctype="multipart/form-data" class="registrarse">
	<div style="font-size:8px;text-align:center;color:rgb(0,0,0);padding:0px;"><h1 >Regístrese gratis y explore los cursos</h1></div>
	<div style="text-align:center"><img src="ww2.svg" style="width:80px;" alt=""></div>
	<div id="cerrar"><a href="javascript:close()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

  	<input title="Apellidos y nombres, este campo como mínimo debe tener tres palabras" type="text" name="nombreww" placeholder="Introduce Apellidos y Nombres" autofocus="autofocus" required value="<?php if(isset($n))echo $n ?>">
	<input type="text" name="correoww" placeholder="Introduce correo" required  value="<?php if(isset($c)) echo $c ?>">
	<input type="password" name="password" placeholder="Introduce contraseña" required >
        <select style="display:none" type="tipo" name="tipo">
            <option value="estudiante">Estudiante</option>
            <option value="docente">Docente</option>
        </select>

	<input class="button" style="background:rgb(30,0,20);color:white;font-family:Georgia;font-size:15px;cursor:pointer;" type="submit" name="registro" value="Registrar">
</form>

<!--
        <div style="width:200px;margin:auto;text-align:center;display:block;"><img style="width:70px;" src="ww1.svg"></div>
-->

    </div>

<style>
#fff{
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.9);
  z-index: 999;
}

.registrarse{
width:300px;
position:absolute;
z-index: 9999;
padding:18px;
border-radius:15px;
position:absolute;
top:50%;
left:50%;
text-align: center;
background-color: rgb(250,220,180);
transform:translate(-50%,-50%);
} 

#fff input{
width:280px;
border-radius:5px;
padding:5px;
border:none;
display:block;
margin:1em auto;
}
</style>


<script>
function open(){
	document.getElementById("fff").style.display="block";
document.getElementById("ff").style.display="none"
}

function close(){
document.getElementById("fff").style.display="none"
}
</script>





























<script type='text/javascript'>
		JXG.Options.text.useMathJax = true;
		JXG.Options.text.fontSize = 14;
		JXG.Options = JXG.merge(JXG.Options, { showNavigation: false, point: { face: 'o', showInfobox:false, size: 1, color: '#000000' } });
</script>


		










<!--
<iframe style="border:none;border-radius:30px 1px 30px 1px;width:95%;height:360px;display:block;margin:auto;" src="3/examples/webgl_points_dynamic.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="3/examples/physics_ammo_break.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="3/examples/my.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="untitled.html" seamless></iframe>
-->


<script src="jquery-3.0.0.min.js"></script>

<script>
$(document).ready(function(){
function getw_data(){
$.ajax({
url:"indexajax.php",
method:"POST", 
success:function(data){
  $("#resulta").html(data)
}
})
}

//INSERTAR BENEFICIOS
$(document).on("click", "#additems", function(){
var text="Edite";
//   alert(text);
$.ajax({
url:"datos_index.php",
method:"post",
data:{textitems:text},
success:function(data){ 
getw_data();
//   alert(data);
}
})
})

//INSERTAR BENEFICIOS
$(document).on("click", "#add", function(){
var text="Edite";
//   alert(text);
$.ajax({
url:"datos_index.php",
method:"post",
data:{text:text},
success:function(data){ 
getw_data();
//   alert(data);
}
})
})




//INSERTAR videodescripcion
$(document).on("click", "#addvideo", function(){
var text="Edite";
//   alert(text);
$.ajax({
url:"datos_index.php",
method:"post",
data:{textvideo:text},
success:function(data){ 
getw_data();
//   alert(data);
}
})
})

		
//ACTUALIZAR
function actualizar_datos(id,texto,columna){
$.ajax({
url:"datos_index.php",
method:"post",
data:{id: id, texto: texto, columna: columna},
success:function(data){
getw_data();
//alert(data);
}})}

//ACTUALIZAR texto
$(document).on("blur", "#ww1", function(){
var id=$(this).data("c1");
var x1=$(this).text();
//alert(id);
actualizar_datos(id, x1,"texto")
})
//ACTUALIZAR videoescripcion
$(document).on("blur", "#wwvideo", function(){
var id=$(this).data("c1");
var x=$(this).text();
var x1 = x.replace('https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/');
//alert(x1);
//alert(id);
actualizar_datos(id, x1,"archivo")
})
//ACTUALIZAR nombre
$(document).on("blur", "#wwnombre", function(){
var id=$(this).data("c1"); 
var x1=$(this).text();     
//alert(id);
actualizar_datos(id, x1,"nombre")
})
//ACTUALIZAR color
$(document).on("change", "#color", function(){
var id=$(this).data("c1");
var x1=$(this).val();
//alert(x1);
//alert(id);
actualizar_datos(id, x1,"color")
})

//ACTUALIZAR color2
$(document).on("change", "#color2", function(){
var id=$(this).data("c1");
var x1=$(this).val();
//alert(x1);
//alert(id);
actualizar_datos(id, x1,"color2")
})


//actualizar archivos logo.
$(document).on("change", "#imagew2", function() {
var id=$(this).data("c1");
    var data = new FormData();
    data.append('filesww', $('#imagew2')[0].files[0]);
    data.append('id',id);
//    data.append('user',user);	
//  alert(id);
$.ajax({ 
        type: 'post',
        url: "datos_index.php",
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
getw_data();
//        alert(data);
        }
    });
});


//archivos foto insert.
$(document).on("change", "#imagew", function() {
    var data = new FormData();
    data.append('filesw', $('#imagew')[0].files[0]);
//    data.append('claves',claves);
//    data.append('user',user);	
//  alert("data");

$.ajax({
        type: 'post',
        url: "datos_index.php",
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
getw_data();
//        alert(data);
        }
    });
});



//ACTUALIZAR footer
function actualizarw(id,texto,columna){
$.ajax({
url:"datos_index.php",
method:"post",
data:{id: id, textff: texto, columna: columna},
success:function(data){
getw_data();
//   alert(data);
}})}
//ACTUALIZAR textff
$(document).on("blur", "#ffw", function(){var id=$(this).data("c1");var x1=$(this).val();actualizarw(id, x1,"t1")})
$(document).on("blur", "#ffw2", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t2")})
$(document).on("blur", "#ffw3", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t3")})
$(document).on("blur", "#ffw4", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t4")})
$(document).on("blur", "#ffw5", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t5")})
$(document).on("blur", "#ffw6", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t6")})
$(document).on("blur", "#ffw7", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t7")})	
$(document).on("blur", "#ffw8", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t8")})
$(document).on("blur", "#ffw9", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t9")})
$(document).on("blur", "#ffw9", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t9")})
$(document).on("blur", "#ffw10", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t10")})
$(document).on("blur", "#ffw11", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t11")})
$(document).on("blur", "#ffw12", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t12")})
$(document).on("blur", "#ffw13", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t13")})
$(document).on("blur", "#ffw14", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t14")})
$(document).on("blur", "#ffw15", function(){var id=$(this).data("c1");var x1=$(this).text();actualizarw(id, x1,"t15")})




//ELIMINAR ids
$(document).on("click", "#deleter", function(){
if(confirm("Esta seguro de eliminar esta fila")){
var idw=$(this).data("ff");
//   alert(idw);
//   alert(idw);
$.ajax({ 
url:"datos_index.php",
method:"post",
data:{idele:idw},
success:function(data){
getw_data();
//alert(data);
}
})
};
})

getw_data();

});
</script>


<div id ="resulta"></div>





<!--
<a href="javascript:abrirw()">Enviar mensaje</a>

<div id="email">
<form action="index.php" method="post" class="email">
<img src="ww2.svg" style="width:80px" alt="">
<div id="cerrarww"><a href="javascript:cerrarw()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
<input style="width:20em;" type="text" name="nombre" placeholder="Nombre" required>
<input style="width:20em;" type="text" name="email" autofocus="autofocus" placeholder="Email" required>
<textarea name="mensaje" cols="30" rows="10"></textarea>
<input style="width:18em;background:rgb(30,0,20);color:white;font-family:Georgia;font-size:15px;cursor:pointer;" 
class="button" name="correow" type="submit" value="Enviar mensaje">
</form>  
</div>
-->

<style>
#email{
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.9);
  z-index: 999;
}
.email{
width:300px;
position:absolute;
z-index: 9999;
padding:18px;
border-radius:15px;
position:absolute;
top:50%;
left:50%;
 z-index: 999;
text-align: center;
background-color: rgb(100,0,220);
transform:translate(-50%,-50%);
} 

input{
display:block;
border:none;
padding:5px;
border-radius:5px;
margin:1em auto;
}

#cerrarww{
	right:5px;
	top:5px;
	font-size:20px;
	color:black;
	cursor:pointer;
	position:absolute;
}
#cerrarww a i {
color:black;
}

</style>

<script>
function abrirw(){
	document.getElementById("email").style.display="block";
}

function cerrarw(){
document.getElementById("email").style.display="none"
}
</script>


</article>





<?php include('footer.php'); ?>
