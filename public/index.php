<?php

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Début du diagnostic
echo "<h1>Diagnostic Ecoride</h1>";

// Charger l'autoload
//require_once __DIR__ . '/../vendor/autoload.php';

// Vérification de l'autoload
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    echo "<p style='color:green'>✓ Fichier autoload.php trouvé.</p>";
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
require_once $autoloadPath;

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


// On définit une constante pour avoir le chemin racine de l'app
define('APP_ROOT', realpath(__DIR__ . '/..'));
define('APP_ENV', '.env.example');

echo "<p>APP_ROOT : " . APP_ROOT . "</p>";
echo "<p>APP_ENV : " . APP_ENV . "</p>";

/** use App\Controller\PageController;
*use App\Routing\Router;


*$pageController = new PageController();

*$pageController->accueil();


*$router = new Router();
*$router->handleRequest($_SERVER["REQUEST_URI"]);
*/

// Si tout est OK, nous allons essayer d'exécuter le contrôleur
try {
    $pageController = new App\Controller\PageController();
    echo "<p style='color:green'>✓ PageController instancié.</p>";

    // Appel de la méthode accueil
    $pageController->accueil();
} catch (Exception $e) {
    echo "<p style='color:red'>✗ Erreur lors de l'instanciation ou de l'appel de PageController : " . $e->getMessage() . "</p>";
}

// Essayer le router
try {
    $router = new App\Routing\Router();
    echo "<p style='color:green'>✓ Router instancié.</p>";

    // Traiter la requête
    $router->handleRequest($_SERVER["REQUEST_URI"]);
} catch (Exception $e) {
    echo "<p style='color:red'>✗ Erreur lors de l'instanciation ou de l'appel du Router : " . $e->getMessage() . "</p>";
}


