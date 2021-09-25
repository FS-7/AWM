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
    <?php
    $conn = mysqli_connect("localhost", "root", "", "awm");
    $q = mysqli_query($conn, "SELECT `name`, `phone_no` FROM `mechanic`");
    $q2 = mysqli_query($conn, "select 'rating' from feedback");
    
    while ($row= mysqli_fetch_array($q)) {
        $name = $row['name'];
        $phone_no = $row['phone_no'];    
    }
    while ($row2= mysqli_fetch_array($q2)) {
        echo $row2['rating'];
    }
    ?>
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
                    var coords
                    const platform = new H.service.Platform({ apikey: 'RcKQATNQXIpKkx6J71y8MmQGByCNnoTqDKcyicGgVgw' });
                    const defaultLayers = platform.createDefaultLayers();
                    const map = new H.Map(document.getElementById('map'),
                    defaultLayers.vector.normal.map, {
                        center: { lat: 15.333, lng: 75 },
                        zoom: 14,
                        pixelRatio: window.devicePixelRatio || 1
                    });
                    window.addEventListener('resize', () => map.getViewPort().resize());
                    const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
                    const ui = H.ui.UI.createDefault(map, defaultLayers);

                    //geocoding
                    function Marker() {
                        var add = document.getElementById('search').value;
                        const searchText = add;
                        const geocoder = platform.getGeocodingService();
                        geocoder.geocode({ searchText }, result => {
                            const location = result.Response.View[0].Result[0].Location.DisplayPosition;
                            const { Latitude : lat, Longitude: lng } = location;
                            const marker = new H.map.Marker({ lat, lng });
                            const LocOfMarker = { lat, lng };
                            map.addObject(marker);
                            map.setCenter(LocOfMarker);
                        }); 
                    }
                    
                </script>
                
                <!--mechanic list-->
                <div class="lower-right" placeholder="list"> 
                <table>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                <td>Image
                                    <img src="">
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>X<input type="text" name="x" id="x"></td>
                                        </tr>
                                        <tr>
                                            <td>Y<input type="text" name="y" id="y"></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo "Location: " ?></td>
                                        </tr>
                                    </table>
                                </td>
                                </tr>    
                            </table>
                        </td>
                    </tr>
                </table>    
                <script>
                    var x = document.getElementById('x');
                    var y = document.getElementById('y');
                    map.addEventListener('tap', function(evt) {
                    x.value=evt.currentPointer.viewportX, y.value=evt.currentPointer.viewportY
                    });
                </script>
                
                </div>
            </div>     
        </div>
        </form>
        </center>
    </body>
</html>
