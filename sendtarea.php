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



$idsec=$_SESSION['idsec']=$_GET['idsec'];
$idcpt=$_SESSION['idcpt']=$_GET['idcpt'];



?>

<?php include('first.php');?><?php include('margin.php'); ?>

<script src="jquery-3.0.0.min.js"></script>


<script>
$(document).ready(function(){
function obtenersendtarea(){
$.ajax({
url:"sendtareajax.php",
method:"POST", 
success:function(data){
$("#tarea").html(data)
}
})
}
obtenersendtarea();


//archivos insert.
$(document).on("change", "#imagew", function() {
    var idseccion="<?php echo $_SESSION['idsec']?>";
    var user="<?php echo $_SESSION['user']?>";             //
    var data = new FormData();
    data.append('file', $('#imagew')[0].files[0]);
    
    data.append('idseccion',idseccion);
    data.append('user',user);
//    alert(idseccion);
    
$.ajax({
        type: 'post',
        url: "sendtareajax.php",
        processData: false,
        contentType: false,
        data: data,
        success: function (data) {
        obtenersendtarea();
//        alert(data);
        }
    });
});


//INSERTAR y actualizar tarea
$(document).on("blur", "#addtarea", function(){
var clavecurso="<?php echo $_SESSION['clave']?>";      //
var idseccion="<?php echo $_SESSION['idsec']?>";
var idcapitulo="<?php echo $_SESSION['idcpt']?>";
var user="<?php echo $_SESSION['user']?>";             //
var text=$(this).val();
//   alert(clavecurso);
//   alert(idseccion);
//   alert(idcapitulo);
//   alert(user);
//   alert(text);
$.ajax({
url:"sendtareajax.php",
method:"post",
data:{clavecurso:clavecurso, idseccion:idseccion,idcapitulo:idcapitulo,user:user,text:text},
success:function(data){ 
obtenersendtarea();
//  alert(data);
}})})
 

//ELIMINAR tarea
$(document).on("click", "#deleteww", function(){
if(confirm("Esta seguro de eliminar esta fila")){
var idw=$(this).data("idw");var ids=$(this).data("ids");
alert(ids);
$.ajax({
url:"sendtareajax.php",
method:"post",
data:{ideleteww1:idw},
success:function(data){
obtenersendtarea();
//alert(data);
}
})
};
})



})
</script>

<div id ="tarea"></div>



<?php include('footer.php'); ?>
