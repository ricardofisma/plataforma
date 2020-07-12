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

?>

  <script src="https://checkout.culqi.com/js/v3"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--
-->

<title>Inicio</title>


<style>
.contenedor-imageneswr{
    display:flex;
    width:100%;
}
.contenedor-imageneswr .imagen{
text-align: center;
width:250px;
background:rgb(11, 146, 94);
border-radius:5px;
position:relative;
margin:5px;
box-shadow:0px 0px 2px 0px rgba(0,0,0,.75);
}


.contenedor-imagenesw{
    display:flex;
    width:100%;
    
    flex-wrap:wrap;
    align-items: center;
  justify-content: center;
}
.contenedor-imagenesw .imagen{
text-align: center;
width:250px;
border-radius:10px;
position:relative;
margin:5px;
box-shadow:0px 0px 1px 0px rgba(0,0,0,.75);
}
.imagen img{
width:100%;
height:100%;
}


.overlayw{
position:absolute;
bottom:0;
left:0;
width:100%;
height:0;
transition: .5 ease;
overflow:hidden;
}

.overlayw a{
color:#fff;
font-weight:300;
font-size:20px;
position:absolute;
top:50%;
left:50%;
text-align: center;
transform:translate(-50%,-50%);
}
.imagen:hover .overlayw{
height:100%;
cursor:pointer;
}
</style>

<?php include('first.php'); ?>

<article style="background:rgb(70,0,70);">

<?php

if(isset($_REQUEST['clave'])){
    $_SESSION['clave']=$_REQUEST['clave'];
    $clase=mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_SESSION['clave']."'"));
}

//if($w['tipo']=='estudiante'){
//    echo "<h1>Hola ".$w['nombre']." bienvenido a E learning</h1>";   
//}

?>



<div  style= "display:flex; width:100%;">
<?php
echo "<div class='imagen' style='float:left;'>";
echo "<div style='text-align: center;width:370px;border:0px solid;;border-radius:5px;position:relative;margin:5px;'>";
echo "<div title='Edite su perfil' class='wrapper' style='margin:5px auto;'><a style='cursor: pointer;' href='editar.php'><img style='cursor: pointer;' src= 'archivos/".$w['usuario']."".$w['foto']."' onerror=this.src='foto.png'></a></div>";
echo "<div style='margin:auto;width:97%; margin-bottom:0px;'><h1 style='border-radius:5px 5px 0px 0px;background:rgba(255,255,255,0.95);'>" .$w['nombre']. "</h1></div>";
echo "</div>";
echo "</div>";
?>
</div>





</article>





<!--crear del profe-->

<?php
if(isset($_REQUEST['jj'])){
    $n=$_REQUEST['clase'];
    $f1=$_FILES['gg']['name'];
    $str= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $cad="";
    for($i=0;$i<11;$i++){
      $cad .=substr($str,rand(0,62),1);
    }
    $u=$w['usuario'];
    $price=$_REQUEST['price'];
    $cont=$_REQUEST['descripcion'];
    $cont = mysqli_real_escape_string($link, $cont); 
    $video=$_REQUEST['link'];
        mysqli_query($link, "INSERT INTO clase VALUES(NULL, '$n','$cad','$u', NULL , '$f1', '$price', '$cont', '$video')");
        mysqli_query($link, "UPDATE clase SET  link = REPLACE(link, 'https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/')");
    copy($_FILES['gg']['tmp_name'],"archivoscrearclase/".$u.$f1);  
}

if(isset($_REQUEST['e'])){
mysqli_query($link, "DELETE FROM clase WHERE clase.idclase=".$_REQUEST['e']);
}

$con=mysqli_query($link,"SELECT * FROM clase WHERE usuario='".$w['usuario']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con);
?>
<article>

  <?php
