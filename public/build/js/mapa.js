// Funció d'inicialització del mapa
window.initMap = function () {
  const centre = { lat: 41.3879, lng: 2.16992 };

  const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 15,
      center: centre,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      tilt: 0,
      heading: 0,
  });

  const autocomplete = initAutocomplete(map);
  document.getElementById("startSelection").addEventListener("click", () => iniciarSeleccio(map));
  document.getElementById("buttonBuscar").addEventListener("click", () => geocodeAddress(map));
};

// Funció per inicialitzar Autocomplete
function initAutocomplete(map) {
  const autocomplete = new google.maps.places.Autocomplete(
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
      crearMarcador(map, place.geometry.location);
  });

  return autocomplete;
}

// Funció per geolocalitzar una adreça introduïda
function geocodeAddress(map) {
  const address = document.getElementById("address").value;

  if (address === "") {
      alert("Per favor, introduïu una adreça.");
      return;
  }

  const geocoder = new google.maps.Geocoder();

  geocoder.geocode({ address: address }, function (results, status) {
      if (status === "OK") {
          map.setCenter(results[0].geometry.location);
          crearMarcador(map, results[0].geometry.location);
          alert("Ubicació trobada");
      } else {
          alert("No sa trobat la direcció, torna-ho a intentar.");
          console.log(results);
      }
  });
}

// Función para crear un marcador
function crearMarcador(map, latLng) {
  const nomEdifici = prompt("Introdueix el nom de l'edifici:");
  if (nomEdifici) {
      if (window.marcadorExistente) {
          window.marcadorExistente.setMap(null);
      }
      window.marcadorExistente = new google.maps.Marker({
          position: latLng,
          map: map,
          title: nomEdifici,
      });

      map.setCenter(latLng);

      const areaText = document.getElementById("areaResult").innerText;
      const areaValue = areaText.replace("Àrea: ", "").replace(" m²", ""); 

      const edifici = {
          id: window.edificis ? window.edificis.length + 1 : 1,
          lat: latLng.lat(),
          lng: latLng.lng(),
          nom: nomEdifici,
          inclinacion: latLng.lat().toFixed(0),
          area: areaValue, 
      };

      if (!window.edificis) {
          window.edificis = [];
      }
      window.edificis.push(edifici);

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

// Comienza la selección de puntos
function iniciarSeleccio(map) {
  // Reinicia todo el estado
  reiniciarEstado(map);

  // Añade un nuevo evento de clic
  const clickListener = map.addListener("click", (event) => {
      seleccionarPunt(event, map);
  });

  // Guarda el listener para poder eliminarlo después
  window.clickListener = clickListener;
}

function reiniciarEstado(map) {
    // Elimina todos los marcadores
    if (window.selectedMarkers) {
        window.selectedMarkers.forEach((marker) => marker.setMap(null));
        window.selectedMarkers = [];
    }
  
    // Elimina el polígono anterior
    if (window.selectedPolygon) {
        window.selectedPolygon.setMap(null);
    }
  
    // Crea un nuevo array para los marcadores
    window.selectedMarkers = [];
  
    // Crea un nuevo polígono (sin asignarlo todavía)
    window.selectedPolygon = null;
  
    // Limpia el área mostrada
    document.getElementById("areaResult").innerText = "";
  
    // Elimina el botón "Configurar pla:" si existe
    const configurarPlaButton = document.querySelector(".configurar-pla-button");
    if (configurarPlaButton) {
        configurarPlaButton.remove();
    }
  
    // Elimina el listener de clic anterior si existe
    if (window.clickListener) {
        google.maps.event.removeListener(window.clickListener);
        window.clickListener = null;
    }
  }

// Función para seleccionar puntos
function seleccionarPunt(event, map) {
  const marker = new google.maps.Marker({
      position: event.latLng,
      map: map,
      icon: {
          path: google.maps.SymbolPath.CIRCLE,
          scale: 6,
          fillColor: "red",
          fillOpacity: 1,
          strokeWeight: 1,
      },
      draggable: true,
  });

  window.selectedMarkers.push(marker);

  marker.addListener("dragend", function () {
      dibuixarPoligon(map);
  });

  if (window.selectedMarkers.length >= 3) {
      dibuixarPoligon(map);
  }
}

// Función para dibujar el polígono
function dibuixarPoligon(map) {
  // Elimina el polígono anterior si existe
  if (window.selectedPolygon) {
      window.selectedPolygon.setMap(null);
  }

  const coordinates = window.selectedMarkers.map((marker) => marker.getPosition());

  // Només tanca el polígon si hi ha 3 punts o més
  if (coordinates.length >= 3) {
      coordinates.push(coordinates[0]); // Tanca només si hi ha 3 o més punts
  }

  // Crea un nuevo polígono
  window.selectedPolygon = new google.maps.Polygon({
      paths: coordinates,
      strokeColor: "#00FF00",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#00FF00",
      fillOpacity: 0.35,
      map: map,
  });   

  if (coordinates.length >= 3) {
      calcularArea(window.selectedPolygon);
  }
}

function calcularArea(selectedPolygon) {
    const areaLabel = document.getElementById("areaResult");
    const areaLabelPanel = document.getElementById("areaResultPanel");

    if (selectedPolygon) {
        const area = google.maps.geometry.spherical.computeArea(selectedPolygon.getPath());
        areaLabel.innerText = `Àrea: ${area.toFixed(2)} m²`;
        areaLabelPanel.innerText = `Àrea: ${area.toFixed(2)} m²`;
  
        const edificiData = JSON.parse(localStorage.getItem("edificiData")) || {};
        edificiData.area = area.toFixed(2);
        localStorage.setItem("edificiData", JSON.stringify(edificiData));
  
        // Crear el botón "Configurar pla:" solo si no existe
        if (!document.querySelector(".configurar-pla-button")) {
            const configurarPlaButton = document.createElement("button");
            configurarPlaButton.innerText = "Configurar pla";
            configurarPlaButton.className = "configurar-pla-button";
            configurarPlaButton.addEventListener("click", () => {
                // Abrir el side panel
                const sidePanel = document.getElementById("sidePanel");
                sidePanel.classList.add("open");
            });
  
            // Añadir el botón al lado de "areaResult"
            areaLabel.insertAdjacentElement("afterend", configurarPlaButton);
        }
    }
  }

// Cerrar el side panel
document.getElementById("closePanelButton").addEventListener("click", () => {
    const sidePanel = document.getElementById("sidePanel");
    sidePanel.classList.remove("open");
});



document.getElementById("startSelection").addEventListener("click", () => {
    reiniciarEstado(map); // Reinicia el estado, incluyendo eliminar el botón "Configurar pla:"
    iniciarSeleccio(map); // Inicia una nueva selección
  });

