const userId = window.userId;

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
    window.obstacleIdCounter = { value: 0 };

    // Crear el contador de IDs
    const obstacleIdCounter = { value: 0 };

    if(!localStorage.getItem(`user_${userId}_direccion`)) {
        const autocomplete = initAutocomplete(map);
        document.getElementById("buttonBuscar").addEventListener("click", () => geocodeAddress(map));
    } else {
        const savedAddress = localStorage.getItem(`user_${userId}_direccion`);
        document.getElementById("address").value = savedAddress;
        geocodeAddress(map);
    }
    
    const startSelectionButton = document.getElementById("startSelection");
    startSelectionButton.disabled = true;
    
    if (localStorage.getItem(`user_${userId}_polygon`)) {
        startSelectionButton.textContent = "Reiniciar selecció";
        iniciarSeleccio(map);
        
        cargarObstaculosDesdeLocalStorage(map).then(() => {
            // Asegurarnos de que el botón se crea incluso sin obstáculos
            crearBotonConfigurarPlaSiNoExiste();
            
            // Recuperar el tipus de panell del localStorage
            const savedPanelId = localStorage.getItem(`user_${userId}_panel_id`);
            if (savedPanelId) {
                const selectPanel = document.getElementById("panel_model");
                for (let i = 0; i < selectPanel.options.length; i++) {
                    if (selectPanel.options[i].value === savedPanelId) {
                        selectPanel.selectedIndex = i;
                        break;
                    }
                }
                selectPanel.dispatchEvent(new Event('change'));
            }
        });
    } else {
        startSelectionButton.textContent = "Seleccionar area";
    };

    
    
    document.getElementById("startSelection").addEventListener("click", () => {
        const button = document.getElementById("startSelection");
    
        if (button.textContent === "Reiniciar selecció") {
            button.textContent = "Seleccionar area"; 
            reiniciarEstado(map);
            const sidePanel = document.getElementById("sidePanel");
            sidePanel.classList.remove("open");
        } else {
            button.textContent = "Reiniciar selecció";
            iniciarSeleccio(map); 
        }
    });

    

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

function crearBotonConfigurarPlaSiNoExiste() {
    if (!document.querySelector(".configurar-pla-button")) {
        const areaLabel = document.getElementById("areaResult");
        if (areaLabel) {
            const configurarPlaButton = document.createElement("button");
            configurarPlaButton.innerText = "Configurar pla";
            configurarPlaButton.className = "configurar-pla-button";
            configurarPlaButton.addEventListener("click", () => {
                const sidePanel = document.getElementById("sidePanel");
                sidePanel.classList.add("open");
                guardarInclinacion();
                
                if (window.clickListener) {
                    google.maps.event.removeListener(window.clickListener);
                    window.clickListener = null;
                }

                // Rellenar el formulario con los datos guardados
                const edificiData = JSON.parse(localStorage.getItem(`user_${userId}_edificiData`));
                if (edificiData) {
                    document.getElementById("inclinacion").value = edificiData.inclinacion;
                    document.getElementById("area").value = edificiData.area;
                }
                guardarInclinacion();
            });

            areaLabel.insertAdjacentElement("afterend", configurarPlaButton);
        }
    }
}

