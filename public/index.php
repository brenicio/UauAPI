<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Autoload do Slim Framework
require '../vendor/autoload.php';

//Inserindo dependencia do banco de dados
require '../src/config/db.php';

// Rotas
require '../src/routes/routes.php';

//Executa o SLIM FRAMEWORK
$app->run();