if($w['tipo']=='docente'){
  ?>
<h1>Gestión de cursos</h1>
<form action="inicio.php" method="post" enctype="multipart/form-data">
  <input style='border:1px solid;padding:5px;border-radius:3px;margin:5px;' type="text" name="clase" placeholder="Nombre de la clase" required>
  <input style='border:1px solid;padding:5px;border-radius:3px;width:200px;margin:5px' type="text" name="price" placeholder="Precio del curso ej. 250" required>
  <input style='border:1px solid;padding:5px;border-radius:3px;width:300px;margin:5px' type="file" name="gg" required>
  <input style='border:1px solid;padding:5px;border-radius:3px;width:350px;margin:5px' type="text" name="link" placeholder="Link de video referencial - Youtuve" required>
  <textarea name="descripcion" id="" cols="30" rows="5" placeholder="Introduce la descripción del curso" required></textarea><br>
  <input style='border:1px solid;padding:5px;border-radius:3px;width:300px;margin:5px' type="submit" value="Crear" name="jj">
</form>

</article>


<article>

<div style= "    display:flex;    width:100%;    flex-wrap:wrap;    align-items: center;    justify-content: center;">
  <?php
$_SESSION['clave']=$a['clave'];

if($n>0){
  do{
    echo "<div class='imagen' style='float:left;'>";
    echo "<a style='cursor: pointer;text-decoration: none;color:rgb(30,10,30);' href='capitulo.php?clave=".$a['clave']."'>";
echo "<div style='text-align: center;background:rgb(100,8,100);width:200px;border-radius:10px;position:relative;margin:5px;box-shadow:0px 0px 5px 0px rgba(0,0,0,.75);'>";
echo "<div style='margin:auto;width:80%; margin-bottom:5px;background:rgb(10,100,100);border-radius:0px 0px 5px 5px;'><p style='border-radius:0px 0px 5px 5px;'>" .$a['nombre']. "</p></div>";
echo "<div style='margin:auto;width:80%; margin-bottom:5px;'><p>" .$a['clave']. "</p></div>";
echo "<div style='margin:auto;width:80%'><p>" .$a['fecha']. "</p></div>";
echo "<div style='margin:auto;width:80%'><p>Ver clase</p></div>";
echo "<div class='wrapper' style='margin:5px auto;'><a style='cursor: pointer;' href='capitulo.php?clave=".$a['clave']."'><img src= 'archivoscrearclase/".$a['usuario']."".$a['foto']."' onerror=this.src='curso.png'></a></div>";
        echo "<a href='updatecursos.php?update=".$a['idclase']."' style='margin:auto;width:80%; text-decoration:none;color:rgb(275,105,75);'> Editar </a>";
echo "<div  style='margin:auto;width:80%; margin-bottom:0px;'><p style='border-radius:5px 5px 0px 0px;background:rgb(200,100,100);'><a style='text-decoration: none;' href=\"javascript:preguntarw('".$a['idclase']."')\">Eliminar</a></p></div>";
echo "</div>";echo "</div>";
echo "</a>";
}while($a=mysqli_fetch_assoc($con));
}else{
  echo "<tr><td> No hay clases creadas</td></tr>";
}
?>
</div>

<script>
function preguntarw(valor){
eliminar=confirm("Esta seguro de eliminar esta clase?")
if(eliminar)
window.location.href="inicio.php?e="+valor;
}
</script>

</article>

<?php
}
?>

<style>
.crearclase{
margin: 5px auto;
display:block;
border: 1px solid ;
border-radius:3px;
background:#2333ee22;
padding:5px;

}
</style>















<!--las clases creadas del profe que se muestran a todos-->




 <?php
if($w['tipo']=='estudiante'){
  ?>


<article  style="background:rgb(255,255,150);">

<h1>Cursos disponibles</h1>

<?php



if(isset($_REQUEST['clave'])){
        $n=mysqli_num_rows(mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_REQUEST['clave']."'"));
        if($n>0){       
        $nc=mysqli_num_rows(mysqli_query($link,"SELECT * FROM misclases WHERE clave='".$_REQUEST['clave']."' AND usuario='".$_SESSION['user']."'"));    
        if($nc==0){
            
            $u = $_SESSION['user'];
            $c = $_REQUEST['clave'];
            mysqli_query($link,"INSERT INTO misclases VALUES(NULL,'$u','$c')");
            
        }else{
            
        echo "<script> alert('Ya te uniste a esa clase')</script>";
        }
        }else{
        echo "<script> alert('La clase no existe')</script>";
        }
    }


