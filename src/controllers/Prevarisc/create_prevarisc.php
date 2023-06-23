<?php


use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;

$connexion = require '../../../config.php';

$dbParams = $connexion['db'];
$em_config = $connexion['em_config'];
$connection = DriverManager::getConnection($dbParams, $em_config);

$em = new EntityManager($connection, $em_config);
$preva = new \App\Entity\Prevarisc("117.15.1.2", "3306", "pdo-sql");


$em->persist($preva);
$em->flush();
