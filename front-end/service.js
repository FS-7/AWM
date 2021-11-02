//                     ADD LOCATION + MARKER

//adds marker
var marker;
function fnc_marker(location) {
    if(marker){
        map.removeObject(marker);
    }
    marker = new H.map.Marker(location);
    map.addObject(marker);
    map.setCenter(location);
    //map.setZoom(14);
    check=1;
    ds(location.lat, location.lng);
    return marker;
}

//Search Text Location
function STL() {
    const searchText = document.getElementById('search').value;
    const geocoder = platform.getGeocodingService();
    geocoder.geocode({ searchText }, result => {
        const location = result.Response.View[0].Result[0].Location.DisplayPosition;
        const {Latitude: lat, Longitude: lng} = location;
        coords = {lat: lat, lng: lng};
        fnc_marker(coords);
    });
}

//get location by clicking on the map
function setUpClickListener(map) {
    map.addEventListener('tap', function (evt) {
        var coord = map.screenToGeo(evt.currentPointer.viewportX, evt.currentPointer.viewportY);
        lat = Math.abs(coord.lat.toFixed(4)); 
        lng = Math.abs(coord.lng.toFixed(4));
        RGC(lat, lng);
    });
}

var service = platform.getSearchService();
var bubble, bubblex;
function RGC(x, y) {
    service.reverseGeocode({
        at: ''+x+','+y+''
    }, (result) => {
        result.items.forEach((item) => {
                bubble = new H.ui.InfoBubble(item.position, {
                content: item.address.label+', lat:'+x+', lng:'+y 
            });
            ui.removeBubble(bubblex);
            ui.addBubble(bubble);
            bubblex = bubble;
            marker = fnc_marker({lat: x, lng: y});
            map.removeObject(marker);
        });
    }, alert);
}
setUpClickListener(map);

//automatic location using GPS
function GPS(event) {
    var HEREHQcoordinates = {
        lat: event.coords.latitude,
        lng: event.coords.longitude,
    };
    fnc_marker(HEREHQcoordinates);
    marker.draggable = true;
    addDraggableMarker(map, behavior);
}

//draggable marker
function addDraggableMarker(map, behavior){
    map.addEventListener('dragstart', function(ev) {
        var target = ev.target,
            pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
            var targetPosition = map.geoToScreen(target.getGeometry());
            target['offset'] = new H.math.Point(pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y);
            behavior.disable();
        }
    }, false);
+
    map.addEventListener('dragend', function(ev) {
        var target = ev.target;
        if (target instanceof H.map.Marker) {
            behavior.enable();
        }
        ds(marker.getGeometry().lat, marker.getGeometry().lng);
    }, false);

    map.addEventListener('drag', function(ev) {
        var target = ev.target,
        pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
            target.setGeometry(map.screenToGeo(pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y));
        }
    }, false);
}

//                      OTHER FUNCTIONS

//Distance

function distance(lat1, lon1, lat2, lon2) {
    var p = 0.017453292519943295;
    var c = Math.cos;
    var a = 0.5 - c((lat2 - lat1) * p)/2 + c(lat1 * p) * c(lat2 * p) * (1 - c((lon2 - lon1) * p))/2;
    return 12742 * Math.asin(Math.sqrt(a));
}

function ds(x, y){
    option = document.getElementById('lol').value;
    for (let i = 0; i < myObj.length; i++) {
        if(myObj[i].dist = parseInt(distance(myObj[i].gar_loc_lat, myObj[i].gar_loc_lng, x, y))){
            dynamicSort(option);
        }
    }
}

var temp = new Array(); completelynew = new Array() ;
function dynamicSort(x) {
    var dst = new Array(),
    temp = myObj;
    for (i = 0; i < temp.length; i++) {
        var j = dst.length-1;
        while(j!=-1 && dst[j][x]>temp[i][x]){
            dst[j+1] = dst[j];
            j--;
        }
        dst[j+1] = temp[i];
    }
    Table(dst);
}

var add;
function loc(x, y, garx, gary, h) {
    service.reverseGeocode({
        at: ''+x+','+y+''
    }, (result) => {
        add = result.items[0].title;
        C_Arr[h].loc = add;
        C_Arr[h].dist = parseInt(distance(x, y, garx, gary));
    }, alert);
    return true;
}

// DB VALUES

function book(book) {
    if(!marker){
        alert('Enter Location');
    }else{
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            alert('Booked');
            
        }
        xmlhttp.open("POST", "../back-end/service_log.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send('mid='+book.name+'&lat='+marker.getGeometry().lat+'&lng='+marker.getGeometry().lng);
    }
}

function task(task) {
    console.log(task);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        init();
    }
    xmlhttp.open("POST", "../back-end/cal.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("func="+task+"&request_id="+C_Arr[0].request_id);
    
}
