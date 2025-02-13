let map;
      const edificis = []; // Array per emmagatzemar les coordenades dels edificis

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

          // Crear un marcador a la posició clicada
          const marcador = new google.maps.Marker({
            position: latLng,
            map: map,
            title: "Edifici",
          });

          // Afegir les coordenades de l'edifici a la llista
          edificis.push({
            lat: latLng.lat(),
            lng: latLng.lng(),
            nom: "Edifici" + (edificis.length + 1),
          });

          // Mostrar un missatge amb les coordenades
          alert(
            "Edifici seleccionat! Coordenades: " +
              latLng.lat() +
              ", " +
              latLng.lng()
          );

          // Obtenir dades de l'edifici
          obtenirDadesEdifici(latLng.lat(), latLng.lng());
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

        geocoder.geocode({ address: address }, function (results, status) {
          if (status === "OK") {
            // Centrar el mapa a la nova ubicació
            map.setCenter(results[0].geometry.location);
            // Col·locar un marcador a la ubicació
            const marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location,
              title: "Ubicació trobada",
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