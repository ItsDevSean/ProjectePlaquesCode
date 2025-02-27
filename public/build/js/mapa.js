// Funció d'inicialització del mapa
window.initMap = function () {
    const centre = { lat: 41.3879, lng: 2.16992 };
  
    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 15,
      center: centre,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      tilt: 0, 
      heading: 0
    });
  
    initAutocomplete();
    document.getElementById("startSelection").addEventListener("click", iniciarSeleccio);
    document.getElementById("buttonBuscar").addEventListener("click", geocodeAddress);
  };
  
  // Funció per inicialitzar Autocomplete
  function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("address"),
        { types: ["geocode"] }
    );
  
    autocomplete.addListener("place_changed", function () {
        const place = autocomplete.getPlace();
  
        if (!place.geometry) {
            alert("No s'han trobat detalls per aquesta adreça.");
            return;
        }
  
        console.log("Direcció seleccionada:", place.formatted_address);
        console.log("Latitud:", place.geometry.location.lat());
        console.log("Longitud:", place.geometry.location.lng());
  
        map.setCenter(place.geometry.location);
        if (marcadorExistente) marcadorExistente.setMap(null);
        crearMarcador(place.geometry.location);
    });
  }
  
  // Funció per geolocalitzar una adreça introduïda
  function geocodeAddress() {
    const address = document.getElementById("address").value;
  
    if (address === "") {
      alert("Per favor, introduïu una adreça.");
      return;
    }
  
    const geocoder = new google.maps.Geocoder();
  
    geocoder.geocode({ address: address }, function (results, status) {
      if (status === "OK") {
        map.setCenter(results[0].geometry.location);
        if (marcadorExistente) {
          marcadorExistente.setMap(null);
        }
        marcadorExistente = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location,
          title: results[0].formatted_address,
        });
        alert("Ubicació trobada");
      } else {
        alert("No sa trobat la direcció, torna-ho a intentar.");
        console.log(results);
      }
    });
  }
  
  // Comienza la selección de puntos
  function iniciarSeleccio() {
    netejarSeleccio();
    map.addListener("click", seleccionarPunt);
  }
  
  // Función para seleccionar puntos
  function seleccionarPunt(event) {
    let marker = new google.maps.Marker({
        position: event.latLng,
        map: map,
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 6,
            fillColor: "red",
            fillOpacity: 1,
            strokeWeight: 1,
        },
        draggable: true 
    });
  
    selectedMarkers.push(marker);
  
    marker.addListener('dragend', function() {
        dibuixarPoligon();
    });
  
    if (selectedMarkers.length >= 3) {
        dibuixarPoligon();
    }
  }
  
  // Dibuja el polígono
  function dibuixarPoligon() {
    if (selectedPolygon) {
        selectedPolygon.setMap(null);
    }
  
    let coordinates = selectedMarkers.map(marker => marker.getPosition());
    coordinates.push(coordinates[0]);
  
    selectedPolygon = new google.maps.Polygon({
        paths: coordinates,
        strokeColor: "#00FF00",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#00FF00",
        fillOpacity: 0.35,
        map: map,
    });
  
    calcularArea();
  }
  
  // Calcula el área del polígón
  function calcularArea() {
    if (selectedPolygon) {
      let area = google.maps.geometry.spherical.computeArea(selectedPolygon.getPath());
      areaLabel.innerText = `Àrea: ${area.toFixed(2)} m²`;
  
      const edificiData = JSON.parse(localStorage.getItem("edificiData")) || {};
      edificiData.area = area.toFixed(2);
      localStorage.setItem("edificiData", JSON.stringify(edificiData));
    }
  }
  
  // Limpia los puntos y el polígono anterior
  function netejarSeleccio() {
    selectedMarkers.forEach(marker => marker.setMap(null));
    selectedMarkers = [];
  
    if (selectedPolygon) {
        selectedPolygon.setMap(null);
        selectedPolygon = null;
    }
  
    areaLabel.innerText = "";
  }