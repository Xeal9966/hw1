<?php
if(isset($_COOKIE["ID_COOKIE"])) $result=$_COOKIE["ID_COOKIE"];
else $result=0;
echo json_encode($result);
?>