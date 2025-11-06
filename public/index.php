<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/core/Router.php';

// Panggil router
$router = new Router();

// Tambahkan route (ubah sesuai project kamu)
$router->get('/', 'HomeController@index');
$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');

// Jalankan router
$router->resolve();
