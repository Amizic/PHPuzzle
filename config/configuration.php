<?php

// This is the autoloader function that will be called automatically by PHP
function myAutoloader($class) {

    // Construct the path to the class file based on its name from ROOT
    $path = __DIR__ . '/classes/' . $class . '.php';

    //IF CALLED FROM ROOT, HAS TO BE DIRECT PATH
    if (file_exists($path)) {
        require_once $path;
    //IF CALLED FROM SERVICES, HAS TO BE FROM ONE DIRECTORY UP
    } else {
        $path = '../classes/' . $class . '.php';
        if (file_exists($path)) {
            require_once $path;
        }else{
            echo "Class {$class} file not found on path $path.\n";
        }
    }
}

// Register the autoloader function
spl_autoload_register('myAutoloader');
