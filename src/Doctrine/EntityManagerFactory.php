<?php

declare(strict_types = 1);

namespace App\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{

    public static function create(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../'], true);
        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        return EntityManager::create([
            'driver' => 'pdo_mysql',
            'host' => 'shipmonk-packing-mysql',
            'user' => 'root',
            'password' => 'secret',
            'dbname' => 'packing',
        ], $config);
    }

}