$con=mysqli_query($link,"SELECT b.* FROM clase b LEFT JOIN (SELECT clase.nombre, misclases.idmiclase, clase.clave, clase.foto, clase.link , clase.descripcion , clase.usuario FROM clase, misclases WHERE clase.clave=misclases.clave AND misclases.usuario='".$w['email']."'
) a ON a.clave = b.clave WHERE a.clave IS NULL");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con);
?>

<style>
.contenedorww{
    display:flex;
    width:100%;
    flex-wrap:wrap;
    align-items: center;
    justify-content: center;
}
.contenedorww .imagen{
    text-align: center;
    background:rgb(100,10,100);
width:200px;
border-radius:10px;
position:relative;
margin:5px;
box-shadow:0px 0px 5px 0px rgba(0,0,0,.75);
}
.wrapperww {
  width:200px;
  height:200px;
  overflow: hidden;
  border-radius:1px;
  position: relative;
  object-fit:cover;
}
.wrapperww img {
  height:200px;
  position: absolute;
  top:50%;
  left:50%;
  object-fit:cover;
  transform: translate(-50%,-50%)
}
</style>

 
<div class= "contenedorww">
<?php
if($n>0){
    do{
        echo "<div class='imagen'>";
        echo "<div class='wrapperww' style='margin:auto;'><img src= 'archivoscrearclase/".$a['usuario']."".$a['foto']."' onerror=this.src='curso.png'></div>";
        echo "<div style='margin:5px;background:rgb(200,100,250);padding:5px;color:black;border-radius:5px;''><h1>".$a['nombre']."</h1></div>";
        echo "<div style='margin:auto;width:80%; margin-bottom:5px;color:white;'>S/ ".$a['precio']."</div>";
//        echo "<div style='margin:auto;width:80%; margin-bottom:5px;'>".$a['clave']."</div>";
 
//echo $a['clave'];
?>
<script>
function <?php echo $a['clave']?>(){
	document.getElementById("<?php echo $a['clave']?>").style.display="block";
}

function <?php echo $a['clave']."2"?>(){
document.getElementById("<?php echo $a['clave']?>").style.display="none"
}
</script>
<a style="color:rgb(50,50,50);width:97%;text-decoration: none;" href="javascript:<?php echo $a['clave']?>()">
<div style="margin:5px;background:rgb(50,10,20);padding:5px;color:white;border-radius:5px;">
Detalles del curso
</div></a>



<div id="<?php echo $a['clave']?>" style="  position: fixed;  display: none;  width: 100%;  height: 100%;  top: 0;  left: 0;  right: 0;  bottom: 0;  background-color: rgba(0,0,0,0.9);  z-index: 999;">
<form action="index.php" method="post" class="sesion">
<div id="cerrar"><a href="javascript:<?php echo $a['clave']."2"?>()"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>

<img src="ww1.svg" style="width:80px" alt="">

<?php 
      echo "<div class='imagen' style='float:left;width:30%;'>";
      echo "<div class='wrapperww' style='display:block; margin:auto;'><img style='margin:auto;' src= 'archivoscrearclase/".$a['usuario']."".$a['foto']."' onerror=this.src='curso.png'></div>";
      echo "<div style='margin:auto;width:80%;'><h1>".$a['nombre']."</h1></div>";
      echo "<div style='margin:auto;width:80%'>S/ ".$a['precio']."</div>";
      echo "<input type='button' style='border:none;padding:5px;font-size:20px;font-family:Georgia;background:rgb(20,2,105);color:rgb(255,255,255);border-radius:5px 5px 0px 0px;cursor:pointer;' name='' class='buyButtonw' value='Comprar el curso' user='".$_SESSION['user']."' clave='".$a['clave']."' data-producto='".$a['nombre']."' data-precio='".$a['precio']."00'>";
      echo "</div>";
?>

<div style="width:97%;float:left;display:block;width:33%;">
<p>Introducción del curso</p>
<object style="float:right;align:center;display:block;;margin:5px auto;width:300px;height:200px;" data="<?php echo $a['link'] ?>"></object>
</div>

<div style="float:right;display:block;width:33%;text-align:left;">


<?php 
echo "<p style='text-align:center;font-family:Georgia;;background:rgb(20,2,105);border-radius:5px;color:white;padding:5px;'>".$a['descripcion']."</p>";

$conzw= mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$a['clave']."'");
$zzw=mysqli_fetch_assoc($conzw);
$ww=mysqli_num_rows($conzw);

?>
								<?php
                echo "<ul>";
								
                if($ww>0){

								$r=1;
								do{
                echo "<li><h1 style='font-weight:300;color:green;font-size:20px'>Capítulo ".$r.": ".$zzw['nombre']."</h1>";
                echo "<ul>";
                									
									$conzww= mysqli_query($link,"SELECT * FROM secciones WHERE clavew='".$zzw['idcapitulo']."'");
									$zzww=mysqli_fetch_assoc($conzww);								
                  $www=mysqli_num_rows($conzww);
                if($www>0){

                  $i=1;
								do{
								echo "<li><a>Sección ".$i.": ".$zzww['nombre']."</a></li>";
								$i++;
								}while($zzww=mysqli_fetch_assoc($conzww));

              }else{
                echo "<li> No hay secciones creadas</li>";
              }					
              echo "</ul>";
              echo "</li>";
                
                $r++;
								}while($zzw=mysqli_fetch_assoc($conzw));
                echo "</ul>";
                }else{
                echo "<li>No hay capítulos creadas</li>";
                }					
                ?>


</div>

</form> 
</div>



<?php 
echo "<input type='button' style='border:none;padding:5px;font-family:Georgia;font-size:16px;background:rgb(20,2,105);color:rgb(255,255,255);border-radius:5px 5px 0px 0px;cursor:pointer;' name='' class='buyButtonw' value='Comprar el curso' user='".$_SESSION['user']."' clave='".$a['clave']."' data-producto='".$a['nombre']."' data-precio='".$a['precio']."00'>";
echo "</div>";
    }while($a=mysqli_fetch_assoc($con));
}else{
    echo "No hay clases creadas";
}
}
?>
</div>

