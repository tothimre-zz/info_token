<?php
namespace InfoToken;

class TimeInterval
{
    const DEFAULT_INTERVAL = 300;
    protected $intervalInSeconds;
    protected $currentTimestamp;

    public function __construct($IntervalInSeconds = self::DEFAULT_INTERVAL)
    {
        $this->currentTimestamp = time();
        $this->intervalInSeconds = $IntervalInSeconds;
    }

    public function getPreviousIntervalStartTime()
    {
        return $this->getIntervalStartTime(-1);
    }

    public function getIntervalStartTime($shift = 0)
    {
        $item =  ($this->currentTimestamp - $this->currentTimestamp % $this->intervalInSeconds);
        return $item  + $shift * $this->intervalInSeconds;
    }

    public function getNextIntervalStartTime()
    {
        return $this->getIntervalStartTime(1);
    }

    /**
     * @param int $currentTimestamp
     */
    public function setCurrentTimestamp($currentTimestamp)
    {
        $this->currentTimestamp = $currentTimestamp;
    }

    /**
     * @return int
     */
    public function getCurrentTimestamp()
    {
        return $this->currentTimestamp;
    }

    /**
     * @param int $intervalInSeconds
     */
    public function setIntervalInSeconds($intervalInSeconds)
    {
        $this->intervalInSeconds = $intervalInSeconds;
    }

    /**
     * @return int
     */
    public function getIntervalInSeconds()
    {
        return $this->intervalInSeconds;
    }

} 