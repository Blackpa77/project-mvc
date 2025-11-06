<?php
// === Load dependencies & core ===
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Router.php';

// === Tes koneksi ke database ===
try {
    $db = Database::getInstance()->getConnection();
} catch (Exception $e) {
    echo "<h2>DB ERROR:</h2> " . htmlspecialchars($e->getMessage());
    exit; // hentikan eksekusi jika database gagal
}

// === Inisialisasi router ===
$router = new Router();

// === Definisikan rute ===
$router->get('/', 'HomeController@index');
$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users', 'UserController@store');

// === Jalankan router ===
$router->resolve();
