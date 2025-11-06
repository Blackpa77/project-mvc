<?php
// DEBUG sementara: menampilkan error (hapus/buang setelah fix)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load autoload & core (require dulu agar class tersedia)
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Router.php';

// Tes koneksi ke database (jika gagal, tampilkan pesan agar tidak muncul 502 kosong)
try {
    $db = Database::getInstance()->getConnection();
} catch (Exception $e) {
    // tampilkan pesan yang aman dan hentikan eksekusi
    echo "<h2>DB ERROR:</h2> " . htmlspecialchars($e->getMessage());
    exit;
}

// Inisialisasi router
$router = new Router();

// Definisikan rute
$router->get('/', 'HomeController@index');
$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->post('/users', 'UserController@store');

// Resolve -> jalankan routing
$router->resolve();
