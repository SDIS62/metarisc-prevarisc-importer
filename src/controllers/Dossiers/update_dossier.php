<?php


use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;

$connexion = require '../../../config.php';

$dbParams = $connexion['db'];
$em_config = $connexion['em_config'];
$connection = DriverManager::getConnection($dbParams, $em_config);

$em = new EntityManager($connection, $em_config);


$dossiers = $em->getRepository('App\Entity\Dossier');
$dossier = $dossiers->find(1);
$dossier->setEstImporte(false);
$em->persist($dossier);
$em->flush();
