<?php

namespace InfoToken\Hashers\Hashids;


class HasherConstructorValues
{
    protected $salt;

    protected $minHashLength;

    protected $alphabet;

    protected $myCustomSalt = "";

    function __construct($salt = '', $min_hash_length = 0, $alphabet = '')
    {
        $this->salt = $salt;
        $this->minHashLength = $min_hash_length;
        $this->alphabet = $alphabet;
    }

    /**
     * @param mixed $alphabet
     */
    public function setAlphabet($alphabet)
    {
        $this->alphabet = $alphabet;
    }

    /**
     * @return mixed
     */
    public function getAlphabet()
    {
        return $this->alphabet;
    }

    /**
     * @param mixed $minHashLength
     */
    public function setMinHashLength($minHashLength)
    {
        $this->minHashLength = $minHashLength;
    }

    /**
     * @return mixed
     */
    public function getMinHashLength()
    {
        return $this->minHashLength;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

}