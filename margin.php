<?php

require('conect.php');

if(!isset($_SESSION['user'])){
header("Location:index.php");
        }

if(isset($_REQUEST['cerrar'])){
   session_destroy();
   header("Location:index.php");
}

$conz= mysqli_query($link,"SELECT clase.nombre FROM clase WHERE clave='".$_SESSION['clave']."'");
    $zz=mysqli_fetch_assoc($conz);

$conzw= mysqli_query($link,"SELECT * FROM capitulo WHERE clave='".$_SESSION['clave']."'");
    $zzw=mysqli_fetch_assoc($conzw);


//echo $zz['nombre'];


?>






	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/font-awesome.css">

	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/main.js"></script>

	<header>
		<span id="button-menu" class="fa fa-bars"></span>

		<nav class="navegacion"  id="buttonw-menuw" style='cursor:pointer;'>
			<ul class="menu">
				<!-- TITULAR
				<li class="title-menu">Todas las categorias</li>
				 TITULAR -->
				
				<li><a href="capitulo.php?clave=<?php echo $_SESSION['clave'];?>"><span class="fa fa-home icon-menu"></span>Inicio del curso</a></li>
				
				
				<li class="item-submenu" menu="2">
					<a href="#"><span class="fa fa-book icon-menu"></span><?php echo $zz['nombre']?></a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-book icon-menu"></span></span><?php echo $zz['nombre']?></li>
						<li class="go-back">Atras</li>
				
								<?php
								$r=1;
								do{
									echo "<li class='itemw-submenuw' menu='".$zzw['idcapitulo']."'>";
									echo "<a><span></span>Capítulo ".$r.": ".$zzw['nombre']."</a>";
									echo "<ul class='submenuw'>";
									echo "<li class='titlew-menuw'><span class='fa fa-suitcase icon-menu'></span>Capítulo ".$r.": ".$zzw['nombre']."</li>";
									echo "<li class='go-backw'>Atras</li>";
								
									$conzww= mysqli_query($link,"SELECT * FROM secciones WHERE clavew='".$zzw['idcapitulo']."'");
									$zzww=mysqli_fetch_assoc($conzww);
									$n=mysqli_num_rows($conzww);
									if($n>0){

										$i=1;
									do{
									echo "<li><a href='sesion.php?claveww=".$zzww['idseccion']."'>Sección ".$i.": ".$zzww['nombre'].$zzww['idseccion']."</a></li>";
									$i++;
									}while($zzww=mysqli_fetch_assoc($conzww));
									
								}else{
								echo "";
								}
									echo "</ul>";
									echo "</li>";

									$r++;
									}while($zzw=mysqli_fetch_assoc($conzw));
								?>

					</ul>
				</li>
				
				<li>  <a href="foro.php"><span class="fa fa-comments-o icon-menu"></span>Foro</a></li> 
				<li>  <a href="tareas.php"><span class="fa fa-tasks icon-menu"></span>Tareas</a></li> 
				<li>  <a href="calificaciones.php"><span class="fa fa-list icon-menu"></span>Calificaciones</a></li> 
				<li>  <a href="email.php"><span class="fa fa-envelope icon-menu"></span>Email</a></li> 
				<li>  <a href="archivos.php" ><span class="fa fa-archive icon-menu"></span>Archivos</a></li> 
				<li>  <a href="miembros.php"><span class="fa fa-users icon-menu"></span>Integrantes</a></li>
				<li>  <a href="inicio.php?cerrar=1"><span class="fa fa-sign-out icon-menu"></span>Cerrar sesión</a></li>
<!--
				<li class="item-submenu" menu="1">
					<a href="#"><span class="fa fa-suitcase icon-menu"></span>Servicios</a>
					<ul class="submenu">
						<li class="title-menu"><span class="fa fa-suitcase icon-menu"></span>Servicios</li>
						<li class="go-back">Atras</li>
			
						<li><a href="#">Diseño web</a></li>
						<li><a href="#">Alojamiento web</a></li>
						<li><a href="#">Dominios</a></li>
					</ul>
				</li>
	-->
			</ul>
		</nav>
	</header>



