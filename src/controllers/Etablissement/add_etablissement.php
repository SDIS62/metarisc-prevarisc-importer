<?php

require __DIR__.'/../../../vendor/autoload.php';


$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../../../templates');
$twig = new Twig\Environment($loader, [
    'cache' => false,
]);


$template = $twig->load('create_etablissement.html.twig');


echo $template->render([
    'lien' => "create_etablissement.php"

]);