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



$user=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'")     ;
$w=mysqli_fetch_assoc($user);


$conwW=mysqli_query($link,"SELECT * FROM categoria WHERE user='".$_SESSION['user']."'");
$conw=mysqli_query($link,"SELECT * FROM categoria");
$nw=mysqli_num_rows($conw);
$curso1=mysqli_fetch_assoc($conw);


?>  

<article style="background:rgb(70,200,200);">
<div  style= "display:flex; width:100%;border:3px solid rgb(255,255,225);width:90%; margin:auto; border-radius: 10px;   display:flex;
    width:100%;
    padding:5px;
    flex-wrap:wrap;
    align-items: center;
  justify-content: center;">
<?php
echo "<div style=' color:rgb(255,255,255);font-size: 50px;margin :auto;'  title='Edite su perfil' class='www'><a href='editar.php' ><i class='fa fa-cog'></i></a></div>";
echo "<div title='Edite su perfil' class='wrapper' style='margin: auto;'><a style='cursor: pointer;'><img style='cursor: pointer;'  class='image'  id='".$w['idusuario']."' src= 'archivos/".$w['idusuario']."".$w['foto']."' onerror=this.src='foto.png'></a></div>";
//echo "</div>";
//echo "</div>";
echo "<div style='margin:auto;background:rgb(10,100,100);border-radius:7px;color:white;font-size:20px;text-align:center;padding:5px;' id='nombre' data-c1='".$w['idusuario']."' contenteditable>".$w['nombre']."</div>";
?>
</div>
</article>


<?php 
if($w['tipo']=='docente'){
  echo "<article>";
echo "<a style='text-decoration:none;font-size:20px;' href='index.php'>Edite el landing page</a>";
//echo "<a style='text-decoration:none;font-size:20px;' href='filetransfer/index.html'>www</a>";
echo "</article>";
}
?>


<script>

iframe.onerror = function() {
  console.log("Something wrong happened");
};  
</script>

  <?php

