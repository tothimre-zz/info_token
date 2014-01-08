<?php
namespace InfoToken\Hashers\Hashids\HashJugglers;

use InfoToken\Hashers\CrypterInterface;
use InfoToken\Hashers\HasherInterface;

class Creator
{
//    public static function create(CrypterInterface $hashId, $numbersArray)
//    {
////        $hash = call_user_func_array(array($hashId, 'encrypt' ),array_merge(self::getCheckerArray(), $numbersArray));
//        $hash = $hashId->encrypt(array_merge(self::getCheckerArray(), $numbersArray));
//        return $hash;
//    }

    public static function getCheckerArray(){
        return array(
            123456,789012,345678,901234,567890,
            123456,789012,345678,901234,567890,
            123456,789012,345678,901234,567890,
            123456,789012,345678,901234,567890,
            123456,789012,345678,901234,567890,
            123456,789012,345678,901234,5
        );
    }
}
