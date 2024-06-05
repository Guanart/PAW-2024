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
    public function menu(Request $request) {
        $title = "Menu";
        $get = $request->get();
        $page = isset($get['page']) ? (int)$get['page'] : 0;
        $itemsPerPage = 2;
        $products = $this->repository->getPage($itemsPerPage, $page); 
        echo $this->twig->render('menu.view.twig', [
            'nav' => $this->nav,
            'footer' => $this->footer,
            'title' => $title,
            'products' => $products
        ]);
    }

}