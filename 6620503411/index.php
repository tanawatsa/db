<?php
if(isset($_GET['controller'])&&isset($_GET['action'])){
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}else{
    $controller = 'pages';
    $action = 'home';
}
?>

<!DOCTYPE html>
<html>
    <head><title>MVC</title></head>
    <body>
        <?php
            echo "controller = $controller,action = $action <br>";
        ?>
        <?php
            echo require("route.php");
        ?>
</html>