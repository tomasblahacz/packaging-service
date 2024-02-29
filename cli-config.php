<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$containerBuilder = require_once __DIR__ . '/src/bootstrap.php';
$entityManager = $containerBuilder->get(\Doctrine\ORM\EntityManager::class);

return ConsoleRunner::createHelperSet($entityManager); // needed by vendor/bin/doctrine

