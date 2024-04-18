<?php

namespace Paw\App\Controllers;

class PageController extends Controller
{
    public function index() {
        $title = "Paw Power";
        view('index', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    public function menu() {
        $title = "Menu";
        view('menu', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

}