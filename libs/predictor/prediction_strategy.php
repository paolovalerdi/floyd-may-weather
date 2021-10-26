<?php

include "libs/database.php";

abstract class PredictionStrategy {

    public abstract function compute($temp, $humidity, $pressure);
}


class LoosePredictionStrategy extends PredictionStrategy {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function compute($temp, $humidity, $pressure) {
        $tempA = $temp - 10;
        $tempB = $temp + 10;
        $tempTween = "BETWEEN $tempA AND $tempB";

        $humidityA = $humidity - 10;
        $humidityB = $humidity + 10;
        $humTween = "BETWEEN $humidityA AND $humidityB";

        $pressureA = $pressure - 10;
        $pressureB = $pressure + 10;
        $pressureTween = "BETWEEN $pressureA AND $pressureB";

        return $this->database->getWhere("WHERE temp $tempTween OR humidity $humTween OR pressure $pressureTween LIMIT 24");
    }
}

class TightPredictionStrategy extends PredictionStrategy {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function compute($temp, $humidity, $pressure) {
        $tempA = $temp - 5;
        $tempB = $temp + 5;
        $tempTween = "BETWEEN $tempA AND $tempB";

        $humidityA = $humidity - 5;
        $humidityB = $humidity + 5;
        $humTween = "BETWEEN $humidityA AND $humidityB";

        $pressureA = $pressure - 5;
        $pressureB = $pressure + 5;
        $pressureTween = "BETWEEN $pressureA AND $pressureB";

        return $this->database->getWhere("WHERE temp $tempTween AND humidity $humTween AND pressure $pressureTween LIMIT 7");
    }
}


class PredictionStrategyFactory {

    public static function create($what) {
        $db = new Database;
        if ($what == "tight") {
            return new TightPredictionStrategy($db);
        }
        return new LoosePredictionStrategy($db);
    } 
}
?>