function geocodeAddress(map) {
    const address = document.getElementById("address").value;
    localStorage.setItem(`user_${userId}_direccion`, address);
    
    if (address === "") {
        alert("Per favor, introduïu una adreça.");
        return;
    }
    
    const geocoder = new google.maps.Geocoder();
    
    geocoder.geocode({ address: address }, function (results, status) {
        if (status === "OK") {
            map.setCenter(results[0].geometry.location);
            crearMarcador(map, results[0].geometry.location);
            
            // Cambiar el mapa a modo satélite, desactivar etiquetas y hacer zoom
            map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
            map.setOptions({ styles: [{ featureType: "all", elementType: "labels", stylers: [{ visibility: "off" }] }] });
            map.setZoom(18);
            const mapOverlay = document.getElementById("mapOverlay");
            mapOverlay.classList.add("hidden");
            
            enableMapInteractions(map);
            // Habilitar el botón "Seleccionar área"
            document.getElementById("startSelection").disabled = false;
            document.getElementById("startSelection").classList.remove("hidden");
            getSolarData(results[0].geometry.location.lat(), results[0].geometry.location.lng());
            getMonthlySolarData(results[0].geometry.location.lat(), results[0].geometry.location.lng());
            
        } else {
            alert("No sa trobat la direcció, torna-ho a intentar.");
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
        localStorage.setItem(`user_${userId}_direccion`, address);

        

        // Obtener coordenadas
        const lat = place.geometry.location.lat();
        const lng = place.geometry.location.lng();

        map.setCenter(place.geometry.location);
        crearMarcador(map, place.geometry.location);

        // Cambiar el mapa a modo satélite y desactivar etiquetas
        map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
        map.setOptions({ styles: [{ featureType: "all", elementType: "labels", stylers: [{ visibility: "off" }] }] });
        map.setZoom(18);
        const mapOverlay = document.getElementById("mapOverlay");
        mapOverlay.classList.add("hidden");
        enableMapInteractions(map);
        
        // Llamar a getSolarData con las coordenadas
        getSolarData(lat, lng);
        getMonthlySolarData(lat, lng)

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
    const estacio = localStorage.getItem(`user_${userId}_estacionalidad`);

    // Calcular la inclinació segons l'estacionalitat
    
    const lat = latLng.lat();
    let inclinacion;
    
    if (estacio === 'Estiu') {
        inclinacion = lat - 10;  
    } else if (estacio === 'Hivern') {
        inclinacion = lat + 10;  
    } else if (estacio === 'any') {
        inclinacion = lat;
    } else {
        console.log('Estacionalitat no vàlida');
        inclinacion = lat;       
    }

    const edifici = {
        id: window.edificis ? window.edificis.length + 1 : 1,
        lat: lat,
        lng: latLng.lng(),
        inclinacion: inclinacion.toFixed(0),  // Arrodonim a 0 decimals
        area: areaValue, 
    };

    if (!window.edificis) {
        window.edificis = [];
    }
    window.edificis.push(edifici);

    localStorage.setItem(`user_${userId}_edificiData`, JSON.stringify(edifici));
}

// Comienza la selección de puntos
function iniciarSeleccio(map) {
    guardarOrientacion();
    
    // Intenta cargar marcadores guardados
    const savedPolygon = localStorage.getItem(`user_${userId}_polygon`);
    
    if (savedPolygon) {
        
        const parsedPolygon = JSON.parse(savedPolygon);
        window.selectedMarkers = [];
        
        // Recrear los marcadores desde el localStorage
        parsedPolygon.forEach(coord => {
            
            const latLng = new google.maps.LatLng(coord.lat, coord.lng);
            const marker = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 8,  // Un poco más grande
                    fillColor: "#4285F4",  // Azul de Google más profesional
                    fillOpacity: 0.9,
                    strokeColor: "#FFFFFF",  // Borde blanco para contraste
                    strokeWeight: 2,  // Borde más grueso
                    strokeOpacity: 1,
                    anchor: new google.maps.Point(0, 0)  // Mejor posicionamiento
                },
                draggable: true,
            });
            
            window.selectedMarkers.push(marker);
            marker.addListener("dragend", function() {
                dibuixarPoligon(map); // Solo se ejecuta si se mueve un marcador
            });
        });
        
        crearBotonConfigurarPlaSiNoExiste();
        
        // Dibujar el polígono si hay suficientes puntos
        if (window.selectedMarkers.length >= 2) {
            
            const coordinates = window.selectedMarkers.map(marker => marker.getPosition());
            
            window.selectedPolygon = new google.maps.Polygon({
                paths: coordinates,
                strokeColor: "#1E88E5",  // Azul más profesional
                strokeOpacity: 0.9,
                strokeWeight: 3,  // Línea un poco más gruesa
                fillColor: "#42A5F5",  // Azul más claro para el relleno
                fillOpacity: 0.3,  // Más transparente
                map: map,
                clickable: false,
                zIndex: 1,  // Para asegurar que esté encima de otros elementos
                strokeDashArray: [0, 0],  // Podrías usar [5, 5] para línea punteada si prefieres
                editable: false  // Asegurar que no sea editable si no lo necesitas
              });
            
            // Obtener el área desde localStorage en lugar de recalcularla
            const areaGuardada = localStorage.getItem(`user_${userId}_novaArea`);
            const areaLabel = document.getElementById("areaResult");
            
            if (areaGuardada) {
                console.log("loc")
                areaLabel.innerText = `Àrea: ${parseFloat(areaGuardada).toFixed(2)} m²`;
                
            } else {
                
                // Si no hay área guardada, calcularla (por si acaso)
                calcularArea(window.selectedPolygon);
            }
            
            // Configurar el botón "Configurar pla" sin recalcular
            if (!document.querySelector(".configurar-pla-button")) {
                const configurarPlaButton = document.createElement("button");
                configurarPlaButton.innerText = "Configurar pla";
                configurarPlaButton.className = "configurar-pla-button";
                configurarPlaButton.addEventListener("click", () => {
                    const sidePanel = document.getElementById("sidePanel");
                    sidePanel.classList.add("open");
                    guardarInclinacion();
                    
                    if (window.clickListener) {
                        google.maps.event.removeListener(window.clickListener);
                        window.clickListener = null;
                    }

                    // Rellenar el formulario con los datos guardados
                    const edificiData = JSON.parse(localStorage.getItem(`user_${userId}_edificiData`));
                    if (edificiData) {
                        document.getElementById("inclinacion").value = edificiData.inclinacion;
                        document.getElementById("area").value = edificiData.area;
                    }
                    guardarInclinacion();
                });

                areaLabel.insertAdjacentElement("afterend", configurarPlaButton);
            }
            
        }
        
    } else {
        // Si no hay polígono guardado, iniciar selección normal
        window.selectedMarkers = [];
        const clickListener = map.addListener("click", (event) => {
            seleccionarPunt(event, map);
        });
        window.clickListener = clickListener;
    }
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

    // Limpiar localStorage de los datos específicos de esta vista
    localStorage.removeItem(`user_${userId}_polygon`);
    localStorage.removeItem(`user_${userId}_obstacles`);
    localStorage.removeItem(`user_${userId}_novaArea`);
    localStorage.removeItem(`user_${userId}_edificiData`);
    localStorage.removeItem(`user_${userId}_placaCount`);
    localStorage.removeItem(`user_${userId}_panel_model`);
    localStorage.removeItem(`user_${userId}_panel_id`);
    localStorage.removeItem(`user_${userId}_panel_pot`);
    localStorage.removeItem(`user_${userId}_superficie`);
    localStorage.removeItem(`user_${userId}_maxPlacas`);
    localStorage.removeItem(`user_${userId}_orientacion`);

    // Reiniciar valores en el formulario
    document.getElementById("area").value = "";
    document.getElementById("placaCount").value = "0";
    document.getElementById("placaSlider").value = "0";
    actualizarEstiloSlider(document.getElementById("placaSlider"));
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
            scale: 8,  // Un poco más grande
            fillColor: "#4285F4",  // Azul de Google más profesional
            fillOpacity: 0.9,
            strokeColor: "#FFFFFF",  // Borde blanco para contraste
            strokeWeight: 2,  // Borde más grueso
            strokeOpacity: 1,
            anchor: new google.maps.Point(0, 0)  // Mejor posicionamiento
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

    guardarPoligonoEnLocalStorage();
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
    strokeColor: "#1E88E5",  // Azul más profesional
    strokeOpacity: 0.9,
    strokeWeight: 3,  // Línea un poco más gruesa
    fillColor: "#42A5F5",  // Azul más claro para el relleno
    fillOpacity: 0.3,  // Más transparente
    map: map,
    clickable: false,
    zIndex: 1,  // Para asegurar que esté encima de otros elementos
    strokeDashArray: [0, 0],  // Podrías usar [5, 5] para línea punteada si prefieres
    editable: false  // Asegurar que no sea editable si no lo necesitas
  });
  
  if (coordinates.length >= 3) {
    calcularArea(window.selectedPolygon);
  }
  
  guardarPoligonoEnLocalStorage();
}
 
