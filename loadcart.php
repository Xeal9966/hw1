<?php

$conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 
$query = "SELECT g.name,g.main_image,g.prezzo,COUNT(*) as n from games g join cart c on g.id_game=c.game WHERE c.user_site='".$_COOKIE["ID_COOKIE"]."' GROUP by g.id_game";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
$array=array();
while($row=mysqli_fetch_object($res)){
$array[]=array("nome"=>$row->name, "imm"=>$row->main_image,"prezzo"=>$row->prezzo, "n_aggiunti"=>$row->n);
}
echo json_encode($array);
mysqli_close($conn);
exit;
?>