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



    map.setOptions({ draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true });


    // Inicialització de variables globals
    window.obstacles = []; 
    window.currentObstacle = null; 
    window.obstacleMarkers = [];
    window.obstaclePolygons = [];

    // Crear el contador de IDs
    const obstacleIdCounter = { value: 0 };

    const autocomplete = initAutocomplete(map);
    const startSelectionButton = document.getElementById("startSelection");
    startSelectionButton.disabled = true;
    document.getElementById("startSelection").addEventListener("click", () => {
        const button = document.getElementById("startSelection");
    
        if (button.textContent === "Reiniciar selecció") {
            button.textContent = "Seleccionar area"; // Torna a canviar el text del botó
            reiniciarEstado(map);
            const sidePanel = document.getElementById("sidePanel");
            sidePanel.classList.remove("open");
        } else {
            button.textContent = "Reiniciar selecció"; // Canvia el text del botó
            iniciarSeleccio(map); // Inicia la selecció d'una nova àrea
        }
    });

    document.getElementById("buttonBuscar").addEventListener("click", () => geocodeAddress(map));
    document.getElementById("nouObstacleButton").addEventListener("click", () => {
        const sidePanel = document.getElementById("sidePanel");
        sidePanel.classList.remove("open");

        const polygonPrincipal = window.selectedPolygon;

        if (!polygonPrincipal || polygonPrincipal.getPath().getLength() < 3) {
            alert("Primer has de crear el polígon principal amb almenys 3 punts.");
            return;
        }

        // Pasar el contador de IDs como parámetro
        iniciarSeleccioObstacle(map, obstacleIdCounter);
    });
};

// Funció per inicialitzar Autocomplete
function geocodeAddress(map) {
    const address = document.getElementById("address").value;
    localStorage.setItem('direccion', address);
  
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
  
            // Cambiar el mapa a modo satélite, desactivar etiquetas y hacer zoom
            map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
            map.setOptions({ styles: [{ featureType: "all", elementType: "labels", stylers: [{ visibility: "off" }] }] });
            map.setZoom(18);
            const mapOverlay = document.getElementById("mapOverlay");
            mapOverlay.classList.add("hidden");
            
            enableMapInteractions(map)
            // Habilitar el botón "Seleccionar área"
            document.getElementById("startSelection").disabled = false;
            document.getElementById("startSelection").classList.remove("hidden");
        } else {
            alert("No sa trobat la direcció, torna-ho a intentar.");
            console.log(results);
        }
    });
}
  
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
        
        const address = place.formatted_address;
        localStorage.setItem('direccion', address);

        console.log("Direcció seleccionada:", place.formatted_address);
        console.log("Latitud:", place.geometry.location.lat());
        console.log("Longitud:", place.geometry.location.lng());
  
        map.setCenter(place.geometry.location);
        crearMarcador(map, place.geometry.location);
  
        // Cambiar el mapa a modo satélite y desactivar etiquetas
        map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
        map.setOptions({ styles: [{ featureType: "all", elementType: "labels", stylers: [{ visibility: "off" }] }] });
        map.setZoom(18);
        const mapOverlay = document.getElementById("mapOverlay");
        mapOverlay.classList.add("hidden");
        enableMapInteractions(map)
        // Habilitar el botón "Seleccionar área"
        document.getElementById("startSelection").disabled = false;
        document.getElementById("startSelection").classList.remove("hidden");
      });
  
      return autocomplete;
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
      console.log(localStorage)  
}

// Comienza la selección de puntos
function iniciarSeleccio(map) {
  // Añade un nuevo evento de clic
  window.selectedMarkers = [];
  const clickListener = map.addListener("click", (event) => {
      seleccionarPunt(event, map);
  });

  // Guarda el listener para poder eliminarlo después
  window.clickListener = clickListener;
}

