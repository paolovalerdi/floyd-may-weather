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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <script>
        function reload() {
            if ($("#amount").val()) {
                $.ajax({
                    url: `libs/admin_update.php?amount=${$("#amount").val()}`,
                    type: "GET",
                    success: function (_) { location.reload(); },
                });
            } else {
                alert("Ingresa un número");
            }
        }
    </script>
    <div class="weather-app-container">
        <div class="weather-admin-btn-container">
            <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cerrar sesión</button>            
        </div>
        <div class="weather-main-grid">
            <div>
                <h1 style="margin: 0;">Administrador</h1>
                <div class="p-3"></div>
                <div class="mb-3">
                    <label class="form-label">Cantidad a obtener</label>
                    <input type="number" id="amount" name="amount" class="form-control">
                </div>
                <button id="submit" class="btn btn-primary" onclick="reload()" >Obtener</button>
            </div>
            <div>
                <?php
                    include "libs/weather_api.php";
                    $api = new WeatherApi;
                    $predictions = $api->getAllPredictions();
                    $amount = count($predictions);
                    echo '
                        <div class="weather-predictions-title">
                            <h3 style="margin: 0;">'.$amount.' entradas</h3>
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
                ?>
            </div>
        </div>
    </div>
</body>

</html>