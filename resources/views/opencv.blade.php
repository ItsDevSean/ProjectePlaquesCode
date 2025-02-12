<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Altura de Fachada</title>
    <script async src="https://docs.opencv.org/3.4/opencv.js"></script>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        #imageInput {
            margin-top: 20px;
        }
        #canvasOutput {
            margin-top: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="container">
                <h1>Calcular Altura de Fachada</h1>
                <input type="file" id="imageInput" accept="image/*">
                <canvas id="canvasOutput"></canvas>
                <div id="statusMessage"></div>
            </div>
        </x-slot>

    <script>
        let points = [];

        // Función para procesar la imagen
        function processImage(imgElement) {
            const canvas = document.getElementById('canvasOutput');
            const ctx = canvas.getContext('2d');

            // Establecer las dimensiones del canvas según la imagen
            canvas.width = imgElement.width;
            canvas.height = imgElement.height;

            // Dibujar la imagen en el canvas
            ctx.drawImage(imgElement, 0, 0);
        }

        // Función para manejar la carga de la imagen
        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = new Image();
                    imgElement.onload = function() {
                        processImage(imgElement);
                    };
                    imgElement.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert('Por favor selecciona una imagen válida');
            }
        }

        // Función para calcular la distancia entre dos puntos en píxeles
        function calculateDistance(p1, p2) {
            return Math.sqrt(Math.pow(p2.x - p1.x, 2) + Math.pow(p2.y - p1.y, 2));
        }

        // Función para calcular la dimensión de la fachada
        function calculateFacadeHeight() {
            if (points.length < 4) {
                alert("Por favor selecciona 4 puntos: dos para la referencia y dos para la fachada.");
                return;
            }

            // Distancia entre los puntos de referencia (en píxeles)
            const referenceDistance = calculateDistance(points[0], points[1]);

            // Distancia entre los puntos de la fachada (en píxeles)
            const facadeDistance = calculateDistance(points[2], points[3]);

            // Suponiendo que la distancia de referencia es conocida (por ejemplo, 2 metros en la vida real)
            const referenceRealDistance = 2; // Esto puede ser ajustado si se tiene una referencia real, por ejemplo

            // Calcular la escala (metros por píxel)
            const scale = referenceRealDistance / referenceDistance;

            // Calcular la altura de la fachada en metros
            const facadeHeight = facadeDistance * scale;

            alert("La altura de la fachada es: " + facadeHeight.toFixed(2) + " metros.");
        }

        // Función para manejar el clic en el canvas y seleccionar puntos
        function handleCanvasClick(event) {
            const rect = event.target.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            // Almacenar los puntos seleccionados
            if (points.length < 4) {
                points.push({ x, y });

                // Dibujar un círculo en el punto seleccionado
                const canvas = document.getElementById('canvasOutput');
                const ctx = canvas.getContext('2d');
                ctx.beginPath();
                ctx.arc(x, y, 5, 0, Math.PI * 2, false);
                ctx.fillStyle = points.length <= 2 ? 'blue' : 'red'; // Puntos de referencia en azul, puntos de la fachada en rojo
                ctx.fill();

                // Si ya hay 4 puntos, calcular la altura de la fachada
                if (points.length === 4) {
                    calculateFacadeHeight();
                }
            }
        }

        // Asignar el evento de clic al canvas para seleccionar puntos
        document.getElementById('canvasOutput').addEventListener('click', handleCanvasClick);

        // Asignar el evento de carga de imagen
        document.getElementById('imageInput').addEventListener('change', handleImageUpload);
    </script>
    </x-app-layout>
</body>
</html>
