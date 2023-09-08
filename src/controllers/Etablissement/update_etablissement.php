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



/*$etablissement = $em->find('App\Entity\Etablissement',$_GET['id'] );
$etablissement->setEstImporte(false);
$em->persist($etablissement);
$em->flush();*/

$template = $twig->load('updateEtablissement.html.twig');


echo $template->render([
]);
