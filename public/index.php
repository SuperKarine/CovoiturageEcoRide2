<?php

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Charger l'autoload
require_once __DIR__ . '/../vendor/autoload.php';


// On définit une constante pour avoir le chemin racine de l'app
define('APP_ROOT', realpath(__DIR__ . '/..'));
define('APP_ENV', ".env.example");

use App\Controller\PageController;
use App\Routing\Router;


$pageController = new PageController();

$pageController->accueil();


$router = new Router();
$router->handleRequest($_SERVER["REQUEST_URI"]);


