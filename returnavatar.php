<?php

$conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 
$query = "SELECT avatar_image, name from users  WHERE id='".$_COOKIE["ID_COOKIE"]."'";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
$array=array();
while($row=mysqli_fetch_object($res)){
$array[]=array("img"=>$row->avatar_image, "nome"=>$row->name);
}
echo json_encode($array);
mysqli_free_result($res);
mysqli_close($conn);
exit;
?>