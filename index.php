<?php
spl_autoload_register(function($class){
    require_once $class . '.php';
});
require_once "vendor/autoload.php";

Core\Helpers\Route::start();