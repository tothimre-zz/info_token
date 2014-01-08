<?php
namespace InfoToken\Hashers\Container;

use InfoToken\Hashers\HasherContainersInterface;

class HasherContainers implements HasherContainersInterface
{
    protected $hashids;

    public function __construct(array $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * @inheritdoc
     */
    public function setHashers($hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * @inheritdoc
     */
    public function getHashers()
    {
        return $this->hashids;
    }

} 