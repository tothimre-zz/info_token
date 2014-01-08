<?php
use InfoToken\Hashers\Container\HasherContainers;
use InfoToken\Hashers\Hashids\Factory\HashsidsFactory;
use InfoToken\Hashers\Hashids\HasherConstructorValues;
use InfoToken\TimeInterval;
use InfoToken\Hashers\Hashids\HashJugglers\Checker;
use InfoToken\Hashers\Hashids\HashJugglers\Creator;

class checkerTest extends \PHPUnit_Framework_TestCase
{
    const DEF_INTERVAL = 2;

    /**
     * @param $timeOffset
     * @param $hasNumbers
     */
    public function testCreate(){

        $baseTimestamp = self::DEF_INTERVAL;

        for($testNumber = 0; $testNumber <= 1110000 ; $testNumber+=10000 )
        {
            for($measurementTimeShift = 0; $measurementTimeShift <= self::DEF_INTERVAL; $measurementTimeShift++ ){
                for($startTimeShift = 0; $startTimeShift <= self::DEF_INTERVAL; $startTimeShift++ ){

                    $HashidsConstructorValues = new HasherConstructorValues();
                    $interval = new TimeInterval(self::DEF_INTERVAL);
                    $interval->setCurrentTimestamp($baseTimestamp + $startTimeShift);
                    $hasher = HashsidsFactory::getEncryptHashids($HashidsConstructorValues, $interval);
                    $hash = $hasher->encrypt(array($testNumber,$testNumber+1));

                    $checkerInterval = new TimeInterval(self::DEF_INTERVAL);
                    $checkerInterval->setCurrentTimestamp($interval->getCurrentTimestamp() + $measurementTimeShift);
                    $hasher = new HasherContainers(HashsidsFactory::getDecryptHashids($HashidsConstructorValues, $checkerInterval));
                    $result = Checker::check($hasher,$hash);

                    $hasNumbers = true;
                        if($hasNumbers){
                        $this->assertEquals($hasNumbers, !empty($result),
                            '$hasnumbers = '.print_r($hasNumbers, true)."\n"
                           .'$i = '.$testNumber." \n"
                           .'$result = '.print_r($result, true))."\n";
                            $this->assertEquals($testNumber, $result[0]);
                            $this->assertEquals($testNumber+1, $result[1]);
                    }
                }
            }
        }
    }
}