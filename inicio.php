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
//echo $_SESSION['user'];
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
.imagen{
   display: inline-block;
#  background:rgb(100,110,200);
}

.imagen .ww .www{
position:absolute; 
float:left;
top: 0%; 
left: 0%; 
display:none;
}

.imagen:hover .ww .www{
display:inline;
}


.imagen:hover img{
image: url("curso.png");

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
    $u=$w['idusuario'];
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

$con=mysqli_query($link,"SELECT * FROM clase WHERE usuario='".$w['idusuario']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con);
?>




<script src="js_c/jquery-1.10.2.min.js"></script>  
<link rel="stylesheet" href="css_c/bootstrap.min.css" />  
<script src="js_c/bootstrap.min.js"></script>  




<div id="imageModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Add Image</h4>
    
   </div>

   <div class="modal-body">

    <form id="image_form" method="post" enctype="multipart/form-data">

     <p><label>Seleccionar Imagen</label>
     <input type="file" name="image" id="image" /></p><br />
     <input type="hidden" name="action" id="action" value="insert" />
     <input type="hidden" name="image_id" id="image_id" /> <!--hidden-->
     <input type="hidden" name="wimage_id" id="wimage_id" /> <!--hidden-->
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
      
    </form>

   </div>
   <div class="modal-footer">
<!--
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
-->
   </div>
  </div>
 </div>
</div>



<script>


$(document).ready(function(){
function obtener_inicio(){
$.ajax({
url:"inicioajax.php",
method:"POST", 
success:function(data){
$("#resultadoinicio").html(data)
}})}


obtener_inicio();

//INSERTAR curso
$(document).on("click", "#curso", function(){
var claves="<?php echo $_SESSION['user']?>";
var clavvcategoria = $(this).data("c1");
//
//alert(clavvcategoria);
//alert(claves);
$.ajax({
url:"datos_inicio.php",
method:"post",
data:{clavecurso:claves,clavvcategoria:clavvcategoria},
success:function(data){ 
obtener_inicio();
//   alert(data);
}})})
    

//INSERTAR categoria
$(document).on("click", "#categoria", function(){
var claves="<?php echo $_SESSION['user']?>";
//alert(claves);
$.ajax({
url:"datos_inicio.php",
method:"post",
data:{clavewc:claves},
success:function(data){ 
obtener_inicio();
//   alert(data);
}})})
 
//ACTUALIZAR categoria
function actualizar_datoc(id,texto,columna){
$.ajax({
url:"datos_inicio.php",
method:"post", 
data:{widd: id, wtextt: texto, wcolumnn: columna},
success:function(data){
obtener_inicio();
//   alert(data);
}})}
//ACTUALIZAR nombre
$(document).on("blur", "#nombre", function(){
var id = $(this).data("c1");
var x1 = $(this).text();
// alert(x1);
// alert(id);
actualizar_datoc(id, x1,"nombre")
})
//ACTUALIZAR descripcion
$(document).on("blur", "#desc", function(){
var id = $(this).data("c1");
var x1 = $(this).text();
// alert(x1);
// alert(id);
actualizar_datoc(id, x1,"descripcion")
})
//ACTUALIZAR color
$(document).on("change", "#color", function(){
var id = $(this).data("c1");
var x1 = $(this).val();
// alert(x1);
// alert(id); 
actualizar_datoc(id, x1,"color")
})

 


//ACTUALIZAR curso
function actualizar_dato(id,texto,columna){
$.ajax({
url:"datos_inicio.php",
method:"post", 
data:{id: id, text: texto, column: columna},
success:function(data){
obtener_inicio();
//   alert(data);
}})}
//ACTUALIZAR nombre
$(document).on("blur", "#www", function(){
var id = $(this).data("c1");
var x1 = $(this).text();
// alert(x1);
// alert(id);
actualizar_dato(id, x1,"nombre")
})

//ACTUALIZAR precio
$(document).on("blur", "#cc2", function(){
var id = $(this).data("c2");
var x1 = $(this).text();
// alert(x1);
// alert(id);
actualizar_dato(id, x1,"precio")
})
//ACTUALIZAR precio
$(document).on("blur", "#cc3", function(){
var id = $(this).data("c3");
var x1 = $(this).text();
// alert(x1);
// alert(id);
actualizar_dato(id, x1,"descripcion")
})
$(document).on("blur", "#ccc", function(){
var id=$(this).data("cc");
var x=$(this).text();
var x1 = x.replace('https://www.youtube.com/watch?v=', 'http://www.youtube.com/embed/');
//alert(x1);
//alert(id);
actualizar_dato(id, x1,"link")
})

//////////////////////////////////////////

obtener_inicio();




 $('#image_form').submit(function(event){
  event.preventDefault();
  var image_name = $('#image').val();
  if(image_name == '')
  {
   alert("Please Select Image");
   return false;

  }else{
   var extension = $('#image').val().split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
    alert("Invalid Image File");
    $('#image').val('');
    return false;
   }else{

    $.ajax({
     url:"datos_inicio.php",
     method:"POST",
     data:new FormData(this),
     contentType:false,
     processData:false,
     success:function(data)
     {
 //     alert(data);
obtener_inicio();
      $('#image_form')[0].reset();
      $('#imageModal').modal('hide'); 
     }

    });
   }
  }

 });

 $(document).on('click', '.update', function(){
  $('#image_id').val($(this).attr("id"));
  $('#wimage_id').val($(this).data("id"));
    $('#action').val("update");
  $('.modal-title').text("Actualizar imágen");
  $('#insert').val("Actualizar");  
  $('#imageModal').modal("show");
 });
 
 $(document).on('click', '.image', function(){
  $('#image_id').val($(this).attr("id"));
    $('#action').val("image");
  $('.modal-title').text("Actualizar imágen");
  $('#insert').val("Actualizar");  
  $('#imageModal').modal("show");
 });


//ELIMINAR categoria
$(document).on("click", "#delete", function(){
if(confirm("Esta seguro de eliminar esta categoria")){
var idw=$(this).data("c1");
//   alert(idw);
//  alert(idw);
$.ajax({ 
url:"datos_inicio.php",
method:"post",
data:{delet:idw},
success:function(data){
obtener_inicio(); 
}
})
};
})

//ELIMINAR CURSO
$(document).on("click", "#deletecurso", function(){
if(confirm("Esta seguro de eliminar esta categoria")){
var idw=$(this).data("c1");
var idc=$(this).data("cc1");
//   alert(idw);
//   alert(idw);
$.ajax({ 
url:"datos_inicio.php",
method:"post",
data:{deletw:idw, idc:idc},
success:function(data){
obtener_inicio();
//   alert(data);
}
})
};
})



});  
</script>


