<?php

declare(strict_types = 1);

namespace App\Domain\Exception;

class DomainException extends \Exception
{
    final public static function createError(\Throwable $e): self
    {
        return new self("Create error", 0, $e);
    }

    final public static function invalidArgumentException(string $name): self
    {
        return new self("Invalid value for argument: $name");
    }
}
