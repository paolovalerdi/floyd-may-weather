<?php 
include "weather_api.php";

$api = new WeatherApi;

$api->oneCall($_GET["amount"]);
?>
