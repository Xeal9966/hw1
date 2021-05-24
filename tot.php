<?php
if(!isset($_COOKIE["ID_COOKIE"])){
    header("Location: homepage.html");
    exit;
}
$conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 
$query = "call calcolaTotale('".$_COOKIE["ID_COOKIE"]."')";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
$array=array();
while($row=mysqli_fetch_object($res)){
$array[]=array("tot"=>$row->tot,);
}
echo json_encode($array);
mysqli_free_result($res);
mysqli_close($conn);
exit;
?>