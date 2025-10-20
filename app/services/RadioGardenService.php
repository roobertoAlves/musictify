<?php
class RadioGardenService {
    private $apiBase = 'https://radio.garden/api/ara/content';
    private function get($endpoint) {
        $url = $this->apiBase . $endpoint;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
    public function getPlaces() {
        $data = $this->get('/places');
        return isset($data['data']['list']) ? $data['data']['list'] : [];
    }
    public function getPlaceDetails($placeId) {
        $data = $this->get("/page/$placeId");
        return isset($data['data']) ? $data['data'] : [];
    }
    public function getChannelsByPlace($placeId) {
        $data = $this->get("/page/$placeId/channels");
        return isset($data['data']['list']) ? $data['data']['list'] : [];
    }
    public function getNearbyPlaces($lat, $lng) {
        $data = $this->get("/nearby/$lat,$lng");
        return isset($data['data']['list']) ? $data['data']['list'] : [];
    }
    public function getPopularChannelsByCountry($countryCode) {
        $data = $this->get("/popular/$countryCode");
        return isset($data['data']['list']) ? $data['data']['list'] : [];
    }
    public function getChannelDetails($channelId) {
        $data = $this->get("/channel/$channelId");
        return isset($data['data']) ? $data['data'] : [];
    }
    public function getChannelStream($channelId) {
        return [ 'streamUrl' => "https://radio.garden/api/ara/content/listen/$channelId/channel.mp3" ];
    }
    public function search($query) {
        $url = "https://radio.garden/api/search?q=" . urlencode($query);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
    public function geolocate() {
        $url = "https://radio.garden/api/geo";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
}
