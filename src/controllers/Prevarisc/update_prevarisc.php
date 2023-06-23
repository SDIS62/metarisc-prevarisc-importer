<?php


use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;

$connexion = require '../../../config.php';

$dbParams = $connexion['db'];
$em_config = $connexion['em_config'];
$connection = DriverManager::getConnection($dbParams, $em_config);

$em = new EntityManager($connection, $em_config);


$prevas = $em->getRepository('App\Entity\Prevarisc');
$preva = $prevas->find(1);
$preva->setPort(8000);
$em->persist($preva);
$em->flush();
