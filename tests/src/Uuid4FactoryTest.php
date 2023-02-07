<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4\Test;

use PHPUnit\Framework\TestCase;
use rafalswierczek\Uuid4\Uuid4Factory;

final class Uuid4FactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $uuid4 = Uuid4Factory::create();

        $this->assertNotNull($uuid4);
    }

    public function testCreateBinary(): void
    {
        $uuid4Binary = Uuid4Factory::createBinary();

        $this->assertNotNull($uuid4Binary);
    }
}
