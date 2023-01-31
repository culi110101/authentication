<?php
    spl_autoload_register('customAutoLoader');
    function customAutoLoader($className){
        $path = "libraries/";
        $fullPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . $path . $className . ".php";
        if(file_exists($fullPath)){
            include_once $fullPath;
        }
    }
?>