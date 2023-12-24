# TournamentSystem


## Использование
Клонируйте репозиторий:
```sh
$ git clone https://github.com/Keembler/TournamentSystem.git
```

Установите composer зависимости:
```sh
$ composer install
``` 

Создайте БД:
```sh
$ php bin/console doctrine:database:create
``` 

Запустите миграции:
```sh
$ php bin/console doctrine:migrations:migrate
``` 

Соберите проект:
```sh
$ docker-compose build
``` 

Запустите собранный проект:
```sh
$ docker-compose up -d
``` 

Откройте страницу турниров:
```sh
http://localhost:8888/
``` 