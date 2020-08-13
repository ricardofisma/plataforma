<?php
require('conect.php');
session_start();


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

<script src="jquery-3.0.0.min.js"></script>
<script src="jquery-1.12.4.js"></script>
<script src="jquery-ui.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>





<!--
<form name="ww7" id="ww7" enctype="multipart/form-data" method="post">
<input style='border:1px solid;padding:5px;border-radius:3px;width:200px;margin:5px' type="text" id="nombre" name="nombre" placeholder="Precio del curso ej. 250" required>
<input class="crearclase" type="file" name="archivo" id="archivo" required>
<input class="crearclase" type="button" value="Ok" onclick="registrar();">
</form>



<div class="container" style="width:200px;">
<img src="w1.png" id="upfilew" data-c1="ww" style="cursor:pointer" />
<input type="file" name="file" id="file" data-c1="ww" style="display:none"/>
</div> 
-->
<script>
//$("#upfilew").click(function () {
//    $("#file").trigger('click');
//});
</script>

<!--
<iframe style="border:none;border-radius:30px 1px 30px 1px;width:95%;height:360px;display:block;margin:auto;" src="3/examples/webgl_points_dynamic.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="3/examples/physics_ammo_break.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="3/examples/my.html" seamless></iframe>
<br><iframe style="border:none;border-radius:3px;width:90%;height:500px;display:block;margin:auto;" src="untitled.html" seamless></iframe>
-->


<?php
//logo
  if(!isset($_SESSION['user'])){
	  $_SESSION['user'] = 'wf';
	}
	//   echo $_SESSION['user'];

$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);


if($w['tipo']=='docente'){
	echo "<article style='width:80%;text-align:center;color:white;background:rgb(10,100,100);margin:5px auto;border-radius:5px;padding:5px'>";
echo "<a style='text-decoration:none;color:white;font-size:20px;' href='inicio.php'>Salir de la edición - Regrese a los cursos</a>";
echo "</article>";
}

?>

<?php
	$about2=mysqli_query($link,"SELECT * FROM land WHERE tipo='logo'");
	$aboutw2=mysqli_fetch_assoc($about2);
	
	echo "<article style='width:80%;text-align:center;color:white;background:".$aboutw2['color'].";margin:5px auto;border-radius:5px;padding:5px;'>";
	if($w['tipo']=='docente'){
		echo "<button style='float:right;border:none;border-radius:3px;padding:5px;' id='deleter' data-ff='".$aboutw2['idland']."'><i class='fa fa-trash'></i></button>";
		echo "<input style='padding:1px;border-radius:3px;border:2px solid;' type='color' id='color' data-c1='".$aboutw2['idland']."' value = '".$aboutw2['color']."'>";
		echo "<input style='float:right;padding:1px;border-radius:3px;border:2px solid;' type='color' id='color2' data-c1='".$aboutw2['idland']."' value = '".$aboutw2['color2']."'>";
		echo "<div style='float:right;width:50%;color:white;background:".$aboutw2['color2'].";font-size:30px;font-family:Georgia;border-radius:3px;padding:5px;' id='wwnombre' data-c1='".$aboutw2['idland']."' contenteditable>".$aboutw2['nombre']."</div>";
	}else{
		echo "<div style='float:right;width:50%;color:white;background:rgb(10,0,70);font-size:30px;font-family:Georgia;border-radius:3px;padding:5px;'>".$aboutw2['nombre']."</div>";
}
echo "<div>";// style='  width:150px;height:150px;overflow:hidden;border-radius:5px;position:relative;object-fit:cover;margin:auto;'>";
echo "<img style='height:155px ;cursor:pointer;border-radius:5px;' id='upfilew2' src= 'archivosland/".$aboutw2['idland']."".$aboutw2['foto']."' onerror=this.src='curso.png'>";
echo "</div>";


if($w['tipo']=='docente'){
echo "<input type='file' name='file' id='imagew2' data-c1='".$aboutw2['idland']."' style='display:none'/>";
?>	

<script>
$("#upfilew2").click(function () {
$("#imagew2").trigger('click');
});
</script>
<?php
}
?>

