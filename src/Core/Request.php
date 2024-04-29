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
}
