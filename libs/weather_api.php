<?php


class WeatherApi {
    private $baseUrl = "https://api.openweathermap.org/data/2.5/onecall?";
    private $private = 'Private';

    

    public function oneCall() {
        // ¯\_(ツ)_/¯
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($servername, $username, $password, "weather");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";

        $lat = 19.0414;
        $lon = -98.2063;
        $path = $this->baseUrl."lat=".$lat."&lon=".$lon."&appid=e0fdbe97393951d095147320b6cbbf1e&lang=es&units=metric";
        $result = file_get_contents($path);
        $json = json_decode($result, true);
        foreach ($json["hourly"] as $key => $value) {
            $temp = $value["temp"];
            $pressure = $value["pressure"];
            $humidity = $value["humidity"];
            $main = $value["weather"][0]["main"];
            $description =  $value["weather"][0]["description"];
            $icon = $value["weather"][0]["icon"];
            $query = "INSERT INTO predictions (temp, pressure, humidity, main, description, icon) VALUES (".$temp.", ".$pressure.", ".$humidity.", '".$main."', '".$description."', '".$icon."')";
            if ($conn->query($query) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
    }
}

$api = new WeatherApi;


$api->oneCall();

?>