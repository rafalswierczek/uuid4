<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4;

interface Uuid4Interface
{
    public function __toString(): string;

    public function get(): string;

    public function equals(Uuid4Interface $uuid4): bool;
}
