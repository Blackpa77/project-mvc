<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h3>ENV CHECK</h3>";
echo "PORT = " . htmlspecialchars(getenv('PORT')) . "<br>";
echo "MYSQLHOST = " . htmlspecialchars(getenv('MYSQLHOST')) . "<br>";
echo "MYSQLUSER = " . htmlspecialchars(getenv('MYSQLUSER')) . "<br>";
echo "MYSQLDATABASE = " . htmlspecialchars(getenv('MYSQLDATABASE')) . "<br>";
echo "MYSQLPORT = " . htmlspecialchars(getenv('MYSQLPORT')) . "<br>";

echo "<h3>DB CONNECTION</h3>";
require_once __DIR__ . '/../app/core/Database.php';
try {
    $db = Database::getInstance()->getConnection();
    echo "DB connected OK";
} catch (Exception $e) {
    echo "DB ERROR: " . htmlspecialchars($e->getMessage());
}
