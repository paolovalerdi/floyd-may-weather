<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_Style.css">
    <title>Document</title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        function reload() {
            $.ajax({
                url: "libs/admin_update.php",
                type: "GET",
                success: function (_) {location.reload();},
            })
            
        }
    </script>

    <?php 
        include "libs/weather_api.php";

        $api = new WeatherApi;

        $all = $api->getPrediction();

        echo "<h1>Clima</h1>";
    ?>

        <form method="POST">
            <label>Tiempo:</label>
            <input type="text" id="tiempo" placeholder="soleado/numblado">
            </br></br>
            <label>Temperatura:</label>
            <input type="number" id="temp" placeholder="ejemplo 35 °C"> °C</input>
            </br></br>
            <label>Humedad:</label>
            <input type="number" id="humedad" placeholder="ejemplo 25%"> %</input>
            <br><br>
            <label>Presion:</label>
            <input type="number" id="presion" placeholder="ejemplo 1013">
            <br><br>
            <button type="submit" onclick="reload()">Predecir</button>
        </form>


    <div class="wrapper">
        <?php 
            foreach ($all as $value) {
                $icon = $value->icon;
                $imageUrl = "http://openweathermap.org/img/wn/$icon@2x.png";
                echo '
                    <div class="card">
                        <div class="header">
                            <span>'.$value->description.'</span>
                            <img src='.$imageUrl.'>
                        </div>
                        <div class="footer">
                            <span>Temperatura: '.$value->temp.'°C</span>
                            <span>Humedad: '.$value->humidity.'</span>
                            <span>Presión: '.$value->pressure.'</span>
                        </div> 
                    </div>
                ';
            }
        ?>
    </div>
</body>
</html>