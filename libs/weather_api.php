<?php

include "database.php";

class WeatherApi {

    private $baseUrl = "https://api.openweathermap.org/data/2.5/onecall?";
    private $database;

    public static function create() {
        return new WeatherApi(new Database);
    }

    public function __construct($database) {
        $this->database = $database;
    }

    public function oneCall($amount) {
        $lat = 19.0414;
        $lon = -98.2063;
        $path = $this->baseUrl."lat=".$lat."&lon=".$lon."&appid=e0fdbe97393951d095147320b6cbbf1e&lang=es&units=metric";
        $result = file_get_contents($path);
        $json = json_decode($result, true);
        $counter = 0;
        foreach ($json["hourly"] as $key => $value) {
            if ($counter < $amount) {
                $this->database->insert($value);
            }
            $counter++;
        }
    }
}
?>