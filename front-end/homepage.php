<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['type'])){
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Any Where Mechanic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
        <link rel="stylesheet" type="text/css" href="homepage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
        <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
        <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
        <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    </head>
    <body>
        <center>
            <div class='main'>
                <div class="header">
                    <div class="logo">
                        <a href="#default" class="logo"> 
                            <div class='img'>
                                <img src="../img/awm.jpg" height='60px' width="60px">
                            </div><p style="padding: 0px 10px; margin: 0px auto; float: left; transform: translateY(50%);">ANY WHERE MECHANIC</p> 
                        </a>
                    </div>
                    <div class="header-right">
                        <a href="">Home</a>
                        <a href="">Feedback</a>
                        <a href="">Contact</a>
                        <a href="../back-end/logout.php">Logout</a>
                    </div>
                </div>
                <form action="../back-end/homepage.php" method="POST"></form>
                <div class="body">
                    <div class="upper">
                        <div class="upper-left"> 
                            <label class='txtlabel'>Find Mechanic</label>
                            <input type="text" name="search" placeholder=" Search.." id="search" onsubmit="STL();" required/>
                            <button type="button" onclick=navigator.geolocation.getCurrentPosition(GPS); placeholder="Automatically Locate"><i class="fa fa-map-marker"></i></button>
                            <button type="submit" onclick=STL();><i class="fa fa-search"></i></button>
                        </div>
        
                        <div class="upper-right" >
                            <table id='status'>
                                <tr>
                                    <td><strong>Status: </strong></td>
                                </tr>
                                <tr>
                                    <td><div id="stat"><p id='temp'>No Notifications<p></div></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="lower">
                        <div class="lower-left" id="map"></div>
                        <div class="lower-right" placeholder="list"><br>
                        <p id="list"><strong>SORT BY: </strong> </p>
                            <select style="float: left;" id='lol' onchange="dynamicSort(value);">
                                <option value="name">Name</option>
                                <option value="dist" selected>Distance</option> 
                            </select>
                        <table class='mec_list' id='mech_list'></table>
                        <script src='init.js'></script>
                        </div>
                    </div>     
                    <script src="cal.js"></script>
                    <script src='service.js'></script>
                </div>
            </div>
        </center>
    </body>
</html>
<?php 
}
else{
    echo "<script>alert('Please Login');window.location.assign('../index.html');</script>";
}
?>