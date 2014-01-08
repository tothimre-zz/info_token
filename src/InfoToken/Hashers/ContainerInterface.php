<?php

namespace InfoToken\Hashers;


interface ContainerInterface
{
    /**
     * @param array <HaserInterface> $hashids
     */
    public function setHashids($hashids);

    /**
     * @return array
     */
    public function getHashids();
}