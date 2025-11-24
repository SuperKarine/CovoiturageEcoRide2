<?php
// Charger l'autoload
require_once __DIR__ . "/../vendor/autoload.php";

// Je définis une constante pour avoir le chemin racine de l'app
define('APP_ROOT', dirname(__DIR__));
define('APP_ENV', ".env");

use App\Routing\Router;

// Démarrer la session
session_start();

$router = new Router();

// Routes d'authentification
$router->match('/connexion', 'connexion', 'login')
       ->match('/inscription', 'inscription', 'register')
       ->post('/login', 'AuthController@handleLogin')
       ->post('/register', 'AuthController@handleRegister')
       ->get('/logout', 'AuthController@logout');


$router->handleRequest($_SERVER["REQUEST_URI"]);




