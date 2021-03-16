<?php

namespace App\Tests;

use App\Tests\TestEnv;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Exception;

class EntityManagerTest extends TestEnv
{

/**
     * @return EntityManager
     * @throws Exception
     */
    public function getEntityManager(): EntityManager
    {
        try {
            $paths = [__DIR__ . '/../src/Entities'];
            $config = Setup::createAnnotationMetadataConfiguration($paths, false);
            $config->newDefaultAnnotationDriver(__DIR__ . '/../src/Entities');
            $cache = new ArrayCache();
            $config->setProxyNamespace("App\\Proxies\\");
            $config->setQueryCacheImpl($cache);
            $config->setAutoGenerateProxyClasses(true);

            $driver = new AnnotationDriver(new AnnotationReader(), $paths);
            // registering noop annotation autoloader - allow all annotations by default
            AnnotationRegistry::registerLoader('class_exists');
            $config->setMetadataDriverImpl($driver);

            // var_dump($this->getConfigDatabase()); die;

            return EntityManager::create($this->getConfigDatabase(), $config);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function getConfigDatabase(): array
    {
        return [
            'driver' => $_ENV['DB_DRIVER'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8mb4'
        ];
    }

}