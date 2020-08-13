
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



include('first.php');
include('margin.php');


$con=mysqli_query($link,"SELECT * FROM clase WHERE clave='".$_GET['clave']."'");
$n=mysqli_num_rows($con);
$curso=mysqli_fetch_assoc($con);


if($n>0){
do{
  

    echo "<div style='text-align: center;background:rgb(255,25,255);width:80%;border-radius:5px;position:relative;margin:5px;margin:auto;'>"; 
    echo "<div style='margin: 0px auto;width:80%;background:rgb(10,100,100);border-radius:0px 0px 5px 5px;color:white;font-size:20px;'>".$curso['nombre']."</div>";
ECHO "<iframe src='".$curso['link']."' style='align:center;display:block;;margin:5px auto;width:300px;height:200px;border-radius:3px;' frameborder='0' allowfullscreen='allowfullscreen'>ww</iframe>";    echo "<div style='margin: 0px auto;width:80%;background:rgb(10,100,250);border-radius:0px 0px 5px 5px;color:white;font-size:20px;' id='www' data-c1='".$curso['idclase']."' contenteditable>".$curso['nombre']."</div>";
    echo "<div class='wrapper' style='margin:5px auto;'><img width='200' src= 'archivoscrearclase/".$_GET['clave1']."_".$curso['idclase']."_".$curso['foto']."' 
    onerror=this.src='curso.png'></div>";
    echo "<div style='background:rgb(230,205,205);border-radius:5px;margin:3px;padding:5px' id='cc3' data-c3='".$curso['idclase']."' >".$curso['descripcion']."</div>";
    echo "<div style='background:rgb(50,30,250);border-radius:5px;margin:3px;padding:5px;color:white;width:200px;margin:auto'>S/ ".$curso['precio']."</div>";
    echo "</div>";
    

    
  }while($curso=mysqli_fetch_assoc($con));
  
}else{
  echo "<div style='margin:auto;width:30%;text-align:center;background:rgb(250,100,100);border-radius: 5px;color:white;display:block;'> No hay clases creadas</div>";
}
  

?>


</div>









<?php


echo "<div style='    display:flex; width:80%;flex-wrap:wrap; background:rgb(255,250,180);margin:5px auto;border:1px solid; border-radius:5px;padding:5px'>";

$conzw= mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_GET['clave']."'");
$zzw=mysqli_fetch_assoc($conzw);
$ww=mysqli_num_rows($conzw);

echo "<ul>";

if($ww>0){
  
  do{
    $r=1;
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
<?php  
          include('footer.php'); 
?>