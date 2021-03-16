
<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\{EntityManager, EntityManagerInterface};
use Psr\Container\ContainerInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;

function getEntityManager (ContainerInterface $container): EntityManagerInterface {
    $doctrineSettings = $container->get('settings')['doctrine'];

    $config = Setup::createAnnotationMetadataConfiguration(
        $doctrineSettings['metadata_dirs'],
        $doctrineSettings['dev_mode']
    );

    $paths = [__DIR__ . '/../src/Entities'];
    $driver = new AnnotationDriver(new AnnotationReader(), $paths);
    // registering noop annotation autoloader - allow all annotations by default
    AnnotationRegistry::registerLoader('class_exists');
    $config->setMetadataDriverImpl($driver);

    return EntityManager::create($doctrineSettings['connection'], $config);
};