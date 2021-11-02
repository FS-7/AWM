<?php
$func = $_POST['func'];
$m_c = $_COOKIE['type'];
//echo $_COOKIE['type'];
if($func=='stat'){
    if ($m_c=='mech') {
        new m_stat();
    }else{
        new c_stat();
    }
}
elseif($func=='Cancelled' || $func=='Accepted' || $func=='Rejected'){
    new cancel($func);
}
else{
    echo 'Wrong function motherfucker';
}

class c_stat{
    public function __construct() {
        session_start();
        $arr = array();
        $id = $_SESSION['id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "SELECT request_id, mechanic.name, c_loc_lat, c_loc_lon, gar_loc_lat, gar_loc_lng, status FROM service_log, mechanic WHERE c_id='$id' AND mechanic.id_no=service_log.m_id AND service_log.status='Waiting' ORDER BY service_log.date DESC");
        while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)){
            $arr[] = $row; 
        }
        echo json_encode($arr);
    }
}

class m_stat{
    public function __construct() {
        $arr = array();
        $id = $_COOKIE['id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "SELECT request_id, customer.name, c_loc_lat, c_loc_lon, gar_loc_lat, gar_loc_lng, status FROM service_log, customer WHERE m_id='$id' AND customer.id_no=service_log.c_id AND service_log.status='Waiting' ORDER BY service_log.date DESC");
        while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)){
            $arr[] = $row; 
        }
        echo json_encode($arr);
    }
}

class cancel{
    public function __construct($task){
        $req_id = $_POST['request_id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "UPDATE `service_log` SET `status` = '$task' WHERE `service_log`.`request_id` = '$req_id'");
    }
}
?>