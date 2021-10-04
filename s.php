<?php
$myObj = new stdClass();
$conn = mysqli_connect("localhost", "root", "", "awm");
$q = mysqli_query($conn, "SELECT id_no,name,phone_no,gar_loc_lat,gar_loc_lng,imgname FROM mechanic");
$row= mysqli_fetch_all($q);
echo json_encode($row);
?>