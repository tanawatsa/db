<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$controller = $_POST['controller'] ?? $_GET['controller'] ?? 'pages';
$action     = $_POST['action']     ?? $_GET['action']     ?? 'home';

// whitelist
$controllers = [
  'pages'    => ['home', 'error'],
  'employee' => ['index', 'add' ,'edit' , 'delete'],
];

function call($controller, $action)
{

    $file = __DIR__ . "/controllers/{$controller}_controller.php";
    if (!file_exists($file)) {
       
        require_once __DIR__ . "/controllers/pages_controller.php";
        return;
    }
    require_once $file;

    switch ($controller) {
        case 'pages':
           
            $controller_obj = new PagesController();
            break;

        case 'employee':

            $controller_obj = new EmployeeController();
            require('models/employeeModel.php');
            break;

        default:
         require('controllers/pages_controller.php');
         (new PagesController())->error("Controller not found: {$controller}");
            return;
    }

    
    if (!method_exists($controller_obj, $action)) {
        require_once __DIR__ . "/controllers/pages_controller.php";
        (new PagesController())->error("Action not found: {$controller}::{$action}");
        return;
    }

   
    $controller_obj->{$action}();
}


if (array_key_exists($controller, $controllers) && in_array($action, $controllers[$controller], true)) {
    call($controller, $action);
} else {
    call('pages', 'error');
}
