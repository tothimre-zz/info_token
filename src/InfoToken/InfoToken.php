<?php
namespace InfoToken;

class InfoToken
{
    /**
     * @var \InfoToken\HashidsConstructorValues
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
     * @param \InfoToken\HashidsConstructorValues $hashidsConstructorValues
     */
    public function setHashidsConstructorValues($hashidsConstructorValues)
    {
        $this->hashidsConstructorValues = $hashidsConstructorValues;
    }

    /**
     * @return \InfoToken\HashidsConstructorValues
     */
    public function getHashidsConstructorValues()
    {
        return $this->hashidsConstructorValues;
    }


} 