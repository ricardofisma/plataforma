<?php


if(isset($_REQUEST['w77']) && !empty($_REQUEST['w77'])){
	$str= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $u="";
    for($i=0;$i<11;$i++){
        $u .=substr($str,rand(0,62),1);
    }
	$p=$_REQUEST['pass'];
	$c=$_REQUEST['correo'];
	$n=$_REQUEST['nombre'];
    $f=$_FILES['picture']['name'];
    $t=$_REQUEST['tipo'];

	if (str_word_count($n) > 2 && str_word_count($n) < 5) {
		if (filter_var($c, FILTER_VALIDATE_EMAIL)) {
$ff=mysqli_num_rows(mysqli_query($link, "SELECT * FROM usuario WHERE email='".$c."'"));
if($ff>1){
    echo "<script> alert('Email ya esta registrado')</script>";
}else{
mysqli_query($link,"INSERT INTO `usuario` (`usuario`, `passw`, `nombre`, `foto`, `tipo`, `email`) VALUES ('$u','$p','$n','$f','$t','$c')");
copy($_FILES['picture']['tmp_name'],"archivos/".$u.$f);
 $_SESSION['user']=$u;
header("Location:inicio.php");
}

} else {
    echo("<script> alert('Formato de email incorrecto')</script>");
}

} else {
    echo("<script> alert('Especifique dos apellidos y un nombre como minimo y como máximo cinco palabras')</script>");
}

}

?>



<style>
td{
	text-align:center;

}

</style>


<div class="fff">

        
            <div style="font-size:10px;text-align:center;color:yellow;font-family:serif"><h1>Bienvenido a Interactive Dinamic Visual Learning</h1></div>
            <div style="text-align:center"><img src="ww1.svg" style="width:80px;" alt=""></div>
		
            <div style="font-size:8px;text-align:center;color:green;padding:0px;"><h1 >Regístrese y explore nuestros cursos</h1></div>

<form action="registro.php" method="post" enctype="multipart/form-data" class="registrarse">
    <table style="margin:auto">
	<!--
	<tr>
	<td><i title="Es una palabra con a lo maximo 14 letras cosider un nick que lo represente" class="fa fa-user" aria-hidden="true"></i></td>
	<td>
	<input title="Es una cadena textual con a lo máximo 14 letras, considere un nick que lo represente ej: FrT6@_7u" type="text" name="user"  value="<?php if(isset($u))echo $u ?>" placeholder="Introduce usuario" required >
	</td>
	</tr>
	-->
	<tr>
	<td ><i title="Apellidos y nombre como minimo debe tener tres palabras" class="fa fa-user" aria-hidden="true"></i></td>
	<td>
    <input title="Apellidos y nombres, este campo como mínimo debe tener tres palabras" type="text" name="nombre" placeholder="Introduce Apellidos y Nombres" required value="<?php if(isset($n))echo $n ?>">
	</td>
	</tr>
    
	<tr>
	<td ><i title="Debe contener el sibolo de @ y un punto" class="fa fa-envelope" aria-hidden="true"></i></td>
		<td>
	<input type="text" name="correo" placeholder="Introduce correo" required  value="<?php if(isset($c)) echo $c ?>">
	</td>
	</tr>
	
	<tr>
    <td ><i title="Contraseña" class="fa fa-key" aria-hidden="true"></i></td>
		<td>
	<input type="password" name="pass" placeholder="Introduce contraseña" required  >
	</td>
	</tr> 
	
    <tr>
	<td></td>
	<td>
		<input type="file" name="picture" id="selectedFile" style="display:none" value="<?php if(isset($f)) echo $f ?>">
			<input style="display:none" title="Cargar la foto de un repositorio local mas no de la nuve" class="ws" type="button" value="Cargar foto" value="<?php if(isset($f)) echo $f ?>" onclick="document.getElementById('selectedFile').click();" >
	</td>
	</tr>
        <select style="display:none" type="tipo" name="tipo">
            <option value="estudiante">Estudiante</option>
            <option value="docente">Docente</option>
        </select>
    
	<td></td>
	<td>
	<input style="background:blue;border-radius:5px;font-size:16px; width:200px;" type="submit" name="w77" value="Registrar">
	</td>
	</table>
</form>

<!--
        <div style="width:200px;margin:auto;text-align:center;display:block;"><img style="width:70px;" src="ww1.svg"></div>
-->

    </div>

<style>
.fff{
width:380px;
padding:10px;
margin:auto;
 background:rgba(0,0,0,0);
position: absolute;
  top:50%;
  left:50%;
  transform: translate(-50%,-50%)
}

.fff input{
width:280px;
border-radius:5px;
padding:5px;
border:none;
display:block;
margin:1em auto;
}
</style>






