<?php

declare(strict_types = 1);

namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

class Identity
{
    private $identity;

    /**
     * @param $identity
     */
    public function __construct($identity)
    {
        $this->setIdentity($identity);
    }

    /**
     * @return Identity
     *
     * @throws \Exception
     */
    public static function create(): self
    {
        return new self((string) Uuid::uuid4());
    }

    /**
     * @param Identity $identity
     * @return bool
     */
    public function equal(Identity $identity): bool
    {
        return $this->identity === $identity->getIdentity();
    }

    /**
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->identity;
    }

    /**
     * @param $identity
     */
    private function setIdentity($identity): void
    {
        $this->identity = $identity;
    }
}
