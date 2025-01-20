<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Socio</title>
    <script>
        function activarNumeroSocio() {
            var numeroSocioInput = document.getElementById("numero-socio"); // Obtenemos el input de 'numero-socio' por ID
            var labelNumeroSocio = document.getElementById("label-numero-socio"); // Obtenemos la etiqueta de 'numero-socio'

            // Si el radio button de "Sí" está seleccionado, mostramos el campo de número de socio
            if (document.getElementById("si-socio").checked) {
                numeroSocioInput.style.display = "inline"; // Muestra campo
                labelNumeroSocio.style.display = "inline"; // Muestra etiqueta
                numeroSocioInput.disabled = false; // Activa campo
            } else {
                numeroSocioInput.style.display = "none"; // Oculta campo
                labelNumeroSocio.style.display = "none"; // Oculta etiqueta
                numeroSocioInput.disabled = true; // Desactiva campo
                numeroSocioInput.value = ''; // Limpia el valor campo
            }
        }
    </script>
</head>
<body>

    <form method="POST" action="procesar_formulario.php">
        <label>¿Eres socio?</label><br>
        <input type="radio" id="no-socio" name="socio" value="No" onclick="activarNumeroSocio()" checked> No
        <input type="radio" id="si-socio" name="socio" value="Sí" onclick="activarNumeroSocio()"> Sí
        <input type="radio" id="quiero-serlo" name="socio" value="Quiero serlo" onclick="activarNumeroSocio()"> Quiero serlo
        <br><br>

        <label for="numero-socio" id="label-numero-socio">Número de socio:</label>
        <input type="text" id="numero-socio" name="numero-socio" disabled><br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php
    // Procesar los datos en PHP cuando se envíen
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $socio = $_POST['socio'];  // Obtenemos el valor del campo 'socio' enviado por POST
        $numeroSocio = isset($_POST['numero-socio']) ? $_POST['numero-socio'] : null;  // Asignamos número de socio si existe, o null si no
        echo "<h3>Resultado de la encuesta</h3>";  
        echo "Eres socio: " . $socio . "<br>";  
        if ($socio == "Sí" && !empty($numeroSocio)) {  // Si es socio y ha puesto número de socio
            echo "Tu número de socio es: " . htmlspecialchars($numeroSocio) . "<br>";  
        } elseif ($socio == "Sí") {  // Si no ha puesto número de socio
            echo "No has proporcionado un número de socio. <br>";  
        }
    }
    ?>

</body>
</html>
