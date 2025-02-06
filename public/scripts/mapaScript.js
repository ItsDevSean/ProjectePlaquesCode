 // Inicializar el canvas y el contexto WebGL
 const canvas = document.createElement("canvas");
 document.getElementById("ar-container").appendChild(canvas);
 const gl = canvas.getContext("webgl", { antialias: true, alpha: true, xrCompatible: true });

 if (!gl) {
     alert("No se pudo inicializar WebGL. Tu navegador puede no ser compatible.");
 }

 // Función para iniciar la sesión AR
 document.getElementById("start-ar").addEventListener("click", async () => {
     if (!navigator.xr) {
         alert("WebXR no está disponible en este dispositivo.");
         return;
     }

     try {
         // Verificar si la sesión AR es compatible
         const isSupported = await navigator.xr.isSessionSupported("immersive-ar");
         if (!isSupported) {
             alert("AR no está soportado en este dispositivo.");
             return;
         }

         // Solicitar la sesión AR con detección de imágenes
         const session = await navigator.xr.requestSession("immersive-ar", {
             requiredFeatures: ["image-tracking"]
         });

         // Cargar la imagen de referencia
         const image = new Image();
         image.src = "fachada.jpg"; // Ruta a tu imagen de fachada
         image.onload = async () => {
             const imageTrackable = await session.createImageTrackable(image, {
                 widthInMeters: 1.0 // Ancho físico de la imagen en metros
             });

             // Configurar el espacio de referencia
             const referenceSpace = await session.requestReferenceSpace("local");

             // Iniciar el bucle de renderizado
             session.requestAnimationFrame(onXRFrame);

             alert("Sesión AR iniciada correctamente. Escanea la imagen de la fachada.");
         };
     } catch (e) {
         alert("Error iniciando WebXR: " + e.message);
     }
 });

 // Función para manejar el bucle de renderizado
 function onXRFrame(time, frame) {
     const session = frame.session;
     const referenceSpace = session.renderState.baseLayer.session.referenceSpace;

     session.requestAnimationFrame(onXRFrame);

     const pose = frame.getViewerPose(referenceSpace);
     if (pose) {
         const glLayer = session.renderState.baseLayer;
         gl.bindFramebuffer(gl.FRAMEBUFFER, glLayer.framebuffer);

         // Limpiar el buffer
         gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);

         // Aquí puedes agregar lógica para renderizar objetos en AR
         // y calcular la altura basada en la posición de la imagen detectada.
     }
 }