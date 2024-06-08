<?php

namespace Paw\App\Controllers;

use Paw\App\Repositories\Repository;

class Controller
{  
    public ?string $repositoryName = null;
    public $repository;
    public string $imagesDir = "public/images/";
    public array $nav = [
        [
            "href" => "/",
            "name" => "Inicio",
            "role" => "user"
        ],
        [
            "href" => "/reservas",
            "name" => "Reservas",
            "role" => "user"
        ],
        [
            "href" => "/menu?page=0",
            "name" => "Menu",
            "role" => "user"
        ],
        [
            "href" => "/hacer_pedido",
            "name" => "Hacer pedido",
            "role" => "user"
        ],
        [
            "href" => "/tus_pedidos",
            "name" => "Tus pedidos",
            "role" => "user"
        ],
        [
            "href" => "/locales",
            "name" => "Locales",
            "role" => "user"
        ],
        [
            "href" => "/admin",
            "name" => "Admin",
            "role" => "admin"
        ],  
        [
            "href" => "/alta_plato",
            "name" => "Alta plato",
            "role" => "admin"
        ],
        [
            "href" => "/turnero",
            "name" => "Turnero",
            "role" => "admin"
        ],
        [
            "href" => "/gestion_pedidos",
            "name" => "Gestion de pedidos",
            "role" => "admin"
        ]
    ];

    public array $footer = [
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

    
    public function __construct(string $repositoryName = null)
    {   
        global $querybuilder;

        if (!is_null($repositoryName)) {
            $repository = new $repositoryName($querybuilder);
            $repository->setModel();
            
            $this->setRepository($repository);
        }
    }
    
    public function setRepository(Repository $repository) {
        $this->repository = $repository;
    }
    
}