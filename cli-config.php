<?php

require_once 'vendor/autoload.php';

use App\Container;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;

$connexion = require 'config.php';


$config = new PhpFile(__DIR__.'/configOrm/migrations.php');


$dbParams = $connexion['db'];
$em_config = $connexion['em_config'];
$connection = DriverManager::getConnection($dbParams, $em_config);

$entityManager = new EntityManager($connection, $em_config);

assert($entityManager instanceof EntityManager);

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));


