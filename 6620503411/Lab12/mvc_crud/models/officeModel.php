<?php class Office {
    public $O_id, $place;
    public function __construct($O_id,$place) {
        $this->O_id = $O_id;
        $this->place = $place;
    }
    public static function getall() {
        $officeList = [];
        require("connection_connect.php");
        $sql = "SELECT * FROM office";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $O_id = $row['O_id'];
            $place = $row['place'];
            $officeList[] = new Office($O_id,$place);
        }
        require("connection_close.php");
        return $officeList;
    }
}