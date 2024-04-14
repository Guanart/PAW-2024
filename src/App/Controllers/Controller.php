<?php

namespace Paw\App\Controllers;

class Controller
{
    public array $nav = [];
    public array $footer = [];
    public string $viewsDir;

    public function __construct()
    {
        $this->viewsDir = __DIR__ . "/../views/";
        $this->nav = [
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
        ];
        $this->footer = [
            [
                "href" => "/contactos",
                "name" => "Contactos",
            ],
            [
                "href" => "/politicas-de-privacidad",
                "name" => "Politicas de privacidad",
            ],
            [
                "href" => "/defensa-del-consumidor",
                "name" => "Defensa del consumidor",
            ],     
        ];
    }
}