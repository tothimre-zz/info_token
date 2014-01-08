<?php
namespace InfoToken;

class InfoToken
{
    /**
     * @var \InfoToken\Hashers\Hashids\HasherConstructorValues
     */
    protected $hashidsConstructorValues;

    /**
     * @var TimeInterval
     */
    protected $timeIntervalCalculator;

    public function __construct(TimeInterval $timeIntervalCalculator, HashidsConstructorValues $hashidsConstructor = null)
    {
        $this->timeIntervalCalculator = $timeIntervalCalculator;

        if(!$hashidsConstructor){
            $this->hashidsConstructorValues = new HashidsConstructorValues();
        }
    }

    /**
     * @param \InfoToken\Hashers\Hashids\HasherConstructorValues $hashidsConstructorValues
     */
    public function setHashidsConstructorValues($hashidsConstructorValues)
    {
        $this->hashidsConstructorValues = $hashidsConstructorValues;
    }

    /**
     * @return \InfoToken\Hashers\Hashids\HasherConstructorValues
     */
    public function getHashidsConstructorValues()
    {
        return $this->hashidsConstructorValues;
    }


} 