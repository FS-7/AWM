<?php
session_start();
$id = $_SESSION['id'];
if($_SESSION['type']=='customer'){
    $conn = mysqli_connect("localhost", "root", "", "awm");
    $q = mysqli_query($conn, "SELECT mechanic.name, date, status FROM service_log, mechanic WHERE c_id='$id' AND mechanic.id_no=service_log.m_id ORDER BY service_log.date DESC");
    while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)){
        $arr[] = $row; 
    }
    echo json_encode($arr);
}
else{
    $conn = mysqli_connect("localhost", "root", "", "awm");
    $q = mysqli_query($conn, "SELECT customer.name, date, status FROM service_log, customer WHERE m_id='$id' AND customer.id_no=service_log.c_id ORDER BY service_log.date DESC");
    while ($row = mysqli_fetch_array($q, MYSQLI_ASSOC)){
        $arr[] = $row; 
    }
    echo json_encode($arr);
}
mysqli_close($conn);
?>