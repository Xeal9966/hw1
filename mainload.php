<?php

$conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 
$query = "SELECT g.name, g.main_image, g.prezzo from games g";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
$array=array();
while($row=mysqli_fetch_object($res)){
$array[]=array("nome"=>$row->name, "imm"=>$row->main_image,"prezzo"=>$row->prezzo);
}
echo json_encode($array);
mysqli_free_result($res);
mysqli_close($conn);
exit;
?>