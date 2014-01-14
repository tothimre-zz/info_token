<?php
use InfoToken\Hashers\Container\HasherContainers;
use InfoToken\Hashers\Hashids\Factory\HashsidsFactory;
use InfoToken\Hashers\Hashids\HasherConstructorValues;
use InfoToken\TimeInterval;
use InfoToken\HashJugglers\Checker;
use InfoToken\HashJugglers\Creator;
use Symfony\Component\Stopwatch\Stopwatch;

class InfoTokenAnalyticsAndTest extends \PHPUnit_Framework_TestCase
{
    const DEF_INTERVAL = 2;

    /**
     * @param $timeOffset
     * @param $hasNumbers
     */
    public function testCreate(){


    // Initialize values: 10000 keys of 20 bytes with 40 bytes of data


        $baseTimestamp = self::DEF_INTERVAL;

        $stopwatch = new Stopwatch();

        $events = array();
        $eventSections = array();
        $tstCnt = 0;

//        $c = 1009;
//        $values = array();
//        for ($i=0;$i<$c;$i++)
//        {
//            $values[sha1($i)]=str_pad(' ',2048);
//        }
//
//        echo "memcached: $c keys\n";
//        // Memcached
//        $m = new Memcached();
//        $start = microtime();
//        $stopwatch->openSection($this->checkEventSection($eventSections, 'addMemecached'));
//        var_dump($eventSections);
//        foreach ($values as $k => $v)
//        {
//            $stopwatch->start('add '.$k);
//            $m->set($k, $v, 3600);
//            $stopwatch->stop('add '.$k);
//        }
//        $stopwatch->stopSection('addMemecached');
//        $time = microtime()-$start;
//        echo "memcached set: $time\n";
//        $start = microtime();
//        $stopwatch->openSection($this->checkEventSection($eventSections, 'getMemecached'));
//        foreach ($values as $k => $v)
//        {
//            $stopwatch->start('get '.$k);
//            $m->get($k);
//            $stopwatch->stop('get '.$k);
//
//        }
//        $stopwatch->stopSection('getMemecached');
//        $time = microtime()-$start;
//        echo "memcached get: $time\n";

        for($testNumber = 0; $testNumber <= 1000 ; $testNumber+=100 )
        {
            for($measurementTimeShift = 0; $measurementTimeShift <= self::DEF_INTERVAL; $measurementTimeShift++ ){
                for($startTimeShift = 0; $startTimeShift <= self::DEF_INTERVAL; $startTimeShift++ ){

                    //echo ($startTimeShift),", ";
                    $tstCnt++;

                    $timeId = "-+$tstCnt+- $testNumber, $measurementTimeShift, $startTimeShift ";

                    $createTimeId = $timeId.'cerate ';
                    $interval = new TimeInterval(self::DEF_INTERVAL);

                    $stopwatch->openSection($this->checkEventSection($eventSections, 'create'));
                    $stopwatch->start($createTimeId);
                    $hasherFactory = new HashsidsFactory();
                    $HashidsConstructorValues = new HasherConstructorValues();
                    $interval->setCurrentTimestamp($baseTimestamp + $startTimeShift);
                    $hasher = $hasherFactory->getEncryptHasher($HashidsConstructorValues, $interval);
                    $events[$createTimeId] = $stopwatch->stop($createTimeId);
                    $stopwatch->stopSection('create');

                    $encryptTimeId = $timeId.'encrypt ';

                    $stopwatch->openSection($this->checkEventSection($eventSections, 'encrypt'));
                    $stopwatch->start($encryptTimeId);
                    $hash = $hasher->encrypt(array($testNumber,$testNumber+1));
                    $events[$encryptTimeId] = $stopwatch->stop($encryptTimeId);
                    $stopwatch->stopSection('encrypt');


                    $checkTimeId = $timeId.'check ';
                    $checkerInterval = new TimeInterval(self::DEF_INTERVAL);

                    $stopwatch->openSection($this->checkEventSection($eventSections, 'check'));
                    $stopwatch->start($checkTimeId);
                    $checkerInterval->setCurrentTimestamp($interval->getCurrentTimestamp() + $measurementTimeShift);
                    $hasher = new HasherContainers($hasherFactory->getDecryptHashers($HashidsConstructorValues, $checkerInterval));
                    $result = Checker::check($hasher,$hash);
                    $events[$checkTimeId] = $stopwatch->stop($checkTimeId);
                    $stopwatch->stopSection('check');

                    $hasNumbers = true;
                        if($hasNumbers){
                        $this->assertEquals($hasNumbers, !empty($result),
                            '$hasnumbers = '.print_r($hasNumbers, true)."\n"
                           .'$i = '.$testNumber." \n"
                           .'$result = '.print_r($result, true))."\n";
                            $this->assertEquals($testNumber, $result[0]);
                            $this->assertEquals($testNumber+1, $result[1]);
                    }

//                  $this->printEvents($events, $stopwatch, $eventSections);
                }
            }
        }
        $this->printSumEvents($stopwatch, $eventSections);
    }


    private function checkEventSection(&$events, $event)
    {
        if(isset($events[$event]))
        {
            return $event;
        }
        $events[$event] = 1;
        return null;
    }
    /**
     * @param $events
     * @param Stopwatch $stopwatch
     */
    private function printEvents($events)
    {
        foreach($events as $eventId =>$event)
        {
            echo "EventName: $eventId, Duration: ",$event->getDuration(), ", Memory: ",$event->getMemory()."\n";
        }
    }
    /**
     * @param $events
     * @param Stopwatch $stopwatch
     *
     * For some perforance analytics
     *
     */
    private function printSumEvents($stopwatch, $eventSections)
    {
        echo"\n";
        foreach($eventSections as $eventSection => $created)
        {
            $sectionEvents = $stopwatch->getSectionEvents($eventSection);
            {
                $duration = 0;
                foreach($sectionEvents as $event)
                {
                    $duration += $event->getDuration();
                }

                $counter = count($sectionEvents);
                echo $eventSection.': AverageDuration='.($duration/$counter)." microseconds\n".str_pad(' ',strlen($eventSection)+2)."Number of samples: =$counter\n";
            }
        }
    }
}