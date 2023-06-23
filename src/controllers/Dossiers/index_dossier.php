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

$dossiers = $em->getRepository('App\Entity\Dossier')->findAll();

$dossiersTab = [];
foreach ($dossiers as $dossier) {
    $dossiersTab[] = [
        "id" => $dossier->getId(),
        "estImporte" => $dossier->IsImporte()==true,
        "idPrevarisc" => $dossier->getIdPrevarisc(),
    ];
}

$em->flush();



$template = $twig->load('dossiers.html.twig');


echo $template->render([
    "dossiers" => $dossiersTab

]);

