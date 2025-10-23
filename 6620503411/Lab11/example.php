<!DOCTYPE html>
<html> 
<head><title>Boat</title></head>
<body>
    <p>Boat</p>
        <?php
         $servername = "localhost" ; 
         $username = "db25_016" ;
         $password = "db25_016" ;
         $dbname = "db25_016_Boat" ;

         $conn = new mysqli($servername, $username, $password); 
         if($conn->connect_error)
            { die("Connection failed: " . $conn->connect_error); }
         echo "Connected to server successfully <br>" ;
         $conn->select_db($dbname); 
         if(!$conn->select_db($dbname)){
            echo $conn->connect_error;
         }else{
            echo "Connected to db successfully <br>" ;
         }
         $sql = "select * from boats";
         $result = $conn->query($sql) ;
        ?>
        <table border = 1 >
            <tr><th>bid</th><th>bname</th><th>color</th></tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                echo "<tr><th>$row[bid]</th><th>$row[bname]</th><th>$row[color]</th></tr>" ; 
            }
            $conn->close();
            ?>
        </table>
</body>
</html>