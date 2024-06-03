<?php

namespace Paw\App\Controllers;

use Twig\Environment;

class PageController extends Controller
{
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index() {
        $title = "Paw Power";
        echo $this->twig->render('index.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    public function menu() {
        $title = "Menu";
        echo $this->twig->render('menu.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

}