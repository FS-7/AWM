var mechname = new Array(), mechph = new Array(), dist = new Array(), mech_lat = new Array(), mech_lng = new Array(), mech_img = new Array();
xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
    var myObj = JSON.parse(this.responseText);
    var h=0, loc = new Array();
    myObj.forEach(element => {
        mechname[h]=element[1];
        mechph[h]=element[2];
        mech_lat[h]=element[3];
        mech_lng[h]=element[4];
        mech_img[h]=element[5];
        loc[h] = {lat: mech_lat[h], lng: mech_lng[h]};
        addBubble(loc[h], mechname[h], mechph[h], h, mech_img[h]);
        h++;
    })
}
xmlhttp.open("POST", "../s.php");
xmlhttp.send();

//mechanic markers
function addBubble(value, mechname, mechph, h, mechimgx) {
    if(mechimgx==''){
        mechimgx='awm.jpg';
    }
    var html = '<div><img src="../img/'+mechimgx+'" id="mechimg_'+h+'"/></div>'+'<div><p id="info_'+h+'"></p></div>';
    var bubble = new Array();
    bubble[h] = new H.ui.InfoBubble(value,{
        content: html
    });
    ui.addBubble(bubble[h]);
    var mechimg = document.getElementById('mechimg_'+h);
    var info = document.getElementById('info_'+h);
    mechimg.innerHTML = '';
    info.innerHTML = 'Name: '+mechname+'<br>Phone: '+mechph;
    mechimg.setAttribute('height', '50px');
    info.setAttribute('style', 'font-size: 12px;');
}

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

