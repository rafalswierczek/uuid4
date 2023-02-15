<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4;

final class Uuid4 implements Uuid4Interface
{
    public function __construct(private string $uuid4)
    {
        self::validate($uuid4);
    }

    public function __toString(): string
    {
        return $this->uuid4;
    }

    public function toHex(): string
    {
        return $this->uuid4;
    }
    
    public function toBinary(): string
    {
        $hexString = str_replace('-', '', $this->uuid4);
        
        return pack('H*', $hexString);
    }

    public function equals(Uuid4Interface $uuid4): bool
    {
        return strtolower($uuid4->toHex()) === strtolower($this->uuid4);
    }

    public static function validate(string $uuid4): void
    {
        if (!preg_match("/^[0-9a-f]{8}\-[0-9a-f]{4}\-4[0-9a-f]{3}\-[89ab][0-9a-f]{3}\-[0-9a-f]{12}$/", $uuid4)) {
            throw new \Exception('Invalid UUID v4 format');
        }
    }
}