if($nw>0){
  do{
    
echo "<article style='background:".$curso1['color'].";padding:0px;'>";
if($w['tipo']=='docente'){
echo "<input style='padding:1px;border-radius:3px;border:2px solid;float:right;' type='color' id='color' data-c1='".$curso1['id']."' value = '".$curso1['color']."'>";
echo "<div style='margin:0px auto;width:80%;background:rgb(10,100,100);border-radius:0px 0px 5px 5px;color:white;font-size:30px;text-align:center;' id='nombre' data-c1='".$curso1['id']."' contenteditable><p style='border-radius:0px 0px 5px 5px;padding:5px;'>".$curso1['nombre']."</p></div>";
echo "<div style='margin:auto;width:80%; margin-bottom:5px;background:rgb(80,90,80);border-radius:5px;color:white;text-align:center' id='desc' data-c1='".$curso1['id']."' contenteditable><p style='border-radius:0px 0px 5px 5px;padding:5px;'>".$curso1['descripcion']."</p></div>";
}else{
  echo "<div style='margin:0px auto;width:80%;background:rgb(10,100,100);border-radius:0px 0px 5px 5px;color:white;font-size:30px;text-align:center;'>".$curso1['nombre']."</div>";
  echo "<div style='margin: 0px auto;width:80%; margin-bottom:5px;background:rgb(80,90,80);border-radius:5px;color:white;text-align:center'><p style='border-radius:0px 0px 5px 5px;padding:5px;'>".$curso1['descripcion']."</p></div>";
}



$con=mysqli_query($link,"SELECT * FROM clase WHERE categoria='".$curso1['id']."'");
$n=mysqli_num_rows($con);
$curso=mysqli_fetch_assoc($con);

echo "<div style='    display:flex;    width:100%;    flex-wrap:wrap;    align-items: center;    justify-content: center;'>";

if($n>0){
  do{
    
    echo "<div class='imagen' style='float:left;'>";
    

    $misclases=mysqli_query($link,"SELECT * FROM misclases WHERE clave='".$curso['clave']."' AND usuario='".$_SESSION['user']."'");
    $nmisclases=mysqli_num_rows($misclases);
    $misclasesw=mysqli_fetch_assoc($misclases);
    

    if($nmisclases>0){
      echo "<div style='text-align: center;background:rgb(255,100,100);width:250px;border-radius:10px;position:relative;margin:5px;border:1px solid;'>";
    }else{
      echo "<div style='text-align: center;background:rgb(255,255,255);width:200px;border-radius:5px;position:relative;margin:5px;padding:0.2em;'>";
    
    }
    if($w['tipo']=='estudiante'){
    echo "<div style='margin: 0px auto;width:80%;background:rgb(10,100,100);border-radius:0px 0px 5px 5px;color:white;font-size:20px;'>".$curso['nombre']."</div>";
    }
    if($curso['link']=='Link video'){
      ECHO "<iframe src='https://www.youtube.com/embed/zoGqt6ObPC8' style='align:center;display:block;width:100%; height:200px;border-radius:3px;' frameborder='0' allowfullscreen='allowfullscreen'>wwwww</iframe>";
      }else{
      ECHO "<iframe src='".$curso['link']."' style='align:center;display:block;width:100%;height:200px;border-radius:3px;' frameborder='0' allowfullscreen='allowfullscreen'>ww</iframe>";
    }
     //    echo "<iframe style='align:center;display:block;;margin:5px auto;width:97%;height:300px;border-radius:3px;' data='".$curso['link']."'  frameborder = '0' allowfullscreen></iframe>";
        //  echo "<div style='margin:auto;width:80%; margin-bottom:5px;'><p>" .$curso['clave']. "</p></div>";
  //  echo "<div style='margin:auto;width:80%'><p>" .$curso['fecha']. "</p></div>";
    if($w['tipo']=='docente'){
    echo "<div style='margin: 0px auto;width:80%;background:rgb(10,100,250);border-radius:0px 0px 5px 5px;color:white;font-size:20px;' id='www' data-c1='".$curso['idclase']."' contenteditable>".$curso['nombre']."</div>";
      echo "<div style='background:rgb(230,255,250);border-radius:5px;margin:3px;padding:5px;cursor:pointer' id='ccc' data-cc='".$curso['idclase']."' contenteditable>".$curso['link']."</div>";
      echo "<div style='background:rgb(230,205,205);border-radius:5px;margin:3px;padding:5px;cursor:pointer' id='cc3' data-c3='".$curso['idclase']."' contenteditable>".$curso['descripcion']."</div>";
      echo "<button style='border:none;border-radius:50%;cursor:pointer;' name='update' class='update' id='".$curso['idclase']."'  data-id='".$curso1['id']."'><div class='wrapper' style='margin:5px auto;'><img src= 'archivoscrearclase/".$curso1['id']."_".$curso['idclase']."_".$curso['foto']."' onerror=this.src='curso.png'></div></button>";
  }
  //    echo "<div style='background:rgb(23,3,80);border-radius:5px;margin:3px;padding:5px;cursor:pointer' id='cc3' data-c3='".$curso['idclase']."' contenteditable>".$curso['idclase']."</div>";
    if($w['tipo']=='estudiante'){
  echo "<div style='background:rgb(230,205,205);border-radius:5px;margin:3px;padding:5px' id='cc3' data-c3='".$curso['idclase']."' >".$curso['descripcion']."</div>";
    echo "<div class='wrapper' style='margin:5px auto;'><img src= 'archivoscrearclase/".$curso1['id']."_".$curso['idclase']."_".$curso['foto']."' onerror=this.src='curso.png'></div>";
    }
    echo "<div style='margin:5px auto;'><a style='cursor: pointer;color:rgb(70,10,70);' href='curso.php?clave=".$curso['clave']."&clave1=".$curso1['id']."&'>Introduccion al curso</a></div>";
    if($w['tipo']=='docente'){
      echo "<div style='margin:5px auto;'><a style='cursor: pointer;' href='capitulo.php?clave=".$curso['clave']."'>Ir al curso</a></div>";

      echo "<button type='button' name='delete' class='btn btn-danger bt-xs'id='deletecurso' data-c1='".$curso['idclase']."' data-cc1='".$curso1['id']."'>Delete</button><br><br>";
    }
    
    if($nmisclases>0){
      //echo "Curso comprado";
      echo "<div style='border:none;padding:5px;font-size:20px;width:80%;font-family:Georgia;background:rgb(7,20,75);border-radius:5px 5px 0px 0px;cursor:pointer;margin:auto;'><a style='cursor: pointer;color:white;' href='capitulo.php?clave=".$curso['clave']."'>Ir al curso</a></div>";
      
    }else{
 
      if($w['tipo']=='docente'){
      echo "<div style='background:rgb(50,30,250);border-radius:5px;margin:3px;padding:5px;cursor:pointer; color:white;' id='cc2' data-c2='".$curso['idclase']."' contenteditable>".$curso['precio']."</div>";
         }else{
      echo "<div style='background:rgb(50,30,250);border-radius:5px;margin:3px;padding:5px;color:white;'>S/ ".$curso['precio']."</div>";
        }
      echo "<input type='button' style='border:none;padding:5px;font-size:20px;font-family:Georgia;background:rgb(20,2,105);color:rgb(255,255,255);border-radius:5px 5px 0px 0px;cursor:pointer;' name='' class='buyButtonw' value='Comprar el curso' user='".$_SESSION['user']."' categoria='".$curso1['id']."' clave='".$curso['clave']."' curso='".$curso['nombre']."' data-producto='".$curso['nombre']."' id='".$curso['idclase']."' data-precio='".$curso['precio']."00'>";
}
echo "</div>";

echo "</div>";


}while($curso=mysqli_fetch_assoc($con));

}else{
  echo "<div style='margin:auto;width:30%;text-align:center;background:rgb(250,100,100);border-radius: 5px;color:white;display:block;'> No hay clases creadas</div>";
}

if($w['tipo']=='docente'){
echo "<div style='margin:auto;width:90%;text-align:center;background:rgb(200,200,210);border-radius: 5px 5px 0px 0px;color:white;cursor:pointer;' id='delete' data-c1='".$curso1['id']."'>Delete</div>";
echo "<div style='margin:auto;width:90%;text-align:center; margin-bottom:0px;background:rgb(10,100,100);border-radius: 5px 5px 0px 0px;color:white;cursor:pointer;' id='curso' data-c1='".$curso1['id']."'>Adicionar curso</div>";
}
echo "</article>";

}while($curso1=mysqli_fetch_assoc($conw));
}else{
  echo "No hay categorias creadas creadas";
  echo "<div style='background:rgb(520,30,250);border-radius:5px;margin:3px;width:90%;padding:5px;cursor:pointer;display:block;margin:auto' id='categoria'>Adicionar categoria</div>";
}
if($w['tipo']=='docente'){
  echo "<div style='background:rgb(520,30,250);border-radius:5px;margin:3px;width:90%;padding:5px;cursor:pointer;display:block;margin:auto' id='categoria'>Adicionar categoria</div>";
}
?>


