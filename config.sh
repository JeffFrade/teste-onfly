#!/bin/bash

echo "##### Inicializa os Containers ######"
docker compose up -d --build

echo "##### Copia o .env #####"
docker exec jefffrade-teste-onfly-php-fpm cp .env.example .env

echo "##### Remove a vendor #####"
docker exec jefffrade-teste-onfly-php-fpm rm -rf vendor

echo "##### Instala os Pacotes da Aplicação #####"
docker exec jefffrade-teste-onfly-php-fpm composer install

echo "##### Gera a Chave da Aplicação #####"
docker exec jefffrade-teste-onfly-php-fpm php artisan key:generate

echo "##### Cria as Tabelas e Popula o Banco de Dados #####"
docker exec jefffrade-teste-onfly-php-fpm php artisan migrate:fresh --seed

echo "##### Gera as chaves do passport em storage/app/public/passport-keys.txt #####"
docker exec jefffrade-teste-onfly-php-fpm php artisan passport:keys >> storage/app/public/passport-keys.txt

echo "##### Limpa os logs antigos #####"
docker exec jefffrade-teste-onfly-php-fpm rm -rf storage/logs/laravel-*