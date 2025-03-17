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
  document.getElementById("nouObstacleButton").addEventListener("click", () => iniciarSeleccioObstacle(map));
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
  
    window.marcadorExistente = new google.maps.Marker({
        position: latLng,
        map: map,
      });

      map.setCenter(latLng);

      const areaText = document.getElementById("areaResult").innerText;
      const areaValue = areaText.replace("Àrea: ", "").replace(" m²", ""); 

      const edifici = {
          id: window.edificis ? window.edificis.length + 1 : 1,
          lat: latLng.lat(),
          lng: latLng.lng(),
          inclinacion: latLng.lat().toFixed(0),
          area: areaValue, 
      };

      if (!window.edificis) {
          window.edificis = [];
      }
      window.edificis.push(edifici);

      localStorage.setItem("edificiData", JSON.stringify(edifici));

      const url = `/formulari?lat=${edifici.lat}&lng=${edifici.lng}&inclinacion=${edifici.inclinacion}&area=${edifici.area}`;

      

      updateEdificiSelect(edifici);
      document.getElementById("edifici").value = edifici.id;
      obtenirDadesEdifici(latLng.lat(), latLng.lng());
  
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
    const sidePanel = document.getElementById("sidePanel");

    // Evitar añadir puntos si el side panel está abierto
    if (sidePanel.classList.contains("open")) {
        return;
    }

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

    if (window.selectedMarkers.length >= 2) {
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
      clickable: false,
  });   

  if (coordinates.length >= 3) {
      calcularArea(window.selectedPolygon);
  }
}

// Función para calcular el número máximo de placas
function calcularMaxPlacas(areaTotal) {
    const selectPanel = document.getElementById('panel_model');
    const selectedOption = selectPanel.options[selectPanel.selectedIndex];
    const areaPlaca = parseFloat(selectedOption.getAttribute('data-surface'));

    if (isNaN(areaPlaca) || areaPlaca <= 0) {
        console.error('No se ha seleccionado un panel válido o la superficie no está definida.');
        return 0;
    }

    return Math.floor(areaTotal / areaPlaca);
}

// Escuchar cambios en el select
const selectPanel = document.getElementById('panel_model');
selectPanel.addEventListener('change', function () {
    // Obtener el área total desde localStorage o desde la función calcularArea
    const edificiData = JSON.parse(localStorage.getItem("edificiData")) || {};
    const areaTotal = parseFloat(edificiData.area);

    if (isNaN(areaTotal) || areaTotal <= 0) {
        console.error('No se ha calculado un área válida.');
        return;
    }

    // Calcular el número máximo de placas
    const maxPlacas = calcularMaxPlacas(areaTotal);
    console.log('Número máximo de placas:', maxPlacas);

    // Actualizar el slider (si es necesario)
    actualizarSlider(maxPlacas);
});

// Función para calcular el área del polígono
function calcularArea(selectedPolygon) {
    const areaLabel = document.getElementById("areaResult");

    if (selectedPolygon) {
        const area = google.maps.geometry.spherical.computeArea(selectedPolygon.getPath());
        areaLabel.innerText = `Àrea: ${area.toFixed(2)} m²`;

        // Guardar el área en localStorage
        const edificiData = JSON.parse(localStorage.getItem("edificiData")) || {};
        edificiData.area = area.toFixed(2);
        localStorage.setItem("edificiData", JSON.stringify(edificiData));

        // Calcular el número máximo de placas con el área actual
        const maxPlacas = calcularMaxPlacas(area);
        actualizarSlider(maxPlacas);

        // Crear el botón "Configurar pla:" solo si no existe
        if (!document.querySelector(".configurar-pla-button")) {
            const configurarPlaButton = document.createElement("button");
            configurarPlaButton.innerText = "Configurar pla";
            configurarPlaButton.className = "configurar-pla-button";
            configurarPlaButton.addEventListener("click", () => {
                // Abrir el side panel
                const sidePanel = document.getElementById("sidePanel");
                sidePanel.classList.add("open");

                // Desactivar la selección de puntos
                if (window.clickListener) {
                    google.maps.event.removeListener(window.clickListener);
                    window.clickListener = null;
                }

                // Rellenar el formulario con los datos guardados
                const edificiData = JSON.parse(localStorage.getItem("edificiData"));
                if (edificiData) {
                    document.getElementById("inclinacion").value = edificiData.inclinacion;
                    document.getElementById("area").value = edificiData.area;
                }
            });

            // Añadir el botón al lado de "areaResult"
            areaLabel.insertAdjacentElement("afterend", configurarPlaButton);
        }
    }
}

