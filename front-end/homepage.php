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
                    <input type="text" name="search" placeholder="Search.." id="search" />
                    <button type="submit" onclick=Marker();><i class="fa fa-search"></i></button>
                </div>

                <div class="upper-right">
                </div>
            </div>
            <div class="lower">
                <!--MAPS-->
                <div class="lower-left" id="map"></div>
                <script>
                    const platform = new H.service.Platform({ apikey: 'RcKQATNQXIpKkx6J71y8MmQGByCNnoTqDKcyicGgVgw' });
                    const defaultLayers = platform.createDefaultLayers();
                    const map = new H.Map(document.getElementById('map'),
                    defaultLayers.vector.normal.map, {
                        center: { lat: 15.333, lng: 75 },
                        zoom: 10,
                        pixelRatio: window.devicePixelRatio || 1
                    });
                    window.addEventListener('resize', () => map.getViewPort().resize());
                    const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
                    const ui = H.ui.UI.createDefault(map, defaultLayers);

                    //geocoding
                    function Marker() {
                        var x,y;
                        var add = document.getElementById('search').value;
                        const searchText = add;
                        const geocoder = platform.getGeocodingService();
                        geocoder.geocode({ searchText }, result => {
                            const location = result.Response.View[0].Result[0].Location.DisplayPosition;
                            const { Latitude : lat, Longitude: lng } = location;
                            const marker = new H.map.Marker({ lat, lng });
                            const LocOfMarker = { lat, lng };
                            marker.draggable = true;
                            map.addObject(marker);
                            map.setCenter(LocOfMarker);
                            map.setZoom(16);
                            map.addEventListener('dragstart', evt => {
                                if (evt.target instanceof H.map.Marker) behavior.disable();
                            }, false);
                            map.addEventListener('dragend', evt => {
                                if (evt.target instanceof H.map.Marker) {
                                    behavior.enable();    
                                }
                            }, false);
                            map.addEventListener('drag', evt => {
                                const pointer = evt.currentPointer;
                                if (evt.target instanceof H.map.Marker) {
                                    evt.target.setGeometry(map.screenToGeo(pointer.viewportX, pointer.viewportY));
                                    map.setCenter(LocOfMarker);
                                }
                            }, false);    
                        }); 
                    }    
                    map.addEventListener('drag', function(evt) {
                    x=evt.currentPointer.viewportX, y=evt.currentPointer.viewportY;
                    console.log();
                    });
                </script>
                <!--mechanic list-->
                <div class="lower-right" placeholder="list"> 
                <span>SORT BY: </span>
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
