<?php
$conn=mysqli_connect("localhost","root","","awm");
$name=$_POST['name'];
$phone_no=$_POST['phone_no'];
$email_id=$_POST['email_id'];
$password=$_POST['password'];
$sql=mysqli_query($conn, "insert into customer values( null,'$name','$phone_no','$email_id','$password')");
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