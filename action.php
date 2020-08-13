
<?php
//action.php
if(isset($_POST["action"]))
{
require('conect.php');
 if($_POST["action"] == "fetch")
 {
  $query = "SELECT * FROM tbl_images ORDER BY id DESC";
  $result = mysqli_query($link, $query);
  $output = '  ';
  while($row = mysqli_fetch_array($result))
  {
echo " 
    <button type='button' name='update' class='btn btn-warning bt-xs update' id='".$row['id']."'><img src='archivosclase/".$row["id"].$row["name"]."' height='160' width='175' class='img-thumbnail' /></button><br>
    <div type='button' name='update' class='btn btn-warning bt-xs update' id='".$row['id']."'>Change</div>
    <button type='button' name='delete' class='btn btn-danger bt-xs delete' id='".$row['id']."'>Remove</button><br><br>
    ";
  }
 }



 if($_POST["action"] == "insert")
 {
$nombre=$_FILES['image']['name'];
echo $nombre;
$query = mysqli_query($link,"INSERT INTO tbl_images VALUES (NULL, '$nombre')");
$idarchivo=mysqli_insert_id($link);
copy($_FILES['image']['tmp_name'],"archivosclase/".$idarchivo.$nombre);
if(!$query){
  echo "no ok";
}else{
  echo "ok";
}
 }
 


 if($_POST["action"] == "update")
 {
 $nombre=$_FILES['image']['name'];
echo $nombre;
  
  $query = mysqli_query($link,"UPDATE tbl_images SET name = '$nombre' WHERE id = '".$_POST["image_id"]."'");
copy($_FILES['image']['tmp_name'],"archivosclase/".$_POST["image_id"].$nombre);
 if(!$query){
  echo "no ok";
}else{
  echo "ok";
}
 }

 if($_POST["action"] == "delete")
 {
  $query = "DELETE FROM tbl_images WHERE id = '".$_POST["image_id"]."'";
  if(mysqli_query($link, $query))
  {
   echo 'Image Deleted from Database';
  }
 }
}
?>