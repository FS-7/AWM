var top1='c_tab'

function Table(Table) {
    var h=0;
    while (h<4 && h<Table.length ) {
        document.getElementById('img_'+h).innerHTML = '<img src="../img/'+Table[h].imgname+'" height="60px" width="60px">';
        document.getElementById('mech_0'+h).innerHTML = 'Name: '+Table[h].name;
        document.getElementById('mech_1'+h).innerHTML = 'Phone: '+Table[h].phone_no;
        if(Table[h].dist==undefined || Table[h].dist==null){
            document.getElementById('mech_2'+h).innerHTML = 'Distance: Enter location';
        }else{
            document.getElementById('mech_2'+h).innerHTML = 'Distance: '+Table[h].dist+'km';
        }
        document.getElementById('Book'+h).value = 'Book';
        document.getElementById('Book'+h).name = Table[h].id_no;
        document.getElementById('rating'+h).innerHTML = 'NR';
        h++;
    }
}

function cust_status(C_Arr){
    document.getElementById('mech_name').innerHTML = 'Name: '+C_Arr[0].name;
    document.getElementById('Dist_C').innerHTML = 'Distance: '+C_Arr[0].dist;
    document.getElementById('Loc_C').innerHTML = 'Location: '+C_Arr[0].location;
    document.getElementById('statp').innerHTML = C_Arr[0].status;
}

function mech_stat(){
    document.getElementById('cname').innerHTML = 'Name: '+C_Arr[0].name;
    document.getElementById('cphone').innerHTML = 'Distance: '+C_Arr[0].dist;
    document.getElementById('Loc_M').innerHTML = 'Location: '+C_Arr[0].request_id;
    document.getElementById('statp').innerHTML = C_Arr[0].status;
}

function update(){
    var dom_old = document.getElementById(top1).style;
    if(0){
        var dom_new = document.getElementById('no_nofi').style;
        dom_old.zIndex='0';
        dom_new.zIndex='10';
        dom_old.visibility='hidden';
        dom_new.visibility='visible';
        top='no_noti';
    }
    else{
        if(1){
            var dom_new = document.getElementById('c_tab').style;
            dom_old.zIndex='0';
            dom_new.zIndex='10';
            dom_old.visibility='hidden';
            dom_new.visibility='visible';
            top='c_tab';
            //cust_status();
        }
        else{
            var dom_new = document.getElementById('m_tab').style;
            dom_old.zIndex='0';
            dom_new.zIndex='10';
            dom_old.visibility='hidden';
            dom_new.visibility='visible';
            top='m_tab';
        }
    }
}
//update();
































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
