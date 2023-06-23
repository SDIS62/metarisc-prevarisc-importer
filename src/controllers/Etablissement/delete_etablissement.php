<?php


use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;

$connexion = require '../../../config.php';

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../../../templates');
$twig = new Twig\Environment($loader, [
    'cache' => false,
]);

$dbParams = $connexion['db'];
$em_config = $connexion['em_config'];
$connection = DriverManager::getConnection($dbParams, $em_config);

$em = new EntityManager($connection, $em_config);


$etablissement = $em->find('App\Entity\Etablissement', $_GET["idEtablissement"]);

$em->remove($etablissement);
$em->flush();

$template = $twig->load('deleted_etablissement.html.twig');

echo $template->render([
    "id" => $_GET["idEtablissement"]
]);