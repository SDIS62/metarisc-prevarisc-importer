<?php

use Doctrine\ORM\ORMSetup;

require 'vendor/autoload.php';

return [
    'db' => [
        'driver' => 'pdo_mysql',
        'host' => 'host.docker.internal',
        'dbname' => 'liaison-meta-preva',
        'user' => 'root',
        'password' => 'XXXX'

    ],
    'em_config' => ORMSetup::createXMLMetadataConfiguration([
        __DIR__.'/configOrm'
    ],
    true
    )

];
