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

$query="SELECT c.id_add
FROM cart c
WHERE c.game='".$id_game."' and c.user_site='".$id."'";

$res2 = mysqli_query($conn, $query);
$row=mysqli_fetch_row($res2);
$query="DELETE
FROM cart 
WHERE id_add='".$row['0']."'";
$res2 = mysqli_query($conn, $query);
echo json_encode($row['0']);
mysqli_close($conn);
exit;
?>