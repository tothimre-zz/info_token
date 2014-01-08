<?php
namespace InfoToken\Hashers;

interface HasherContainersInterface
{
    /**
     * @return HasherInterface
     */
    public function getHashers();

    /**
     * @param HasherInterface $hashids
     */
    public function setHashers($hashids);
}