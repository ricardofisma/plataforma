<style>

input[type='submit']{
	width: 100%;
	height: 40px;
	border: none;
	border-radius: 5px;
background: rgb(255,25,255);
	cursor: pointer;
}

textarea{  
#  display: block;
  box-sizing: padding-box;
  overflow: hidden;
background: rgb(255,255,255);
  padding: 5px;
  width: 100%;
  border-radius: 8px;
  border: none;
}

</style>
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
			
			
			<!DOCTYPE html>
			<html>
			<head>

<title>Chat</title>


<?php include('first.php');?><?php include('margin.php'); ?>
			
				<script type="text/javascript">
					function ajax(){
						var req = new XMLHttpRequest();
			
						req.onreadystatechange = function(){
							if (req.readyState == 4 && req.status == 200) {
								document.getElementById('chat').innerHTML = req.responseText;
							}
						}
			
						req.open('GET', 'chat.php', true);
						req.send();
					}
			
					//linea que hace que se refreseque la pagina cada segundo
					setInterval(function(){ajax();}, 1000);
				</script>
</head>




<body onload="ajax();">
			
	<div style='width:90%;padding:5px;margin:auto;border-radius:5px;background:rgb(10,100,100);'>
			<form method="POST" action="chatt.php">
				<textarea name="mensaje" class='autoExpand' rows='2' data-min-rows='3' placeholder='Escriba su mensaje'></textarea>
				<input type="submit" name="enviar" value="Enviar mensaje">
			</form>

	
			<div id="chat"></div>
<?php
$nombre=mysqli_query($link,"SELECT * FROM usuario WHERE idusuario='".$_SESSION['user']."'");
$nombreww=mysqli_fetch_assoc($nombre);
$nombrew=mysqli_num_rows($nombre);
?>

		<?php
			if (isset($_POST['enviar'])) {
				$nombre = $nombreww['nombre'];
				$mensaje = $_POST['mensaje'];
				$consulta = "INSERT INTO chat (nombre, mensaje) VALUES ('$nombre', '$mensaje')";
				$ejecutar = $link->query($consulta);
				if ($ejecutar) {
					echo "<embed loop='false' src='beep.mp3' hidden='true' autoplay='true'>";
				}
			}

		?>
	</div>


<?php include('footer.php'); ?>



</body>
</html>