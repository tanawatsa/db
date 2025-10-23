<?php class Employee {
    public $E_id, $O_id, $name, $officeplace;
    public function __construct($E_id, $O_id, $name, $officeplace = null) {
        $this->E_id = $E_id;
        $this->O_id = $O_id;
        $this->name = $name;
        $this->officeplace = $officeplace;
    }
    
    public static function getall() {
        require("connection_connect.php");
        $employeeList = [];
        $sql = "SELECT e.E_id , 
                       e.O_id, 
                       e.name, 
                       o.place 
                       FROM employee As e
                JOIN office AS o ON e.O_id = o.O_id";
        $result = $conn->query($sql);
        while ($myrow = $result->fetch_assoc()){
            $E_id = $myrow['E_id'];
            $O_id = $myrow['O_id'];     
            $name = $myrow['name'];
            $officeplace = $myrow['place'];
            $employeeList[] = new Employee($E_id, $O_id, $name, $officeplace);
        }
        $result->free();
        require("connection_close.php");
        return $employeeList;
    }

    public static function add( $employeeName, $OfficeName) {
    require 'connection_connect.php';

    $OfficeName = $conn->real_escape_string($OfficeName);
    $sqlOffice = "SELECT O_id FROM office WHERE place = '$OfficeName' LIMIT 1";
    $result = $conn->query($sqlOffice);

    if ($result && $row = $result->fetch_assoc()) {
        $O_id = $row['O_id'];
    } else {
        die("ไม่พบชื่อสำนักงาน: " . $OfficeName);
    }

    $sql = "INSERT INTO employee (O_id, name)
            VALUES ( '$O_id','$employeeName')";
    $conn->query($sql);
    
    require 'connection_close.php';
    }

    public static function search($keyword) {
    require('connection_connect.php');
    $list = [];
    $keyword = $conn->real_escape_string($keyword);

    $sql = "SELECT *
            FROM employee 
            WHERE employee.name LIKE '%$keyword%'
            ORDER BY employee.E_id ASC";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $list[] = new Employee(
            $row['E_id'],
            $row['O_id'],
            $row['name']
        );
    }

    require('connection_close.php');
    return $list;
    }

    public static function update($employeeId, $employeeName, $Officeplace) {
        require('connection_connect.php');

        $employeeId   = (int)$employeeId;  
        $employeeName = $conn->real_escape_string($employeeName);
        $Officeplace  = $conn->real_escape_string($Officeplace);

        $resCom = $conn->query("SELECT O_id FROM office WHERE place = '$Officeplace' LIMIT 1");
        if ($resCom && ($row = $resCom->fetch_assoc())) {
            $O_id = (int)$row['O_id'];
        } else {
            $O_id = 0;
        }

        $sql = "UPDATE employee
                SET name = '$employeeName',
                    O_id = $O_id
                WHERE E_id = $employeeId
                LIMIT 1";

        $ok = ($conn->query($sql) === true);

        require('connection_close.php');
        return $ok;
    }

    public static function getById($id) {
        require('connection_connect.php');
        $id = (int)$id;

        $sql = "SELECT *
                FROM employee
                WHERE E_id = $id
                LIMIT 1";

        $result = $conn->query($sql);
        $item = null;
        if ($result && ($row = $result->fetch_assoc())) {
            $item = new Employee(
                $row['E_id'],
                $row['O_id'],
                $row['name']
            );
        }

        if ($result) $result->free();
        require('connection_close.php');

        return $item; 
    }

    public static function delete($employeeId) {
        require("connection_connect.php");

        $query = "DELETE FROM employee WHERE E_id  = $employeeId";
        $conn->query($query);
       require("connection_close.php");
    }
}   
?>