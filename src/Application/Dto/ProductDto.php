<?php

declare(strict_types = 1);

namespace App\Application\Dto;

final class ProductDto
{
    /** @var string */
    public $identity;

    /** @var string */
    public $name;

    /** @var string */
    public $description;

    /** @var int */
    public $price;

    /** @var string */
    public $currency;

    /**
     * @param string $identity
     * @param string $name
     * @param null|string $description
     * @param float $price
     * @param string $currency
     * @return ProductDto
     */
    public static function create(
        string $identity,
        string $name,
        ?string $description,
        float $price,
        string $currency
    ): self {

        $dto = new self();
        $dto->identity = $identity;
        $dto->name = $name;
        $dto->description = $description;
        $dto->price = $price;
        $dto->currency = $currency;

        return $dto;
    }
}
