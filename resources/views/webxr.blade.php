<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Google Places Autocomplete</title>
    <link rel="stylesheet" type="text/css" href="build\css\style2.css" />
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu3ReEUVEQANj_h1EAtfe4-zyarcb3X04&libraries=places"></script>
    <script defer src="build\js\index.js"></script>
  </head>
  <body>
    <h1>Predicciones de Autocompletado</h1>
    
    <input type="text" id="searchBox" placeholder="Escribe un lugar..." autocomplete="off" />
    <ul id="results"></ul>
    <p><span id="prediction"></span></p>
    
    <img
      class="powered-by-google"
      src="https://storage.googleapis.com/geo-devrel-public-buckets/powered_by_google_on_white.png"
      alt="Powered by Google"
    />
  </body>
</html>
