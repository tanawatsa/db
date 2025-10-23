<!DOCTYPE html>
<html>

    <head><title>sailors</title></head>
    
    <body>
        <p>sailors</p>
        <form method = "POST" action = "index.php">
            sid: <input type = "text" name = "sid" required><br>
            sname: <input type = "text" name = "sname" required><br>
            rating: <input type = "text" name = "rating" required><br>
            age: <input type = "text" name = "age" required><br>
            <input type = "submit" name = "submit" value = "Add Sailor">
        </form>
         <?php
         $servername = "localhost" ; 
         $username = "db25_016" ;
         $password = "db25_016" ;
         $dbname = "db25_016_Boat" ;

         $conn = new mysqli($servername, $username, $password); 
         $conn->select_db($dbname); 
         $sql = "select * from sailors";
         $result = $conn->query($sql) ;

            if(isset($_POST['submit'])){
                    $sid = $_POST['sid'] ;
                    $sname = $_POST['sname'] ;
                    $rating = $_POST['rating'] ;
                    $age = $_POST['age'] ;
                    $sql = "insert into sailors(sid, sname, rating, age) values($sid, '$sname', $rating, $age)" ;
                    $conn->query($sql);
                    header("Location: index.php"); 
                    exit;
                }

            if(isset($_GET['deleteid'])){
                $deletedid = $_GET['deleteid'] ;
                $sql = "delete from sailors where sid = $deletedid" ;
                if($conn->query($sql)){
                    echo "Record deleted successfully" ;
                    header("Location: index.php"); 
                    exit;
                }else{  
                    echo "Error deleting record: " . $conn->error ;
                }
            }
        ?>
        <table border = 1 >
            <tr><th>sid</th>
                <th>sname</th> 
                <th>rating</th>
                <th>age</th>
                <th>delete</th></tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>$row[sid]</td>
                          <td>$row[sname]</td>
                          <td>$row[rating]</td>
                          <td>$row[age]</td><td>
                          <a href='?deleteid=$row[sid]'>delete</a></td></tr>" ; 
            }
            $conn->close();
            ?>
        </table>
    </body>
</html>