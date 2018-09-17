<?php

declare(strict_types = 1);

namespace App\Application\Query;

use App\Application\Dto\ProductDto;
use App\Application\Exception\DataNotFoundException;

interface ProductQueryInterface
{
    /**
     * @param array $criteria
     *
     * @return int
     */
    public function count(array $criteria = []): int;

    /**
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $offset
     * @param int|null   $limit
     * @return ProductDto[]
     */
    public function findAll(array $criteria = [], array $orderBy = null, int $offset = null, int $limit = null): array;
}
