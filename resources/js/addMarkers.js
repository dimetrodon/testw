
const form = document.getElementById('add-marker-form');
form.addEventListener('submit', function (e) {
    e.preventDefault();
    
    axios.post(this.getAttribute('action'), {
        lat: this.lat.value,
        lng: this.lng.value
    }).then((m) => {
        e.target.elements.lat.value = e.target.elements.lng.value = '';
    }).catch((error) => {
        if ( error.response.status == 422 ) {
            let alertM = "";
            let errors = error.response.data.errors;

            for(let index in errors) { 
                alertM += errors[index][0] + "\r\n"; 
            }
            
            alert(alertM);
        }
    });
});

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 1,
        center: { lat: 0.0, lng: 0.0 },
        zoomControl: true,
        gestureHandling: "none",
    });
    addOldMarkers();

    function addOldMarkers() {
        oldMarkers.forEach(addMarker)
    }

    function addMarker(latLng){
        const alive = latLng['alive'];
        delete latLng['alive'];
        latLng['lat'] = parseFloat(latLng['lat']);
        latLng['lng'] = parseFloat(latLng['lng']);

        const Marker = new google.maps.Marker({
            position: latLng,
            map,
        });

        setTimeout(()=>{
            Marker.setMap(null);
        }, alive * 1000)
    }
    Echo.channel('addmarkers').listen('AddMarker', addMarker);
}
window.initMap = initMap;