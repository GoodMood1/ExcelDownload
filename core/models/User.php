<?php
namespace Core\Models;

class User extends Model{
    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    protected static function getTable()
    {
        return 'users';
    }
}