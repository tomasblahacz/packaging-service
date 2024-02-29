<?php

declare(strict_types = 1);

namespace App\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LoggerFactory
{

    public static function create(): LoggerInterface
    {
        $logger = new Logger('name');
        // @todo move path to yaml
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../log/log'));

        return $logger;
    }

}
