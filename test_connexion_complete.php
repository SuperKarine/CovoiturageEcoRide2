<?php
require_once "vendor/autoload.php";
define("APP_ROOT", __DIR__);
define("APP_ENV", ".env");

use App\Routing\Router;

session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo "<h1>Test Complet Connexion</h1>";

// Test 1: Route
echo "<h2>1. Test Route</h2>";
$router = new Router();
try {
    $router->get("/connexion", "AuthController@showLogin");
    echo "✅ Route /connexion ajoutée<br>";
} catch (Exception $e) {
    echo "❌ Erreur route: " . $e->getMessage() . "<br>";
}

// Test 2: AuthController
echo "<h2>2. Test AuthController</h2>";
try {
    if (!class_exists("App\Controller\AuthController")) {
        echo "❌ AuthController n'existe pas<br>";
        exit;
    }
    echo "✅ AuthController existe<br>";
    
    $auth = new App\Controller\AuthController();
    
    if (!method_exists($auth, "showLogin")) {
        echo "❌ showLogin n'existe pas<br>";
        exit;
    }
    echo "✅ showLogin existe<br>";
    
} catch (Exception $e) {
    echo "❌ Erreur AuthController: " . $e->getMessage() . "<br>";
}

// Test 3: Template
echo "<h2>3. Test Template</h2>";
$templatePath = __DIR__ . "/public/templates/auth/connexion.php";
echo "Chemin: $templatePath<br>";
echo "Existe: " . (file_exists($templatePath) ? "✅ OUI" : "❌ NON") . "<br>";
echo "Taille: " . filesize($templatePath) . " bytes<br>";

if (file_exists($templatePath)) {
    // Test syntaxe
    $syntax = shell_exec("php -l " . escapeshellarg($templatePath) . " 2>&1");
    echo "Syntaxe: $syntax<br>";
    
    // Test inclusion
    try {
        ob_start();
        require $templatePath;
        $content = ob_get_clean();
        echo "✅ Template peut être inclus (" . strlen($content) . " caractères)<br>";
    } catch (Exception $e) {
        echo "❌ Erreur inclusion: " . $e->getMessage() . "<br>";
    }
}

// Test 4: Test final
echo "<h2>4. Test Final</h2>";
try {
    $router->handleRequest("/connexion");
    echo "✅ SUCCÈS COMPLET!";
} catch (Exception $e) {
    echo "❌ ÉCHEC FINAL: " . $e->getMessage() . "<br>";
}
