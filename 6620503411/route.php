<?php
    $controllers = array('pages'=>['home','error']);
    //pages home
    function call($controller,$action){
        require("controllers/".$controller."_controller.php");
        switch($controller){
            case "pages" : $controller_obj = new PagesController();
            break;
        }
        $controller_obj->{$action}();
    }
    if(array_key_exists($controller,$controllers)){
        if(in_array($action,$controllers[$controller])){
            call($controller,$action);
        }else{
            call('pages','error');
        }
    }else{
        call('pages','error');
    }
?>