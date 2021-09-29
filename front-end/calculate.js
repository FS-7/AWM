//Mech dist calculator
var x= new Array(), y= new Array(), dist = new Array();
var x1=15,y1=75, i=0;
const xmlhttp1 = new XMLHttpRequest();
xmlhttp1.onload = function() {
    const myObj = JSON.parse(this.responseText);    
    myObj.forEach(element => {
        x[i]=element[3];
        y[i]=element[4];
        dist[i] = parseInt(distance(x[i], y[i], x1, y1));
        document.getElementById("dist").innerHTML = 'Distance: '+dist;
        i++;
    });
    //mark(x, y);
}
xmlhttp1.open("POST", "../s.php");
xmlhttp1.send();

function mark(x, y) {
    var coords = [{lat: x, lng: y}];
    coords.forEach(function (value, index) {
        marker = new H.map.Marker(value,  {
          volatility: true
        });
        marker.setData(index + 1);
        map.addObject(marker);
        map.setCenter({lat: x, lng: y});
    });
}

function distance(lat1, lon1, lat2, lon2) {
    var p = 0.017453292519943295;
    var c = Math.cos;
    var a = 0.5 - c((lat2 - lat1) * p)/2 + c(lat1 * p) * c(lat2 * p) * (1 - c((lon2 - lon1) * p))/2;
    return 12742 * Math.asin(Math.sqrt(a));
}

//mechanic markers
function addMarkerToGroup(group, coordinate, html) {
    var marker = new H.map.Marker(coordinate);
    marker.setData(html);
    group.addObject(marker);
}

function addInfoBubble(map) {
    var group = new H.map.Group();
    map.addObject(group);
    ui.removeBubble(bubblex);
    group.addEventListener('tap', function (evt) {
            var ibubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
            content: evt.target.getData()
        });
        ui.addBubble(ibubble);
        document.getElementById('info').innerHTML = mechname;
        setTimeout('ui.removeBubble(bubble);', 1000);
    }, false);
    addMarkerToGroup(group, {lat: 15, lng: 75},
        "<div><img src='../img/awm.jpg' height='50px' width='50px'></div>" +
        "<div id='info'>Hi</div>"
    );
}
//addInfoBubble(map);

//routing
var routingParameters = {
    'routingMode': 'fast',
    'transportMode': 'car',
    'origin': '15.3425,75.1475',
    'destination': '15.34,75.14',
    'return': 'polyline'
};

var onResult = function(result) {
    if (result.routes.length) {
        result.routes[0].sections.forEach((section) => {
            let linestring = H.geo.LineString.fromFlexiblePolyline(section.polyline);
            var routeOutLine = new H.map.Polyline(linestring, {
                style: { 
                    lineWidth: 10,
                    strokeColor: 'rgba(255, 255, 255, 1)',
                    lineTailCap: 'arrow-tail', 
                    lineHeadCap: 'arrow-head' 
                }
            });
            var routeArrows = new H.map.Polyline(linestring, {
                style: { 
                    lineWidth: 7,
                    fillColor: 'white',
                    strokeColor: 'rgba(0, 128, 255, 0.75)',
                    lineDash: [0, 2], 
                    lineTailCap: 'arrow-tail', 
                    lineHeadCap: 'arrow-head' 
                }
            });
        var routeLine = new H.map.Group();
        routeLine.addObjects([routeOutLine, routeArrows]);
        let startMarker = new H.map.Marker(section.departure.place.location);
        let endMarker = new H.map.Marker(section.arrival.place.location);
        map.addObjects([routeLine, startMarker, endMarker]);
        map.getViewModel().setLookAtData({bounds: routeLine.getBoundingBox()});
        });
    }
};

function route() {
    var router = platform.getRoutingService(null, 8);
    router.calculateRoute(routingParameters, onResult,
    function(error) {
        alert(error.message);
    });
}

