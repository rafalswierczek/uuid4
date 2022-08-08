# Super simple UUID v4 generator in PHP

> RFC: https://datatracker.ietf.org/doc/html/rfc4122#section-4.4

## Installation:

> composer require rafalswierczek/uuid4

## Explanation:

UUID v4 is data of 128 random bits (with small modifications) represented in hexadecimal notation.

Data is divided into 16 octets (from 0 to 15), 8 bits each.

Octets are grouped into sections with following names:

* time_low (octets 0-3)
* time_mid (octets 4-5)
* time_high_and_version (octets 6-7)
* clock_seq_and_reserved (octet 8)
* clock_seq_low (octet 9)
* node (octets 10-15)

Result of UUID in hex notation looks like this:

`time_low`-`time_mid`-`time_high_and_version`-`clock_seq_and_reserved clock_seq_low`-`node`

example:

`f2e0aa63-22f2-410c-bcfa-9475cf573193`

As you can see, for example `time_low` has 4 octets, each is as follows `f2`, `e0`, `aa`, `63` in hex notation.

Now once you have 128 random bits, you have to modify octet 8 in the way that two most significant bits (MSB) are set to: `0` and `1`. For example, let's say 8 octet is as follows: `01101101`. Now you have to make sure that two bits on the left are `00` and then you can add desired `10` so the result is: `10101101`. It's done this way:

`01101101` & `00111111` = `00101101`

`00101101` | `10000000` = `10101101`

Once clock_seq_and_reserved is updated it's time to modify octet 6 (first 8 bits of time_high_and_version). You have to do the same steps but with `00001111` for AND and `01000000` for OR. For example if octet 6 is `10100101`, the result is `01000101` so first 4 bits are replaced with `0100` which are bits reserved for UUID v4.

After modifying octet 8 and 6 of 128 random bits and converting it to hex notation you have ready to use UUID v4 string :)
