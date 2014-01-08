<?php

namespace InfoToken\Hashers\Hashids\Hasher;

use Hashids\Hashids;
use InfoToken\Hashers\CrypterInterface;
use InfoToken\HashJugglers\Creator;

class HashidsCrypter implements CrypterInterface
{
    private  $salt;

    private  $hashidsConstructorValues;

    public function setCrypter($hashidsConstructorValues = null)
    {
        $this->hashidsConstructorValues = $hashidsConstructorValues;
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
        $hashid = $this->getHashid();
        $hash = call_user_func_array(array($hashid, 'encrypt' ),array_merge(self::getCheckerArray(), $data));
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


    private function getHashid()
    {
        return  new Hashids($this->salt,
                            $this->hashidsConstructorValues->getMinHashLength(),
                            $this->hashidsConstructorValues->getAlphabet());
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