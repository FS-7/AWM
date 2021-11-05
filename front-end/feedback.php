<?php
session_start();
$cid=$_SESSION['id'];
$con=mysqli_connect('localhost','root','','awm');
$result=mysqli_query($con,"select request_id,date from service_log where c_id='$cid'");
echo "<script> var i=new Array();</script>";
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{
echo "<script>i[i.length]=[".$row['request_id'].", ".$row['date']."]</script>";
}
?>
<html>
    <head>
        <title>
            feedback
        </title>
        <link rel="stylesheet" href="homepage.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
              <center>
                <div class="main">
                <div class="imagebg"></div>
                <div class="row " style="margin-top: 50px">
                    <div class="col-md-6 col-md-offset-3 form-container">
                        <h2>Feedback</h2> 
                        <p> Please provide your feedback below: </p>
                        <form role="form" method="post" id="reused_form">
                            <div>
                                <div class="col-sm-12 form-group">
                                
                                    <label>How do you rate your Mechanic experience?</label><br>
                                    Service: <select name="" id="">
                                    </select>
                                    <p>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="Very Bad" >
                                            Very Bad
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="Bad" >
                                            Bad 
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="Average" >
                                            Average
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="Good" >
                                            Good 
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="experience" id="radio_experience" value="Excellent" >
                                            Excellent 
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="comments"> Description:</label>
                                    <textarea class="form-control" type="textarea" name="comments" id="comments" placeholder="(optional)" maxlength="6000" rows="7"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <button type="submit" class="btn btn-lg btn-warning btn-block" >Post </button>
                                </div>
                            </div>
                        </form>
                        <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Posted your feedback successfully!</h3> </div>
                        <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                    </div>
                </div>
            </div>
        </center>
        <script>
            function feed() {
                for (let index = 0; index < i.length; index++) {
                    console.log(i[index]);
                }
            }
            feed();
        </script>
        </body>
    </html>

   
