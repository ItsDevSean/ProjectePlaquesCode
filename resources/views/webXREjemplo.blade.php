<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medir Altura con WebXR</title>

    <script type="importmap">
        {
            "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@0.128.0/build/three.module.js",
                "three/examples/jsm/": "https://cdn.jsdelivr.net/npm/three@0.128.0/examples/jsm/"
            }
        }
    </script>

    <script type="module">
        import * as THREE from 'three';
        import { XRControllerModelFactory } from 'three/examples/jsm/webxr/XRControllerModelFactory.js';
        import { XRHandModelFactory } from 'three/examples/jsm/webxr/XRHandModelFactory.js';

        let scene, camera, renderer;
        let controller, controllerGrip;
        let points = [];
        let line;
        let video, videoTexture;

        async function init() {
            // Configuramos la escena
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(70, window.innerWidth / window.innerHeight, 0.01, 100);

            // Crear un renderer y configurar su tamaño
            renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.xr.enabled = true;
            document.body.appendChild(renderer.domElement);

            // Verificamos si getUserMedia está disponible
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                try {
                    // Crear y configurar el video para usar como textura de fondo
                    video = document.createElement('video');
                    video.autoplay = true;
                    video.loop = true;
                    video.playsInline = true;

                    // Acceder a la cámara del dispositivo (cámara trasera)
                    const stream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: 'environment' }  // Cambié a 'environment' para usar la cámara trasera
                    });
                    video.srcObject = stream;
                    videoTexture = new THREE.VideoTexture(video);
                    videoTexture.minFilter = THREE.LinearFilter;
                    videoTexture.magFilter = THREE.LinearFilter;
                    videoTexture.format = THREE.RGBFormat;
                    video.play();  // Aseguramos que el video se reproduce correctamente
                } catch (error) {
                    console.error("Error al acceder a la cámara:", error);
                    alert("No se pudo acceder a la cámara. Asegúrate de que tienes los permisos necesarios.");
                }
            } else {
                alert("Tu navegador no soporta la API getUserMedia.");
            }

            // Crear un plano para mostrar el video como fondo
            const aspectRatio = window.innerWidth / window.innerHeight;  // Relación de aspecto de la pantalla
            const planeGeometry = new THREE.PlaneGeometry(aspectRatio * 2, 2);  // Hacer que el plano ocupe toda la pantalla
            const planeMaterial = new THREE.MeshBasicMaterial({
                map: videoTexture,
                side: THREE.DoubleSide,
                transparent: true
            });
            const plane = new THREE.Mesh(planeGeometry, planeMaterial);
            plane.position.z = -1;  // Colocar el plano un poco alejado de la cámara
            scene.add(plane);

            // Configuración del controlador y la luz
            controller = renderer.xr.getController(0);
            controller.addEventListener('selectstart', onSelect);
            scene.add(controller);

            controllerGrip = renderer.xr.getControllerGrip(0);
            scene.add(controllerGrip);

            const light = new THREE.HemisphereLight(0xffffff, 0xbbbbff, 1);
            scene.add(light);

            const ground = new THREE.GridHelper(10, 10);
            scene.add(ground);

            // Iniciar el ciclo de renderizado
            renderer.setAnimationLoop(() => {
                if (videoTexture) {
                    videoTexture.needsUpdate = true;  // Actualizar la textura en cada cuadro
                }
                renderer.render(scene, camera);
            });
        }

        function onSelect() {
            if (points.length < 2) {
                const point = controller.position.clone();
                points.push(point);
                addMarker(point);
            }

            if (points.length === 2) {
                drawLine();
                calculateDistance();
            }
        }

        function addMarker(position) {
            const geometry = new THREE.SphereGeometry(0.1, 16, 16); // Hacemos el marcador más visible
            const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 }); // Verde
            const marker = new THREE.Mesh(geometry, material);
            marker.position.copy(position);
            scene.add(marker);
        }

        function drawLine() {
            const material = new THREE.LineBasicMaterial({ color: 0x0000ff }); // Azul
            const geometry = new THREE.BufferGeometry().setFromPoints(points);

            if (line) scene.remove(line);
            line = new THREE.Line(geometry, material);
            scene.add(line);
        }

        function calculateDistance() {
            if (points.length === 2) {
                const distance = points[0].distanceTo(points[1]);
                alert(`Distancia medida: ${distance.toFixed(2)} metros`);
                displayDistance(distance);
            }
        }

        function displayDistance(distance) {
            const textGeometry = new THREE.TextGeometry(distance.toFixed(2) + ' m', {
                font: new THREE.FontLoader().load('https://threejs.org/examples/fonts/helvetiker_regular.typeface.json'),
                size: 0.5,
                height: 0.1
            });

            const textMaterial = new THREE.MeshBasicMaterial({ color: 0xffffff });
            const textMesh = new THREE.Mesh(textGeometry, textMaterial);
            textMesh.position.set((points[0].x + points[1].x) / 2, (points[0].y + points[1].y) / 2, (points[0].z + points[1].z) / 2);
            scene.add(textMesh);
        }

        document.getElementById('enter-ar').addEventListener('click', async () => {
            if (navigator.xr) {
                try {
                    // Cambié a 'inline' para que funcione sin inmersión immersive-ar 'local', 'hit-test'
                    const session = await navigator.xr.requestSession('inline', { requiredFeatures: ['local-floor'] });
                    renderer.xr.setSession(session);
                } catch (error) {
                    alert("No se pudo iniciar la sesión AR. Verifica que tu dispositivo y navegador soporten WebXR.");
                }
            } else {
                alert("Tu dispositivo no es compatible con WebXR.");
            }
        });

        init();
    </script>

</head>
<body>
    <button id="enter-ar">Iniciar RA</button>
</body>
</html>
