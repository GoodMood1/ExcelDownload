<?php
namespace Core\Controllers;

abstract class Controller{

    protected static function redirect(string $path){
        header('Location: ' . $path);
        exit;
    }

    protected static function dump($data){
        echo '<pre>' . print_r($data, true) . '</pre>';
    }
    
}