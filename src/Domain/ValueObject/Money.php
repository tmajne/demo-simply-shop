<?php

declare(strict_types = 1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\DomainException;

class Money
{
    /** @var int */
    private $amount;

    /** @var string */
    private $currency;

    /**
     * @param int $amount
     * @param string $currency
     *
     * @throws DomainException
     */
    public function __construct(int $amount, string $currency)
    {
        $this->setAmount($amount);
        $this->setCurrency($currency);
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    /**
     * @param int $amount
     *
     * @throws DomainException
     */
    private function setAmount(int $amount): void
    {
        $this->validAmount($amount);
        $this->amount = $amount;
    }

    /**
     * @param string $currency
     */
    private function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @param int $amount
     *
     * @throws DomainException
     */
    private function validAmount(int $amount): void
    {
        if ($amount < 0) {
            throw DomainException::invalidArgumentException('price amount');
        }
    }
}
