var C_Arr = new Array();
var h=0;

xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
    //console.log(this.responseText);
    var myObj = JSON.parse(this.responseText);
    myObj.forEach(element => {
        C_Arr[h] = element;
        loc(element[4], element[5], h);
        h++;
    });
}
xmlhttp.open("POST", "../back-end/cal.php");
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send('id=301');

var add;
function loc(x, y, h) {
    service.reverseGeocode({
        at: ''+x+','+y+''
    }, (result) => {
        add = result.items[0].title;
        C_Arr[h].push(add);
    }, alert);
}

function notify() {
    body = document.getElementById('status');
    tr = document.createElement('tr');
        td = document.createElement('td');
            strong = document.createElement('strong');
                table = document.createElement('table');
                    row = document.createElement('tr');
                        cell = document.createElement('td');
                            cell.setAttribute('id', 'cname');
                        row.appendChild(cell);
                    table.appendChild(row);
                    row = document.createElement('tr');
                        cell = document.createElement('td');
                            cell.setAttribute('id', 'cphone');
                        row.appendChild(cell);
                    table.appendChild(row);
                    row = document.createElement('tr');
                        cell = document.createElement('td');
                            cell.setAttribute('id', 'Location');
                        row.appendChild(cell);
                    table.appendChild(row);
                strong.appendChild(table);
            td.appendChild(strong);
        tr.appendChild(td);
        td2 = document.createElement('td');
            button1 = document.createElement('button');
                button1.setAttribute('id', 'acc');
            td2.appendChild(button1);
            button2 = document.createElement('button');
                button2.setAttribute('id', 'rej');
            td2.appendChild(button2);
            td2.setAttribute('id','stat_right')
        tr.appendChild(td2);
    body.appendChild(tr);
    document.getElementById('acc').innerHTML = 'ACCEPT';
    document.getElementById('rej').innerHTML = 'REJECT';
}
//notify();

function c_stat() {
    body = document.getElementById('status');
    tr = document.createElement('tr');
        td = document.createElement('td');
            strong = document.createElement('strong');
                table = document.createElement('table');
                    row = document.createElement('tr');
                        cell = document.createElement('td');
                            cell.setAttribute('id', 'mech_name');
                        row.appendChild(cell);
                    table.appendChild(row);
                    row = document.createElement('tr');
                        cell = document.createElement('td');
                            cell.setAttribute('id', 'Distance');
                        row.appendChild(cell);
                    table.appendChild(row);
                    row = document.createElement('tr');
                        cell = document.createElement('td');
                            cell.setAttribute('id', 'Location');
                        row.appendChild(cell);
                    table.appendChild(row);
                strong.appendChild(table);
            td.appendChild(strong);
        tr.appendChild(td);
        td2 = document.createElement('td');
            button2 = document.createElement('button');
                button2.setAttribute('id', 'cancel');
            td2.appendChild(button2);
            td2.setAttribute('id','stat_right')
        tr.appendChild(td2);
    body.appendChild(tr);
    document.getElementById('cancel').innerHTML = 'CANCEL';
}
c_stat();

function service(){

}

var lat_s=0, lat_d=0, lng_s=0, lng_d=0;
//routing
var routingParameters = {
    'routingMode': 'fast',
    'transportMode': 'car',
    'origin': lat_s+','+lng_s,
    'destination': lat_d+', '+lng_d,
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
