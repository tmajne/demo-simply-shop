<?php

declare(strict_types = 1);

namespace App\Application\Exception;

final class CommandException extends ApplicationException
{
    public static function invalidDataError(string $commandClass): self
    {
        return new self("Command: $commandClass contains invalid data");
    }
}
