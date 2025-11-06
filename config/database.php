<?php
// Railway menyediakan MySQL variables otomatis
return [
    'host' => getenv('MYSQLHOST'),
    'port' => getenv('MYSQLPORT') ?: 3306,
    'dbname' => getenv('MYSQLDATABASE'),
    'username' => getenv('MYSQLUSER'),
    'password' => getenv('MYSQLPASSWORD'),
    'charset' => 'utf8mb4'
];
