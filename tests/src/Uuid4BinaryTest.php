<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4\Test;

use PHPUnit\Framework\TestCase;
use rafalswierczek\Uuid4\Uuid4;
use rafalswierczek\Uuid4\Uuid4Binary;

final class Uuid4BinaryTest extends TestCase
{
    public function testNewInstanceAsString(): void
    {
        $uuid4Binary = (new Uuid4(Uuid4Test::VALID_UUID4))->toBinary();
        
        $this->assertSame($uuid4Binary->get(), "$uuid4Binary");
    }

    public function testEquals(): void
    {
        $uuid4 = new Uuid4(Uuid4Test::VALID_UUID4);
        $validUuid4Binary = $uuid4->toBinary()->get();

        $uuid4BinaryA = new Uuid4Binary($validUuid4Binary);
        $uuid4BinaryB = new Uuid4Binary($validUuid4Binary);

        $this->assertTrue($uuid4BinaryA->equals($uuid4BinaryB));
        $this->assertTrue($uuid4BinaryA->equals($uuid4));
    }

    public function testInvalidUuid(): void
    {
        $this->expectException(\Exception::class);

        new Uuid4Binary('abc');
    }
}
