<?php 
include "prediction.php";

class Database {

    private $server = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "weather";
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->server, $this->user, $this->password, $this->dbName);
    }

    public function insert($value) {
        $temp = $value["temp"];
        $pressure = $value["wind_speed"];
        $humidity = $value["humidity"];
        $main = $value["weather"][0]["main"];
        $description =  $value["weather"][0]["description"];
        $icon = $value["weather"][0]["icon"];
        $query = "INSERT INTO predictions (temp, pressure, humidity, main, description, icon) VALUES (".$temp.", ".$pressure.", ".$humidity.", '".$main."', '".$description."', '".$icon."')";
        if ($this->conn->query($query) === TRUE) {
            echo "New record created successfully\n";
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function getWhere($statement) {
        $query = "SELECT * FROM predictions $statement";
        $result = $this->conn->query($query);
        $predictions = array();
        while($row = $result->fetch_assoc()) {
            array_push($predictions, new Prediction($row["temp"], $row["pressure"], $row["humidity"], $row["main"], $row["description"], $row["icon"]));
        }
        return $predictions;
    }
}
?>