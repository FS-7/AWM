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

