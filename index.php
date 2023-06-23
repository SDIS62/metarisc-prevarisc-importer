<?php declare(strict_types=1);

include 'vendor/autoload.php';

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$responseFactory = new Laminas\Diactoros\ResponseFactory();

$router   = new League\Route\Router;

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new Twig\Environment($loader, [
     'cache' => false,
]);

$router->map('GET', '/', function (ServerRequestInterface $request) use ($twig): ResponseInterface {
    $template = $twig->load('index.html.twig');
    $html = $template->render([
        'title' => "Portail Prevarisc-Metarisc"
    ]);
    $response = new Response();
    $response->getBody()->write($html);

    return $response;
});

$router->map('GET', '/connected', function (ServerRequestInterface $request)use ($twig): ResponseInterface {
    $template = $twig->load('connected.html.twig');
    $html = $template->render([
        'title' => "Enfin !"
    ]);
    $response = new Response();
    $response->getBody()->write($html);

    return $response;
});


$router->map('GET', '/token', function (ServerRequestInterface $request)use ($twig): ResponseInterface {
    $template = $twig->load('token.html.twig');
    $code = $request->getQueryParams()['code'] ?? null; 
    $html = $template->render([
        'title' => "Enfin !",
        'code' => $code
    ]);
    $response = new Response();
    $response->getBody()->write($html);

    return $response;
});



$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);