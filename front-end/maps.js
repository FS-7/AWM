const platform = new H.service.Platform({ apikey: 'D_6Bq02OZ4b2BBwXAJYFlZ6yHIixKl0Q5ym9lUlNhxg' });
const defaultLayers = platform.createDefaultLayers();
const map = new H.Map(document.getElementById('map'),
    defaultLayers.vector.normal.map, {
    center: { lat: 15.3425, lng: 75.1475 },
    zoom: 11,
    pixelRatio: window.devicePixelRatio || 1
});

//UI controls
window.addEventListener('resize', () => map.getViewPort().resize());
const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
const ui = H.ui.UI.createDefault(map, defaultLayers);
var lat=0, lng=0;
var marker = new H.map.Marker({ lat, lng });

//Search your Location
function SYL() {
    const searchText = document.getElementById('search').value;
    const geocoder = platform.getGeocodingService();
    geocoder.geocode({ searchText }, result => {
        const location = result.Response.View[0].Result[0].Location.DisplayPosition;
        const { Latitude : lat, Longitude: lng } = location;
        marker.setGeometry({lat, lng});
        map.addObject(marker);
        map.setCenter({lat, lng});
        map.setZoom(14);
    });
}

//get location by clicking on the map
function setUpClickListener(map) {
    map.addEventListener('tap', function (evt) {
        var coord = map.screenToGeo(evt.currentPointer.viewportX, evt.currentPointer.viewportY);
        lat = Math.abs(coord.lat.toFixed(4)); 
        lng = Math.abs(coord.lng.toFixed(4));
        RGC(lat, lng);
        marker.setGeometry({ lat, lng });
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
        });
    }, alert);
}
setUpClickListener(map);

//automatic location using GPS
function updatePosition (event) {
    var HEREHQcoordinates = {
        lat: event.coords.latitude,
        lng: event.coords.longitude,
    };
    marker.setGeometry(HEREHQcoordinates);
    marker.draggable = true;
    map.addObject(marker);
    map.setCenter(HEREHQcoordinates);
    map.setZoom(14);
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

    map.addEventListener('dragend', function(ev) {
        var target = ev.target;
        if (target instanceof H.map.Marker) {
            behavior.enable();
        }
    }, false);

    map.addEventListener('drag', function(ev) {
        var target = ev.target,
        pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
            target.setGeometry(map.screenToGeo(pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y));
        }
    }, false);
}

//lower-right.js
function distance(lat1, lon1, lat2, lon2) {
    var p = 0.017453292519943295;
    var c = Math.cos;
    var a = 0.5 - c((lat2 - lat1) * p)/2 + c(lat1 * p) * c(lat2 * p) * (1 - c((lon2 - lon1) * p))/2;
    return 12742 * Math.asin(Math.sqrt(a));
    //document.getElementById("mech_"+h+"2").innerHTML = 'Distance: '+dist[h];
}

function dynamicSort(property) {
    var sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        /* next line works with strings and numbers, 
         * and you may want to customize it to your needs
         */
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}

//
var mechname = new Array(), mechph = new Array(), dist = new Array(), mech_lat = new Array(), mech_lng = new Array();
var body = document.getElementById('mech_list');
var h=0;
const xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
    var myObj = JSON.parse(this.responseText);
    myObj.forEach(element => {
        mechname[h]=element[1];
        mechph[h]=element[2];
        mech_lat[h]=element[3];
        mech_lng[h]=element[4];
        tr = document.createElement("tr");
            td = document.createElement("td");
                tbl = document.createElement("table");
                    tblBody = document.createElement("tbody");
                        row = document.createElement("tr");
                            //img
                            cell = document.createElement("td");
                                cellText = document.createElement("img");
                                    cellText.setAttribute('id','img');
                                    cellText.setAttribute('src','../img/awm.jpg');
                                    cellText.setAttribute('height','60px');
                                    cellText.setAttribute('width','60px');
                                cell.appendChild(cellText);
                            row.appendChild(cell);
                            //name+phone
                            cell2 = document.createElement("td");
                                tbl2 = document.createElement("table");
                                    tblBody2 = document.createElement("tbody");
                                        for (let index = 0; index < 3; index++) {
                                            row2 = document.createElement("tr");
                                                cell21 = document.createElement("td");
                                                    cellText2 = document.createElement("p");
                                                    cellText2.setAttribute('id','mech_'+h+index);
                                                    cellText2.setAttribute('style','margin: 0px;');
                                                    cell21.appendChild(cellText2);
                                                row2.appendChild(cell21);
                                            tblBody2.appendChild(row2);    
                                        }
                                    tbl2.appendChild(tblBody2);
                                cell2.appendChild(tbl2); 
                            row.appendChild(cell2);  
                            cellRating = document.createElement("td");
                                //button
                                button = document.createElement("button");
                                button.setAttribute('id', 'Book'+h);
                                cellRating.appendChild(button);
                                cellTextRating = document.createElement("p");
                                cellTextRating.setAttribute('id','rating'+h);
                                cellTextRating.setAttribute('style','margin: 0px;');
                                cellRating.appendChild(cellTextRating);                
                            row.appendChild(cellRating);        
                        tblBody.appendChild(row);
                    tbl.appendChild(tblBody);
                td.appendChild(tbl);
            tr.appendChild(td);
        body.appendChild(tr);
        dist[h] = parseInt(distance(mech_lat[h], mech_lng[h], lat, lng));
        //dynamicSort();
        document.getElementById("mech_"+h+"2").innerHTML = 'Distance: '+dist[h];
        document.getElementById("Book"+h).innerHTML = 'Book';
        document.getElementById("mech_"+h+"0").innerHTML = 'Name: '+mechname[h];
        document.getElementById("mech_"+h+"1").innerHTML = 'Phone: +91'+mechph[h];
        document.getElementById("rating"+h).innerHTML = 'No Rating';
        h++;
    });   
}
xmlhttp.open("POST", "../s.php");
xmlhttp.send();
