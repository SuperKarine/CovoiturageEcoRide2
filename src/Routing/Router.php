<?php

namespace App\Routing;

use App\Controller\ErrorController;
use Exception;

class Router
{
    private $routes;
    
    public function __construct()
    {
        $this->routes = require_once APP_ROOT."/config/routes.php";
    }

    public function handleRequest(string $uri)
    {
        try {
            $path = $this->normalizePath($uri);
        
            echo "<!-- Debug: URI = '$uri' -->";
            echo "<!-- Debug: Path normalisé = '$path' -->";
            echo "<!-- Debug: Routes disponibles = " . implode(', ', array_keys($this->routes)) . " -->";
        
            if (!isset($this->routes[$path])) {
                throw new Exception("La route '$path' n'existe pas. Routes disponibles: " . implode(', ', array_keys($this->routes)));
            }
            
            $route = $this->routes[$path];
            $controllerPath = $route["controller"];
            $action = $route["action"];

            if (!class_exists(($controllerPath))) {
                throw new Exception("La classe n'existe pas");
            }
            
            $controller = new $controllerPath();
            
            if (!method_exists($controller, $action)) {
                throw new Exception("L'action n'existe pas");
            }

            // Vérifie si la route a une vue à passer
            if (isset($route['view'])) {
                $controller->$action($route['view']);
            } else {
                $controller->$action();
            }
            
        } catch(Exception $e) {
            $errorController = new ErrorController();
            $errorController->show($e->getMessage());
        }
    }

    public static function normalizePath(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $path = rtrim($path, "/");
        
        if (empty($path)) {
            return '/';
        }
        
        if ($path[0] !== '/') {
            $path = '/' . $path;
        }
        
        return $path;
    }

    /**
     * Pour les vues directes 
     */
    public function match(string $url, string $view, ?string $name = null): self
    {
        $this->routes[$url] = [
            "controller" => "App\Controller\PageController",
            "action" => "renderView",
            "view" => $view
        ];
        return $this;
    }

    /**
     * Pour les actions GET
     */
    public function get(string $url, string $controllerAction, ?string $name = null): self
    {
        [$controller, $action] = explode('@', $controllerAction);
        $this->routes[$url] = [
            "controller" => "App\Controller\\" . $controller,
            "action" => $action
        ];
        return $this;
    }

    /**
     * Pour les actions POST  
     */
    public function post(string $url, string $controllerAction, ?string $name = null): self
    {
        [$controller, $action] = explode('@', $controllerAction);
        $this->routes[$url] = [
            "controller" => "App\Controller\\" . $controller,
            "action" => $action
        ];
        return $this;
    }
}