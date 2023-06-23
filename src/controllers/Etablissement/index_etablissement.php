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

$etablissements = $em->getRepository('App\Entity\Etablissement')->findAll();
//Faire un tableau à rendre sur twig
$etablissementsTab = [];
foreach ($etablissements as $etablissement) {
    $etablissementsTab[] = [
        "id" => $etablissement->getId(),
        "estImporte" => $etablissement->IsImporte()==true,
        "idPrevarisc" => $etablissement->getIdPrevarisc(),
    ];
}

$em->flush();

$template = $twig->load('etablissements.html.twig');


echo $template->render([
    "etablissements" => $etablissementsTab

]);

