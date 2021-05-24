<?php

$conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 
$query = "SELECT name, voto, nome
FROM games join recensore join recensione 
WHERE id_game=gioco and id_editore=editor";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
$array=array();
while($row=mysqli_fetch_object($res)){
$array[]=array("nome"=>$row->name, "voto"=>$row->voto,"nome_editor"=>$row->nome);
}
echo json_encode($array);
mysqli_free_result($res);
mysqli_close($conn);
exit;
?>