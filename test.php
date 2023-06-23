<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;

$connexion = require 'config.php';





$dbParams = $connexion['db'];
$em_config = $connexion['em_config'];
$connection = DriverManager::getConnection($dbParams, $em_config);

$em = new EntityManager($connection, $em_config);
$user = new \App\Entity\User(2, "CR7", 1);

//$prevarisc = new \App\Entity\Prevarisc("107.10.5.30", "3306", "pdo_sqlite");

$em->persist($user);
//$em->persist($prevarisc);
$em->flush();
