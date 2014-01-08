<?php
namespace InfoToken\Hashids\HashJugglers;

use Hashids\Hashids;
use InfoToken\Hashids\Container\HashidsContainers;

class Creator
{
    public static function create(Hashids $hashId, $numbersArray)
    {
        $hash = call_user_func_array(array($hashId, 'encrypt' ),array_merge(self::getCheckerArray(), $numbersArray));
        return $hash;
    }

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
