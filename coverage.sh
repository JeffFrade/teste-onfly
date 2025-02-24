#!/bin/bash

echo "##### Executando os testes com coverage #####"
docker exec jefffrade-teste-onfly-php-fpm vendor/bin/phpunit --coverage-html coverage/

echo "Arquivos gerados em coverage/"