<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="w.ico">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="font-awesome.min.css">
<script type="text/javascript" src="jsxgraphcore.js"></script>
<link rel="stylesheet" href="jsxgraph.css">

<script type='text/javascript'>
		JXG.Options.text.useMathJax = true;
    JXG.Options.text.fontSize = 14;
    JXG.Options.axis.ticks.strokeOpacity = 0;
    JXG.Options.axis.ticks.insertTicks = false;
		JXG.Options = JXG.merge(JXG.Options, { showNavigation: false, point: { face: 'o', size: 1, color: '#000000' } });
</script>



<script type="text/javascript"
src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({TeX: {equationNumbers: { autoNumber:"AMS"}}, tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}, "HTML-CSS": { availableFonts: ["Tex"] }});
MathJax.Hub.processSectionDelay = 0;
</script>







<style>
  @import url(font-awesome.min.css);
.social-icon{
  font-size:1.5em;
}
body {
  margin: 0;
  margin-top:50px;
  background-color: #fff;
  padding:0px;
  #  font-family:serif;
}


.wrapper {
  width:150px;
  height:150px;
  overflow: hidden;
  border-radius:50%;
  position: relative;
  object-fit:cover;
}
.wrapper img {
  height:155px;
  position: absolute;
  top:50%;
  left:50%;
  object-fit:cover;
  transform: translate(-50%,-50%)
}






textarea {
  width: 100%;
  min-height: 100px;
 /* resize: none;*/
  border-radius: 2px;
  padding: 0.5rem;
  color: #666;
/*  box-shadow: inset 0 0 0.25rem #ddd;*/
}





.contenedor-imagenes{
    display:flex;
    width:100%;
    margin:auto;
    justify-content: space-around;
    flex-wrap:wrap;
    background-color:DARKSALMON;
}


.contenedor-imagenes .imagen{
width:32.7%;
border-radius:5px;
position:relative;
height:300px;
margin-bottom:8px;
box-shadow:0px 0px 3px 0px rgba(0,0,0,.75);
}

.imagen img{
    border-radius:10px;
width:100%;
height:100%;
  position: relative;
object-fit:cover;

}


.overlay{
position:absolute;
bottom:0;
left:0;
border-radius:10px;
background:rgba(3, 81, 10, 0.87);
width:100%;
height:0;
transition: .5 ease;
overflow:hidden;
}

.overlay a{
color:#fff;
font-weight:300;
font-size:30px;
position:absolute;
top:50%;
left:50%;
text-align: center;
transform:translate(-50%,-50%);
}
.imagen:hover .overlay{
height:100%;
cursor:pointer;
}

@media screen and (max-width:1000px){
.contenedor-imagenes{
    width:55%;
}

.contenedor-imagenes .imagen{
   width:90%;
}

@media screen and (max-width:700px){
.contenedor-imagenes{
    width:100%;
}

.contenedor-imagenes .imgen{
    width:100%;
}

}




@media screen and (max-width:800px){
body{
    width:100%;
}

article{
    width:100%;
}

.w1{
  right:80px;top:-0px;

}
.w2{
left:-72px;top:2px;
}

}
</style>



</head>

<body>


<?php

require('conect.php');

$user=mysqli_query($link,"SELECT * FROM usuario WHERE email='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);
?>











<style>

#navbar {
  overflow: hidden;
  position: fixed;
  top: 0;
  right:0;
  z-index: 9999;
# background: rgb(50,0,50);
 border-radius:5px;

}

#navbar a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 11px;
  text-decoration: none;
  font-size: 17px;
# background: gray;
 border-radius:5px;

}

#navbar a:hover {
  color: rgb(75,0,75);
# font-weight:700;
}

.main {
  padding: 16px;
  margin-top: 30px;
  height: 1500px; /* Used in this example to enable scrolling */
}
</style>


<div id="navbar">

<!--
<a title="Cerrar sesión"  href="inicio.php?cerrar=1" style="float:right;" class="social-icon">
<i title="Cerrar sesion" class="fa fa-sign-out" aria-hidden="true"></i></a>
-->

<a title="Inicio"  href="inicio.php" id="right" style="background-color: transparent;padding:0px;; float:right" href="">
<?php 
echo "<div class='imagen' style='float:left;'>";
echo 
"<div style='width:45px;height:45px;overflow:hidden;border-radius:50%;position:relative;  object-fit:cover;'>
<div><img style='margin:auto;height:45px;  position: absolute;  top:50%;  left:50%;  object-fit:cover;  transform: translate(-50%,-50%)' src= 'archivos/".$w['usuario']."".$w['foto']."' onerror=this.src='foto.png'>
</div>
</div>
</div>"
?>
</a>

<a title="Cerrar sesión"  href="inicio.php?cerrar=1" style="float:right;color:rgb(70,0,70);">Cerrar</a>

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

</body>
</html>
