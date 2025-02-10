// Cargar y analizar la imagen con EXIF y OpenCV.js
import EXIF from 'exif-js';

async function processImage(file) {
    const img = new Image();
    img.src = URL.createObjectURL(file);
    img.onload = async () => {
        const exifData = await getExifData(file);
        const focalLength = exifData.FocalLength || 4.25; // En mm
        const sensorHeight = getSensorHeight(exifData.Model) || 4.8; // Estimado en mm

        const scale = calculateScale(focalLength, sensorHeight, img.height);
        detectFacade(img, scale);
    };
}

function getExifData(file) {
    return new Promise((resolve) => {
        EXIF.getData(file, function () {
            resolve(EXIF.getAllTags(this));
        });
    });
}

function getSensorHeight(model) {
    const sensorSizes = {
        'iPhone 12': 4.8,
        'Samsung Galaxy S21': 5.2
    };
    return sensorSizes[model] || 4.8;
}

function calculateScale(focalLength, sensorHeight, imageHeight) {
    const sensorToImageRatio = sensorHeight / imageHeight;
    return focalLength * sensorToImageRatio;
}

function detectFacade(img, scale) {
    cv.imread(img);
    let edges = new cv.Mat();
    cv.cvtColor(img, edges, cv.COLOR_RGBA2GRAY, 0);
    cv.Canny(edges, edges, 50, 150);
    
    let contours = new cv.MatVector();
    let hierarchy = new cv.Mat();
    cv.findContours(edges, contours, hierarchy, cv.RETR_EXTERNAL, cv.CHAIN_APPROX_SIMPLE);
    
    console.log(`Se encontraron ${contours.size()} contornos`);
    // Aquí se calcularían las dimensiones de la fachada
}

// Manejar la subida de archivos
document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Detiene la recarga de la página
    event.stopPropagation(); // Asegura que el evento no siga propagándose

    const file = document.getElementById('fileInput').files[0];
    if (file) {
        console.log("Imagen cargada, procesando...");
        processImage(file);
    } else {
        console.error("No se ha seleccionado ninguna imagen.");
        alert("Por favor, sube una imagen primero.");
    }
});

document.addEventListener('DOMContentLoaded', () => {
    cv['onRuntimeInitialized'] = () => {
        document.getElementById('status').innerText = "OpenCV.js está listo";
    };
});