<?php

declare(strict_types = 1);

namespace App\Infrastructure\Query;

use Doctrine\DBAL\Connection;

abstract class AbstractQuery
{
    /** @var Connection */
    protected $dbal;

    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }
}