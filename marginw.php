<?php
require('conect.php');
if(!isset($_SESSION['user'])){
header("Location:index.php");
        }
        if(isset($_REQUEST['cerrar'])){
          session_destroy();
        header("Location:index.php");
}
?>


<div style="position: fixed;  top: 12;left: 0;padding:2px;  z-index: 9999;  transition: top 0.5s;">
<a style="color:rgb(30,0,30);font-size:20px;margin-right :5px" href="javascript:abrir()"><i class="fa fa-list"></i></a><br><br>

<?php echo "<a style='color:rgb(30,0,30);font-size:23px;margin-right :5px' href='plan.php?clave='".$_SESSION['clave']."'><i class='fa fa-home' aria-hidden='true'></i></a>";?>
</div>











<div id="ff">
<form action="index.php" method="post" class="sesion">

<div id="cerrar"><a href="javascript:cerrar()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

<ul>
<li>  <a href="foro.php">Foro</a></li> 
<li>  <a href="entregatarea.php">Entregar tarea</a></li> 
<li>  <a href="calificaciones.php">Calificaciones</a></li> 
<li>    <a href="email.php">Email</a></li> 
<li><?php echo "<a href='plan.php?clave='".$_SESSION['clave']."'>".$_SESSION['clave']."</a>";?></li> 
<li>  <a href="archivos.php" >Archivos</a></li> 
<li>
 <a href="calificaciones.php" >Calificaciones</a>
<ul>
  <li><a href="miembros.php">Participantesee</a></li>
  <li><a href="miembros.php">Participanteeeees</a></li>
  <li><a href="miembros.php">Participanteeeees</a></li>
</ul>
</li> 

</form>  
</div>

<style>
  @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css);
.social-icon{
  font-size:1.2em;
}

#ff{
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(10,0,10,0.5);
  z-index: 999;
}

#ff ul{
  list-style:none;
  background:rgb(255,255,255);
  border-radius:3px;
}

#ff li a{
color:black;
text-decoration:none;
background:rgb(255,205,250);
display:block;
text-align:left;
margin-top:0px;
border-radius:0px;

}

#ff li a:hover {
background-color:DARKSALMON;
#border-radius:5px;
}




.sesion{
width:700px;
position:absolute;
z-index: 9999;
padding:18px;
border-radius:5px;
position:absolute;
top:50%;
left:50%;
 z-index: 999;
text-align: center;
background-color: rgb(155,5,255);
transform:translate(-50%,-50%);
} 

@media screen and (max-width:800px){
.sesion{
width:300px;
} 
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
}

function cerrar(){
document.getElementById("ff").style.display="none"
}
</script>




