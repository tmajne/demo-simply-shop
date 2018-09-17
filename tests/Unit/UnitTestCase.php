<?php

declare(strict_types = 1);

namespace App\Tests\Unit;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    /**
     * @param string $locale
     * @return Generator
     */
    public function getFaker(string $locale = Factory::DEFAULT_LOCALE): Generator
    {
        return Factory::create($locale);
    }
}
