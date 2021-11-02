<?php

$arr = array();
$conn = mysqli_connect("localhost", "root", "", "awm");
$q = mysqli_query($conn, "SELECT id_no,name,phone_no,gar_loc_lat,gar_loc_lng,imgname FROM mechanic order by mechanic.name");
while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)){
    $arr[] = $row;
}
echo json_encode($arr);
?>