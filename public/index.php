<?php

// affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Début du diagnostic
echo "<h1>Diagnostic Ecoride</h1>";

// Vérification de l'autoload
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    echo "<p style='color:green'>✓ Fichier autoload.php trouvé.</p>";
    require_once $autoloadPath;
} else {
    echo "<p style='color:red'>✗ Fichier autoload.php introuvable à l'emplacement : $autoloadPath</p>";
    exit;
}

// Vérification du fichier .env.example
$envFile = __DIR__ . '/../.env.example';
if (file_exists($envFile)) {
    echo "<p style='color:green'>✓ Fichier .env.example trouvé.</p>";
} else {
    echo "<p style='color:red'>✗ Fichier .env.example introuvable.</p>";
}

// Vérification de l'existence des classes
if (class_exists('App\Controller\PageController')) {
    echo "<p style='color:green'>✓ Classe PageController trouvée.</p>";
} else {
    echo "<p style='color:red'>✗ Classe PageController introuvable.</p>";
}

if (class_exists('App\Routing\Router')) {
    echo "<p style='color:green'>✓ Classe Router trouvée.</p>";
} else {
    echo "<p style='color:red'>✗ Classe Router introuvable.</p>";
}

// constante pour avoir le chemin racine de l'app
define('APP_ROOT', realpath(__DIR__ . '/..'));
define('APP_ENV', '.env.example');

echo "<p>APP_ROOT : " . APP_ROOT . "</p>";
echo "<p>APP_ENV : " . APP_ENV . "</p>";

// Exécution de l'application avec gestion d'erreurs
use App\Routing\Router;

try {
    // essai du contrôleur
    $pageController = new App\Controller\PageController();
    echo "<p style='color:green'>✓ PageController instancié.</p>";
    $pageController->accueil();
} catch (Exception $e) {
    echo "<p style='color:red'>✗ Erreur PageController : " . $e->getMessage() . "</p>";
}

try {
    // essai du router
    $router = new Router();
    echo "<p style='color:green'>✓ Router instancié.</p>";
    $router->handleRequest($_SERVER["REQUEST_URI"]);
} catch (Exception $e) {
    echo "<p style='color:red'>✗ Erreur Router : " . $e->getMessage() . "</p>";
}

echo "<h2>Diagnostic terminé</h2>";