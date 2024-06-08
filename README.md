# PAW-2024
Repositorio para los trabajos prácticos de la materia Programación en Ambiente Web, año 2024. 

Integrantes: 
- Gonzalo Benito
- Francisco Guerra
- Kevin Monti
- Lucio Reinoso

Enlaces adicionales:
- [Website y Wireframes (Figma)](https://www.figma.com/file/780n3imOYZXn6FMVT0Zzpq/KLFG---Sitemap?type=design&node-id=0-1&mode=design&t=U6YfYKcbj4ooqUXw-0)


## Instalación y Ejecución (local)

* ```git clone <url-repo>```
* ```cd project-name```
* ```composer install```
* ```cp .env.example .env``` # Editar el ```.env``` con los valores deseados
* ```docker compose up -d```
* ```./vendor/robmorgan/phinx/bin/phinx migrate -e development```
* ```./vendor/robmorgan/phinx/bin/phinx seed:run```
* Ejecutar: ```php -S localhost:8888 -t public/```

## Posibles problemas al levantar el proyecto
### Phinx migrate
Para ejecutar los migrations en Linux, es necesario tener instalada esta librería: ```sudo apt install php-pgsql```