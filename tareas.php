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


$qtareas=mysqli_query($link,"SELECT * FROM plan WHERE clave='".$_SESSION['clave']."' ORDER BY fecha DESC");
$ntareas=mysqli_num_rows($qtareas);
$arraytareas=mysqli_fetch_assoc($qtareas);


$con= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
$wew=mysqli_fetch_assoc($con);
    ?>




<title>Tareas</title>

<?php include('first.php');?><?php include('margin.php'); ?>



<h1 >Tareas del curso de <?php echo $wew['nombre']?></h1> 

<article>

<?php
if($ntareas>0){
    do{
      echo "<ul>";
      echo "<li><a href='entregatarea.php?tarea=".$arraytareas['idplan']."'>".$arraytareas['titulo']."</a></li>";
      echo "</ul>";
    }while($arraytareas=mysqli_fetch_assoc($qtareas));
  }else{

    echo "No hay tarea";
  }
  ?>


</article>
<?php include('footer.php');?>
