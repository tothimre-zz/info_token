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

    public function getDecryptHashers(HasherConstructorValues $hashidConstructorValues, TimeInterval $timeinterval)
    {
        return array(
            $this->getHashid($hashidConstructorValues, $timeinterval->getIntervalStartTime()),
            $this->getHashid($hashidConstructorValues, $timeinterval->getPreviousIntervalStartTime()),
        );
    }

    /**
     * @param HasherConstructorValues $hasherConstructorValues
     * @param TimeInterval $timeinterval
     * @return CrypterInterface HashidsCrypter
     */
    public function getEncryptHasher(HasherConstructorValues $hasherConstructorValues, TimeInterval $timeinterval)
    {
//      $hashid =  $this->getHashid($hasherConstructorValues, $timeinterval->getIntervalStartTime());
        $crypter = new HashidsCrypter();
        $crypter->setCrypter($hasherConstructorValues);
        $crypter->setSalt($hasherConstructorValues->getSalt().$timeinterval->getIntervalStartTime());

        return $crypter;
    }

    /**
     * @param HasherConstructorValues $hashidConstructorValues
     * @param $timestamp
     * @return Hashids
     */
    protected function getHashid(HasherConstructorValues $hashidConstructorValues, $timestamp)
    {
        return  new Hashids($hashidConstructorValues->getSalt().$timestamp,
                            $hashidConstructorValues->getMinHashLength(),
                            $hashidConstructorValues->getAlphabet());
    }

}