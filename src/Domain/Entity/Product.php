<?php

declare(strict_types = 1);

namespace App\Domain\Entity;

use App\Domain\Exception\DomainException;
use App\Domain\ValueObject\Identity;
use App\Domain\ValueObject\Money;

class Product
{
    /** @var int */
    private $id;    // this field is only for doctrine, in domain we must not use this field

    /** @var string */
    private $identity;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var int */
    private $price;

    /** @var string */
    private $currency;

    /**
     * @param Identity $identity
     * @param string $name
     * @param string $description
     * @param Money $price
     *
     * @throws DomainException
     */
    public function __construct(
        Identity $identity,
        string $name,
        string $description,
        Money $price
    ) {
        $this->setIdentity($identity);
        $this->setName($name);
        $this->setDescription($description);
        $this->setPrice($price);
    }

    /**
     * @return Identity
     */
    public function identity(): Identity
    {
        return new Identity($this->identity);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }



    /**
     * @param string $description
     *
     * @throws DomainException
     */
    private function setDescription(string $description): void
    {
        $nameLength = strlen($description);
        if ($nameLength < 100) {
            throw DomainException::invalidArgumentException('description');
        }
        $this->description = $description;
    }

    /**
     * @param Identity $identity
     */
    private function setIdentity(Identity $identity): void
    {
        $this->identity = $identity->getIdentity();
    }

    /**
     * @param string $name
     *
     * @throws DomainException
     */
    private function setName(string $name): void
    {
        $nameLength = strlen($name);
        if ($nameLength <= 0) {
            throw DomainException::invalidArgumentException('name');
        }

        $this->name = $name;
    }

    /**
     * @param Money $money
     */
    private function setPrice(Money $money): void
    {
        $this->price = (int) $money->amount();
        $this->currency = $money->currency();
    }
}
