<?php

use InfoToken\TimeInterval;

class TimeIntervalTest extends \PHPUnit_Framework_TestCase {

    const DEFAULT_INTERVAL = 5;

    protected $interval;
    protected $timeInterval;
    protected $currentTimestamp;

    public function __construct(){
        $this->interval = self::DEFAULT_INTERVAL;
        $this->timeInterval = new TimeInterval($this->interval);
        $this->timeInterval->setCurrentTimestamp(5);
        $this->currentTimestamp = 5;
    }

    public function testGetIntervalStartTime()
    {
        $interval = $this->interval;
        $timeInterval = $this->timeInterval;
        $currentTimestamp = $this->currentTimestamp;
        $baseStartTime = $this->currentTimestamp;

        $this->assertTrue($baseStartTime + $interval == $timeInterval->getNextIntervalStartTime());

        $timeInterval->setCurrentTimestamp($currentTimestamp);
        $this->assertEquals($baseStartTime, $timeInterval->getIntervalStartTime());
        $timeInterval->setCurrentTimestamp($currentTimestamp+1);
        $this->assertEquals($baseStartTime, $timeInterval->getIntervalStartTime());
        $timeInterval->setCurrentTimestamp($currentTimestamp+2);
        $this->assertEquals($baseStartTime, $timeInterval->getIntervalStartTime());
        $timeInterval->setCurrentTimestamp($currentTimestamp+3);
        $this->assertEquals($baseStartTime, $timeInterval->getIntervalStartTime());
        $timeInterval->setCurrentTimestamp($currentTimestamp+4);
        $this->assertEquals($baseStartTime, $timeInterval->getIntervalStartTime());
        $timeInterval->setCurrentTimestamp($currentTimestamp+5);
        $this->assertNotEquals($baseStartTime, $timeInterval->getIntervalStartTime());
    }


}