<?php

declare(strict_types = 1);

namespace App\Domain\Repository;

use App\Domain\Entity\Product;
use App\Domain\Exception\DomainException;

interface ProductRepositoryInterface
{
    /**
     * @param Product $product
     *
     * @throws DomainException
     */
    public function add(Product $product): void;
}
