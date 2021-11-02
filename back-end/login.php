<?php
session_start();
$email= $_POST['email'];
$password=$_POST['pass'];
if(isset($email))
	{
	$conn = mysqli_connect("localhost", "root", "", "awm");
	$result=mysqli_query($conn,"SELECT *from customer where email_id='$email'");
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
			$_SESSION['type'] = 'customer';
			?>
			<script>
			window.location.assign("../front-end/homepage.php");
			</script>
			<?php
		}
	}
}
?>