<?php

namespace Paw\App\Controllers;
use Paw\Core\Request;
use Twig\Environment;
use Paw\App\Repositories\ProductoRepository;

class PageController extends Controller
{
    private $twig;
    public $repository;

    public function __construct(Environment $twig) {
        parent::__construct(ProductoRepository::class);
        $this->twig = $twig;
    }

    public function index(Request $request) {
        $title = "Paw Power";
        echo $this->twig->render('index.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }
    public function menu() {
        $title = "Menu";
        // $products = productRepository(); TODO
        echo $this->twig->render('menu.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
        ]);
    }

}