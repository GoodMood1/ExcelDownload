<?php 
namespace Core\Models;

use Core\Exceptions\NotFoundException;
use Core\Services\Db;

abstract class Model{
    abstract protected static function getTable();

    public static function all()
    {
        $p = Db::getInstance();
        return $p->query('SELECT * FROM ' . static::getTable(), [], static::class);
    }

    public static function find($id)
    {
        $p = Db::getInstance();
        $result = $p->query('SELECT * FROM ' . static::getTable() . ' WHERE id=?', [$id], static::class);
        return  $result ? $result[0] : null;
    }

    public static function findOrFail($id)
    {
        $item = self::find($id);
        return $item;
    }

    public function save()
    {
        $db = Db::getInstance();
        $props = $this->getProperties();

        if($this->id){
            $propsUpdate = [];
            foreach($props as $p){
                $propsUpdate[] = $p . '=:' . $p;
            }
            $sql = 'UPDATE ' . static::getTable() . ' SET ' . join(', ', $propsUpdate) . ' WHERE id=:id';
        }
        else{
            unset( $props[array_search('id', $props)] );
            unset( $props[array_search('created_at', $props)] );

            $sql = 'INSERT INTO ' . static::getTable() . ' (' . implode(', ',  $props) . ') VALUES (:' . implode(', :', $props) . ')';
        }

        $data = [];
        foreach($props as $p){
            $data[$p] = $this->$p;
        }
        $db->query($sql, $data);
    }


    private function getProperties()
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        
        $props = [];
        foreach($properties as $p){
            $props[] = $p->name;
        }
        return $props;
    }
public static function findByColumn(string $columnName, $value){
$db = Db::getInstance();
$sql = 'SELECT * FROM ' . static::getTable() . ' WHERE ' . $columnName . '=?';
$result = $db->query($sql,[$value],static::class);
return $result===[] ? null : $result[0];
}

}