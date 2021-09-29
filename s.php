<?php
$myObj = new stdClass();
$conn = mysqli_connect("localhost", "root", "", "awm");
$q = mysqli_query($conn, "SELECT name, phone_no,gar_loc_lat,gar_loc_lng FROM mechanic where mechanic.id_no=1;");
while ($row= mysqli_fetch_array($q)) {
        $myObj->name = $row['name'];
        $myObj->phone = $row['phone_no']; 
        $myObj->loc_lat = $row['gar_loc_lat']; 
        $myObj->loc_lng = $row['gar_loc_lng'];
}
$myObj->rating = 'No Rating';
$myJSON = json_encode($myObj);
echo $myJSON;
?>