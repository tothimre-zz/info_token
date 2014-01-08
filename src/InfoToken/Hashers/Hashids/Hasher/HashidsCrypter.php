<?php

namespace InfoToken\Hashers\Hashids\Hasher;

use Hashids\Hashids;
use InfoToken\Hashers\CrypterInterface;
use InfoToken\Hashers\Hashids\HashJugglers\Creator;

class HashidsCrypter implements CrypterInterface
{
    protected $salt;

    /**
     * @var Hashids
     */
    protected $crypter;

    public function setCrypter($crypter = null)
    {
        $this->crypter = $crypter;
    }

    /**
     * @param string $salt
     * @return mixed
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function encrypt($data)
    {
//      public static function create(HasherInterface $hashId, $numbersArray)
        $hash = call_user_func_array(array($this->crypter, 'encrypt' ),array_merge(Creator::getCheckerArray(), $data));
        return $hash;
        return $this->crypter->encrypt($string);
    }

    /**
     * @param $string
     * @return mixed
     */
    public function decrypt($string)
    {
        return $this->crypter->decrypt($string);
    }



} 