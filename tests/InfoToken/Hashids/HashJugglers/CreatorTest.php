<?php

use InfoToken\Hashids\Container\HashidsContainers;
use InfoToken\Hashids\Factory\HashsidsFactory;
use InfoToken\HashidsConstructorValues;
use InfoToken\TimeInterval;
use InfoToken\Hashids\HashJugglers\Creator;

class CreatorTest extends \PHPUnit_Framework_TestCase
{
    const DEF_INTERVAL = 5;

    public function testCreate(){
        $HashidsConstructorValues = new HashidsConstructorValues();
        $interval = new TimeInterval(self::DEF_INTERVAL);
        $hasher = HashsidsFactory::getEncryptHashids($HashidsConstructorValues, $interval);
        $this->assertNotEquals('',Creator::create($hasher,array(123456, 123457, 123458)));
    }
} 