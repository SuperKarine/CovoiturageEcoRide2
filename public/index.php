<?php
// Charger l'autoload
require_once __DIR__ . "/../vendor/autoload.php";

// Je définis une constante pour avoir le chemin racine de l'app
define('APP_ROOT', dirname(__DIR__));
define('APP_ENV', ".env");

use App\Routing\Router;

$router = new Router();
$router->handleRequest($_SERVER["REQUEST_URI"]);




/*
use App\Controller\PageController;


$pageController = new PageController();
$pageController->home();
*/