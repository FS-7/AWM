<?php
session_start();
$email= $_POST['email'];
$password=$_POST['pass'];
if(isset($email))
	{
	$conn = mysqli_connect("localhost", "root", "", "awm");
	$result=mysqli_query($conn,"SELECT id_no, email_id, password from mechanic where email_id='$email'");
	$temp = mysqli_num_rows($result);
	if($temp>0){
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			if($row['password']!=$password){
				?>
				<script>
				window.location.assign("../index.html");
				alert("Login failed");
				</script>
				<?php
			}else{
				$_SESSION['id'] = $row['id_no'];
				$_SESSION['type'] = 'mechanic';
				?>
				<script>
				window.location.assign("../front-end/homepage.php");
				</script>
				<?php
			}
		}
	}else{
		echo '<script>window.location.assign("../index.html"); alert("Login Failed, Please Re-enter Email and Password");</script>';
	}
}
mysqli_close($conn);
?>