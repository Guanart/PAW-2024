<?php

namespace Paw\App\Controllers;

use Paw\Core\Repository;
use Paw\Core\Database\QueryBuilder;

class Controller
{
    public ?string $repositoryName = null;
    public Repository $repository;

    public string $viewsDir = __DIR__ . "/../views/";

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

    
    public function __construct()
    {   
        global $connection, $log;

        if (!is_null($this->repositoryName)) {
            $qb = new QueryBuilder($connection);
            $qb->setLogger($log);

            $repository = new $this->repositoryName;
            $repository->setQueryBuilder($qb);
            
            $this->setRepository($repository);
        }
    }

    public function setRepository(Repository $repository) {
        $this->repository = $repository;
    }
}