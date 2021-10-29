<?php
class Cls{

}
$arr = new Cls;
$id=301;
$conn = mysqli_connect("localhost", "root", "", "awm");
$q = mysqli_query($conn, "SELECT * FROM service_log where c_id=$id");
while ($row = mysqli_fetch_all($q)){
    $arr = $row;
    echo json_encode($arr); 
}
?>