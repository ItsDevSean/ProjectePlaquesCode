<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$lat = $_GET['lat'] ?? null;
$lng = $_GET['lng'] ?? null;

if (!$lat || !$lng) {
    http_response_code(400);
    echo json_encode(['error' => 'Coordenades requerides']);
    exit;
}

$url = "https://re.jrc.ec.europa.eu/api/v5_2/PVcalc?" . http_build_query([
    'lat' => $lat,
    'lon' => $lng,
    'peakpower' => 1,
    'loss' => 0,
    'angle' => 35,
    'aspect' => 0,
    'outputformat' => 'json'
]);

$context = stream_context_create([
    'http' => ['ignore_errors' => true]
]);

$response = file_get_contents($url, false, $context);

if ($response === FALSE) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en obtenir dades de PVGIS']);
    exit;
}

echo $response;
?>