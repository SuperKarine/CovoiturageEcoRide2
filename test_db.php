<?php
// test_db.php

// Définir les constantes manquantes
define('APP_ROOT', __DIR__); // Le dossier racine de votre projet
define('APP_ENV', '.env');   // Le nom de votre fichier de configuration

require_once 'vendor/autoload.php';

use App\Db\Mysql;

// Activez l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Test de connexion MySQL</h2>";

try {
    // 1. Test de la classe Mysql
    echo "1. Initialisation de Mysql...<br>";
    $mysql = Mysql::getInstance();
    
    // 2. Test de la connexion PDO
    echo "2. Tentative de connexion PDO...<br>";
    $pdo = $mysql->getPDO();
    echo "✅ Connexion PDO réussie!<br>";
    
    // 3. Test des tables
    echo "3. Vérification des tables...<br>";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(\PDO::FETCH_COLUMN);
    
    echo "Tables dans la base de données: <br>";
    foreach ($tables as $table) {
        echo "- " . $table . "<br>";
    }
    
    // 4. Vérification spécifique de votre table
    echo "4. Vérification de la table 'propose_trajet_chauffeurs'...<br>";
    if (in_array('propose_trajet_chauffeurs', $tables)) {
        echo "✅ Table 'propose_trajet_chauffeurs' existe<br>";
        
        // Comptez les lignes
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM propose_trajet_chauffeurs");
        $count = $stmt->fetch()['count'];
        echo "Nombre de trajets dans la table: " . $count . "<br>";
        
        // Affichez quelques données
        if ($count > 0) {
            echo "5. Données d'exemple:<br>";
            $stmt = $pdo->query("SELECT * FROM propose_trajet_chauffeurs LIMIT 3");
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            echo "<pre>";
            print_r($results);
            echo "</pre>";
        }
    } else {
        echo "❌ Table 'propose_trajet_chauffeurs' n'existe pas<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "<br>";
    
    // Affichez plus de détails pour le debugging
    echo "<h3>Détails de l'erreur:</h3>";
    echo "Fichier: " . $e->getFile() . "<br>";
    echo "Ligne: " . $e->getLine() . "<br>";
}