// Función para calcular el número máximo de placas
function calcularMaxPlacas(areaTotal) {
    const selectPanel = document.getElementById('panel_model');
    const selectedOption = selectPanel.options[selectPanel.selectedIndex];
    const areaPlaca = parseFloat(selectedOption.getAttribute('data-surface'));
    localStorage.setItem(`user_${userId}_superficie`, areaPlaca)

    if (isNaN(areaPlaca) || areaPlaca <= 0) {
        console.error('No se ha seleccionado un panel válido o la superficie no está definida.');
        return 0;
    }

    return Math.floor(areaTotal / areaPlaca);
}

const orientacion = document.getElementById('orientacion');

function guardarOrientacion() {
    const selectedOption = orientacion.options[orientacion.selectedIndex];
    const orientacionValue = selectedOption.textContent.trim();
    localStorage.setItem(`user_${userId}_orientacion`, orientacionValue);
}
orientacion.addEventListener('change', guardarOrientacion);

let inclinacion = document.getElementById('inclinacion');

// Función que guarda el valor actual en localStorage
function guardarInclinacion() {
    const inclinacionValue = inclinacion.value;
    console.log(inclinacionValue)
    localStorage.setItem(`user_${userId}_inclinacion`, inclinacionValue);
}

// Escuchar cambios y actualizar
inclinacion.addEventListener('change', guardarInclinacion);

