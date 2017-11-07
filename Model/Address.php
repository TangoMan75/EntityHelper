<?php

namespace TangoMan\EntityHelper\Model;

use TangoMan\EntityHelper\Traits\HasAddress;
use TangoMan\EntityHelper\Traits\JsonSerializable;

/**
 * Class Address
 * @ORM\HasLifecycleCallbacks()
 *
 * @package TangoMan\EntityHelper\Entity
 */
class Address implements \JsonSerializable
{
    use HasAddress;
    use JsonSerializable;

    /**
     * @ORM\PreUpdate()
     */
    public function updateAddress()
    {
        if (!$this->address) {
            $this->address = $this->__toString();
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $address = [];
        if ($this->street) {
            $address[] = $this->street;
        }
        if ($this->street2) {
            $address[] = $this->street2;
        }
        if ($this->zipCode) {
            $address[] = $this->zipCode;
        }
        if ($this->city) {
            $address[] = $this->city;
        }
        if ($this->country) {
            $address[] = $this->country;
        }

        return implode(', ', $address);
    }
}