<div id ="resultadoinicio"></div>













<!--Culqi-->



<script>
Culqi.publicKey = 'pk_test_18d083b191518652';
  $(document).on('click', '.buyButtonw', function(){
//  $('.buyButtonw').on('click', function(e) {

producto = $(this).attr('data-producto');
precio = $(this).attr('data-precio');
user = $(this).attr('user');
clave = $(this).attr('clave');
categoria = $(this).attr('categoria');
curso  = $(this).attr('curso');
id  = $(this).attr('id');

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
        
        var data = {producto:producto, precio:precio, token:token, email:email,clave:clave,categoria:categoria,curso:curso,id:id};
        
        var url = "proceso.php";

//$.ajax({
//url:"cul.php",
//method:"post", 
//data:data,
//success:function(data){
//obtener_inicio();
////   alert(data);
//}})

$.post(url,data,function(resw){
if(resw.trim() === "exitoso") {
alert('Tu pago fue exitoso. Agradecemos tu preferencia. Si es necesario, actualice la página para cargar su curso a su listado.')  ? "" : location.reload();

var httpr=new XMLHttpRequest();
httpr.open("POST", "./cul.php",true);
httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
httpr.send("user="+ user +"&clave="+ clave +"&categoria="+ categoria +"&curso="+ curso +"&id="+ id);

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
