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
        $binary = (new Uuid4(Uuid4Test::VALID_UUID4))->toBinary();
        $uuid4Binary = new Uuid4Binary($binary);
        
        $this->assertSame($uuid4Binary->toBinary(), "$uuid4Binary");
    }

    public function testEquals(): void
    {
        $uuid4 = new Uuid4(Uuid4Test::VALID_UUID4);
        $binary = $uuid4->toBinary();

        $uuid4BinaryA = new Uuid4Binary($binary);
        $uuid4BinaryB = new Uuid4Binary($binary);

        $this->assertTrue($uuid4BinaryA->equals($uuid4BinaryB));
        $this->assertTrue($uuid4BinaryA->equals($uuid4));
    }

    public function testInvalidUuid(): void
    {
        $this->expectException(\Exception::class);

        new Uuid4Binary('abc');
    }
}
