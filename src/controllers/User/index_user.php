<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use App\Entity\Etablissement;

require __DIR__.'/../../../vendor/autoload.php';

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../../../templates');
$twig = new Twig\Environment($loader, [
    'cache' => false,
]);

$connexion = require '../../../config.php';

$dbParams = $connexion['db'];
$em_config = $connexion['em_config'];
$connection = DriverManager::getConnection($dbParams, $em_config);

$em = new EntityManager($connection, $em_config);

$users = $em->getRepository('App\Entity\User')->findAll();

$usersTab = [];
foreach ($users as $user) {
    $usersTab[] = [
        "id" => $user->getId(),
        "username" => $user->getUsername(),
        "idMetarisc" => $user->getIdMetarisc(),
    ];
}

$em->flush();



$template = $twig->load('users.html.twig');


echo $template->render([
    "users" => $usersTab
]);

