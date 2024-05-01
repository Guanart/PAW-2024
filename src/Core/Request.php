<?php

namespace Paw\Core;

class Request
{
    private $data;

    public function __construct()
    {
        $this->data = $_SERVER;
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function httpMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function url()
    {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    public function route()
    {
        return [
            $this->url(),
            $this->httpMethod(),
        ];
    }

    public function input($key = null): String
    {
        if ($this->httpMethod() == 'GET') {
            return htmlentities($_GET[$key]);
        } else {
            return htmlentities($_POST[$key]);
        }
    }

    public function post($key = null): array
    {
        if (is_null($key)) {
            return $_POST;
        }
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function get($key = null)
    {
        if (is_null($key)) {
            return $_GET;
        }
        // return isset($this->data[$key]) ? $this->data[$key] : null;
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public function file($key = null)
    {
        if (is_null($key)) {
            return $_FILES;
        }
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }

    // Devuelve true si todos los parámetros que se le pasan, se encuentran en una petición POST.
    public function hasBodyParams(array $params): bool
    {
        var_dump($params);
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                var_dump($param);die;
                return false;
            }
        }
        return true;
    }
    /*
    array(4) {
        [0]=> string(6) "nombre" 
        [1]=> string(11) "descripcion" 
        [2]=> string(6) "precio" 
        [3]=> string(6) "imagen" } 
        
    string(6) "imagen"

    */
}
