<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;
$app->get('/hello/{name}/{sobrenome}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $sobrenome = $args['sobrenome'];
    $response->getBody()->write("Hello, $name  $sobrenome");

    return $response;
});


// Rotas das Unidades (Personalizações)
require '../src/routes/unidades.php';


//Executa o SLIM FRAMEWORK
$app->run();
