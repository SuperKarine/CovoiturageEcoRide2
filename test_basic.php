<?php
require_once "vendor/autoload.php";
define("APP_ROOT", __DIR__);
define("APP_ENV", ".env");

echo "<h1>Test Basique</h1>";

// Test 1: Classes existent-elles?
echo "Router: " . (class_exists("App\\\\Routing\\\\Router") ? "✅" : "❌") . "<br>";
echo "AuthController: " . (class_exists("App\\\\Controller\\\\AuthController") ? "✅" : "❌") . "<br>";

// Test 2: Méthode showLogin existe-t-elle?
if (class_exists("App\\\\Controller\\\\AuthController")) {
    \$methods = get_class_methods("App\\\\Controller\\\\AuthController");
    echo "Méthodes AuthController: " . implode(", ", \$methods) . "<br>";
    echo "showLogin existe: " . (in_array("showLogin", \$methods) ? "✅" : "❌") . "<br>";
}

// Test 3: Template existe-t-il?
\$templatePath = __DIR__ . "/public/templates/auth/connexion.php";
echo "Template existe: " . (file_exists(\$templatePath) ? "✅" : "❌") . "<br>";