</article>


<!--Culqi-->


<script>
Culqi.publicKey = 'pk_test_18d083b191518652';
  
var producto = "";
var precio = "";
var user = "";
var clave = "";

  $('.buyButtonw').on('click', function(e) {

producto = $(this).attr('data-producto');
precio = $(this).attr('data-precio');
user = $(this).attr('user');
clave = $(this).attr('clave');

Culqi.settings({
    title: producto,
    currency: 'PEN',
    description: producto,
    amount: precio
  });
  
  // Abre el formulario con la configuración en Culqi.settings
    Culqi.open();
    e.preventDefault();
  });


function culqi() {
  if (Culqi.token) { // ¡Objeto Token creado exitosamente!
        var token = Culqi.token.id;
        var email = Culqi.token.email;
        
        var data = {producto:producto, precio:precio, token:token, email:email};
        
        var url = "proceso.php";

$.post(url,data,function(resw){
if(resw.trim() === "exitoso") {
alert('Tu pago fue exitoso. Agradecemos tu preferencia. Si es necesario, actualice la página para cargar su curso a su listado.')  ? "" : location.reload();


var httpr=new XMLHttpRequest();
httpr.open("POST", "./cul.php",true);
httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
httpr.send("user="+user+" & clave="+clave);

header("Location:unirse.php");
}else{
      alert("No se logró realizar el pago.");

}
     });
    
    } else { // ¡Hubo algún problema!
      // Mostramos JSON de objeto error en consola
      console.log(Culqi.error);
      alert(Culqi.error.user_message);
  }
};
</script>







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
  background-color: rgba(0,0,0,0.5);
  z-index: 999;
}
.sesion{
width:1000px;
position:absolute;
z-index: 9999;
padding:18px;
border-radius:15px;
position:absolute;
top:50%;
left:50%;
 z-index: 999;
text-align: center;
background-color: rgb(255,255,255);
transform:translate(-50%,-50%);
} 

