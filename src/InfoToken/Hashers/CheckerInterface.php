<?php
namespace InfoToken\Hashers;

interface CheckerInterface
{
    public static function check(HasherContainersInterface $hashIdContainers, $stringToCheck);
} 