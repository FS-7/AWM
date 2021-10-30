<?php
$email= $_POST['email'];
$password=$_POST['pass'];
if(isset($email))
	{
	include '../dbconnect/dbconnect.php';
	$result=mysqli_query($conn,"SELECT *from customer where email_id='$email'");
	session_start();	
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		if($row['password']!=$password){
			?>
			<script>
			alert("Login failed");
			window.location.assign("../login.html");
			</script>
			<?php
		}else{
			$id=$row['id_no'];
			$_SESSION['umail']=$email;
			$_SESSION['id']=$id;
			echo $_SESSION['id'];
			?>
			<script>
			window.location.assign("../../main page/front-end/homepage.html");
			</script>
			<?php
		}
	}
}
?>