@media screen and (max-width:800px){
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
background-color: rgb(100,0,220);
transform:translate(-50%,-50%);
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








<!--
paypal


<div id="paypal-button-container"></div>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'paypal',
          
      },
      createOrder: function(data, actions) {
          return actions.order.create({
              purchase_units: [{
                  amount: {
                      value: '1'
                  }
              }]
          });
      },
      onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
              alert('Transaction completed by ' + details.payer.name.given_name + '!');
          });
      }
  }).render('#paypal-button-container');
</script>

16399


-->






<!--las clases adjuntads del estudiante-->








<script>
function Send_Data(){

var user=  document.getElementById("user").value;
var clave=  document.getElementById("clave").value;
 
var httpr=new XMLHttpRequest();
httpr.open("POST", "./cul.php",true);
httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
httpr.send("user="+user+" & clave="+clave);
}

</script>

 <!--  
<div class="form">
    <input type="text" name="user" id="user" placeholder="usuario" required><br>
    <input type="text" name="clave" id="clave" placeholder="Clave de la clase" required><br>
   <input type="submit" value="Unirse a clase" onclick="Send_Data()"><br>
<span id="response"></span>

</div>
-->







<style>

.contenedor{
    display:flex;
    width:100%;
    
    flex-wrap:wrap;
    align-items: center;
  justify-content: center;
}
.contenedor .imagen{
text-align: center;
width:250px;
border-radius:10px;
position:relative;
margin:10px;
background-color: rgb(250,205,250);
#border: 2px solid rgb(100,10,170);
#box-shadow:0px 1px 0px 1px rgba(0,0,0,.2);
}



.wrapperest {
  width:100px;
  height:100px;
  overflow: hidden;
  border-radius:50%;
  position: relative;
  object-fit:cover;
}
.wrapperest img {
  height:283px;
  position: absolute;
  top:50%;
  left:50%;
  object-fit:cover;
  transform: translate(-50%,-50%)
}


</style>




<?php
if($w['tipo']=='estudiante'){
  ?>
  <article style="background:rgb(50,0,50);">
<h1 style="color:rgb(250,200,250);">
Tus cursos</h1>
<?php


if(isset($_REQUEST['ew'])){
  mysqli_query($link,"DELETE FROM misclases WHERE idmiclase=".$_REQUEST['ew']);
}

$con= mysqli_query($link,"SELECT clase.nombre, misclases.idmiclase, clase.clave, clase.foto, clase.usuario FROM clase, misclases WHERE clase.clave=misclases.clave AND misclases.usuario='".$w['email']."'");
$n=mysqli_num_rows($con);
$ww=mysqli_fetch_assoc($con);
//   echo $w['email'];
    ?>
<div class= "contenedor">
<?php  
$_SESSION['clave']=$ww['clave'];

if($n>0){
  do{
    echo "<a style=';text-decoration: none;cursor:pointer;' href='capitulo.php?clave=".$ww['clave']."'>";
    echo "<div class='imagen'>";
    echo "<div style='background:rgb(80,0,80);padding:3px;border-radius:0px 0px 5px 5px;width:80%; margin:10px auto; color:rgb(255,255,255);'>Ir a la clase</div>";
    echo "<div class='wrapper' style='margin:5px auto;'><img src= 'archivoscrearclase/".$ww['usuario']."".$ww['foto']."' onerror=this.src='curso.png'></div>";
    echo "<h1 style='background:rgb(70,70,70);border-radius:5px 5px 0px 0px;width:90%; margin:10px auto;font-size:23;padding:3px;color:rgb(250,200,270)'>" .$ww['nombre']. "</h1>";
    echo "</div>";
    echo "</a>";
  }while($ww=mysqli_fetch_assoc($con));
}else{
    echo "<h2>No tienes cursos disponibles, obtenga uno de nuestros cursos de arriba</h2>";
}
}
?>
</div>









<script>
function preguntar(valor){
eliminar=confirm("¿Estas seguro de eliminar esta clase?"); 
if(eliminar)
window.location.href="inicio.php?ew="+valor; 
}
</script>

</article>
</article>








<?php include('footer.php'); ?>
