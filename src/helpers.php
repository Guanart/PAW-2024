<?php
class Request {
    private $data;

    public function __construct() {
        $this->data = $_SERVER;
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function httpMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function url() {
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

}

$request = new Request();

function request() {
    global $request;
    return $request;
}
