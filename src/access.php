<?php


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Client;
use Laminas\Diactoros\Response;



require __DIR__ . '/../vendor/autoload.php';


// session_start(); 
// $_SESSION['access'] = null;

// if ($_GET['access_token'] ){
//     $_SESSION['access'] = $_GET['access_token'];
//     var_dump("ca marche ???");
// }

$_SESSION['code'] = $_GET['code'];
$code = $_GET['code'];



$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../templates');
$twig = new Twig\Environment($loader, [
     'cache' => false,
]);

$metarisc = new \Metarisc\Metarisc([
    'metarisc_url' => 'https://api.metarisc.fr', // Optionnel
    //'access_token_url' => 'https://lemur-17.cloud-iam.com/auth/realms/metariscoidc/protocol/openid-connect/token', // Optionnel
    'grant_type' => 'code',
    'code' => $code,
    'redirect_uri' => 'http://localhost:8080/src/access.php', // Optionnel
    'client_id' => 'integration-prevarisc-import-dev',
    //'client_secret' => 'your_client_secret', // Optionnel
    //'scope' => 'openid', // Optionnel
]);

$emails = $metarisc->request('GET', '/utilisateurs/@moi/emails')->getBody()->__toString();
$profile = $metarisc->request('GET', '/utilisateurs/@moi')->getBody()->__toString();
$notifications = $metarisc->request('GET', '/notifications')->getBody()->__toString();

$json =json_decode($emails, true);
// $reponse = $metarisc->get('uri');

$email = $json["data"][0]["email"];


$template = $twig->load('emails.html.twig');
echo  $template->render([
    'email' => $email
]);


// Notifications :


$json =json_decode($notifications, true);
// $reponse = $metarisc->get('uri');

$titre = $json["data"][0]["title"];


// $template = $twig->load('notifications.html.twig');
// echo $template->render([
//     'email' => $email
// ]);

$paginator = $metarisc->pagination('GET', '/notifications');
$paginator->setMaxNbPages(75);
$paginator->setCurrentPage(2);
$nbResults = $paginator->getNbResults();
$currentPageResults = $paginator->getCurrentPageResults();


$template = $twig->load('notifications.html.twig');
echo  $template->render([
    'notifications' => $currentPageResults
]);
    