// Función para actualizar el slider y el input de número de placas
function actualizarSlider(maxPlacas) {
    const slider = document.getElementById("placaSlider");
    const placaCount = document.getElementById("placaCount");

    // Actualizar el rango del slider y el input
    slider.max = maxPlacas;
    placaCount.max = maxPlacas;

    // Inicializar el valor del slider y el input
    slider.value = 0;
    placaCount.value = 0;

    // Actualizar el estilo del slider al cargar la página
    actualizarEstiloSlider(slider);

    // Actualizar el input cuando se mueve el slider
    slider.addEventListener("input", function () {
        placaCount.value = this.value;
        actualizarEstiloSlider(this); // Actualizar el estilo del slider
    });

    // Actualizar el slider cuando el input manual cambia
    placaCount.addEventListener("input", function () {
        const newValue = Math.min(Math.max(parseInt(this.value, 10), 0), parseInt(this.max, 10));
        this.value = newValue; // Asegurarse de que el valor esté dentro del rango
        slider.value = newValue;
        actualizarEstiloSlider(slider); // Actualizar el estilo del slider
    });

    // Actualizar el slider cuando el input manual pierde el foco (evento "change")
    placaCount.addEventListener("change", function () {
        const newValue = Math.min(Math.max(parseInt(this.value, 10), 0), parseInt(this.max, 10));
        this.value = newValue; // Asegurarse de que el valor esté dentro del rango
        slider.value = newValue;
        actualizarEstiloSlider(slider); // Actualizar el estilo del slider
    });

    // Actualizar el slider solo cuando el usuario presione Enter
    placaCount.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            e.preventDefault(); // Prevenir el envío del formulario
            const newValue = Math.min(Math.max(parseInt(this.value, 10), 0), parseInt(this.max, 10));
            this.value = newValue; // Asegurarse de que el valor esté dentro del rango
            slider.value = newValue;
            actualizarEstiloSlider(slider); // Actualizar el estilo del slider
        }
    });
}



// Función para actualizar el valor del slider
function actualizarValorSlider(placaCount, slider) {
    const newValue = Math.min(Math.max(parseInt(placaCount.value, 10), 0), parseInt(placaCount.max, 10));
    placaCount.value = newValue; // Asegurarse de que el valor esté dentro del rango
    slider.value = newValue;
    actualizarEstiloSlider(slider); // Actualizar el estilo del slider
}

