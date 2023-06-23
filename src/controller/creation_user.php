<?php
require __DIR__ . '/../../bootstrap.php';

require '/../../vendor/autoload.php';


use Entity\User;
use Doctrine\ORM\EntityManager;

$entityManager= EntityManager::create($connectionOptions, $config);


$nameuser = $argv[1];

$user = new User();
$user->setUsername("nassim");

$entityManager->persist($user);
$entityManager->flush();

echo "Created User with ID " . $user->getId() . "\n";

