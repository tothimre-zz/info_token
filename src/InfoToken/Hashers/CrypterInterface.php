<?php

namespace InfoToken\Hashers;


interface CrypterInterface
{

    public function setCrypter($crypter = null);

    /**
     * @param string $string
     * @return mixed
     */
    public function encrypt($string);

    /**
     * @param $string
     * @return mixed
     */
    public function decrypt($string);

    /**
     * @param string $salt
     * @return mixed
     */
    public function setSalt($salt);

    /**
     * @return string
     */
    public function getSalt();

} 