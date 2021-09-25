<html>
   <head>
       <title>SERVICE REGISTRATION</title>
   </head> 
   <body>
       <?php
        $cid = $_POST[''];
        $mid = $_POST[''];
        $c_email = $_POST[''];
        $c_phone = $_POST[''];
        $c_loc = $_POST[''];
        if(!isset($cid) and !isset($mid) and !isset($c_email) and !isset($c_phone) and !isset($c_loc))
        {
            echo "<h1>error</h1>";
        }
        else
        {
            $conn = mysqli_connect('localhost','root','','AWM');//only xampp
            $query = "insert into service_req values('null','$cid','$mid','$c_email','$c_phone','$c_loc')";
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