let map;
const edificis = []; // Array per emmagatzemar les coordenades dels edificis

// Asegura't que `initMap` estigui en l'àmbit global
window.initMap = function() {
    const centre = { lat: 41.3879, lng: 2.16992 };
    
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: centre,
        mapTypeId: google.maps.MapTypeId.ROADMAP // Inicialitza en mode roadmap
        
    });

    // Afegir un event per a crear un marcador en el lloc on l'usuari fa clic
    google.maps.event.addListener(map, 'click', function(event) {
        const latLng = event.latLng; // Obtenir les coordenades del punt clicat

        // Crear un marcador a la posició clicada
        const marcador = new google.maps.Marker({
            position: latLng,
            map: map,
            title: "Edifici",
        });

        // Afegir les coordenades de l'edifici a la llista
        edificis.push({
            lat: latLng.lat(),
            lng: latLng.lng(),
            nom: "Edifici " + (edificis.length + 1)
        });

        // Mostrar un missatge amb les coordenades
        alert("Edifici afegit! Coordenades: " + latLng.lat() + ", " + latLng.lng());
    });
};

// Funció per canviar el tipus de mapa
function changeMapType(type) {
    if (type === 'satellite') {
        map.setMapTypeId(google.maps.MapTypeId.SATELLITE); // Canvia al mode satèl·lit
    } else {
        map.setMapTypeId(google.maps.MapTypeId.ROADMAP); // Torna al mode normal
    }
}

// Funció per canviar la ubicació seguint la direcció introduïda
function geocodeAddress() {
    const address = document.getElementById("address").value;

    // Si el camp de direcció està buit, mostra un missatge d'error
    if (address === '') {
        alert('Per favor, introduïu una adreça.');
        return;
    }

    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({ 'address': address }, function(results, status) {
        if (status === 'OK') {
            // Centrar el mapa a la nova ubicació
            map.setCenter(results[0].geometry.location);
            // Col·locar un marcador a la ubicació
            const marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                title: "Ubicació trobada",
            });
            // Mostrar un missatge amb les coordenades
            alert("Ubicació: " + results[0].geometry.location.lat() + ", " + results[0].geometry.location.lng());
            
            // Console log de la resposta
            
        } else {
            alert("No es va poder trobar la direcció: " + status);
            console.log(results);
        }
    });     
}
