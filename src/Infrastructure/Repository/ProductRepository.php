<?php

declare(strict_types = 1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Product;
use App\Domain\Exception\DomainException;
use App\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Throwable;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @inheritdoc
     */
    public function add(Product $product): void
    {
        try {
            $em = $this->getEntityManager();
            $em->persist($product);
        } catch (Throwable $e) {
            throw DomainException::createError($e);
        }
    }
}
