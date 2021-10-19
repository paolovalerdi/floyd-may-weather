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
    <input type="button" value="Actualizar" onclick="reload()">

    <?php 
        include "libs/weather_api.php";

        $api = new WeatherApi;

        $all = $api->getAllPredictions();

        $count = count($all);
        echo "<h1>$count Entradas</h1>"
    ?>
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