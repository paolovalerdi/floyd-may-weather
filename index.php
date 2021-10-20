<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_Style.css">
    <title>Cliima</title>
</head>
<body>
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
    <button type="button" onClick="window.location.href='index2.php'">Predecir</button>
</form>

</body>
</html>