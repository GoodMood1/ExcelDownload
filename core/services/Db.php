<?php
namespace Core\Services;

class Db{
    private $pdo;
    private static $instance = null;

    private function __construct()
    {
        extract( (require __DIR__.'/../../config.php')['db'] );
        $this->pdo = new \PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    }

    public function query(string $sql, array $params = [], string $class = 'StdClass')
    {
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($params);
        return $result === false ? null : $stmt->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public static function getInstance()
    {
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone(){}

}

