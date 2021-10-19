<?php 
class Prediction {
    public $temp;
    public $pressure;
    public $humidity;
    public $main;
    public $description;
    public $icon;

    public function __construct($temp, $pressure, $humidity, $main, $description, $icon) {
        $this->temp = $temp;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
        $this->main = $main;
        $this->description = $description;
        $this->icon = $icon; 
    }
}

?>