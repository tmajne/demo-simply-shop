<?php

declare(strict_types = 1);

namespace App\Tests\Unit\Domain\Category\Entity;

use App\Domain\Entity\Product;
use App\Domain\ValueObject\Identity;
use App\Domain\ValueObject\Money;
use App\Tests\Unit\UnitTestCase;
use ArgumentCountError;

class ProductTest extends UnitTestCase
{
    /**
     * @expectedException ArgumentCountError
     * @expectedExceptionMessageRegExp  /Too few arguments to function \w+/
     */
    public function testCreateProductNoArguments()
    {
        new Product();
    }

    public function testCreateProduct()
    {
        $faker = $this->getFaker();

        $identity = new Identity($faker->uuid);
        $name = $faker->text(12);
        $description = $faker->sentence(100);

        $money = new Money($faker->randomDigitNotNull, $faker->currencyCode);

        $product = new Product($identity, $name, $description, $money);

        $this->assertEquals($name, $product->name());
        $this->assertEquals($description, $product->description());
    }

    /**
     * @expectedException App\Domain\Exception\DomainException
     * @expectedExceptionMessage Invalid value for argument: description
     */
    public function testProductNameValidation()
    {
        $faker = $this->getFaker();

        $identity = new Identity($faker->uuid);
        $name = $faker->text(33);
        $description = $faker->text(99);
        $money = new Money($faker->randomDigitNotNull, $faker->currencyCode);

        new Product($identity, $name, $description, $money);
    }

    /**
     * @expectedException App\Domain\Exception\DomainException
     * @expectedExceptionMessage Invalid value for argument: name
     */
    public function testProductDescriptionValidation()
    {
        $faker = $this->getFaker();

        $identity = new Identity($faker->uuid);
        $name = '';
        $description = $faker->sentence(100);
        $money = new Money($faker->randomDigitNotNull, $faker->currencyCode);

        new Product($identity, $name, $description, $money);
    }
}
