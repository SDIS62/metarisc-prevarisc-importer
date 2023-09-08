<?php

namespace App;

use Laminas;
use GuzzleHttp;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use App\Service\EvenementService;
use Psr\Http\Client\ClientInterface;
use Psr\Container\ContainerInterface;
use App\Repository\EvenementRepository;
use Laminas\Di\Container\ConfigFactory;
use Psr\Http\Message\UriFactoryInterface;
use Laminas\ServiceManager\ServiceManager;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Prevarisc\Container\Factory\FractalisticFactory;

class Container extends ServiceManager
{
    public static function initWithDefaults(array $options = []) : self
    {
        // Setup service manager
        $params = [
            'services' => [
                'config' => $options,
            ],
            'invokables' => [
                // PSR-17 HTTP Message Factories
                RequestFactoryInterface::class => GuzzleHttp\Psr7\HttpFactory::class,
                ServerRequestFactoryInterface::class => GuzzleHttp\Psr7\HttpFactory::class,
                ResponseFactoryInterface::class => GuzzleHttp\Psr7\HttpFactory::class,
                StreamFactoryInterface::class => GuzzleHttp\Psr7\HttpFactory::class,
                UploadedFileFactoryInterface::class => GuzzleHttp\Psr7\HttpFactory::class,
                UriFactoryInterface::class => GuzzleHttp\Psr7\HttpFactory::class,

                // PSR-18 HTTP Client implementations
                ClientInterface::class => GuzzleHttp\Client::class,
            ],
            'factories' => [
                Laminas\Di\ConfigInterface::class => ConfigFactory::class,
                Laminas\Di\InjectorInterface::class => Laminas\Di\Container\InjectorFactory::class,
            ],
        ];

        $container = new self($params);

        $container->setFactory(
            EntityManager::class,
            function (ContainerInterface $container) {
                $config = $container->get('config');
                \assert(\is_array($config));

                /** @var array{charset?:string} $em_conn */
                $em_conn = $config['em_conn'];
                $em_config = $config['em_config'];
                \assert($em_config instanceof Configuration);

                /** @psalm-param Connection $connection */
                $connection = DriverManager::getConnection($em_conn, $em_config);

                return new EntityManager(
                    $connection,
                    $em_config
                );
            }
        );

        return $container;
    }
}