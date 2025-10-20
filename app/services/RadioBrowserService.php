<?php
class RadioBrowserService {
    private $apiBase = 'https://de2.api.radio-browser.info'; // Pode ser randomizado
    private $agent = 'musictify/1.0';

    private function get($endpoint, $params = []) {
        $url = $this->apiBase . $endpoint;
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->agent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    // Lista de países disponíveis
    public function getCountries() {
        return $this->get('/json/countries');
    }

    // Lista de cidades por país
    public function getCities($countrycode) {
        return $this->get('/json/cities', ['countrycode' => $countrycode]);
    }

    // Lista de estações por país
    public function getStationsByCountry($countrycode, $limit = 50) {
        return $this->get('/json/stations/bycountrycodeexact/' . urlencode($countrycode), ['limit' => $limit]);
    }

    // Lista de estações por cidade
    public function getStationsByCity($countrycode, $city, $limit = 50) {
        return $this->get('/json/stations/bycountrycodeexact/' . urlencode($countrycode), ['name' => $city, 'limit' => $limit]);
    }

    // Busca estações por nome
    public function searchStations($query, $limit = 50) {
        return $this->get('/json/stations/search', ['name' => $query, 'limit' => $limit]);
    }

    // Detalhes de uma estação
    public function getStation($uuid) {
        return $this->get('/json/stations/byuuid/' . urlencode($uuid));
    }
}