</article>







<?php
//acerca
?>

<?php
	$about=mysqli_query($link,"SELECT * FROM land WHERE tipo='acerca'");
	//	$about=mysqli_num_rows($about);  
	$aboutw=mysqli_fetch_assoc($about);
echo "<article style='width:90%;text-align:center;color:white;background:".$aboutw['color'].";margin:5px auto;border-radius:5px;padding:5px;' id='article'>";
if($w['tipo']=='docente'){
	echo "<input style='padding:1px;border-radius:3px;border:2px solid;' type='color' id='color' data-c1='".$aboutw['idland']."'>";
echo "<h1 style='width:90%;color:white;background:rgb(10,0,70);font-size:30px;font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='wwnombre' data-c1='".$aboutw['idland']."' contenteditable>".$aboutw['nombre']."</h1>";
echo "<div style='width:90%;color:white;background:rgb(10,0,150);font-size:20px;font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$aboutw['idland']."' contenteditable>".$aboutw['texto']."</div>";
}else{
echo "<h1 style='width:90%;color:white;background:rgb(10,0,70);font-size:30px;font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='wwnombre' data-c1='".$aboutw['idland']."'>".$aboutw['nombre']."</h1>";
echo "<div style='width:90%;color:white;background:rgb(10,0,150);font-size:20px;font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$aboutw['idland']."'>".$aboutw['texto']."</div>";
}
$about1=mysqli_query($link,"SELECT * FROM land WHERE tipo='acercaitems'");
$aboutw1=mysqli_fetch_assoc($about1);

do{
	echo "<ul>";
if($w['tipo']=='docente'){
	echo "<button style='float:right;margin:5px;border:none;border-radius:5px;' id='deleter' data-ff='".$aboutw1['idland']."'><i class='fa fa-trash'></i></button>";
	echo "<li><div style='text-align:left;color:rgb(0,0,0);background:rgb(10,100,70);font-family:Georgia;border-radius:3px;padding:5px;' id='ww1' data-c1='".$aboutw1['idland']."' contenteditable>".$aboutw1['texto']."</div></ul>";
}else{
	echo "<li><div style='text-align:left;color:rgb(0,0,0);background:rgb(10,100,70);font-family:Georgia;border-radius:3px;padding:5px;' id='ww1' data-c1='".$aboutw1['idland']."' >".$aboutw1['texto']."</div></ul>";
}
	echo "</ul>";
}while($aboutw1=mysqli_fetch_assoc($about1));
if($w['tipo']=='docente'){

ECHO "<div style='width:90%;text-align:center;color:white;background:rgb(10,10,30);margin:5px auto;border-radius:3px;padding:5px;'> 
<button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;' id='additems'>Agregar items</button></div>";
}
?>	

</article>







<?php
//beneficios
?>



<?php
	$www=mysqli_query($link,"SELECT * FROM land WHERE tipo='beneficios'");
	$nwww=mysqli_num_rows($www);  
	$wwwr=mysqli_fetch_assoc($www);
	echo "<article style='width:80%;text-align:center;color:white;background:".$wwwr['color'].";margin:5px auto;border-radius:5px;padding:5px;'>";
	if($w['tipo']=='docente'){
		echo "<input style='padding:1px;border-radius:3px;border:2px solid;' type='color' id='color' data-c1='".$wwwr['idland']."' value = '".$wwwr['color']."'>";
	}
		echo "<h1 style='width:80%;text-align:center;color:white;background:black;margin:5px auto;border-radius:5px;'>Beneficios</h1>";

	do{
	if($w['tipo']=='docente'){
	echo "<button style='float:right;border:none;border-radius:3px;padding:5px;' id='deleter' data-ff='".$wwwr['idland']."'><i class='fa fa-trash'></i></button>";
	echo "<div style='width:90%;text-align:center;color:white;background:rgb(10,0,70);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$wwwr['idland']."' contenteditable>".$wwwr['texto']."</div>";
}else{
	echo "<div style='width:90%;text-align:center;color:white;background:rgb(10,0,70);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$wwwr['idland']."'>".$wwwr['texto']."</div>";
}
}while($wwwr=mysqli_fetch_assoc($www));
if($w['tipo']=='docente'){

ECHO "<div style='width:90%;text-align:center;color:white;background:rgb(10,10,30);margin:5px auto;border-radius:3px;padding:5px;'> 
<button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;' id='add'>Agregar beneficios</button></div>";
}
?>	