function reiniciarEstado(map) {
    // Elimina tots els marcadors seleccionats
    if (window.selectedMarkers) {
        window.selectedMarkers.forEach((marker) => marker.setMap(null));
    }

    // Elimina el polígon principal
    if (window.selectedPolygon) {
        window.selectedPolygon.setMap(null);
        window.selectedPolygon = null;
    }

    window.selectedMarkers = [];
    document.getElementById("areaResult").innerText = "";

    const configurarPlaButton = document.querySelector(".configurar-pla-button");
    if (configurarPlaButton) {
        configurarPlaButton.remove();
    }

    if (window.clickListener) {
        google.maps.event.removeListener(window.clickListener);
        window.clickListener = null;
    }

    // Elimina tots els obstacles i els seus marcadors
    if (window.obstaclePolygons) {
        window.obstaclePolygons.forEach((polygon) => polygon.setMap(null));
        window.obstaclePolygons = [];
    }

    if (window.obstacleMarkers) {
        window.obstacleMarkers.forEach((marker) => marker.setMap(null));
        window.obstacleMarkers = [];
    }

    if (window.obstacles) {
        window.obstacles.forEach((obstacle) => {
            if (obstacle.markers) {
                obstacle.markers.forEach((marker) => marker.setMap(null));
            }
            if (obstacle.polygons) {
                obstacle.polygons.forEach((polygon) => polygon.setMap(null));
            }
        });
        window.obstacles = [];
    }

    // Elimina l'obstacle actual si existeix i té marcadors
    if (window.currentObstacle && window.currentObstacle.markers) {
        window.currentObstacle.markers.forEach((marker) => marker.setMap(null));
    }

    // Reinicia les llistes
    window.currentObstacle = null;
    window.obstacleMarkers = [];
    window.obstaclePolygons = [];

    // Neteja la llista d'obstacles en el DOM
    const obstaclesList = document.getElementById("obstaclesList");
    if (obstaclesList) {
        obstaclesList.innerHTML = "";
    }

    // Elimina qualsevol marcador o polígon addicional
    if (window.marcadorExistente) {
        window.marcadorExistente.setMap(null);
        window.marcadorExistente = null;
    }

    if (window.edificis) {
        window.edificis = [];
    }

    localStorage.removeItem("edificiData");
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
    console.log(selectedMarkers.length)
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

const orientacion = document.getElementById('orientacion');
orientacion.addEventListener('change', function () {
    const selectedOption = orientacion.options[orientacion.selectedIndex];
    const orientacionValue = selectedOption.textContent.trim();
    localStorage.setItem('orientacion', orientacionValue);
    
});


const inclinacion = document.getElementById('inclinacion');
inclinacion.addEventListener('change', function () {
    const inclinacionValue = inclinacion.value;
    localStorage.setItem('inclinacion', inclinacionValue);
});


// Escuchar cambios en el select
const selectPanel = document.getElementById('panel_model');

selectPanel.addEventListener('change', function () {
    const selectedOption = selectPanel.options[selectPanel.selectedIndex];
    const panelModel = selectedOption.textContent.trim();
    localStorage.setItem('panel_model', panelModel);
    
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
        

        // Obtener los datos existentes de edificiData
        console.log(localStorage)
        const edificiData = JSON.parse(localStorage.getItem("edificiData")) || {};
        
        // Actualizar solo la propiedad 'area' sin sobrescribir las demás
        edificiData.area = area.toFixed(2);

        // Guardar el objeto actualizado en localStorage
        localStorage.setItem("edificiData", JSON.stringify(edificiData));
        console.log(localStorage);
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
                    // Asignar el valor de inclinacion al campo del formulario
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
    setupPlacaCountListener(placaCount, slider);  
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

function iniciarSeleccioObstacle(map, obstacleIdCounter) {
    // Crear un nou obstacle
    const obstacleId = obstacleIdCounter.value++; // Generar un ID único
    window.currentObstacle = {
        id: obstacleId, // Asignar el ID único
        markers: [], // Marcadors d'aquest obstacle
        polygons: [] // Polígons d'aquest obstacle
    };

    // Afegir l'obstacle actual a la llista global
    window.obstacles.push(window.currentObstacle);

    // Eliminar qualsevol listener anterior del botó "Tancar polígon"
    const tancarPoligonButton = document.getElementById("tancarPoligonButton");
    tancarPoligonButton.removeEventListener("click", tancarPoligonHandler);

    // Mostrar el botó "Tancar polígon"
    tancarPoligonButton.style.display = "block";

    // Afegir el nou listener al botó "Tancar polígon"
    tancarPoligonButton.addEventListener("click", tancarPoligonHandler);

    // Funció per gestionar el tancament del polígon
    function tancarPoligonHandler() {
        tancarPoligonButton.removeEventListener("click", tancarPoligonHandler);
        if (window.currentObstacle.markers.length >= 3) {
            // Desactivar el botó per evitar múltiples clics
            tancarPoligonButton.style.display = "none";
    
            // Crear el polígon de l'obstacle
            const coordinates = window.currentObstacle.markers.map((marker) => marker.getPosition());
            if (coordinates.length >= 3) coordinates.push(coordinates[0]);
    
            const obstaclePolygon = new google.maps.Polygon({
                paths: coordinates,
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                map: map,
            });
    
            // Verificar si el polígon està dins del polígon principal
            if (estaPoligonDins(window.selectedPolygon, obstaclePolygon)) {
                // Afegir el polígon a l'obstacle actual
                window.currentObstacle.polygons.push(obstaclePolygon);
    
                // Calcular l'àrea de l'obstacle
                const areaObstacle = google.maps.geometry.spherical.computeArea(obstaclePolygon.getPath());
    
                // Afegir l'obstacle a la llista visual (només un element)
                const obstaclesList = document.getElementById("obstaclesList");
                const obstacleItem = document.createElement("div");
                obstacleItem.className = "obstacle-item";
                obstacleItem.innerHTML = `
                    <div>Obstacle ${window.obstacles.length + 1}</div>
                    <div>Àrea: ${areaObstacle.toFixed(2)} m²</div>
                    <span class="delete-obstacle" data-area="${areaObstacle}" data-id="${obstacleId}">Eliminar</span>
                `;
                obstaclesList.appendChild(obstacleItem);
    
                // Afegir l'obstacle a la llista global
                window.obstacles.push(window.currentObstacle);
    
                // Actualitzar l'àrea total del polígon principal
                const areaLabel = document.getElementById("areaResult");
                const areaPrincipal = parseFloat(areaLabel.innerText.replace("Àrea: ", "").replace(" m²", ""));
                const novaAreaTotal = areaPrincipal - areaObstacle;
    
                areaLabel.innerText = `Àrea: ${novaAreaTotal.toFixed(2)} m²`;
    
                const edificiData = JSON.parse(localStorage.getItem("edificiData")) || {};
                edificiData.area = novaAreaTotal.toFixed(2);
                localStorage.setItem("edificiData", JSON.stringify(edificiData));
    
                const maxPlacas = calcularMaxPlacas(novaAreaTotal);
                actualizarSlider(maxPlacas);
    
                alert("Polígon tancat. No es poden afegir més punts a aquest obstacle.");
            } else {
                alert("L'obstacle ha d'estar completament dins del polígon principal.");
                obstaclePolygon.setMap(null);
            }
        } else {
            alert("Necessiteu almenys 3 punts per tancar el polígon.");
        }
    }

    // Funció per seleccionar punts de l'obstacle
    function seleccionarPuntObstacle(event) {
        if (!window.selectedPolygon) {
            alert("Primer has de crear el polígon principal.");
            return;
        }

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
            draggable: false,
        });

        // Afegir el marcador a l'obstacle actual
        window.currentObstacle.markers.push(marker);

        // Dibuixar el polígon de l'obstacle si hi ha suficients punts
        if (window.currentObstacle.markers.length >= 2) {
            dibuixarPoligonObstacle();
        }
    }

    // Funció per dibuixar el polígon de l'obstacle
    function dibuixarPoligonObstacle() {
        // Eliminar el polígon temporal anterior si existeix
        if (window.currentObstacle.polygons.length > 0) {
            window.currentObstacle.polygons[window.currentObstacle.polygons.length - 1].setMap(null);
        }

        const coordinates = window.currentObstacle.markers.map((marker) => marker.getPosition());
        if (coordinates.length >= 3) coordinates.push(coordinates[0]);

        // Crear un nou polígon temporal
        const tempPolygon = new google.maps.Polygon({
            paths: coordinates,
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35,
            map: map,
        });

        // Afegir el polígon temporal a l'obstacle actual
        window.currentObstacle.polygons.push(tempPolygon);
        
    }

    // Afegir el listener per seleccionar punts
    window.clickListener = map.addListener("click", seleccionarPuntObstacle);

}

document.getElementById("obstaclesList").addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-obstacle")) {
        const obstacleItem = event.target.closest(".obstacle-item");
        const obstacleId = parseInt(event.target.getAttribute("data-id")); // Obtener el ID del obstáculo
        const areaObstacle = parseFloat(event.target.getAttribute("data-area"));

        // Sumar el área del obstáculo al área total
        const areaLabel = document.getElementById("areaResult");
        const areaPrincipal = parseFloat(areaLabel.innerText.replace("Àrea: ", "").replace(" m²", ""));
        const novaAreaTotal = areaPrincipal + areaObstacle;

        areaLabel.innerText = `Àrea: ${novaAreaTotal.toFixed(2)} m²`;

        const edificiData = JSON.parse(localStorage.getItem("edificiData")) || {};
        edificiData.area = novaAreaTotal.toFixed(2);
        localStorage.setItem("edificiData", JSON.stringify(edificiData));

        const maxPlacas = calcularMaxPlacas(novaAreaTotal);
        actualizarSlider(maxPlacas);

        // Buscar el obstáculo por su ID
        const obstacleIndex = window.obstacles.findIndex(obstacle => obstacle.id === obstacleId);
        if (obstacleIndex !== -1) {
            const obstacle = window.obstacles[obstacleIndex];

            // Eliminar solo los marcadores y polígonos del obstáculo eliminado
            if (obstacle) {
                // Eliminar los marcadores del obstáculo
                if (obstacle.markers && obstacle.markers.length > 0) {
                    obstacle.markers.forEach(marker => marker.setMap(null));
                }

                // Eliminar los polígonos del obstáculo
                if (obstacle.polygons && obstacle.polygons.length > 0) {
                    obstacle.polygons.forEach(polygon => polygon.setMap(null));
                }

                // Eliminar el obstáculo de la lista global
                window.obstacles.splice(obstacleIndex, 1);
            }
        }

        // Eliminar el ítem del obstáculo de la lista visual
        obstacleItem.remove();
    }
});

function enableMapInteractions(map) {
    map.setOptions({ draggable: true, zoomControl: true, scrollwheel: true, disableDoubleClickZoom: false });
}



function setupPlacaCountListener(placaCount, slider) {
    // Variable que almacenará el número de placas
    let cantidadPlacas = 0;
    // Función que actualiza la variable y muestra en consola
    const actualizarPlacas = () => {
        // Usamos el valor del input manual si tiene contenido, sino del slider
        cantidadPlacas = placaCount.value || slider.value;
        console.log('Placas seleccionadas:', cantidadPlacas);
    };

    // Configuramos los listeners
    placaCount.addEventListener('input', actualizarPlacas);
    slider.addEventListener('input', actualizarPlacas);

    // Mostramos el valor inicial
    actualizarPlacas();
}
