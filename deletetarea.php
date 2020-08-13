<?php

require('conect.php');



$_SESSION['claveww']=$_GET['claveww'];
echo $_SESSION['claveww'];

mysqli_query($link,"DELETE FROM tareas WHERE idplan=".$_SESSION['claveww']);
header("Location:sesion.php?claveww=".$_SESSION['claveww']);



?>