</article>









<?php
//fotos


$www1=mysqli_query($link,"SELECT * FROM land WHERE tipo='foto'");
	$nwww1=mysqli_num_rows($www1);
	$wwwr1=mysqli_fetch_assoc($www1);

if($w['tipo']=='docente'){
		echo "<input style='padding:1px;border-radius:3px;border:2px solid;' type='color' id='color' data-c1='".$wwwr1['idland']."' value = '".$wwwr1['color']."'>";
}
	echo "<div style='display:flex;flex-wrap:wrap;align-items:center;justify-content:center;margin:5px auto;width:90%;background:".$wwwr1['color'].";border-radius:5px'>";
do{
echo "<div style='text-align: center;
width:250px;
border-radius:10px;
position:relative;
margin:10px;
padding:5px;
background-color: rgb(250,205,250);
'>";
echo "<div style='  width:150px;height:150px;overflow:hidden;border-radius:5px;position:relative;object-fit:cover;margin:auto;'>";
echo "<img  class='".$wwwr1['idland']."ww' style='height:155px;position: absolute;top:50%;left:50%;object-fit:contain;transform: translate(-50%,-50%);' data-c1='rrrr' src= 'archivosland/".$wwwr1['idland']."".$wwwr1['foto']."' onerror=this.src='curso.png'>";
echo "</div>";

?>	 
<script>
//$(".<?php echo $wwwr1['idland']."ww"?>").click(function () {
//    $(".<?php echo $wwwr1['idland']?>").trigger('click');
//});
</script>
<?php

if($w['tipo']=='docente'){
echo "<div style='width:90%;text-align:center;color:white;background:rgb(8,25,70);;font-family:Georgia;font-size:20px;margin:5px auto;border-radius:3px;padding:5px;' id='wwnombre' data-c1='".$wwwr1['idland']."' contenteditable>".$wwwr1['nombre']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,25,255);;font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$wwwr1['idland']."' contenteditable>".$wwwr1['texto']."</div>";
echo "<button style='border:none;border-radius:2px;position:relative;float:right;top:0%;left:0%;' id='deleter' data-ff='".$wwwr1['idland']."'><i class='fa fa-trash'></i></button>";
} else{
echo "<div style='width:90%;text-align:center;color:white;background:rgb(8,25,70);;font-family:Georgia;font-size:20px;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$wwwr1['idland']."'>".$wwwr1['nombre']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,25,255);;font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$wwwr1['idland']."' >".$wwwr1['texto']."</div>";
}
echo "</div>";
}while($wwwr1=mysqli_fetch_assoc($www1));
//ECHO "<div style='width:90%;text-align:center;color:white;background:rgb(100,100,30);margin:5px auto;border-radius:3px;padding:5px;'> 
//<button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;' id='addnew'>Agregar</button></div>";

if($w['tipo']=='docente'){
?>	 

<div style='width:90%;text-align:center;color:white;background:rgb(100,25,255);margin:5px auto;border-radius:3px;padding:5px;'>
<img src="upload.jpg" id="upfilew" width="30" style="cursor:pointer" />
<input type="file" name="file" id="imagew" style="display:none"/>
</div>
<script>
$("#upfilew").click(function () {
    $("#imagew").trigger('click');
});
</script>
<?php
}
?>
</div>;





<?php
//videos


$www1=mysqli_query($link,"SELECT * FROM land WHERE tipo='video'");
	$nwww1=mysqli_num_rows($www1);
	$wwwr1=mysqli_fetch_assoc($www1);
