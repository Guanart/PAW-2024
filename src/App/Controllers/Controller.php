<?php

namespace Paw\App\Controllers;


use Paw\App\Repositories\Repository;
use Paw\Core\Database\QueryBuilder;


use Paw\Core\Model; 

class Controller
{  
    
    public ?string $repositoryName = null;
    public $repository;
    

    //public ?string $modelName = null;

    public string $viewsDir = __DIR__ . "/../views/";
    public string $imagesDir = __DIR__ . "/../../../public/images/";
    public array $nav = [
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
            "href" => "/alta_plato",
            "name" => "Alta plato (admin)",
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
        global $connection, $log;

        if (!is_null($repositoryName)) {
            $qb = new QueryBuilder($connection);
            $qb->setLogger($log);

            $repository = new $repositoryName($qb);
            $repository->setModel();
            
            $this->setRepository($repository);
        }
    }
    
    public function setRepository(Repository $repository) {
        $this->repository = $repository;
    }
    
}