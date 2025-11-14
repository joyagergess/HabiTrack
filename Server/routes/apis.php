<?php

$apis = [
    
    '/users'           => ['controller' => 'UserController', 'method' => 'getUsers', 'type' => 'GET'],
    '/user'            => ['controller' => 'UserController', 'method' => 'getUserByID', 'type' => 'GET'],
    '/user/create'     => ['controller' => 'UserController', 'method' => 'createUser', 'type' => 'POST'],
    '/user/update'     => ['controller' => 'UserController', 'method' => 'updateUser', 'type' => 'PUT'],
    '/user/delete'     => ['controller' => 'UserController', 'method' => 'deleteUser', 'type' => 'DELETE'],

 
    '/habits'          => ['controller' => 'HabitController', 'method' => 'getAll', 'type' => 'GET'],
    '/habit'           => ['controller' => 'HabitController', 'method' => 'getOne', 'type' => 'GET'],
    '/habit/create'    => ['controller' => 'HabitController', 'method' => 'create', 'type' => 'POST'],
    '/habit/update'    => ['controller' => 'HabitController', 'method' => 'update', 'type' => 'PUT'],
    '/habit/delete'    => ['controller' => 'HabitController', 'method' => 'delete', 'type' => 'DELETE'],

    '/entries'         => ['controller' => 'EntryController', 'method' => 'getAll', 'type' => 'GET'],
    '/entry'           => ['controller' => 'EntryController', 'method' => 'getOne', 'type' => 'GET'],
    '/entry/create'    => ['controller' => 'EntryController', 'method' => 'create', 'type' => 'POST'],
    '/entry/update'    => ['controller' => 'EntryController', 'method' => 'update', 'type' => 'PUT'],
    '/entry/delete'    => ['controller' => 'EntryController', 'method' => 'delete', 'type' => 'DELETE'],
    
];
