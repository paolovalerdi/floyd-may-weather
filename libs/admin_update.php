<?php 
include "weather_api.php";

$api = WeatherApi::create();

$api->oneCall($_GET["amount"]);
?>
