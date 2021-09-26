var x,y;
const platform = new H.service.Platform({ apikey: 'RcKQATNQXIpKkx6J71y8MmQGByCNnoTqDKcyicGgVgw' });
const defaultLayers = platform.createDefaultLayers();
//const location = result.Response.View[0].Result[0].Location.DisplayPosition;

const map = new H.Map(document.getElementById('map'),
defaultLayers.vector.normal.map, {
    center: { lat: 52.5 , lng: 13.3 },
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

        console.log(lat, lng);
    });
}

function updatePosition (event) {
    var HEREHQcoordinates = {
      lat: event.coords.latitude,
      lng: event.coords.longitude
    };
    var marker = new H.map.Marker(HEREHQcoordinates);
    map.addObject(marker);
    map.setCenter(HEREHQcoordinates);
  }
navigator.geolocation.watchPosition(updatePosition);