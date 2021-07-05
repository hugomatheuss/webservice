<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

Clonando o repositório

    git clone https://github.com/hugomatheuss/webservice.git

Entrando no diretório do projeto

    cd webservice

Instalando as dependências com o composer

    composer install

Copiando o arquivo .env.example para o arquivo .env para fazer as configurações necessárias

    cp .env.example .env

Gerando uma nova application key

    php artisan key:generate

Gerando uma nova JWT authentication secret key

    php artisan jwt:secret
    
Job para upload de arquivo

    php artisan queue:work 

Migrations (**Ajuste as informações do banco de dados em .env antes de rodar as migrations**)

    php artisan migrate

Iniciando o local server

    php artisan serve

Acessando em http://localhost:8000

    
**Certifique-se de definir as informações de conexão do banco de dados corretas antes de executar as migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve


## Documentação da API

> [Full API Spec](https://app.swaggerhub.com/apis/hugomatheuss/php-challenge-20201117/1.0.0)


----------
#Testes
php artisan tests --filter ProductTest

## Routes

- GET `/api/` - PHP Challenge 20201117
- GET `/api/products` - Todos os produtos
- GET `/api/products/{product}` - Um produto específico
- POST `/api/products` - Cadastra um produto
- PUT `/api/products{product}` - Altera um produto específico
- DELETE `/api/products{product}` - Remove um produto específico
- POST `/api/jsonUpload` - Upload de arquivo Json com a lista de produtos a serem inseridos

# Testando no Postman

    php artisan serve

    http://localhost:8000/api

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Yes 	    | Authorization    	| Token {JWT}      	|
