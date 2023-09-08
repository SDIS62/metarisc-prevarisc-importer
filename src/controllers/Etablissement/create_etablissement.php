<?php


use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;

$connexion = require __DIR__.'/../../../config/config.php';

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../../../templates');
$twig = new Twig\Environment($loader, [
    'cache' => false,
]);


$config = require __DIR__.'/../../../config/config.php';
$container = \App\Container::initWithDefaults($config);

$em = $container->get(EntityManager::class);

$eta = new \App\Entity\Etablissement(false, $_POST['id']);

$em->persist($eta);
$em->flush();

$em = $container->get(EntityManager::class);

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