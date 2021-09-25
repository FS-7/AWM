<html>
   <head>
       <title>FEEDBACK</title>
   </head> 
   <body>
       <?php
        $req_id = $_POST[''];
        $date = $_POST[''];
        $rate = $_POST[''];
        $desc = $_POST[''];
        if(!isset($date) and !isset($rate) and !isset($desc))
        {
            echo "<h1>error</h1>";
        }
        else
        {
            $conn = mysqli_connect('localhost','root','','awm');//only xampp
            $query = "insert into feedback values('$req_id','$rate','$desc','$date')";
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