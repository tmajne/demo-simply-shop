<?php

declare(strict_types = 1);

namespace App\Application\Generator;

use Exception;
use Ramsey\Uuid\Uuid;

class IdentityGenerator
{
    /**
     * @return string
     *
     * @throws Exception
     */
    public static function uuid(): string
    {
        return (string) Uuid::uuid4();
    }
}