if($w['tipo']=='docente'){
		
	echo "<input style='padding:1px;border-radius:3px;border:2px solid;' type='color' id='color' data-c1='".$wwwr1['idland']."' value = '".$wwwr1['color']."'>";
}
echo "<div style='display:flex;flex-wrap:wrap;align-items:center;justify-content:center;background:".$wwwr1['color'].";margin:5px auto;width:90%;padding:5px;;border-radius:5px;'>";
	do{
		echo "<div style='text-align: center;
		width:300px;
border-radius:3px;
position:relative;
margin:10px;
background-color: rgb(250,205,250);'>";
echo "<object style='align:center;display:block;;margin:5px auto;width:97%;height:300px;border-radius:3px;' data='".$wwwr1['archivo']."'></object>";

if($w['tipo']=='docente'){
echo "<h1 style='width:90%;text-align:center;color:white;background:rgb(100,25,255);color:rgb(0,0,0);font-size:20px;font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='wwnombre' data-c1='".$wwwr1['idland']."' contenteditable>".$wwwr1['nombre']."</h1>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$wwwr1['idland']."' contenteditable>".$wwwr1['texto']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(50,5,30);margin:5px auto;border-radius:3px;padding:5px;' id='wwvideo' data-c1='".$wwwr1['idland']."' contenteditable>".$wwwr1['archivo']."</div>";
echo "<button style='margin:5px;border:none;border-radius:5px;' id='deleter' data-ff='".$wwwr1['idland']."'><i class='fa fa-trash'></i></button>";
}else{
echo "<h1 style='width:90%;text-align:center;color:white;background:rgb(100,25,255);color:rgb(0,0,0);font-size:20px;font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='wwnombre' data-c1='".$wwwr1['idland']."' >".$wwwr1['nombre']."</h1>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ww1' data-c1='".$wwwr1['idland']."'>".$wwwr1['texto']."</div>";
}
echo "</div>";
}while($wwwr1=mysqli_fetch_assoc($www1));
if($w['tipo']=='docente'){
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,100,30);margin:5px auto;border-radius:3px;padding:5px;'> 
<button style='background:rgb(22,10,110);color:white;border:none;border-radius:5px;padding:7px;' id='addvideo'>Agregar</button></div>";
}
echo "</div>";
?>


<?php 
// footer editor
if($w['tipo']=='docente'){

$ff=mysqli_query($link,"SELECT * FROM foot");
	$nff=mysqli_num_rows($ff);
	$ff1=mysqli_fetch_assoc($ff);

echo "<input style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw' data-c1='".$ff1['idfoot']."' contenteditable value='".$ff1['t1']."'>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw2' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t2']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw3' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t3']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw4' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t4']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw5' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t5']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw6' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t6']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw7' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t7']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw8' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t8']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw9' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t9']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw10' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t10']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw11' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t11']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw12' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t12']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw13' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t13']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw14' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t14']."</div>";
echo "<div style='width:90%;text-align:center;color:white;background:rgb(100,5,255);font-family:Georgia;margin:5px auto;border-radius:3px;padding:5px;' id='ffw15' data-c1='".$ff1['idfoot']."' contenteditable>".$ff1['t15']."</div>";
}
?>





<style>
.ww a{
		font-size: 17px;
	display: block;
#	width: 30px;
#	height: 30px;
	cursor: pointer;
	background-color:  rgb(255,255,255);
	border-radius: 2px;
padding:5px;
	font-size: 30px;
	border-radius:7px;
	color: rgb(70,0,70);
	text-align: center;
	line-height: 35px;

	margin-right: 3px;
	margin-bottom: 5px;

}
</style>

<div class='ww'>

				    <a target="_blank" href="<?php echo $ff1['t8']?>"><i class="fab fa-whatsapp"></i></a>
					<a target="_blank" href="<?php echo $ff1['t9']?>"><i class="fab fa-facebook-messenger"></i></a>
			
</div>













