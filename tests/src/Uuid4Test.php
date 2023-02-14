<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4\Test;

use rafalswierczek\Uuid4\Uuid4;
use PHPUnit\Framework\TestCase;
use rafalswierczek\Uuid4\Uuid4Binary;

final class Uuid4Test extends TestCase
{
    public const VALID_UUID4 = 'f3d7fa06-d938-4c22-9505-c585efa381df';

    public function testNewInstanceAsString(): void
    {
        $uuid4 = new Uuid4(self::VALID_UUID4);

        $this->assertSame(self::VALID_UUID4, "$uuid4");
    }

    public function testEquals(): void
    {
        $uuid4A = new Uuid4(self::VALID_UUID4);
        $uuid4B = new Uuid4(self::VALID_UUID4);
        $uuid4Binary = new Uuid4Binary($uuid4A->toBinary()->get());

        $this->assertTrue($uuid4A->equals($uuid4B));
        $this->assertTrue($uuid4A->equals($uuid4Binary));
    }

    public function testInvalidUuid(): void
    {
        $this->expectException(\Exception::class);

        new Uuid4('f3d7fa06-d938-4c22-9505-c585efa381dx');
    }
}
