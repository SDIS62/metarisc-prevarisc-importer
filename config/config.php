<?php

use Dotenv\Dotenv;
use Doctrine\ORM\ORMSetup;

require __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/../');
$dotenv->safeLoad();

return [
    'em_conn' => [
        'driver'  => getenv('DB_DRIVER'),
        'host'    => getenv('DB_HOST'),
        'user'    => getenv('DB_USER'),
        'password'=> getenv('DB_PASS'),
        'port'    => getenv('DB_PORT'),
        'dbname'  => getenv('DB_DATABASE'),
    ],
    'em_config' => ORMSetup::createXMLMetadataConfiguration([
        __DIR__,
    ],
    true
    )

];
