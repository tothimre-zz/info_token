<?php
namespace InfoToken\Hashers\Hashids\Factory;

use Hashids\Hashids;
use InfoToken\Hashers\CrypterInterface;
use InfoToken\Hashers\Hashids\Hasher\HashidsCrypter;
use InfoToken\Hashers\Hashids\HasherConstructorValues;
use InfoToken\TimeInterval;

class HashsidsFactory
{
    const ACTUAL_INTERVAL_START_INDEX = 0;
    const PREVIOUS_INTERVAL_START_INDEX = 1;

    public static function getDecryptHashids(HasherConstructorValues $hashidConstructorValues, TimeInterval $timeinterval)
    {
        return array(self::ACTUAL_INTERVAL_START_INDEX =>new Hashids($hashidConstructorValues->getSalt().$timeinterval->getIntervalStartTime(),
                $hashidConstructorValues->getMinHashLength(), $hashidConstructorValues->getAlphabet()),
            self::PREVIOUS_INTERVAL_START_INDEX =>new Hashids($hashidConstructorValues->getSalt().$timeinterval->getPreviousIntervalStartTime(),
                    $hashidConstructorValues->getMinHashLength(), $hashidConstructorValues->getAlphabet())
        );
    }

    /**
     * @param HasherConstructorValues $hashidConstructorValues
     * @param TimeInterval $timeinterval
     * @return CrypterInterface HashidsCrypter
     */
    public static function getEncryptHashids(HasherConstructorValues $hashidConstructorValues, TimeInterval $timeinterval)
    {
        $hashid =  new Hashids($hashidConstructorValues->getSalt().$timeinterval->getIntervalStartTime(),
                           $hashidConstructorValues->getMinHashLength(), $hashidConstructorValues->getAlphabet());


        $crypter = new HashidsCrypter();
        $crypter->setCrypter($hashid);
        $crypter->setSalt($hashidConstructorValues->getSalt().$timeinterval->getIntervalStartTime());

        return $crypter;
    }

}