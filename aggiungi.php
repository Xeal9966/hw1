<?php
if(!isset($_COOKIE["ID_COOKIE"])){
    header("Location: login.php");
    exit;
}
$conn=mysqli_connect("localhost","root","","site_database") or die(mysqli_error($conn)); 
$var = mysqli_real_escape_string($conn,$_GET['titolo']);
$query="SELECT g.id_game from games g where g.name='".$var."'";
$res = mysqli_query($conn, $query);
$entry = mysqli_fetch_assoc($res);
$id_game=$entry['id_game'];
$id=$_COOKIE["ID_COOKIE"];

$query="INSERT INTO cart(game,user_site) VALUES('$id_game','$id')";
$res = mysqli_query($conn, $query);
echo json_encode($var);
mysqli_close($conn);
exit;
?>