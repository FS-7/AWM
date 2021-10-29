<?php
$cid= 103;
$mid= $_POST['mid'];
$lat= $_POST['lat'];
$lng= $_POST['lng'];
$stat='Waiting';
$conn = mysqli_connect("localhost", "root", "", "awm");
$q = mysqli_query($conn, "INSERT into service_log(c_id, m_id, c_loc_lat, c_loc_lon, status, request_id) values ($cid, $mid, $lat, $lng, '$stat', null)");
?>