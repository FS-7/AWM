<?php
session_start();
$func = $_POST['func'];
$m_c = $_SESSION['type'];
if($func=='stat'){
    if ($m_c=='mechanic') {
        new m_stat();
    }else{
        new c_stat();
    }
}elseif($func == 'rt'){
    new rt($func);
}elseif($func == 'Cancelled'){
    new cancel($func);
}elseif($func == 'book'){
    new book();    
}elseif($func == 'Accepted'){
    new acc($func);
}elseif($func == 'Rejected'){
    new rej($func);
}elseif($func == 'Completed'){
    new comp($func);
}else{
    echo 'Wrong function';
}

class m_stat{
    public function __construct() {
        $arr = array();
        $id = $_SESSION['id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "SELECT request_id, customer.name, customer.phone_no, c_loc_lat, c_loc_lon, gar_loc_lat, gar_loc_lng, status FROM service_log, customer, mechanic WHERE m_id='$id' AND mechanic.id_no=service_log.m_id AND customer.id_no=service_log.c_id AND service_log.status='Waiting' ORDER BY service_log.date ASC");
        while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)){
            $arr['m'] = $row; 
        }
        echo json_encode($arr);
        mysqli_close($conn);
    }
}

class c_stat{
    public function __construct() {
        $arr = array();
        $id = $_SESSION['id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "SELECT request_id, mechanic.name, mechanic.phone_no, c_loc_lat, c_loc_lon, gar_loc_lat, gar_loc_lng, status FROM service_log, mechanic WHERE c_id='$id' AND mechanic.id_no=service_log.m_id AND (service_log.status='Accepted' OR service_log.status='Waiting') ORDER BY service_log.date ASC");
        while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)){
            $arr['c'] = $row; 
        }
        echo json_encode($arr);
        mysqli_close($conn);
    }
}

class rt{
    public function __construct($func) {
        $req_id = $_POST['request_id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "SELECT AVG(rating) FROM feedback, mechanic WHERE m_id='$req_id' AND mechanic.id_no=feedback.m_id");
        $row = mysqli_fetch_array($q, MYSQLI_NUM);
        echo $row[0]; 
        mysqli_close($conn);
    }
}

class book{
    public function __construct() {
        $cid = $_SESSION['id'];
        $mid= $_POST['mid'];
        $lat= $_POST['lat'];
        $lng= $_POST['lng'];
        $stat='Waiting';
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "INSERT into service_log(c_id, m_id, c_loc_lat, c_loc_lon, status, request_id) values ($cid, $mid, $lat, $lng, '$stat', null)");
        echo $q;
        mysqli_close($conn);
    }
}

class acc{
    public function __construct($func){
        $req_id = $_POST['request_id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "UPDATE `service_log` SET `status` = '$func' WHERE `service_log`.`request_id` = '$req_id'");
        mysqli_close($conn);
    }
}

class rej{
    public function __construct($func){
        $req_id = $_POST['request_id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "UPDATE `service_log` SET `status` = '$func' WHERE `service_log`.`request_id` = '$req_id'");
        mysqli_close($conn);
    }
}

class cancel{
    public function __construct($task){
        $req_id = $_POST['request_id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "UPDATE `service_log` SET `status` = '$task' WHERE `service_log`.`request_id` = '$req_id'");
        mysqli_close($conn);
    }
}

class comp{
    public function __construct($task){
        $req_id = $_POST['request_id'];
        $conn = mysqli_connect("localhost", "root", "", "awm");
        $q = mysqli_query($conn, "UPDATE `service_log` SET `status` = '$task' WHERE `service_log`.`request_id` = '$req_id'");
        mysqli_close($conn);
    }
}
?>