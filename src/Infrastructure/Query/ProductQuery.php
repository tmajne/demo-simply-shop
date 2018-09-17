<?php

declare(strict_types = 1);

namespace App\Infrastructure\Query;

use App\Application\Dto\ProductDto;
use App\Application\Query\ProductQueryInterface;
use Doctrine\DBAL\Connection;

class ProductQuery extends AbstractQuery implements ProductQueryInterface
{
    private const DEFAULT_ORDER_BY = ['name' => 'ASC'];

    /** @var string */
    private $table = 'product';

    /**
     * @inheritdoc
     */
    public function count(array $criteria = []): int
    {
        $query = $this->dbal->createQueryBuilder();
        $query->from($this->table)
            ->select('COUNT(id) as count');

        return (int)$query->execute()->fetchColumn();
    }

    /**
     * @inheritdoc
     */
    public function findAll(array $criteria = [], array $orderBy = null, int $offset = null, int $limit = null): array
    {
        $orderBy = $orderBy ?? static::DEFAULT_ORDER_BY;
        $products = [];

        $query = $this->dbal->createQueryBuilder();
        $query->select('p.*')
            ->from($this->table, 'p')
            ->setFirstResult($offset ?? 0)
            ->orderBy('p.'.key($orderBy), current($orderBy));

        if ($limit) {
            $query->setMaxResults($limit);
        }

        $data = $query->execute()->fetchAll();

        foreach ($data as $row) {
            $products[] = $this->createProductDto($row);
        }

        return $products;
    }

    private function createProductDto(array $data): ProductDto
    {
        return ProductDto::create(
            $data['identity'],
            $data['name'],
            $data['description'],
            $data['price'] / 100,
            $data['currency']
        );
    }
}
