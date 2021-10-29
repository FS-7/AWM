<?php
$cid= ;//customer id
$mid=; //add mechanic id

$conn = mysqli_connect("localhost", "root", "", "awm");
$q = mysqli_query($conn, "INSERT into service_log values $cid, $mid, $lat, $lng, $status");

?>