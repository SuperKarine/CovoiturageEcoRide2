<?php
// Script de test de configuration
echo "=== TEST CONFIGURATION MYSQL ===\n";

// Définir les constantes comme dans votre index.php
define('APP_ROOT', dirname(__DIR__));
define('APP_ENV', '.env');

echo "APP_ROOT: " . APP_ROOT . "\n";
echo "APP_ENV: " . APP_ENV . "\n";

// Vérifier si le fichier .env existe
$envPath = APP_ROOT . "/" . APP_ENV;
echo "Chemin .env: " . $envPath . "\n";
echo ".env existe: " . (file_exists($envPath) ? "OUI" : "NON") . "\n";

if (file_exists($envPath)) {
    echo "Contenu de .env:\n";
    echo file_get_contents($envPath) . "\n";
}

// Tester la connexion MySQL directement
require_once __DIR__ . "/vendor/autoload.php";

use App\Db\Mysql;

try {
    echo "Test de connexion MySQL...\n";
    $mysql = Mysql::getInstance();
    $pdo = $mysql->getPDO();
    echo "✅ Connexion MySQL reussie!\n";
    
    // Tester si la table utilisateurs existe
    $tables = $pdo->query("SHOW TABLES LIKE 'utilisateurs'")->fetch();
    if ($tables) {
        echo "✅ Table 'utilisateurs' existe\n";
    } else {
        echo "❌ Table 'utilisateurs' n'existe pas\n";
    }
} catch (Exception $e) {
    echo "❌ Erreur MySQL: " . $e->getMessage() . "\n";
}

echo "=== FIN TEST ===\n";
