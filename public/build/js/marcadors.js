let map;
const edificis = []; 
let marcadorExistente = null; 

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

  google.maps.event.addListener(map, "click", function (event) {
    const latLng = event.latLng;

    if (marcadorExistente) {
      const resposta = confirm("Ja existeix un marcador al mapa. Vols crear un nou projecte amb aquesta ubicació?");
      if (resposta) {
        marcadorExistente.setMap(null);
        crearMarcador(latLng);
      }
    } else {
      crearMarcador(latLng);
    }
  });
};

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
  select.appendChild(option);
}

function seleccionarEdifici() {
  const select = document.getElementById("edifici");
  const id = select.value;
  const edificiSeleccionat = edificis.find(e => e.id == id);
  if (edificiSeleccionat) {
    if (marcadorExistente) {
      marcadorExistente.setMap(null);
    }
    marcadorExistente = new google.maps.Marker({
      position: { lat: edificiSeleccionat.lat, lng: edificiSeleccionat.lng },
      map: map,
      title: edificiSeleccionat.nom,
    });
    map.setCenter({ lat: edificiSeleccionat.lat, lng: edificiSeleccionat.lng });
    if (edificiSeleccionat.nom && edificiSeleccionat.nom.toLowerCase().includes("edifici")) {
      alert(edificiSeleccionat.nom + " seleccionat!");
      } else {
      alert("Edifici " + edificiSeleccionat.nom + " seleccionat!");
    }
  }
}

// Funció per canviar el tipus de mapa 
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
