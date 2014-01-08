<?php
namespace InfoToken\Hashers\Hashids\HashJugglers;

use InfoToken\Hashers\HasherInterface;

class Creator
{
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