// Escuchar cambios en el select
const selectPanel = document.getElementById('panel_model');

selectPanel.addEventListener('change', function () {
    const selectedOption = selectPanel.options[selectPanel.selectedIndex];
    const panelModel = selectedOption.textContent.trim();
    const panelId = selectedOption.value;
    const potenciaMaxima = selectedOption.getAttribute('data-potencia-maxima')
    localStorage.setItem(`user_${userId}_panel_pot`, potenciaMaxima);
    localStorage.setItem(`user_${userId}_panel_model`, panelModel);
    localStorage.setItem(`user_${userId}_panel_id`, panelId);
    
    // Obtener el área total desde localStorage o desde la función calcularArea
    const edificiData = JSON.parse(localStorage.getItem(`user_${userId}_edificiData`)) || {};
    const areaTotal = parseFloat(edificiData.area);

    if (isNaN(areaTotal) || areaTotal <= 0) {
        console.error('No se ha calculado un área válida.');
        return;
    }

    // Calcular el número máximo de placas
    const maxPlacas = calcularMaxPlacas(areaTotal);
    localStorage.setItem(`user_${userId}_maxPlacas`, maxPlacas);

    // Actualizar el slider (si es necesario)
    actualizarSlider(maxPlacas);
});

// Función para calcular el área del polígono
function calcularArea(selectedPolygon) {
    const areaLabel = document.getElementById("areaResult");
    
    if (selectedPolygon) {
        const area = google.maps.geometry.spherical.computeArea(selectedPolygon.getPath());
        localStorage.setItem(`user_${userId}_novaArea`, area)
        areaLabel.innerText = `Àrea: ${area.toFixed(2)} m²`;
        
        // Obtener los datos existentes de edificiData
        const edificiData = JSON.parse(localStorage.getItem(`user_${userId}_edificiData`)) || {};
        
        // Actualizar solo la propiedad 'area' sin sobrescribir las demás
        edificiData.area = area.toFixed(2);

        // Guardar el objeto actualizado en localStorage
        localStorage.setItem(`user_${userId}_edificiData`, JSON.stringify(edificiData));
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
                guardarInclinacion();
                // Desactivar la selección de puntos
                if (window.clickListener) {
                    google.maps.event.removeListener(window.clickListener);
                    window.clickListener = null;
                }
                
                


                // Rellenar el formulario con los datos guardados
                const edificiData = JSON.parse(localStorage.getItem(`user_${userId}_edificiData`));
                if (edificiData) {
                    // Asignar el valor de inclinacion al campo del formulario
                    document.getElementById("inclinacion").value = edificiData.inclinacion;
                    document.getElementById("area").value = edificiData.area;
                }

                guardarInclinacion();
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

    // Cargar valor guardado o inicializar a 0
    const savedPlacaCount = localStorage.getItem(`user_${userId}_placaCount`) || 0;
    const initialValue = Math.min(parseInt(savedPlacaCount, 10), maxPlacas);

    // Establecer valores iniciales
    slider.value = initialValue;
    placaCount.value = initialValue;
    actualizarEstiloSlider(slider);
    actualitzarFonsSlider();

    // Actualizar el input cuando se mueve el slider
    slider.addEventListener("input", function() {
        placaCount.value = this.value;
        actualizarEstiloSlider(this);
        localStorage.setItem(`user_${userId}_placaCount`, this.value);
    });

    // Actualizar el slider cuando el input manual cambia
    placaCount.addEventListener("input", function() {
        const newValue = Math.min(Math.max(parseInt(this.value, 10), 0), parseInt(this.max, 10));
        this.value = newValue;
        slider.value = newValue;
        actualizarEstiloSlider(slider);
        localStorage.setItem(`user_${userId}_placaCount`, newValue);
    });

    // Manejar el evento 'change' para cuando se pierde el foco
    placaCount.addEventListener("change", function() {
        const newValue = Math.min(Math.max(parseInt(this.value, 10), 0), parseInt(this.max, 10));
        this.value = newValue;
        slider.value = newValue;
        actualizarEstiloSlider(slider);
        localStorage.setItem(`user_${userId}_placaCount`, newValue);
    });

    // Manejar la tecla Enter
    placaCount.addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            const newValue = Math.min(Math.max(parseInt(this.value, 10), 0), parseInt(this.max, 10));
            this.value = newValue;
            slider.value = newValue;
            actualizarEstiloSlider(slider);
            localStorage.setItem(`user_${userId}_placaCount`, newValue);
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
    const value = parseInt(slider.value) || 0;
    const max = parseInt(slider.max) || 1;
    const progress = (value / max) * 100 + "%"; // Calcular el porcentaje de progreso
    slider.style.background = `linear-gradient(to right, #49DBA3 ${progress}, #e0e0e0 ${progress})`; // Actualizar el fondo del slider
}

const slider = document.getElementById("placaSlider");
const placaCount = document.getElementById("placaCount");
let value = 0
// Funció per actualitzar el fons del slider
function actualitzarFonsSlider() {
    if (value === 0) {  
        slider.style.background = '#e0e0e0';   
    } else {
        slider.style.background = `linear-gradient(to right, #49DBA3 ${value}%, #e0e0e0 ${value}%)`;
    }
value = ((slider.value - slider.min) / (slider.max - slider.min)) * 100;
}

// Inicialitza el fons del slider al carregar la pàgina
window.addEventListener("load", function () {
    placaCount.innerText = slider.value;  
    actualitzarFonsSlider();  
});

// Actualitza el fons i el comptador quan es mou el slider
slider.addEventListener("input", function () {
    actualitzarFonsSlider();  
    placaCount.innerText = this.value;
});

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
            tancarPoligonButton.style.display = "none";
    
            const coordinates = window.currentObstacle.markers.map(marker => marker.getPosition());
            coordinates.push(coordinates[0]); // Cerrar el polígono
    
            const obstaclePolygon = new google.maps.Polygon({
                paths: coordinates,
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                map: map,
            });

            window.obstaclePolygons.push(obstaclePolygon);
            window.currentObstacle.polygons.push(obstaclePolygon);
    
            if (estaPoligonDins(window.selectedPolygon, obstaclePolygon)) {
                window.currentObstacle.polygons = [obstaclePolygon];
                
                // Calcular área
                const areaObstacle = google.maps.geometry.spherical.computeArea(
                    obstaclePolygon.getPath()
                );
                
                // Actualizar área principal
                const areaLabel = document.getElementById("areaResult");
                const areaPrincipal = parseFloat(areaLabel.innerText.replace("Àrea: ", "").replace(" m²", ""));
                const novaAreaTotal = areaPrincipal - areaObstacle;
                
                localStorage.setItem(`user_${userId}_novaArea`, novaAreaTotal);
                areaLabel.innerText = `Àrea: ${novaAreaTotal.toFixed(2)} m²`;
    
                // Actualizar datos del edificio
                const edificiData = JSON.parse(localStorage.getItem(`user_${userId}_edificiData`)) || {};
                edificiData.area = novaAreaTotal.toFixed(2);
                localStorage.setItem(`user_${userId}_edificiData`, JSON.stringify(edificiData));
    
                // Actualizar slider
                const maxPlacas = calcularMaxPlacas(novaAreaTotal);
                actualizarSlider(maxPlacas);
    
                // Añadir a la lista
                const obstaclesList = document.getElementById("obstaclesList");
                const obstacleItem = document.createElement("div");
                obstacleItem.className = "obstacle-item";
                obstacleItem.innerHTML = `
                    <div>Obstacle ${window.obstacles.length}</div>
                    <div>Àrea: ${areaObstacle.toFixed(2)} m²</div>
                    <span class="delete-obstacle" data-area="${areaObstacle}" 
                          data-id="${window.currentObstacle.id}">Eliminar</span>
                `;
                obstaclesList.appendChild(obstacleItem);
    
                // Guardar todos los obstáculos
                guardarObstaculosEnLocalStorage();
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

    

    // Afegir el listener per seleccionar punts
    window.clickListener = map.addListener("click", seleccionarPuntObstacle);

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

document.getElementById("obstaclesList").addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-obstacle")) {
        const obstacleItem = event.target.closest(".obstacle-item");
        const obstacleId = parseInt(event.target.getAttribute("data-id"));
        const areaObstacle = parseFloat(event.target.getAttribute("data-area"));

        // 1. Actualizar área total
        const areaLabel = document.getElementById("areaResult");
        const areaPrincipal = parseFloat(areaLabel.innerText.replace("Àrea: ", "").replace(" m²", ""));
        const novaAreaTotal = areaPrincipal + areaObstacle;
        localStorage.setItem(`user_${userId}_novaArea`, novaAreaTotal);
        areaLabel.innerText = `Àrea: ${novaAreaTotal.toFixed(2)} m²`;

        // Actualizar datos del edificio
        const edificiData = JSON.parse(localStorage.getItem(`user_${userId}_edificiData`)) || {};
        edificiData.area = novaAreaTotal.toFixed(2);
        localStorage.setItem(`user_${userId}_edificiData`, JSON.stringify(edificiData));

        // Actualizar slider
        const maxPlacas = calcularMaxPlacas(novaAreaTotal);
        actualizarSlider(maxPlacas);

        // 2. Buscar y eliminar el obstáculo
        const obstacleIndex = window.obstacles.findIndex(obstacle => obstacle.id === obstacleId);
        if (obstacleIndex !== -1) {
            const obstacle = window.obstacles[obstacleIndex];
            
            // Eliminar todos los elementos gráficos asociados
            eliminarElementosObstaculo(obstacle);
            
            // Eliminar de las listas globales
            window.obstacles.splice(obstacleIndex, 1);
            
            // Si es el obstáculo actual, limpiarlo
            if (window.currentObstacle && window.currentObstacle.id === obstacleId) {
                window.currentObstacle = null;
            }
        }

        // 3. Actualizar localStorage
        guardarObstaculosEnLocalStorage();

        // 4. Eliminar de la interfaz
        obstacleItem.remove();
    }
});

