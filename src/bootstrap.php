<?php

declare(strict_types = 1);

use Symfony\Component\Config\FileLocator;

require __DIR__ . '/../vendor/autoload.php';


$containerBuilder = new \Symfony\Component\DependencyInjection\ContainerBuilder();
$loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader(
    $containerBuilder,
    new FileLocator(__DIR__)
);
$loader->load(__DIR__ . '/../config/services.yaml');

$containerBuilder->compile();

return $containerBuilder;
