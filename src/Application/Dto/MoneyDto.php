<?php

declare(strict_types = 1);

namespace App\Application\Dto;

class MoneyDto
{
    /** @var mixed */
    public $amount;

    /** @var string */
    public $currency;

    /**
     * @param string $amount
     * @param string $currency
     * @return MoneyDto
     */
    public static function create(string $amount, string $currency): self
    {
        $dto = new self();
        $dto->amount = $amount;
        $dto->currency = $currency;

        return $dto;
    }
}
