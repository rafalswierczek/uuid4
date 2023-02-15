<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4;

interface Uuid4Interface
{
    public function __toString(): string;

    public function toHex(): string;

    public function toBinary(): string;

    public function equals(Uuid4Interface $uuid4): bool;
}
