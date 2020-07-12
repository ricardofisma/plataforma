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

<title>Inicio</title>


<?php include('first.php');?><?php include('margin.php'); ?>



<?php
$_SESSION['clave']=$_GET['clave'];

if(isset($_REQUEST['jjw'])){
    $clave = $_SESSION['clave'];
    $n = $_REQUEST['nombre'];
    $n = mysqli_real_escape_string($link, $n);
    $text = $_REQUEST['descripcion'];
       $text = mysqli_real_escape_string($link, $text); 
    mysqli_query($link, "INSERT INTO capitulo VALUES(NULL, '$n','$text', '$clave')");
}

if(isset($_REQUEST['e'])){
mysqli_query($link, "DELETE FROM capitulo WHERE idcapitulo='".$_REQUEST['e']."'");
mysqli_query($link, "DELETE FROM secciones WHERE clavew='".$_REQUEST['e']."'");
mysqli_query($link, "DELETE FROM tareas WHERE clavew='".$_REQUEST['e']."'");
}

$con=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
$n=mysqli_num_rows($con);
$a=mysqli_fetch_assoc($con);

$_SESSION['clavew']= $a['idcapitulo'];
//echo $_SESSION['clave'];
//
//echo $a['idcapitulo'];
?>

<article>


<?php
if($w['tipo']=='docente'){
?>
<h1>Gestión de CAPITULOS</h1>
    <form action="capitulo.php?clave=<?php echo $_SESSION['clave']?>" method="post" enctype="multipart/form-data">
    <input style='width:300px' class='crearclase' type="text" name="nombre" placeholder="Nombre del capítulo" required>
    <textarea name="descripcion" id="" cols="30" rows="7" placeholder="Descripcion del capítulo" required></textarea>
    <input class='crearclase' type="submit" value="Crear capítulo" name="jjw">
    </form>

<?php
}
?>

<div style= "display:flex; width:100%; flex-wrap:wrap; align-items: center; justify-content: center;">
  <?php
if($n>0){
$i=1;

  do{
      echo "<a style='cursor: pointer;;text-decoration: none;color:white;' href='secciones.php?clavew=".$a['idcapitulo']."&clave=".$_SESSION['clave']."'>";
      echo "<div class='imagen' style='float:left;'>";
      echo "<div style='padding:7px;text-align: center;background:rgb(50,0,50);width:280px;border-radius:10px;position:relative;margin:5px;box-shadow:0px 0px 5px 0px rgba(0,0,0,.75);'>";

      echo "Capitulo ".$i."<div style='margin:auto;width:80%'><h1>" .$a['nombre']. "</h1></div>";
      echo "<div style='margin:auto;width:80%'><p>Ver capítulo</p></div>";
      if($w['tipo']=='docente'){
      echo "<a href='updatecapitulo.php?update=".$a['idcapitulo']."' style='margin:auto;width:80%; text-decoration:none;color:rgb(75,105,75);'> Editar </a>";
echo "<a style='text-decoration: none;' href=\"javascript:preguntarw('".$_SESSION['clave']."', '".$a['idcapitulo']."')\"><div  style='margin:auto;width:80%; margin-bottom:0px;'><p style='border-radius:5px 5px 0px 0px;background:rgb(200,100,100);'>Eliminar</p></div></a>";

    }
      echo "</div>";
      $i++;
      echo "</div>";
      echo "</a>";
    }while($a=mysqli_fetch_assoc($con));
  }else{
    echo "<tr><td> No hay capítulos creadas</td></tr>";
  }
?>
</div>



<script>
function preguntarw(w, ww){
eliminar=confirm("Esta seguro de eliminar esta clase?")
if(eliminar)
window.location.href="capitulo.php?clave="+w+"&e="+ww;
}
</script>

</article>

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







  <?php
//echo $_SESSION['clave'];
$conw=mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
$nw=mysqli_num_rows($conw);
$ww=mysqli_fetch_assoc($conw);

