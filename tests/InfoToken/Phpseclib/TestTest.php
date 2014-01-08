<?php

class TestTest extends \PHPUnit_Framework_TestCase
{
    public function testTest()
    {
        $cipher = new Crypt_DES(); // could use CRYPT_DES_MODE_CBC
        $cipher->setPassword('whateverrljdlfsg lkfjdhgdklfhg ldfhgl dfgl dfkjgh lkdfjg dfljg lfkjhglkdjfhg kljdfhgl kjdfhlg kj');

        $size = 3 * 1024;
        $plaintext = str_repeat('abc', $size);
        $plaintext = "123456789012345678901234567890123456789012345678901234567890";
        $encrypted = base64_encode($cipher->encrypt($plaintext));

        echo $encrypted, "\n\n", $cipher->decrypt(base64_decode($encrypted)), "\n";
    }
} 