<?php

namespace Paw\App\Controllers;

require __DIR__ . "/../src/bootstrap.php";

class ErrorControler
{
    public array $menu = [];

    public string $viewsDir;

    public function __construct()
    {
        $this->viewsDir = __DIR__ . "/../views/";
        $this->menu = [
            [
                "href" => "/",
                "name" => "Inicio",
            ],
            [
                "href" => "/reservas",
                "name" => "Reservas",
            ],
            [
                "href" => "/menu",
                "name" => "Menu",
            ],
            [
                "href" => "/hacer_pedido",
                "name" => "Hacer pedido",
            ],
            [
                "href" => "/locales",
                "name" => "Locales",
            ],
            [
                "href" => "/login",
                "name" => "Login",
            ],
            [
                "href" => "/contactos",
                "name" => "Contactos",
            ],
        ];
    }

    public function notFound() {
        http_response_code(404);
        require $this->viewsDir . 'not-found.view.php';
    }
}