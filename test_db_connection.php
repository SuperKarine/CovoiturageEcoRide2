<?php
// test_db_connection.php - Version complète corrigée

require_once __DIR__ . "/vendor/autoload.php";

// CORRECTION : APP_ROOT doit pointer vers le projet, pas son parent
define('APP_ROOT', __DIR__);  // Au lieu de dirname(__DIR__)
define('APP_ENV', ".env");

use App\Db\Mysql;

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head><title>Test Connexion DB</title></head>";
echo "<body style='font-family: Arial, sans-serif; padding: 20px;'>";
echo "<h1>🔧 Test de Connexion à la Base de Données</h1>";

try {
    // Test 1: Vérification du fichier .env
    echo "<h2>1. Vérification du fichier .env</h2>";
    
    $envPath = APP_ROOT . "/" . APP_ENV;
    echo "Chemin recherché: <code>$envPath</code><br>";
    
    if (!file_exists($envPath)) {
        throw new Exception("❌ Fichier .env NON TROUVÉ à cet emplacement");
    }
    echo "✅ Fichier .env TROUVÉ<br>";
    
    // Test 2: Lecture du fichier .env
    echo "<h2>2. Lecture du fichier .env</h2>";
    
    $dbConf = parse_ini_file($envPath);
    if ($dbConf === false) {
        throw new Exception("❌ Impossible de parser le fichier .env");
    }
    echo "✅ Fichier .env analysé avec succès<br>";
    
    echo "Contenu du .env:<br>";
    echo "<pre>";
    print_r($dbConf);
    echo "</pre>";
    
    // Test 3: Vérification des clés requises
    echo "<h2>3. Vérification des paramètres DB</h2>";
    
    $requiredKeys = ['db_host', 'db_user', 'db_password', 'db_port', 'db_name'];
    $missingKeys = [];
    
    foreach ($requiredKeys as $key) {
        if (!isset($dbConf[$key])) {
            $missingKeys[] = $key;
        }
    }
    
    if (!empty($missingKeys)) {
        throw new Exception("❌ Clés manquantes dans .env: " . implode(', ', $missingKeys));
    }
    echo "✅ Tous les paramètres DB sont présents<br>";
    
    // Test 4: Test de connexion PDO direct
    echo "<h2>4. Test de connexion directe avec PDO</h2>";
    
    // Utiliser les paramètres du .env (db_host=db pour Docker)
    $dsn = "mysql:host={$dbConf['db_host']};port={$dbConf['db_port']};dbname={$dbConf['db_name']};charset=utf8";
    $user = $dbConf['db_user'];
    $password = $dbConf['db_password'];
    
    echo "DSN: <code>$dsn</code><br>";
    echo "User: <code>$user</code><br>";
    echo "Password: <code>" . (empty($password) ? '(vide)' : '***') . "</code><br>";
    
    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo "✅ Connexion PDO directe RÉUSSIE!<br>";
        
        // Test de requête simple
        $stmt = $pdo->query("SELECT 1 as test");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "✅ Test de requête SQL réussi: " . $result['test'] . "<br>";
        
        $pdo = null; // Fermer la connexion
        
    } catch (PDOException $e) {
        throw new Exception("❌ Erreur PDO: " . $e->getMessage());
    }
    
    // Test 5: Test avec votre classe Mysql
    echo "<h2>5. Test avec votre classe Mysql</h2>";
    
    try {
        $mysql = Mysql::getInstance();
        echo "✅ Instance Mysql créée avec succès<br>";
        
        $pdo = $mysql->getPDO();
        echo "✅ PDO obtenu avec succès<br>";
        
        // Test de requête avec votre classe
        $stmt = $pdo->query("SELECT DATABASE() as db_name");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "✅ Base de données connectée: " . $result['db_name'] . "<br>";
        
        // Test supplémentaire : compter les trajets
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM propose_trajet_chauffeurs");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "✅ Nombre de trajets dans la table: " . $result['count'] . "<br>";
        
        echo "<h2 style='color: green;'>🎉 TOUS LES TESTS SONT RÉUSSIS! Votre DB fonctionne parfaitement.</h2>";
        
    } catch (Exception $e) {
        throw new Exception("❌ Erreur avec votre classe Mysql: " . $e->getMessage());
    }
    
} catch (Exception $e) {
    echo "<div style='color: red; font-weight: bold;'>";
    echo $e->getMessage();
    echo "</div>";
    
    // Aide supplémentaire
    echo "<h3>🔧 Aide de dépannage:</h3>";
    echo "<ul>";
    echo "<li>Vérifiez que Docker est démarré: <code>docker ps</code></li>";
    echo "<li>Vérifiez que le service MySQL dans Docker est en cours d'exécution</li>";
    echo "<li>Vérifiez que la base de données '{$dbConf['db_name']}' existe</li>";
    echo "<li>Vérifiez l'utilisateur et mot de passe MySQL dans Docker</li>";
    echo "<li>Si vous testez hors Docker, modifiez <code>db_host=db</code> en <code>db_host=localhost</code> dans .env</li>";
    echo "</ul>";
}

echo "</body>";
echo "</html>";