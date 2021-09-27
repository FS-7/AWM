<html>
   <head>
       <title>REGISTRATION</title>
   </head> 
   <body>
       <?php
        $name = $_POST[''];
        $email = $_POST[''];
        $phone = $_POST[''];
        $pass = $_POST[''];
        $vehicle = $_POST[''];
        if(!isset($name) and !isset($email) and !isset($pass) and !isset($phone))
        {
            echo "<h1>error</h1>";
        }
        else{
            $conn = mysqli_connect('localhost','root','','awm'); //only XAMPP
            $passw = hash('sha256', $pass);
            $query = "INSERT INTO `customer`(`id_no`, `name`, `phone_no`, `email_id`, `password`) VALUES ('null','$name','$phone','$email','$passw')";
            $q = mysqli_query($conn, $query);
            if(!$q)
            {
                echo "<h1>error</h1>";
            }
            else
            {
                echo "<h1>done</h1>";
            }
        }
       ?>
   </body>
</html>