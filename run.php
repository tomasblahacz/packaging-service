<?php

use App\Application;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;

$containerBuilder = require __DIR__ . '/src/bootstrap.php';

$request = new Request('POST', new Uri('http://localhost/pack'), ['Content-Type' => 'application/json'], $argv[1]);

/** @var Application $application */
$application = $containerBuilder->get(Application::class);
$response = $application->run($request);

echo "<<< In:\n" . Message::toString($request) . "\n\n";
echo ">>> Out:\n" . Message::toString($response) . "\n\n";
