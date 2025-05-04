<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;
use Math\Geometria as Basic;

require __DIR__ . '/vendor/autoload.php';
 
$app = AppFactory::create();
// middleware é um evento que ocorre antes da requisição chegar na rota.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function (Request $request, Throwable $excepition, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails, ) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write('{"error": "Recurso não foi encontrado"}');
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(404);
});

$app->post('/Math/triangulo/{base}/{altura}', function ($request, $response, $args) {
    $basic = new Basic();
    $area = $basic->calcularAreaTriangulo($args['base'], $args['altura']);
    $response->getBody()->write("Área do triângulo: $area");
    return $response;
});

$app->post('/Math/retangulo/{base}/{altura}', function ($request, $response, $args) {
    $basic = new Basic();
    $area = $basic->calcularAreaRetangulo($args['base'], $args['altura']);
    $response->getBody()->write("Área do retângulo: $area");
    return $response;
});

$app-> run();