<?php
echo "<h2>🔍 Railway Health Check</h2>";

// --- PHP check ---
echo "<p>✅ PHP is running on version: " . phpversion() . "</p>";

// --- Show environment variables (Railway auto set these) ---
echo "<h3>🌍 Environment Variables</h3><pre>";
$envKeys = [
    'PORT', 'MYSQLHOST', 'MYSQLPORT', 'MYSQLUSER', 'MYSQLPASSWORD', 'MYSQLDATABASE'
];
foreach ($envKeys as $key) {
    $val = getenv($key);
    echo str_pad($key, 15) . " = " . ($val ? $val : "(not set)") . "\n";
}
echo "</pre>";

// --- Database connection test ---
echo "<h3>🧩 Database Connection</h3>";
try {
    $host = getenv('MYSQLHOST') ?: 'localhost';
    $port = getenv('MYSQLPORT') ?: '3306';
    $dbname = getenv('MYSQLDATABASE') ?: 'mvc_db';
    $user = getenv('MYSQLUSER') ?: 'root';
    $pass = getenv('MYSQLPASSWORD') ?: '';

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<p>✅ Successfully connected to database <strong>$dbname</strong> on <strong>$host:$port</strong></p>";

    // Optional: show sample tables
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    if ($tables) {
        echo "<p>📋 Tables found:</p><ul>";
        foreach ($tables as $t) echo "<li>$t</li>";
        echo "</ul>";
    } else {
        echo "<p>⚠️ Database connected but no tables found.</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Database connection failed:</p><pre>" . $e->getMessage() . "</pre>";
}

// --- Apache check ---
echo "<h3>🛰️ Apache Info</h3>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

echo "<hr><p>✅ Health check complete.</p>";