// Función auxiliar para eliminar todos los elementos de un obstáculo
function eliminarElementosObstaculo(obstacle) {
    // Eliminar marcadores
    if (obstacle.markers && obstacle.markers.length > 0) {
        obstacle.markers.forEach(marker => {
            if (marker && marker.setMap) {
                marker.setMap(null);
            }
            // Eliminar de obstacleMarkers si existe
            if (window.obstacleMarkers) {
                const markerIndex = window.obstacleMarkers.findIndex(m => m === marker);
                if (markerIndex !== -1) {
                    window.obstacleMarkers.splice(markerIndex, 1);
                }
            }
        });
    }

    // Eliminar polígonos
    if (obstacle.polygons && obstacle.polygons.length > 0) {
        obstacle.polygons.forEach(polygon => {
            if (polygon && polygon.setMap) {
                polygon.setMap(null);
            }
            // Eliminar de obstaclePolygons si existe
            if (window.obstaclePolygons) {
                const polygonIndex = window.obstaclePolygons.findIndex(p => p === polygon);
                if (polygonIndex !== -1) {
                    window.obstaclePolygons.splice(polygonIndex, 1);
                }
            }
        });
    }
}

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
        localStorage.setItem(`user_${userId}_placaCount`, cantidadPlacas);
    };
    
    // Configuramos los listeners
    placaCount.addEventListener('input', actualizarPlacas);
    slider.addEventListener('input', actualizarPlacas);

    // Mostramos el valor inicial
    actualizarPlacas();
}

