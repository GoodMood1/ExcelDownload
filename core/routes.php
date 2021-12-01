<?php
return [
    '/'         => ['HomeController', 'index'],
    'contacts'  => ['HomeController', 'contacts'],
    'send-mail' => ['HomeController', 'sendMail'],

    'users'                     => ['UserController', 'index'],
    'users/([0-9]+)'            => ['UserController', 'edit'],
    'users/([0-9]+)/update'     => ['UserController', 'update'],
    'users/create'              => ['UserController', 'create'],
    'users/store'               => ['UserController', 'store'],
    'sign-in'                   => ['UserController','signIn'],
    'sign-in-check'             => ['UserController','signInCheck'],
    'get-pdf'                   => ['HomeController','getPdf'],
    'get-excel'                 => ['HomeController','getExcel']
];
