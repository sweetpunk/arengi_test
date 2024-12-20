# arengi_test

## Prérequis

- PHP: 8.2
- Composer
- Symfony CLI
- base de donnée: Mysql, MariaD, etc...

## Installation

- git clone https://github.com/sweetpunk/arengi_test.git
- cd arengi_test
- composer install
- modifier DATABASE_URL dans le .env avec votre base en local
- exemple: DATABASE_URL="mysql://login:password@127.0.0.1:3306/arengi?serverVersion=9.1.0-MariaDB&charset=utf8mb4"

## Migration

- symfony console doctrine:database:create
- symfony console doctrine:migration:migrate
- Importer le fichier sql Script/car_type.sql dans votre base de donnée

## Lancer le projet en local

- symfony server:start
- ouvrir un navigateur et aller sur http://127.0.0.1:8000/cars/list


