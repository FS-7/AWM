<?php
$conn=mysqli_connect("localhost","root","","awm");
$name=$_POST['name'];
$phone_no=$_POST['phone_no'];
$email_id=$_POST['email_id'];
$password=$_POST['password'];
$aadhar=$_POST['aadhar'];
$garlat=$_POST['garlat'];
$garlng=$_POST['garlng'];
$sql=mysqli_query($conn, "insert into mechanic values( null, '$aadhar','$name','$phone_no','$email_id','$password', '', '')");
if($sql>0){
    ?>
    <script>
        alert("Registered Successfully");
        window.location.href="../index.html";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("Try Again to Register");
        window.location.href="front-end/Register.html";
    </script>
    <?php
}
?>