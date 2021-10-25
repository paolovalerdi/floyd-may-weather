<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>

    <link rel="stylesheet" href="styles.css">

    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="weather-app-container">
        <div class="weather-login-btn-container">
            <button class="btn btn-primary" onclick="window.location.href='login.html'">Iniciar sesión</button>
        </div>
        <div class="weather-main-grid">
            <div>
                <form method="GET" action="index.php">
                    <h1 style="margin: 0;">Predictor de clima</h1>
                    <div class="p-3"></div>
                    <div class="mb-3">
                        <label class="form-label">Temperatura</label>
                        <input type="number" id="temp" name="temp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Humedad</label>
                        <input type="number" id="hudimity" name="humidity" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Presión</label>
                        <input type="number" id="pressure" name="pressure" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Generar</button>
                </form>
            </div>
            <div>
                <?php
                    if (isset($_GET["temp"]) && isset($_GET["humidity"]) && isset($_GET["pressure"])) {
                        include "libs/weather_api.php";
                        $api = new WeatherApi;
                        $predictions = $api->getPrediction();
                        $amount = count($predictions);

                        echo '
                            <div class="weather-predictions-title">
                                <h3 style="margin: 0;">'.$amount.' predicciones generadas</h3>
                            </div>
                        ';

                        echo '<div class="p-3"></div>';
                        echo '<div class="weather-predictions-grid">';
                        foreach ($predictions as $element) {
                            $icon = $element->icon;
                            $imageUrl = "http://openweathermap.org/img/wn/$icon@2x.png";
                            echo '
                                <div class="card text-dark">
                                    <div class="card-body">
                                        <div class="weather-prediction-card-header">
                                            <h5 class="card-title">'.$element->description.'</h5>
                                            <img src="'.$imageUrl.'">
                                        </div>
                                        <p class="card-text">Temperatura: '.$element->temp.'</p>
                                        <p class="card-text">Humedad: '.$element->humidity.'</p>
                                        <p class="card-text">Presión: '.$element->pressure.'</p>
                                    </div>
                                </div>
                            ';
                        }
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>