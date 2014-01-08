<?php
namespace InfoToken\Hashids\HashJugglers;

use Hashids\Hashids;
use InfoToken\Hashids\Container\HashidsContainers;

class Checker
{
    public static function check(HashidsContainers $hashIdContainers, $stringToCheck)
    {
        $hashIds = $hashIdContainers->getHashids();
        /** @var Hashids $hashId */
        $hash = array();
        foreach ($hashIds as $hashId){
            $hash = $hashId->decrypt($stringToCheck);
//            var_dump($hash);
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