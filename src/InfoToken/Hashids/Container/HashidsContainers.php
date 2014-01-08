<?php
namespace InfoToken\Hashids\Container;


class HashidsContainers
{
    protected $hashids;

    public function __construct(array $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * @param array $hashids
     */
    public function setHashids($hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * @return array
     */
    public function getHashids()
    {
        return $this->hashids;
    }

} 