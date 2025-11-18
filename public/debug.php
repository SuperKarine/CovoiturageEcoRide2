<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

echo "<h1>Debug Page</h1>";
echo "PHP Version: " . phpversion() . "<br>";

// Test autoloader
if (file_exists("/var/www/html/vendor/autoload.php")) {
    require_once "/var/www/html/vendor/autoload.php";
    echo "Autoloader: OK<br>";
} else {
    echo "Autoloader: MISSING at /var/www/html/vendor/autoload.php<br>";
}

// Test database connection
try {
    $pdo = new PDO("mysql:host=db;dbname=" . getenv("MYSQL_DATABASE"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"));
    echo "MySQL: OK<br>";
} catch (Exception $e) {
    echo "MySQL Error: " . $e->getMessage() . "<br>";
}

// Test MongoDB
try {
    $mongo = new MongoDB\Client("mongodb://" . getenv("MONGO_INITDB_ROOT_USERNAME") . ":" . getenv("MONGO_INITDB_ROOT_PASSWORD") . "@mongo:27017");
    echo "MongoDB: OK<br>";
} catch (Exception $e) {
    echo "MongoDB Error: " . $e->getMessage() . "<br>";
}

echo "Testing index.php inclusion...<br>";
// Test include index.php
try {
    include "/var/www/html/public/index.php";
    echo "index.php included successfully<br>";
} catch (Exception $e) {
    echo "Error including index.php: " . $e->getMessage() . "<br>";
}
