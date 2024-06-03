<?php

namespace Paw\App\Controllers;

use Twig\Environment;

class ErrorController extends Controller
{
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function notFound() {
        http_response_code(404);
        echo $this->twig->render('not-found.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
        ]);
    }

    public function internalError() {
        http_response_code(500);
        echo $this->twig->render('internal_error.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
        ]);
    }
}