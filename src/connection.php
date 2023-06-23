<?php


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Client;
use Laminas\Diactoros\Response;


require __DIR__ . '/../vendor/autoload.php';

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../templates');
$twig = new Twig\Environment($loader, [
     'cache' => false,
]);

$client = new Client([
    'verify' => false,
]);

$auth_url = \Metarisc\Metarisc::authorizeUrl([
    'client_id' => 'integration-prevarisc-import-dev',
    'redirect_uri' => 'http://localhost:8080/src/access.php',
    'scope' => 'openid profile email',
]);

$template = $twig->load('connected.html.twig');

echo $template->render([
    "link" => $auth_url
]); 
    





// $response = $client->get("https://lemur-17.cloud-iam.com/auth/realms/metariscoidc/protocol/openid-connect/auth?response_type=code&client_id=xx");
// $code = $response->getStatusCode(); // 200
// $body = $response->getBody()->__toString();

// var_dump($body);

// $reponse = $metarisc->get('uri');


    