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
        <script type="text/javascript" src="dist/jso.js"></script>
        <script type="text/javascript">
	        var config = {...}
	        var j = new jso.JSO(config)
        </script>
        <script>
        /*const xmlhttp = new XMLHttpRequest();
        URL url = new URL ("https://positioning.hereapi.com/v2/locate&apiKey=RcKQATNQXIpKkx6J71y8MmQGByCNnoTqDKcyicGgVgw&fallback=any&confidence=75");
        HttpURLConnection con = (HttpURLConnection)url.openConnection();
        con.setRequestMethod("POST");
        con.setRequestProperty("Content-Type", "application/json; utf-8");
        con.setRequestProperty("Accept", "application/json");
        con.setDoOutput(true);
        String jsonInputString = {"lte": 
            [
                {"mcc": 262, "mnc": 2, "cid": 2898945,"rsrp": -50, "rsrq": -5,
                    "nmr": [
                        { "earfcn": 6300, "pci": 237, "rsrp": -60, "rsrq": -6 },
                        { "earfcn": 6300, "pci": 442, "rsrp": -70, "rsrq": -7 }
                    ]
                }
            ]
        };
        
        try(OutputStream os = con.getOutputStream()) {
            byte[] input = jsonInputString.getBytes("utf-8");
            os.write(input, 0, input.length);			
        }

        try(BufferedReader br = new BufferedReader(new InputStreamReader(con.getInputStream(), "utf-8"))) {
            StringBuilder response = new StringBuilder();
            String responseLine = null;
            while ((responseLine = br.readLine()) != null) {
                response.append(responseLine.trim());
            }
            System.out.println(response.toString());
        }*/
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "https://positioning.hereapi.com/v2/locate&apiKey=RcKQATNQXIpKkx6J71y8MmQGByCNnoTqDKcyicGgVgw&fallback=any&confidence=75", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send({"lte": 
            [
                {"mcc": 262, "mnc": 2, "cid": 2898945,"rsrp": -50, "rsrq": -5,
                    "nmr": [
                        { "earfcn": 6300, "pci": 237, "rsrp": -60, "rsrq": -6 },
                        { "earfcn": 6300, "pci": 442, "rsrp": -70, "rsrq": -7 }
                    ]
                }
            ]
        });
        </script>
    </head>
    <body>
        <center>
        <div class="header">
            <div class="left">
                <!--logo-->
            </div>
            <div class="right">
                <!--buttons-->
            </div>
        </div>
        <form action="../back-end/homepage.php" method="GET"></form>
        <!--body-->
        <div class="body">
            <div class="upper">
                <div class="upper-left"> 
                    <!--search bar-->
                    <input type="text" name="search" placeholder="Search.." id="search"/>
                    <button type="submit" onclick=Marker();><i class="fa fa-search"></i></button>
                </div>

                <div class="upper-right">
                </div>
            </div>
            <div class="lower">
                <!--MAPS-->
                <div class="lower-left" id="map" onmouseover=func();></div>
                <script src="../maps.js"></script>

                <!--mechanic list-->
                <div class="lower-right" placeholder="list"> 
                <span id="list">SORT BY: </span>
                    <select>
                        <option value="Name">Name</option>
                        <option value="Distance">Distance</option> 
                    </select><br><br>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "awm");
                $q = mysqli_query($conn, "SELECT name, phone_no, rating FROM mechanic, feedback, service_log where feedback.request_id = service_log.request_id and mechanic.id_no = service_log.m_id order by mechanic.name;");
                echo "<table class='mec_list' border=2px><tr><td>";
                while ($row= mysqli_fetch_array($q)) {
                echo "<table><tr><td>";
                echo "<img src='../img/awm.jpg' height='75px' width='75px'>";
                echo "</td><td><table class='mec_list2'><tr><td>";
                echo "Name: ".$row['name'];
                echo "</td></tr><tr><td>";
                echo "Phone: ".$row['phone_no'];
                echo "</td></tr><tr><td>";
                echo "Distance: ";
                echo "</td></tr></table></td><td>";
                echo "<input type='button' name='submit' value='Book'/><br> Rating: ".$row['rating'];
                echo "</td></tr></table>";
                }
                echo "</td></tr></table>";
                ?>    
                </div>
            </div>     
        </div>
        </form>
        </center>
    </body>
</html>
