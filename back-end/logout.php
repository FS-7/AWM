<?php 
session_start();
unset($_SESSION['type']);
unset($_SESSION['id']);
session_destroy();
echo "<script>alert('logout successfull'); window.location.assign('../front-end/login.html'); </script>";
?>