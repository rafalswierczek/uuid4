<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4\Test;

use Exception;
use PHPUnit\Framework\TestCase;
use rafalswierczek\Uuid4\Uuid4;
use rafalswierczek\Uuid4\Uuid4Binary;
use rafalswierczek\Uuid4\Uuid4Factory;
use rafalswierczek\Uuid4\Uuid4Interface;

final class UsageTest extends TestCase
{
    public function testUsage(): void
    {
        $uuid4 = Uuid4Factory::create();

        $uuid4 = new Uuid4('f3d7fa06-d938-4c22-9505-c585efa381df');

        $uuid4 = new Uuid4(Uuid4Factory::createBinary()->toHex());

        $uuid4 = new Uuid4(Uuid4Factory::create()->toHex());

        $uuid4Binary = Uuid4Factory::createBinary();

        $uuid4Binary = new Uuid4Binary(random_bytes(16));

        $uuid4Binary = new Uuid4Binary(Uuid4Factory::createBinary()->toBinary());

        $uuid4Binary = new Uuid4Binary(Uuid4Factory::create()->toBinary());

        // example 1:
        $userClass = new class()
        {
            private Uuid4Interface $uuid4;

            public function getUuid(bool $toHex = true): string
            {
                return $toHex ? $this->uuid4->toHex() : $this->uuid4->toBinary();
            }

            public function setUuid(Uuid4Interface $uuid4): void
            {
                $this->uuid4 = $uuid4;
            }
        };

        $userClass->setUuid(Uuid4Factory::createBinary());
        $uuid4 = $userClass->getUuid(toHex: true); // hex format

        $this->assertNull(Uuid4::validate($uuid4));

        // example 2:
        $this->expectException(Exception::class);

        $unknownSource = 'f3d7fa06-d938-4c22-9505-c585efaxxxxx';
        Uuid4::validate($unknownSource);

        // example 3:
        $uuid4 = new Uuid4('f3d7fa06-d938-4c22-9505-c585efa381df'); // this also calls validate method because it is VO
        $uuid4Binary = new Uuid4Binary($uuid4->toBinary());         // this also calls validate method because it is VO
        $hexEqualsBin = $uuid4->equals($uuid4Binary);
        $binEqualsHex = $uuid4Binary->equals($uuid4);

        $this->assertTrue($hexEqualsBin);
        $this->assertTrue($binEqualsHex);
    }
}
