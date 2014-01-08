<?php
use InfoToken\Hashers\Hashids\Factory\HashsidsFactory;
use InfoToken\Hashers\Hashids\HasherConstructorValues;
use InfoToken\TimeInterval;
use InfoToken\Hashers\Hashids\HashJugglers\Creator;

class CreatorTest extends \PHPUnit_Framework_TestCase
{
    const DEF_INTERVAL = 5;

    public function testCreate(){
        $HashidsConstructorValues = new HasherConstructorValues();
        $interval = new TimeInterval(self::DEF_INTERVAL);
        $hasher = HashsidsFactory::getEncryptHashids($HashidsConstructorValues, $interval);
        $hash = $hasher->encrypt(array(123456, 123457, 123458));
        $this->assertNotEquals('', $hash);

    }
} 