async function getSolarData(lat, lon) {
    
    const url = `https://archive-api.open-meteo.com/v1/archive?latitude=${lat}&longitude=${lon}&start_date=2024-01-01&end_date=2024-12-31&daily=shortwave_radiation_sum&timezone=auto`;
  
    const response = await fetch(url);
    const data = await response.json();
    
    // Suma total en Joules (convertir a kWh)
    const annualRadiation_J = data.daily.shortwave_radiation_sum.reduce((a, b) => a + b, 0);
    const annualRadiation_kWh = (annualRadiation_J / 3.6).toFixed(2); 
    localStorage.setItem(`user_${userId}_radiacion`, annualRadiation_kWh);
  
    return annualRadiation_kWh;
}
  
async function getMonthlySolarData(lat, lon) {
    const months = [
        { name: "Enero", start: "2024-01-01", end: "2024-01-31" },
        { name: "Febrero", start: "2024-02-01", end: "2024-02-29" },
        { name: "Marzo", start: "2024-03-01", end: "2024-03-31" },
        { name: "Abril", start: "2024-04-01", end: "2024-04-30" },
        { name: "Mayo", start: "2024-05-01", end: "2024-05-31" },
        { name: "Junio", start: "2024-06-01", end: "2024-06-30" },
        { name: "Julio", start: "2024-07-01", end: "2024-07-31" },
        { name: "Agosto", start: "2024-08-01", end: "2024-08-31" },
        { name: "Septiembre", start: "2024-09-01", end: "2024-09-30" },
        { name: "Octubre", start: "2024-10-01", end: "2024-10-31" },
        { name: "Noviembre", start: "2024-11-01", end: "2024-11-30" },
        { name: "Diciembre", start: "2024-12-01", end: "2024-12-31" }
    ];

    // Intentar cargar datos existentes del localStorage
    let monthlyData = JSON.parse(localStorage.getItem(`user_${userId}_monthlyRadiation`)) || [];
    
    // Verificar si ya tenemos datos para estas coordenadas
    const storedCoords = JSON.parse(localStorage.getItem(`user_${userId}_radiationCoords`)) || {};
    if (storedCoords.lat === lat && storedCoords.lon === lon && monthlyData.length > 0) {
        return monthlyData;
    }

    // Si no hay datos o las coordenadas cambiaron, obtener nuevos
    monthlyData = [];

    for (const month of months) {
        const url = `https://archive-api.open-meteo.com/v1/archive?latitude=${lat}&longitude=${lon}&start_date=${month.start}&end_date=${month.end}&daily=shortwave_radiation_sum&timezone=auto`;
        
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            
            const data = await response.json();
            
            // Suma total en Joules (convertir a kWh)
            const monthlyRadiation_J = data.daily.shortwave_radiation_sum.reduce((a, b) => a + b, 0);
            const monthlyRadiation_kWh = (monthlyRadiation_J / 3.6).toFixed(2);
            
            monthlyData.push({
                month: month.name,
                radiation_kWh: parseFloat(monthlyRadiation_kWh) // Convertir a número
            });


        } catch (error) {
            monthlyData.push({
                month: month.name,
                radiation_kWh: null,
                error: error.message
            });
        }
    }

    // Guardar en localStorage
    localStorage.setItem(`user_${userId}_monthlyRadiation`, JSON.stringify(monthlyData));
    localStorage.setItem(`user_${userId}_radiationCoords`, JSON.stringify({ lat, lon }));
    
    return monthlyData;
}

