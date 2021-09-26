var x,y;
const platform = new H.service.Platform({ apikey: 'RcKQATNQXIpKkx6J71y8MmQGByCNnoTqDKcyicGgVgw' });
const defaultLayers = platform.createDefaultLayers();
//const location = result.Response.View[0].Result[0].Location.DisplayPosition;

const map = new H.Map(document.getElementById('map'),
defaultLayers.vector.normal.map, {
    center: { lat: 0 , lng: 0 },
    zoom: 10,
    pixelRatio: window.devicePixelRatio || 1
});

//map.setCenter({lat: 291.8, long: 156});
const mapEvents = new H.mapevents.MapEvents(map);
const Behave = new H.mapevents.Behavior(mapEvents);
const UserI = H.ui.UI;
//resizing and ui buttons 
window.addEventListener('resize', () => map.getViewPort().resize());
const behavior = Behave;
const ui = UserI.createDefault(map, defaultLayers);

//input of the user
const geocoder = platform.getGeocodingService();
function Marker() {
    var searchText = document.getElementById('search').value;
    if(searchText == ''){
        console.log(searchText = "Please Enter");
    }
    else{
        geocoder.geocode({ searchText }, result => {
            const location = result.Response.View[0].Result[0].Location.DisplayPosition;
            const { Latitude : lat, Longitude: lng } = location;
            const marker = new H.map.Marker({ lat, lng });
            map.addObject(marker);
        });
    }
}

function func() {
    map.addEventListener('tap', function(evt) {
        console.log(evt.currentPointer.Latitude, evt.currentPointer.Longitude);
    });
}



                    /*
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
                            map.addObject(marker);
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
                    });*/

                    