</div>























































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
background-color: rgb(150,105,150);
#border: 2px solid rgb(100,10,170);
#box-shadow:0px 1px 0px 1px rgba(0,0,0,.2);
}

.contenedor .imagen:hover{
background-color: rgb(250,200,50);
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
  <article style="background:rgb(250,250,210);">
<h1 style="color:rgb(50,20,50);">
Tus cursos</h1>
<?php


if(isset($_REQUEST['ew'])){
  mysqli_query($link,"DELETE FROM misclases WHERE idmiclase=".$_REQUEST['ew']);
}
$con= mysqli_query($link,"SELECT * FROM clase, misclases WHERE clase.clave=misclases.clave AND misclases.usuario='".$_SESSION['user']."'");
$n=mysqli_num_rows($con);
$ww=mysqli_fetch_assoc($con);
//   echo $w['email'];
    ?>
<div class= "contenedor">
  <?php  
//$_SESSION['clave']=$ww['clave'];

if($n>0){
  do{
    echo "<a style=';text-decoration: none;cursor:pointer;' href='capitulo.php?clave=".$ww['clave']."'>";
    echo "<div class='imagen'>";
    echo "<div style='background:rgb(80,0,80);padding:3px;border-radius:0px 0px 5px 5px;width:80%; margin:0px auto; color:rgb(255,255,255);'>Ir a la clase</div>";
    echo "<div class='wrapper' style='margin:5px auto;'><img src= 'archivoscrearclase/".$ww['categoria']."_".$ww['idclase']."_".$ww['foto']."' onerror=this.src='curso.png'></div>";
//    echo "<h1 style='background:rgb(20,70,100);border-radius:5px 5px 0px 0px;width:90%; margin:0px auto;font-size:23;padding:3px;color:rgb(250,200,270);font-size:15px'>".$ww['categoria']."_".$ww['idclase']."_".$ww['foto']."</h1>";
    echo "<h1 style='background:rgb(20,70,100);border-radius:5px 5px 0px 0px;width:90%; margin:0px auto;font-size:23;padding:3px;color:rgb(250,200,270);font-size:15px'>" .$ww['nombre']. "</h1>";
    echo "</div>";
    echo "</a>";
  }while($ww=mysqli_fetch_assoc($con));
}else{
  echo "<h2>No tienes cursos disponibles, obtenga uno de nuestros cursos de arriba</h2>";
}
}

//echo $_SESSION['user'];

?>
</div>


