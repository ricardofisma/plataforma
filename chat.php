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

//function formatearFecha($fecha){
//	return date('g:i a', strtotime($fecha));
//}

	$consulta = "SELECT * FROM chat ORDER BY id DESC";
	$ejecutar = $link->query($consulta); 
	while($fila = $ejecutar->fetch_array()) : 

	echo "<div style='padding:5px;margin:5px auto;border-radius:5px;background:rgb(185,250,255);'>";
	echo "<div id='".$fila['id']."' style='display:;width:200px;text-align:center; padding:5px;margin:5px auto;border-radius:5px;background:rgb(15,20,255);'>".($fila['fecha'])."</div>";
	echo "<div style='width:200px;text-align:center; padding:5px;margin:5px auto;border-radius:5px;background:rgb(15,20,105);color:rgb(255,255,255);;display:inline-block;'>".$fila['nombre']."</div>";
	echo "<button id='".$fila['id']."7' style='width:700px;text-align:left; padding:5px;margin:5px auto;border-radius:5px;background:rgb(15,20,105);display:inline-block;color:white;'>".$fila['mensaje']."".$fila['id']."</button>";
	?>
	<script>
var button = document.getElementById('<?php echo $fila['id']?>');
button.onclick = function() {
	var div = document.getElementById('<?php echo $fila['id']."7"?>');
    if (div.style.display !== 'none') {
		div.style.display = 'none';
    }
    else {
		div.style.display = 'block';
    }
};
</script>	
<?php
	echo "</div>";
endwhile; //formatearFecha 

?>

