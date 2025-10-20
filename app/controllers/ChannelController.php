<?php
require_once __DIR__ . '/../services/RadioBrowserService.php';
header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
$service = new RadioBrowserService();

if ($action === 'list' && isset($_GET['countrycode'])) {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;
    echo json_encode($service->getStationsByCountry($_GET['countrycode'], $limit));
} elseif ($action === 'listByCity' && isset($_GET['countrycode']) && isset($_GET['city'])) {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;
    echo json_encode($service->getStationsByCity($_GET['countrycode'], $_GET['city'], $limit));
} elseif ($action === 'details' && isset($_GET['uuid'])) {
    echo json_encode($service->getStation($_GET['uuid']));
} elseif ($action === 'stream' && isset($_GET['uuid'])) {
    $station = $service->getStation($_GET['uuid']);
    if (is_array($station) && isset($station[0]['url'])) {
        echo json_encode(['streamUrl' => $station[0]['url']]);
    } else {
        http_response_code(404);
        echo json_encode(['error'=>'Stream not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error'=>'Invalid action']);
}
