let map;
const edificis = []; // Array per emmagatzemar les coordenades dels edificis
let marcadorExistente = null; // Variable per controlar si ja hi ha un marcador al mapa

// Funció per obtenir dades de l'edifici utilitzant l'API Building Insights
async function obtenirDadesEdifici(lat, lng) {
  const API_KEY = "AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04";
  const url = `https://solar.googleapis.com/v1/buildingInsights:findClosest?location.latitude=${lat}&location.longitude=${lng}&key=${API_KEY}`;

  try {
    const resposta = await fetch(url);
    const dades = await resposta.json();

    if (dades.solarPotential) {
      const superficieUtil =
        dades.solarPotential.panelCapacityWatts / 200; // Estimat amb plaques de 200W/m²
      alert(
        `Dades de l'edifici: Superfície útil estimada per plaques solars: ${superficieUtil.toFixed(
          2
        )} m²`
      );
    } else {
      alert("No s'han trobat dades solars per aquest edifici.");
    }
  } catch (error) {
    console.error("Error en obtenir dades de l’edifici:", error);
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

  // Afegir un event per a crear un marcador en el lloc on l'usuari fa clic
  google.maps.event.addListener(map, "click", function (event) {
    const latLng = event.latLng; // Obtenir les coordenades del punt clicat

    if (marcadorExistente) {
      // Si ja existeix un marcador, pregunta si vol crear un nou projecte
      const resposta = confirm(
        "Ja existeix un marcador al mapa. Vols crear un nou projecte amb aquesta ubicació?"
      );
      if (resposta) {
        // Eliminar el marcador anterior del mapa
        marcadorExistente.setMap(null);

        // Crear un nou marcador a la mateixa ubicació
        const nomEdifici = prompt("Introdueix el nom del nou edifici:");
        if (nomEdifici) {
          const marcador = new google.maps.Marker({
            position: latLng,
            map: map,
            title: nomEdifici,
          });

          // Actualitzar el marcador existent amb la nova ubicació
          marcadorExistente = marcador;

          // Afegir les coordenades de l'edifici a la llista
          const edifici = {
            id: edificis.length + 1, // Generar un ID únic per a cada edifici
            lat: latLng.lat(),
            lng: latLng.lng(),
            nom: nomEdifici,
          };
          edificis.push(edifici);
          updateEdificiSelect(edifici); // Actualitzar el desplegable amb el nou edifici

          // Mostrar un missatge amb les coordenades
          alert(
            nomEdifici + " seleccionat! Coordenades: " +
              latLng.lat() +
              ", " +
              latLng.lng()
          );

          // Obtenir dades de l'edifici
          obtenirDadesEdifici(latLng.lat(), latLng.lng());
        }
      }
    } else {
      // Si no hi ha cap marcador, crear el primer marcador
      const nomEdifici = prompt("Introdueix el nom de l'edifici:");

      if (nomEdifici) {
        // Crear un marcador a la posició clicada
        marcadorExistente = new google.maps.Marker({
          position: latLng,
          map: map,
          title: nomEdifici,
        });

        // Afegir les coordenades de l'edifici a la llista
        const edifici = {
          id: edificis.length + 1,
          lat: latLng.lat(),
          lng: latLng.lng(),
          nom: nomEdifici,
        };
        edificis.push(edifici);

        // Actualitzar el desplegable amb el nou edifici
        updateEdificiSelect(edifici);

        // Mostrar un missatge amb les coordenades
        alert(nomEdifici + " seleccionat!");

        // Obtenir dades de l'edifici
        obtenirDadesEdifici(latLng.lat(), latLng.lng());
      }
    }
  });

  // Autocomplete per introduir una direcció
  const input = document.getElementById("address");
  const autocomplete = new google.maps.places.Autocomplete(input, {
    types: ["geocode"],
    componentRestrictions: { country: "es" },
  });

  autocomplete.addListener("place_changed", function () {
    const place = autocomplete.getPlace();

    if (!place.geometry) {
      alert("No s'han trobat coordenades per aquesta ubicació.");
      return;
    }

    // Centrar el mapa en la nova ubicació
    map.setCenter(place.geometry.location);
    map.setZoom(17);

    // Crear marcador en la ubicació seleccionada
    new google.maps.Marker({
      map: map,
      position: place.geometry.location,
      title: place.formatted_address,
    });

    alert(`Ubicació seleccionada: ${place.formatted_address}`);
  });
};

// Funció per canviar el tipus de mapa (roadmap o satèl·lit)
function changeMapType(type) {
  if (type === "satellite") {
    map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
  } else {
    map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
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

  geocoder.geocode({ address: address }, function (results, status, nomEdifici) {
    if (status === "OK") {
      // Centrar el mapa a la nova ubicació
      map.setCenter(results[0].geometry.location);
      // Col·locar un marcador a la ubicació
      const marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location,
        title: nomEdifici,
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

// Funció per actualitzar el desplegable amb els edificis creats
function updateEdificiSelect(edifici) {
  const select = document.getElementById("edifici");
  const option = document.createElement("option");
  option.value = edifici.id; 
  option.text = edifici.nom; 
  select.appendChild(option);
}

// Funció per gestionar la selecció d'un edifici
function seleccionarEdifici() {
  const select = document.getElementById("edifici");
  const id = select.value;

  if (id) {
    const edificiSeleccionat = edificis.find((edifici) => edifici.id === parseInt(id));
    alert(`Has seleccionat: ${edificiSeleccionat.nom}`);
    // Aquí pots fer més accions per treballar amb l'edifici seleccionat
  }
}
