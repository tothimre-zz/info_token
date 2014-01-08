<?php
use InfoToken\Hashers\Hashids\Factory\HashsidsFactory;
use InfoToken\Hashers\Hashids\HasherConstructorValues;
use InfoToken\TimeInterval;
use InfoToken\HashJugglers\Creator;
use InfoToken\Hashers\Hashids\Hasher\HashidsCrypter;

class HashidsCrypterTest extends \PHPUnit_Framework_TestCase
{
    const DEF_INTERVAL = 5;

    public function testCreate(){
        $HashidsConstructorValues = new HasherConstructorValues();
        $interval = new TimeInterval(self::DEF_INTERVAL);
        $hasherFactory = new HashsidsFactory();
        $hasher = $hasherFactory->getEncryptHasher($HashidsConstructorValues, $interval);
        $hash = $hasher->encrypt(array(123456, 123457, 123458));
        $this->assertNotEquals('', $hash);
    }
} 