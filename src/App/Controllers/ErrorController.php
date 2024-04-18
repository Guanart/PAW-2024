<?php

namespace Paw\App\Controllers;

class ErrorControler extends Controller
{
    public function notFound() {
        http_response_code(404);
        require $this->viewsDir . 'not-found.view.php';
    }
}