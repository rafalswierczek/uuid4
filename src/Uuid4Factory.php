<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4;

/**
 * RFC: https://datatracker.ietf.org/doc/html/rfc4122#section-4.4
 */
final class Uuid4Factory
{
    public static function create(): Uuid4
    {
        $bytes = random_bytes(16);
        
        // set 2 MSB of clock_seq_hi_and_reserved to 00 in octet 8 | keep 6 LSB the same
        $reset_clock_seq_hi_and_reserved = ord($bytes[8]) & 0x3F;
        
        // add 10 to 2 MSB | keep 6 LSB the same
        $bytes[8] = chr($reset_clock_seq_hi_and_reserved | 0x80);
        
        // set 4 MSB of time_hi_and_version to 0000 in octet 6 | keep 4 LSB the same 
        $reset_time_hi_and_version = ord($bytes[6]) & 0x0F;
        
        // add 0100 to 4 MSB | keep 4 LSB the same 
        $bytes[6] = chr($reset_time_hi_and_version | 0x40);
        
        $hexString = bin2hex($bytes);
        
        $uuid4 = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split($hexString, 4));
        
        return new Uuid4($uuid4);
    }
    
    public static function createBinary(): Uuid4Binary
    {
        $uuid4 = self::create();
        
        return $uuid4->toBinary();
    }
}
