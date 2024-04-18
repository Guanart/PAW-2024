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
                "href" => "/politicas_privacidad",
                "name" => "Politicas de privacidad",
            ],
            [
                "href" => "/acerca_de_nosotros",
                "name" => "Acerca de Nosotros",
            ],   
            [
                "href" => "/defensa_del_consumidor",
                "name" => "Defensa del consumidor",
            ],     
        ];
    }
}