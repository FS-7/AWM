function book(book) {
    if(!check){
        alert('Enter Location');
    }else{
        param = {'mid': 1, 'lat': marker.getGeometry().lat, 'lng': marker.getGeometry().lng};
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            
        }
        xmlhttp.open("POST", "../back-end/service_log.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send('mid='+book.name+'&lat='+marker.getGeometry().lat+'&lng='+marker.getGeometry().lng);
    }
}