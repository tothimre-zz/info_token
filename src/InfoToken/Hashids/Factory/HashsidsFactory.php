<?php
namespace InfoToken\Hashids\Factory;

use Hashids\Hashids;
use InfoToken\HashidsConstructorValues;
use InfoToken\TimeInterval;

class HashsidsFactory
{
    const ACTUAL_INTERVAL_START_INDEX = 0;
    const PREVIOUS_INTERVAL_START_INDEX = 1;

    public static function getDecryptHashids(HashidsConstructorValues $hashidConstructorValues, TimeInterval $timeinterval)
    {
        return array(self::ACTUAL_INTERVAL_START_INDEX =>new Hashids($hashidConstructorValues->getSalt().$timeinterval->getIntervalStartTime(),
                $hashidConstructorValues->getMinHashLength(), $hashidConstructorValues->getAlphabet()),
            self::PREVIOUS_INTERVAL_START_INDEX =>new Hashids($hashidConstructorValues->getSalt().$timeinterval->getPreviousIntervalStartTime(),
                    $hashidConstructorValues->getMinHashLength(), $hashidConstructorValues->getAlphabet())
        );
    }

    public static function getEncryptHashids(HashidsConstructorValues $hashidConstructorValues, TimeInterval $timeinterval)
    {
        return new Hashids($hashidConstructorValues->getSalt().$timeinterval->getIntervalStartTime(),
                           $hashidConstructorValues->getMinHashLength(), $hashidConstructorValues->getAlphabet());
    }

}