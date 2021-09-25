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
        else
        {
            $conn = mysqli_connect('localhost','root','','awm'); //only XAMPP
            $query = "insert into customer values('null','$name','$phone','$email','$pass','$vehicle')";
            $q = mysqli_query($query,$conn);
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