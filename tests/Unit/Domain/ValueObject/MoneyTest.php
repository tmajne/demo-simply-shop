<?php

declare(strict_types = 1);

namespace App\Tests\Unit\Domain\Category\ValueObject;

use App\Domain\ValueObject\Money;
use App\Tests\Unit\UnitTestCase;
use ArgumentCountError;

class MoneyTest extends UnitTestCase
{
    /**
     * @expectedException ArgumentCountError
     * @expectedExceptionMessageRegExp  /Too few arguments to function \w+/
     */
    public function testCreateMoneyNoArguments()
    {
        new Money();
    }

    public function testCreateMoney()
    {
        $faker = $this->getFaker();
        $amount = $faker->randomDigitNotNull;
        $currency = $faker->currencyCode;

        $money = new Money($amount, $currency);

        $this->assertEquals($amount, $money->amount());
        $this->assertEquals($currency, $money->currency());
    }

    /**
     * @expectedException App\Domain\Exception\DomainException
     * @expectedExceptionMessage Invalid value for argument: price amount
     */
    public function testMoneyAmountValidation()
    {
        $faker = $this->getFaker();
        $amount = -1;
        $currency = $faker->currencyCode;

        new Money($amount, $currency);
    }
}
