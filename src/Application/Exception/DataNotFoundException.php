<?php

declare(strict_types = 1);

namespace App\Application\Exception;

final class DataNotFoundException extends ApplicationException
{
    public static function productNotFound(): self
    {
        return new self('Product not found');
    }
}
