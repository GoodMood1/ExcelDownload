<?php
namespace Core\Controllers;

use Core\Helpers\View;
use Core\Models\User;
use InvalidArgumentException;

class UserController extends Controller{

    public function index()
    {  
        $users = User::all();
        View::render('users/index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        View::render('users/edit', compact('user'));
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->save();
        self::redirect('/users');
    }

    public function create()
    {
        $user = new User();
        View::render('users/create', compact('user'));
    }

    public function store()
    {
        try{
            $name = trim($_POST['name'] ?? '');
        if(empty($name)){
throw new InvalidArgumentException('Name is necessary');
        }
     if(empty($_POST['email'])){
            throw new InvalidArgumentException('Email is necessary');
        }
      if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException('Email is incorrect');  
        }
        if(User::findByColumn('email',$_POST['email'])){
            throw new InvalidArgumentException('User with this email is already exists');  
        }
     if(empty($_POST['password'])){
             throw new InvalidArgumentException('Password is necessary');
        }

        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $user->save();
        self::redirect('/users');
    }
    catch(InvalidArgumentException $e){
$user = new User();
$error = $e->getMessage();
View::render('users/create',compact('user','error'));
    }
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        self::redirect('/users');
    }
    public function signIn(){
        View::render('users/sign-in');
    }
public function signInCheck(){
try{
    if(empty($_POST['email'])){
        throw new InvalidArgumentException('Email is necessary');
    }
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        throw new InvalidArgumentException('Email is incorrect');  
    }
 if(empty($_POST['password'])){
         throw new InvalidArgumentException('Password is necessary');
    }
    $user = User::findByColumn('email',$_POST['email']);
if(!$user){
    throw new InvalidArgumentException('User is not found');
}
if(!password_verify($_POST['password'],$user->password)){
    throw new InvalidArgumentException('Password invalid');
}
$_SESSION['user']=$user->name;
self::redirect('/');
}
catch(InvalidArgumentException $e){
$error = $e->getMessage();
View::render('users/sign-in',compact('error'));
}

}
}