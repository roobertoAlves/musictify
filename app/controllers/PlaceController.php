<?php
require_once __DIR__ . '/../services/RadioBrowserService.php';
header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
$service = new RadioBrowserService();
if ($action === 'countries') {
    echo json_encode($service->getCountries());
} elseif ($action === 'cities' && isset($_GET['countrycode'])) {
    echo json_encode($service->getCities($_GET['countrycode']));
} elseif ($action === 'stations' && isset($_GET['countrycode'])) {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;
    echo json_encode($service->getStationsByCountry($_GET['countrycode'], $limit));
} elseif ($action === 'stationsByCity' && isset($_GET['countrycode']) && isset($_GET['city'])) {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;
    echo json_encode($service->getStationsByCity($_GET['countrycode'], $_GET['city'], $limit));
} elseif ($action === 'search' && isset($_GET['q'])) {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;
    echo json_encode($service->searchStations($_GET['q'], $limit));
} elseif ($action === 'station' && isset($_GET['uuid'])) {
    echo json_encode($service->getStation($_GET['uuid']));
} else {
    http_response_code(400);
    echo json_encode(['error'=>'Invalid action']);
}
