<?php
session_start();
$cid=$_SESSION['id'];
$con=mysqli_connect('localhost','root','','awm');
$result=mysqli_query($con,"select request_id, mechanic.name, date, m_id from service_log, mechanic where c_id='$cid' AND mechanic.id_no = service_log.m_id");
echo "<script> var i=new Array();</script><br>";
$feed = array();
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<script>i[i.length]=[".$row['request_id'].", '".$row['name']."', '".$row['date']."']</script>";
    $_SESSION['feed'][$row['request_id']] = [$row['m_id'], $row['date']];
}
?>
<html>
    <head>
        <title>
            feedback
        </title>
        <link rel="stylesheet" href="homepage.css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .back{
                height: 30px;
                width: 30px;
                margin: 0px;
                padding: 0px;
                background: transparent;
                border: 0px;
                font-size: 28px;
            }
            .back:hover{
                background: rgba(49, 69, 128, 0.7);
            }
            .row{
                height: 400px;
                width: 500px;
                transform: translateY(35%);
                font-family: Calibri;
                color: white;
            }
            .btn{
                font-size: 18px;
                box-sizing: border-box;
                padding: 1px 6px;
                border-image: initial;
                border: 1px solid black;
                border-radius: 2px;
                background-color: rgba(126, 56, 75, 1);
                text-align: center;
            }
            .btn:hover{
                background-color: rgba(49, 69, 128, 0.7);
                color: white;
            }
        </style>
    </head>
    <body>
              <center>
                <div class="main">
                <div class="imagebg" style="float: left; margin: 2%;"><a href="homepage.php"><button class='back'><i class="fa fa-arrow-circle-left"></i></button></a></div><br>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 form-container">
                        <h2>Feedback</h2> 
                        <p> Please provide your feedback below: </p>
                        <form action="../back-end/feed.php" method="post" id="reused_form">
                            <div>
                                <div class="col-sm-12 form-group">
                                
                                    <label>How do you rate your Mechanic experience?</label><br><br>
                                    Service: <select name="req" id="feed_date">
                                    </select>
                                    <p>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="1" >
                                            Very Bad
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="2" >
                                            Bad 
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="3" >
                                            Average
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="4" >
                                            Good 
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="5" >
                                            Excellent 
                                        </label>
                                    </p>
                                </div>
                            <div>
                            <label for="comments"> Description:</label>
                                <div class="col-sm-12 form-group">
                                    <textarea class="form-control" type="textarea" name="comments" id="comments" placeholder="(optional)" maxlength="6000" rows="7"></textarea>
                                </div>
                            </div><br>
                            <div>
                                <div class="col-sm-12 form-group">
                                    <button type="submit" class="btn btn-lg btn-warning btn-block" >Post </button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </center>
        <script>
            var x = document.getElementById('feed_date');
            var row = new Array();
            function feed() {
                for (let index = 0; index < i.length; index++) {
                    row[index]=document.createElement('option');
                    row[index].setAttribute('value', i[index][0]);
                    row[index].innerHTML = i[index][1]+', Date: '+i[index][2].slice(0, 16);
                    x.appendChild(row[index]);
                }
            }
            feed();
        </script>
        </body>
    </html>

   