// Función para actualizar el estilo del slider
function actualizarEstiloSlider(slider) {
    const value = slider.value;
    const max = slider.max;
    const progress = (value / max) * 100 + "%"; // Calcular el porcentaje de progreso
    slider.style.background = `linear-gradient(to right, #49DBA3 ${progress}, #e0e0e0 ${progress})`; // Actualizar el fondo del slider
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

// Cerrar el side panel al hacer clic fuera de él
document.addEventListener("click", (event) => {
    const sidePanel = document.getElementById("sidePanel");
    const closePanelButton = document.getElementById("closePanelButton");
    const configurarPlaButton = document.querySelector(".configurar-pla-button");

    // Verificar si el clic fue fuera del side panel y no en los botones relacionados
    if (
        !sidePanel.contains(event.target) && // Clic fuera del side panel
        !closePanelButton.contains(event.target) && // No es el botón de cerrar
        !configurarPlaButton.contains(event.target) // No es el botón "Configurar pla"
    ) {
        sidePanel.classList.remove("open"); // Cerrar el side panel
    }
});


// Funció per verificar si un polígon està completament dins d'un altre polígon
function estaPoligonDins(polygonPrincipal, polygonObstacle) {
    const paths = polygonObstacle.getPaths();
    for (let i = 0; i < paths.getLength(); i++) {
        const path = paths.getAt(i);
        for (let j = 0; j < path.getLength(); j++) {
            if (!google.maps.geometry.poly.containsLocation(path.getAt(j), polygonPrincipal)) {
                return false; // Si algun punt no està dins, retorna false
            }
        }
    }
    return true; // Tots els punts estan dins
}

// Funció per iniciar la selecció d'obstacles
function iniciarSeleccioObstacle(map) {
    let selectedMarkers = []; // Marcadors seleccionats per a l'obstacle
    let selectedPolygon = null; // Polígon de l'obstacle actual

    // Eliminar qualsevol listener de clic existent
    if (window.clickListener) {
        google.maps.event.removeListener(window.clickListener);
    }

    // Funció per seleccionar punts de l'obstacle
    function seleccionarPuntObstacle(event) {
        // Verifica si el punto está dentro del polígono principal
        if (!google.maps.geometry.poly.containsLocation(event.latLng, window.selectedPolygon)) {
            alert("El punt ha d'estar dins del polígon principal.");
            return;
        }

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

        selectedMarkers.push(marker);

        marker.addListener("dragend", () => dibuixarPoligonObstacle());
        if (selectedMarkers.length >= 2) dibuixarPoligonObstacle();
    }

    // Funció per dibuixar el polígon de l'obstacle
    function dibuixarPoligonObstacle() {
        if (selectedPolygon) selectedPolygon.setMap(null); // Elimina el polígon anterior

        const coordinates = selectedMarkers.map((marker) => marker.getPosition());
        if (coordinates.length >= 3) coordinates.push(coordinates[0]); // Tanca el polígon

        selectedPolygon = new google.maps.Polygon({
            paths: coordinates,
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
            map: map,
        });

        if (coordinates.length >= 3) {
            // Verifica si l'obstacle està dins del polígon principal
            if (estaPoligonDins(window.selectedPolygon, selectedPolygon)) {
                calcularAreaObstacle(selectedPolygon);
            } else {
                alert("L'obstacle ha d'estar completament dins del polígon principal.");
                selectedPolygon.setMap(null); // Elimina l'obstacle si no està dins
                selectedMarkers.forEach((marker) => marker.setMap(null)); // Elimina els marcadors
                selectedMarkers = []; // Reinicia els marcadors
            }
        }
    }

    // Funció per calcular l'àrea de l'obstacle i restar-la de l'àrea principal
    function calcularAreaObstacle(polygon) {
        const areaLabel = document.getElementById("areaResult");
        if (!areaLabel || !polygon) return;

        const areaObstacle = google.maps.geometry.spherical.computeArea(polygon.getPath());
        const areaPrincipal = parseFloat(areaLabel.innerText.replace("Àrea: ", "").replace(" m²", ""));
        const novaAreaTotal = areaPrincipal - areaObstacle;

        areaLabel.innerText = `Àrea: ${novaAreaTotal.toFixed(2)} m²`;

        // Guardar l'àrea actualitzada a localStorage
        const edificiData = JSON.parse(localStorage.getItem("edificiData")) || {};
        edificiData.area = novaAreaTotal.toFixed(2);
        localStorage.setItem("edificiData", JSON.stringify(edificiData));

        // Actualitzar el nombre màxim de plaques amb l'àrea actualitzada
        const maxPlacas = calcularMaxPlacas(novaAreaTotal);
        actualizarSlider(maxPlacas);
    }

    // Afegir event listener per al clic al mapa
    window.clickListener = map.addListener("click", seleccionarPuntObstacle);

    // Retornem una funció per netejar l'estat si és necessari
    return () => {
        google.maps.event.removeListener(window.clickListener);
        selectedMarkers.forEach((marker) => marker.setMap(null));
        if (selectedPolygon) selectedPolygon.setMap(null);
    };
}

// Afegir event listener per al botó de nou obstacle
document.getElementById("nouObstacleButton").addEventListener("click", () => {
    const sidePanel = document.getElementById("sidePanel");
    sidePanel.classList.remove("open"); // Tanca el side panel

    // Obtenir el polígon principal
    const polygonPrincipal = window.selectedPolygon;

    if (!polygonPrincipal) {
        alert("Primer has de crear el polígon principal.");
        return;
    }

    
});