function guardarPoligonoEnLocalStorage() {
    if (window.selectedMarkers && window.selectedMarkers.length > 0) {
        const coordsToSave = window.selectedMarkers.map(marker => {
            return {
                lat: marker.getPosition().lat(),
                lng: marker.getPosition().lng()
            };
        });
        localStorage.setItem(`user_${userId}_polygon`, JSON.stringify(coordsToSave));
    }
}


function guardarObstaculosEnLocalStorage() {
    const obstaclesToSave = window.obstacles.map(obstacle => {
        let areaObstacle = 0;
        if (obstacle.polygons.length > 0) {
            try {
                areaObstacle = google.maps.geometry.spherical.computeArea(
                    obstacle.polygons[0].getPath()
                );
            } catch (e) {
                console.error("Error calculando área:", e);
            }
        }
        
        return {
            id: obstacle.id,
            markers: obstacle.markers.map(marker => ({
                lat: marker.getPosition().lat(),
                lng: marker.getPosition().lng()
            })),
            area: areaObstacle
        };
    });
    
    localStorage.setItem(`user_${userId}_obstacles`, JSON.stringify(obstaclesToSave));
}

function cargarObstaculosDesdeLocalStorage(map) {
    return new Promise((resolve) => {
        const savedObstacles = localStorage.getItem(`user_${userId}_obstacles`);
        if (savedObstacles) {
            const parsedObstacles = JSON.parse(savedObstacles);
            
            // Reiniciar el contador de IDs
            const maxId = parsedObstacles.reduce((max, obstacle) => Math.max(max, obstacle.id), 0);
            window.obstacleIdCounter = { value: maxId + 1 };
            
            // Limpiar obstáculos existentes
            window.obstacles = [];
            document.getElementById("obstaclesList").innerHTML = "";
            
            // Recrear cada obstáculo
            parsedObstacles.forEach(obstacleData => {
                const obstacle = {
                    id: obstacleData.id,
                    markers: [],
                    polygons: []
                };
                
                // Crear marcadores
                obstacleData.markers.forEach(coord => {
                    const latLng = new google.maps.LatLng(coord.lat, coord.lng);
                    const marker = new google.maps.Marker({
                        position: latLng,
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
                    obstacle.markers.push(marker);
                });
                
                // Crear polígono si hay suficientes marcadores
                if (obstacle.markers.length >= 3) {
                    const coordinates = obstacle.markers.map(marker => marker.getPosition());
                    coordinates.push(coordinates[0]);
                    
                    const obstaclePolygon = new google.maps.Polygon({
                        paths: coordinates,
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "#FF0000",
                        fillOpacity: 0.35,
                        map: map,
                    });
                    obstacle.polygons.push(obstaclePolygon);
                }
                
                window.obstacles.push(obstacle);
                
                // Mostrar en la interfaz
                const obstaclesList = document.getElementById("obstaclesList");
                const obstacleItem = document.createElement("div");
                obstacleItem.className = "obstacle-item";
                obstacleItem.innerHTML = `
                    <div>Obstacle ${obstacle.id}</div>
                    <div>Àrea: ${obstacleData.area?.toFixed(2) || "0.00"} m²</div>
                    <span class="delete-obstacle" data-area="${obstacleData.area || 0}" 
                          data-id="${obstacle.id}">Eliminar</span>
                `;
                obstaclesList.appendChild(obstacleItem);
            });
        }
        resolve();
    });
}