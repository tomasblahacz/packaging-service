<?php

declare(strict_types = 1);

namespace App\Jms;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class SerializerFactory
{

    public static function create(): Serializer
    {
        return SerializerBuilder::create()->build();
    }

}
