<?php

namespace Paw\App\Controllers;

class ErrorController extends Controller
{
    public function notFound() {
        http_response_code(404);
        view('not-found', [
            'nav' => $this->nav,
            'footer' => $this->footer,
        ]);
    }

    public function internalError() {
        http_response_code(500);
        view('internal_error', [
            'nav' => $this->nav,
            'footer' => $this->footer,
        ]);
    }
}