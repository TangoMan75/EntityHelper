<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Model;

use TangoMan\EntityHelper\Traits\HasAddress;
use TangoMan\EntityHelper\Traits\HasCoordinates;

/**
 * Class Address
 * @ORM\HasLifecycleCallbacks()
 * @package TangoMan\EntityHelper\Model
 */
class Address implements \JsonSerializable
{

    use HasAddress;
    use HasCoordinates;

    /**
     * @ORM\PreUpdate()
     */
    public function updateAddress()
    {
        if (!$this->address) {
            $this->address = $this->getFullAddress();
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $address['street'] = $this->getStreet();
        $address['street2'] = $this->getStreet2();
        $address['zipcode'] = $this->getZipCode();
        $address['city'] = $this->getCity();
        $address['country'] = $this->getCountry();
        $address['lat'] = $this->getLat();
        $address['lng'] = $this->getLng();

        return $address;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getFullAddress();
    }
}
