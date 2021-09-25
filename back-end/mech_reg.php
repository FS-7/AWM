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
        $gov_id = $_POST[''];
        if(!isset($name) and !isset($email) and !isset($pass) and !isset($phone) and !isset($gov_id))
        {
            echo "<h1>error</h1>";
        }
        else
        {
            $conn = mysqli_connect('localhost','root','','awm');//only xampp
            $query = "insert into mechanic values('null','$gov_id','$name','$phone','$email','$pass','$vehicle')";
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