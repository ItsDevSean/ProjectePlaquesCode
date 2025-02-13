function init() {
    if (!google || !google.maps) {
      console.error("Google Maps API no se ha cargado correctamente.");
      return;
    }
  
    const autocompleteService = new google.maps.places.AutocompleteService();
    const placesService = new google.maps.places.PlacesService(document.createElement("div"));
    const input = document.getElementById("searchBox");
    const resultsElement = document.getElementById("results");
  
    input.addEventListener("input", () => {
      if (input.value.length < 3) return; // Espera al menos 3 caracteres
  
      const request = {
        input: input.value,
        types: ["establishment"],
        language: "es",
      };
  
      autocompleteService.getPlacePredictions(request, (predictions, status) => {
        resultsElement.innerHTML = ""; // Limpiar resultados anteriores
  
        if (status !== google.maps.places.PlacesServiceStatus.OK || !predictions) {
          console.error("Error obteniendo predicciones:", status);
          return;
        }
  
        predictions.forEach((prediction) => {
          const listItem = document.createElement("li");
          listItem.textContent = prediction.description;
          listItem.onclick = () => getPlaceDetails(prediction.place_id, placesService);
          resultsElement.appendChild(listItem);
        });
      });
    });
  }
  
  function getPlaceDetails(placeId, placesService) {
    placesService.getDetails(
      { placeId: placeId, fields: ["name", "formatted_address"] },
      (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          document.getElementById("prediction").textContent =
            `Lugar seleccionado: ${place.name}, ${place.formatted_address}`;
        } else {
          console.error("Error obteniendo detalles del lugar:", status);
        }
      }
    );
  }
  
  window.onload = init;
  