<?php
echo "✅ PHP is running<br>";

try {
    $db = new PDO(
        "mysql:host=" . getenv('MYSQLHOST') .
        ";port=" . getenv('MYSQLPORT') .
        ";dbname=" . getenv('MYSQLDATABASE'),
        getenv('MYSQLUSER'),
        getenv('MYSQLPASSWORD')
    );
    echo "✅ Database connected successfully!";
} catch (Exception $e) {
    echo "❌ DB Connection failed: " . $e->getMessage();
}
