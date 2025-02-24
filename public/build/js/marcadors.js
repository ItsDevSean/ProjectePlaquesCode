let map;
let edificis = []; 
let marcadorExistente = null; 
let selectedMarkers = [];
let selectedPolygon = null;
let areaLabel = document.getElementById("areaResult");


// Funció per obtenir dades de l'edifici
async function obtenirDadesEdifici(lat, lng) {
  const API_KEY = "AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04";
  const url = `https://solar.googleapis.com/v1/buildingInsights:findClosest?location.latitude=${lat}&location.longitude=${lng}&key=${API_KEY}`;

  try {
    const resposta = await fetch(url);
    const dades = await resposta.json();

    if (dades.solarPotential) {
      const superficieUtil =
        dades.solarPotential.panelCapacityWatts / 200; // Estimat amb plaques de 200W/m²
      alert(`Dades de l'edifici: Superfície útil estimada per plaques solars: ${superficieUtil.toFixed(2)} m²`);
    } else {
      alert("No s'han trobat dades solars per aquest edifici.");
    }
  } catch (error) {
    console.error("Error en obtenir dades de l'edifici:", error);
    alert("Hi ha hagut un error en obtenir les dades de l'edifici.");
  }
}



// Funció d'inicialització del mapa
window.initMap = function () {
  const centre = { lat: 41.3879, lng: 2.16992 };

  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: centre,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  });

  initAutocomplete();
  document.getElementById("startSelection").addEventListener("click", iniciarSeleccio);

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


function crearMarcador(latLng) {
  const nomEdifici = prompt("Introdueix el nom de l'edifici:");
  if (nomEdifici) {
    if (marcadorExistente) {
      marcadorExistente.setMap(null);
    }
    marcadorExistente = new google.maps.Marker({
      position: latLng,
      map: map,
      title: nomEdifici,
    });

    map.setCenter(latLng);

    const edifici = {
      id: edificis.length + 1,
      lat: latLng.lat(),
      lng: latLng.lng(),
      nom: nomEdifici,
    };
    edificis.push(edifici);

    // Actualitzar els camps de latitud, longitud i inclinació al formulari
    document.getElementById("latitud").value = edifici.lat;
    document.getElementById("longitud").value = edifici.lng;
    document.getElementById("inclinacion").value = edifici.lat.toFixed(0);

    if (nomEdifici && nomEdifici.toLowerCase().includes("edifici")) {
      alert(nomEdifici + " creat!");
    } else {
      alert("Edifici " + nomEdifici + " creat!");
    }

    updateEdificiSelect(edifici);
    document.getElementById("edifici").value = edifici.id;
    obtenirDadesEdifici(latLng.lat(), latLng.lng());
  }
}



function updateEdificiSelect(edifici) {
  const select = document.getElementById("edifici");
  
  const option = document.createElement("option");
  option.value = edifici.id;
  option.text = edifici.nom;

  const editOption = select.querySelector('option[value="edit"]');

  select.insertBefore(option, editOption);
}


function seleccionarEdifici() {
  const select = document.getElementById("edifici");
  const id = select.value;
  const edificiSeleccionat = edificis.find(e => e.id == id);

  if (id === "edit") {
    window.location.href = "edificis";
  }
  

  if (edificiSeleccionat) {
    if (marcadorExistente) {
      marcadorExistente.setMap(null);
    }

    // Crear un marcador per l'edifici seleccionat
    marcadorExistente = new google.maps.Marker({
      position: { lat: edificiSeleccionat.lat, lng: edificiSeleccionat.lng },
      map: map,
      title: edificiSeleccionat.nom,
    });

    map.setCenter({ lat: edificiSeleccionat.lat, lng: edificiSeleccionat.lng });

    document.getElementById("latitud").value = edificiSeleccionat.lat;
    document.getElementById("longitud").value = edificiSeleccionat.lng;

    if (edificiSeleccionat.nom && edificiSeleccionat.nom.toLowerCase().includes("edifici")) {
      alert(edificiSeleccionat.nom + " seleccionat!");
    } else {
      alert("Edifici " + edificiSeleccionat.nom + " seleccionat!");
    }
  }
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
      alert(
        "Ubicació: " +
          results[0].geometry.location.lat() +
          ", " +
          results[0].geometry.location.lng()
      );
    } else {
      alert("No es va poder trobar la direcció: " + status);
      console.log(results);
    }
  });
}

document.querySelectorAll('ul.flex-col li').forEach((step) => {
  step.addEventListener('click', () => {
    window.location.href = step.getAttribute('data-url');
  });
});

// Comença la selecció de punts
function iniciarSeleccio() {
  netejarSeleccio();
  map.addListener("click", seleccionarPunt);
}

// Funció per seleccionar punts
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
  });

  selectedMarkers.push(marker);

  // Dibuixa el polígon sempre que hi hagi almenys 3 punts
  if (selectedMarkers.length >= 3) {
      dibuixarPoligon();
  }
}

// Dibuixa el polígon
function dibuixarPoligon() {
  if (selectedPolygon) {
      selectedPolygon.setMap(null);
  }

  let coordinates = selectedMarkers.map(marker => marker.getPosition());

  // Tanquem el polígon unint el primer i l'últim punt
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

// Calcula l'àrea del polígon
function calcularArea() {
  if (selectedPolygon) {
      let area = google.maps.geometry.spherical.computeArea(selectedPolygon.getPath());
      areaLabel.innerText = `Àrea: ${area.toFixed(2)} m²`;
  }
}

// Neteja els punts i el polígon anterior
function netejarSeleccio() {
  selectedMarkers.forEach(marker => marker.setMap(null));
  selectedMarkers = [];

  if (selectedPolygon) {
      selectedPolygon.setMap(null);
      selectedPolygon = null;
  }

  areaLabel.innerText = "";
}