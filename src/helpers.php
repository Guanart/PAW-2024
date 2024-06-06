<?php

function view($view, $data = []) {
    $viewFile = __DIR__ . "/App/views/{$view}.view.php";

    if (!file_exists($viewFile)) {
        throw new Exception("Vista no encontrada: {$view}");
    }

    extract($data);
    require $viewFile;
}

function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Pretty var_dump 
 * Possibility to set a title, a background-color and a text color
 */
function dd($data, $title = "", $background = "#EEEEEE", $color = "#000000")
{

    //=== Style  
    echo "  
    <style>
        /* Styling pre tag */
        pre {
            padding:10px 20px;
            white-space: pre-wrap;
            white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            word-wrap: break-word;
        }

        /* ===========================
        == To use with XDEBUG 
        =========================== */
        /* Source file */
        pre small:nth-child(1) {
            font-weight: bold;
            font-size: 14px;
            color: #CC0000;
        }
        pre small:nth-child(1)::after {
            content: '';
            position: relative;
            width: 100%;
            height: 20px;
            left: 0;
            display: block;
            clear: both;
        }

        /* Separator */
        pre i::after{
            content: '';
            position: relative;
            width: 100%;
            height: 15px;
            left: 0;
            display: block;
            clear: both;
            border-bottom: 1px solid grey;
        }  
    </style>
    ";

    //=== Content            
    echo "<pre style='background:$background; color:$color; padding:10px 20px; border:2px inset $color'>";
    echo    "<h2>$title</h2>";
    var_dump($data);
    echo "</pre>";
}


/*
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

    public function input($key): String {
        if ($this->httpMethod()=='GET') {
            return htmlentities($_GET[$key]);
        } else {
            return htmlentities($_POST[$key]);
        }
    }
}

$request = new Request();

function request() {
    global $request;
    return $request;
}

*/