<?php
class Cls{

}
$arr = new Cls;
$ray = Array();
$conn = mysqli_connect("localhost", "root", "", "awm");
$q = mysqli_query($conn, "SELECT request_id, m_id, c_id, phone_no, c_loc_lat, c_loc_lon, status FROM service_log, customer where customer.id_no = service_log.c_id");
while ($row = mysqli_fetch_all($q)){
    $arr = $row;
    echo json_encode($arr); 
}
?>