if($nw>0){
  $i=1;
  do{
    echo "<article style='margin:3px auto;padding:5px;background:rgb(200,200,200);'>";
    echo "<button id='".$ww['idcapitulo']."7' style='border:none;padding:5px;width:95%;background:rgb(50,0,50);;border-radius:5px;font-family:serif;font-size:20px;text-align:left;color:rgb(255,255,255);cursor:pointer;'>Capitulo ".$i.": ".$ww['nombre']."</button>";
    echo "<div style='display:none;' id='".$ww['idcapitulo']."'>";
  
  ?>     
<script>
var button = document.getElementById('<?php echo $ww['idcapitulo']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $ww['idcapitulo']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
        <?php
//    echo "<div style='margin:auto;width:95%;background:rgb(100,0,100);'><h1>Capitulo ".$i.": ".$ww['nombre']. "</h1></div>";
      echo "<div style='margin:auto;width:95%;background:rgb(100,100,10)'>" .$ww['descripcion']. "</div>";
      //echo "<div style='margin:auto;width:80%;background:rgb(10,100,100)'>" .$ww['idcapitulo']. "</div>";
      //  echo "<div style='margin:auto;width:80%;background:rgb(10,100,100)'>" .$ww['clave']. "</div>";
      $i++;
      
      $conw1=mysqli_query($link,"SELECT * FROM secciones WHERE clavew='".$ww['idcapitulo']."'");
      $ww1=mysqli_fetch_assoc($conw1);
      $nw1=mysqli_num_rows($conw1);
      
      
      if($nw1>0){
  $j=1;
  do{
//    echo "<div style='margin:auto;width:90%;background:rgb(250,255,255);'><h1>Seccion ".$j.": ".$ww1['nombre']. "</h1></div>";
    echo "<button id='".$ww1['idseccion']."7' style='margin-left:35px;border:none;padding:5px;width:90%;background:rgb(110,100,100);margin:1px;border-radius:5px;font-family:serif;font-size:20px;text-align:left;color:rgb(255,255,255);cursor:pointer;'>Sección ".$j.": ".$ww1['nombre']."</button>";
    echo "<div style='display:none;' id='".$ww1['idseccion']."'>";
  
  ?>     
<script>
var button = document.getElementById('<?php echo $ww1['idseccion']."7"?>');
button.onclick = function() {
    var div = document.getElementById('<?php echo $ww1['idseccion']?>');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
    else {
        div.style.display = 'block';
    }
};
</script>
        <?php
    echo "<div style='margin:auto;width:90%;background:rgb(200,250,255);padding:5px'>" .$ww1['texto']. "</div>";
            echo "<a style=' color: blue; margin-right: 10px; font-size: 20px;' href='capitulo.php?clave=".$_SESSION['clave']."&ma=".$ww1['idseccion']."'><i class='fa fa-edit'></i></a>";
    echo "<div style='margin:auto;width:85%;background:rgb(255,255,255);padding:5px;'><h1>Tarea: </h1>".$ww1['tarea']."</div>";
   echo "<div style='margin:auto;width:85%;background:rgb(100,100,100);margin-bottom:5px;padding:5px;'>";
    $not=mysqli_query($link,"SELECT * FROM tareas WHERE usuario ='".$_SESSION['user']."' AND idplan ='".$ww1['idseccion']."'");   
        $notw=mysqli_fetch_assoc($not);
        $nnot=mysqli_num_rows($not);

        if($notw['evaluacion']!=""){
          echo "Calificación: \(".$notw['evaluacion']."\)";
        }elseif($nnot>0){ 
            echo "Tarea aún no evaluada - ";
            echo "<a style='text-decoration:none;color:rgb(255,100,100);' href='sesion.php?claveww=".$ww1['idseccion']."'>Modificar</a>";
        }else{
          echo "Tarea no entregada - ";
            echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='sesion.php?claveww=".$ww1['idseccion']."'>Entregar</a>";
        }
        echo "<a style='text-decoration:none;color:rgb(255,255,255)' href='calificaciones.php'> - Resumen de ".$zz['nombre']."</a>";
        
        echo "</div>";
        echo "</div>";


 //     echo "<div style='margin:auto;width:80%;background:rgb(10,100,100)'>" .$ww1['idseccion']. "</div>";
      $j++;
      
    }while($ww1=mysqli_fetch_assoc($conw1));  
  }else{
    echo "<tr><td> No hay secciones creadas</td></tr>";
  }
  
  echo "</div>";
    echo "</article>";
  
}while($ww=mysqli_fetch_assoc($conw));  
}else{
  echo "<tr><td> No hay capítulos creadas</td></tr>";
}

?>




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

    <div id="sprite"></div>
    <script src="sprites/dist/spritz.js"></script>

    <script>

        let sprite = Spritz('#sprite', {
            picture: { srcset: 'sprites/test/spritesheets/singlerow/z.jpg' },
            steps: 7
        }).flip().fps(5).playback().pause()
    </script>


    <div id="sprites" style='width: 500px;height: 500px; border:1px solid; margin:auto; position: relative; overflow: hidden;'></div>

    <script>
        let sprites = Spritz('#sprites', {
            picture: { srcset: 'sprites/test/spritesheets/singlerow/ww.jpg' },
            steps: 6
        }).flip().fps(5).playback().wait(2000)
    </script>

<?php include('footer.php'); ?>




