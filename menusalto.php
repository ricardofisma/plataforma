<script>
function CambiarClase(targ,selObj,restore){
    eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
    if(restore)selObj.selectedIndex=0;
}
</script>


<?php
    if($w['tipo']=='estudiante'){
        $menusalto=mysqli_query($link,"SELECT * FROM misclases, clase WHERE misclases.clave=clase.clave AND misclases.usuario='".$_SESSION['user']."'");   
        $ams=mysqli_fetch_assoc($menusalto);   
    }else{
        $menusalto=mysqli_query($link,"SELECT * FROM clase WHERE usuario='".$_SESSION['user']."'");   
        $ams=mysqli_fetch_assoc($menusalto);   
        }
        echo "<form method='post'>";
        echo "<select name='cambiarclase' onChange='CambiarClase(\"parent\",this,1)'>";
        echo "<option value=''>Cursos</option>";
        do{
echo "<option value='inicio.php?clave=".$ams['clave']."'>".$ams['nombre']."</option>";
        }while($ams=mysqli_fetch_assoc($menusalto));
echo "</select></form>"; 
?>