<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Router.php';

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users', 'UserController@store');

$router->resolve();