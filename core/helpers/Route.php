<?php
namespace Core\Helpers;

use Core\Exceptions\NotFoundException;

abstract class Route{
    private static $url;

    public static function start()
    {
        try{
            self::$url = $_GET['page'] ?? '/';   // users/1
            $routes = require_once 'core/routes.php';

            $matches = [];
            foreach($routes as $patternStr=>$value){
                $reg = '~^' . $patternStr . '$~';   // ~^user/([0-9]+)$~
                if( preg_match($reg, self::$url, $matches) ){
                    break;
                }
            }


            if( count($matches) == 0 ){
               // die('Page not found');
               throw new NotFoundException();
            }

            list($controller, $method) = $routes[$patternStr];

            if(!file_exists("core/controllers/{$controller}.php")){
                die('Controller not found');
            }

            $nameController = "Core\\Controllers\\{$controller}";
            $objController = new $nameController();

            if( !method_exists($objController, $method) ){
                die('Method not Found');
            }

            unset( $matches[0] );
            $objController->$method(...$matches);
        }
        catch(\PDOException $e){
            echo $e->getMessage();
        }
        catch(NotFoundException $e){
            View::render('errors/404', [], 404);
        }
       
    }




    public static function getUrl(){
        return self::$url;
    }
}