<?php
namespace InfoToken\Hashers\Hashids\HashJugglers;

use Hashids\Hashids;
use InfoToken\Hashers\CheckerInterface;
use InfoToken\Hashers\HasherContainersInterface;

class Checker implements CheckerInterface
{
    public static function check(HasherContainersInterface $hashIdContainers, $stringToCheck)
    {
        $hashIds = $hashIdContainers->getHashers();
        /** @var Hashids $hashId */
        $hash = array();
        foreach ($hashIds as $hashId){
            $hash = $hashId->decrypt($stringToCheck);
            $checkerArray =  Creator::getCheckerArray();
            $hashCount = count($checkerArray);
            $broken = false;
            for($i=1;$i<=$hashCount;$i++)
            {
                if(array_shift($hash) != array_shift($checkerArray)){
                    $broken = true;
                    break;
                }
            }
            if($broken){
                continue;
            }
            if(!empty($hash)){
                return $hash;
            }
        }
        return $hash;

    }

} 