<?php
namespace InfoToken\HashJugglers;

use Hashids\Hashids;
use InfoToken\Hashers\CheckerInterface;
use InfoToken\Hashers\HasherContainersInterface;
use InfoToken\Hashers\Hashids\Hasher\HashidsCrypter;

class Checker implements CheckerInterface
{
    public static function check(HasherContainersInterface $hashIdContainers, $stringToCheck)
    {
        $hashIds = $hashIdContainers->getHashers();
        /** @var Hashids $hashId */
        foreach ($hashIds as $hashId){
            $hash = $hashId->decrypt($stringToCheck);
            $broken = self::hashSpecificCheck($hash);
            if($broken){
                continue;
            }
            if(!empty($hash)){
                return $hash;
            }
        }
        return null;
    }

    /**
     * @return array
     */
    public static function hashSpecificCheck(&$value)
    {
        $broken = false;
        $checkerArray = HashidsCrypter::getCheckerArray();
        $hashCount = count($checkerArray);

        for ($i = 1; $i <= $hashCount; $i++) {
            if (array_shift($value) != array_shift($checkerArray)) {
                $broken = true;
                break;
            }
            else{
            }
        }
        return $broken;
    }

} 