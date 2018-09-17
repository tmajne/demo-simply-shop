<?php

declare(strict_types = 1);

namespace App\Application\Command;

use App\Application\Dto\ProductDto;
use App\Application\Exception\CommandException;

class CreateProduct
{
    /** @var ProductDto */
    private $dto;

    private $identity;

    /**
     * @param string $identity
     * @param ProductDto $dto
     *
     * @throws CommandException
     */
    public function __construct(string $identity, ProductDto $dto)
    {
        $this->setIdentity($identity);
        $this->setProductDto($dto);
    }

    /**
     * @return ProductDto
     */
    public function getProductDto(): ProductDto
    {
        return $this->dto;
    }

    /**
     * @return string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @param ProductDto $dto
     *
     * @throws CommandException
     */
    private function setProductDto(ProductDto $dto): void
    {
        $this->validate($dto);
        $this->dto = $dto;
    }

    /**
     * @param string $identity
     */
    private function setIdentity(string $identity): void
    {
        $this->identity = $identity;
    }

    /**
     * @param ProductDto $dto
     *
     * @throws CommandException
     */
    private function validate(ProductDto $dto): void
    {
        if (empty($dto->name)) {
            throw CommandException::invalidDataError(static::class);
        }
    }
}
