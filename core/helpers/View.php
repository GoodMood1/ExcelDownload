<?php
namespace Core\Helpers;

class View{

    public static function render(string $path, array $data = [], int $code = 200)
    {
        http_response_code($code);
        
        extract($data);
        unset($data);
        
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/' . $path . '.php';
        require_once __DIR__ . '/../views/template/footer.php';
    }


}