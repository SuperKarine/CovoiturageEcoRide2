<?php
require_once "vendor/autoload.php";
define("APP_ROOT", __DIR__);
define("APP_ENV", ".env");

use App\Routing\Router;

session_start();

\$router = new Router();
\$router->get("/test-simple-connexion", "AuthController@showLoginSimple");

class AuthController {
    public function showLoginSimple() {
        require APP_ROOT . "/public/templates/auth/connexion_simple.php";
    }
}

\$router->handleRequest("/test-simple-connexion");
