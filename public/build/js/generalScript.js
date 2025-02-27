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
      const superficieUtil = dades.solarPotential.panelCapacityWatts / 200; // Estimat amb plaques de 200W/m²
      alert(`Dades de l'edifici: Superfície útil estimada per plaques solars: ${superficieUtil.toFixed(2)} m²`);
    } else {
      alert("No s'han trobat dades solars per aquest edifici.");
    }
  } catch (error) {
    console.error("Error en obtenir dades de l'edifici:", error);
    alert("Hi ha hagut un error en obtenir les dades de l'edifici.");
  }
}

// Funció per crear un marcador
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

    const areaText = document.getElementById("areaResult").innerText;
    const areaValue = areaText.replace("Àrea: ", "").replace(" m²", ""); 

    const edifici = {
      id: edificis.length + 1,
      lat: latLng.lat(),
      lng: latLng.lng(),
      nom: nomEdifici,
      inclinacion: latLng.lat().toFixed(0),
      area: areaValue, 
    };
    edificis.push(edifici);

    localStorage.setItem("edificiData", JSON.stringify(edifici));

    const url = `/formulari?lat=${edifici.lat}&lng=${edifici.lng}&inclinacion=${edifici.inclinacion}&area=${edifici.area}`;

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