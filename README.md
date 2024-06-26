## Стек технологий
- PHP 8.1 + Composer
- Mysql 8
- Docker, docker-compose
- PHPUnit

## Инструкция по развертыванию
- Установить **docker**, **docker-compose**.
- Склонировать репозиторий.
```
git clone https://github.com/Cripson23/skynet-task.git && cd skynet-task
```
- Задать права доступа для всего проекта:
    - В среде разработки:
        - ```sudo chown -R www-data:www-data .```
        - ```sudo chmod 775 -R .```
    - В продуктовой среде:
        - ```sudo chown -R www-data:www-data .```
        - ```sudo find . -type d -exec chmod 750 {} \; && sudo find . -type f -exec chmod 640 {} \;```
- Скопировать файл **.env.example** в корневую директорию и сохранить с именем **.env** ```cp .env.example .env```
- Убедиться что на хост-машине не занят порт **3366** каким-либо из сервисов.
- Для **dev** окружения в файле hosts хост-машины осуществить маппинг домена **skynet-task.com** на локальный IP (127.0.0.1).
- Для **prod** окружения поместить файлы ssl сертификатов в директорию **./docker/nginx/ssl**:
    - **certificate.crt**
    - **private.key**
- Запустить сборку и запуск частей приложения в зависимости от окружения:
    - ```docker-compose -f docker-compose.dev.yml up --build -d``` **(dev)**.
    - ```docker-compose -f docker-compose.prod.yml up --build -d``` **(prod)**.

## Дополнительно
- Для тестов можно использовать дамп **dump.sql**, который находится в **корневой директории**.   
  Для этого необходимо прокинуть файл дампа в контейнер и выполнить импорт (пример):
```
docker cp dump.sql skynet-task-mysql-1:/home/dump.sql
docker-compose -f docker-compose.dev.yml exec mysql bash
mysql -h localhost -P 3306 -u admin -p skynet < ./home/dump.sql
```
Ввести пароль от пользователя **admin**, после чего данные будут импортированы.

## Описание решения
- В рамках реализации решения выполнены 2 маршрута:
    - **/** - Получение списка всех тарифов (в представлении данные отображаются просто через print_r()).
    - **/view?id=$id** - Получение данных конкретного тарифа по id (в представлении данные отображаются просто через print_r()).
- Реализация пользовательского интерфейса для решения не предусмотрена.
- Тестирование выполнено для основных программных компонентов.
- Запуск тестов:
```
docker-compose -f docker-compose.dev.yml exec php-fpm bash
./vendor/bin/phpunit tests
```
