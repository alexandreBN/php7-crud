<?php

function includeClassIfExists($path, $className) {
    $location = $path . DIRECTORY_SEPARATOR . $className;
    if(file_exists($location)) {
        require_once($location);
    }
}

function includeClass($className) {
    $className .= ".php";
    includeClassIfExists("", $className);
}

spl_autoload_register("includeClass");
spl_autoload_register(function($className) {
    $className .= ".php";
    includeClassIfExists("Dao", $className);
    includeClassIfExists("Dao/User", $className);
    includeClassIfExists("Dao/Generic", $className);
    includeClassIfExists("Model", $className);
    includeClassIfExists("Configuration", $className);
    includeClassIfExists("Security", $className);
    includeClassIfExists("Message", $className);
});
