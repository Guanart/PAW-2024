<?php

namespace Paw\Core;

use Paw\Core\Exceptions\RouteNotFoundException;

class Router
{
    public array $routes = [
        "GET"  => [],
        "POST" => [],
    ]; // Inicializa la propiedad $routes como un array

    public function loadRoutes($path, $action, $method = "GET") {
        $this->routes[$method][$path] = $action; // Accede correctamente a la propiedad $routes sin el símbolo $
    }

    public function get($path, $action){
        $this->loadRoutes($path, $action, "GET");
    }

    public function post($path, $action){
        $this->loadRoutes($path, $action, "POST");
    }

    public function exists($path, $http_method){
        return array_key_exists($path, $this->routes[$http_method]);
    }

    public function getController($path, $http_method) {
        return explode('@', $this->routes[$http_method][$path]);
    }

    public function direct($path, $http_method = "GET") {
        if (!$this->exists($path,$http_method)) {
            throw new RouteNotFoundException("No existe ruta para ese Path"); // Corrige el nombre de la excepción
        }
        list($controlador, $method) = $this->getController($path,$http_method);
        $controller_name = "Paw\\App\\Controllers\\" . $controlador;
        $objController = new $controller_name;
        $objController->$method();
    }
}