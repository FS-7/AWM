<?php
session_start();
$req_id = $_POST['req'];
$rating = $_POST['experience'];
$desc = $_POST['comments'];
$mid = $_SESSION['feed'][$req_id][0];
$date = $_SESSION['feed'][$req_id][1];
$con=mysqli_connect('localhost','root','','awm');
$result=mysqli_query($con,"insert into feedback values ('$req_id', '$mid', '$rating', '$desc', '$date')");
if($result){
    echo "<script>alert('Thanks for feedback'); window.location.assign('../front-end/homepage.php');</script>";
}else{
    echo "<script>alert('error');</script>";
}
unset($_SESSION['feed']);
?>