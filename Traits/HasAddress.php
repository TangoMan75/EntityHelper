<?php

namespace TangoMan\EntityHelper\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait HasAddress
 *
 * Requires entity to be marked with "HasLifecycleCallbacks" annotation.
 * @package TangoMan\EntityHelper
 */
Trait HasAddress
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $street;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $street2;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\w[\w ]+/",
     *     message="La ville ne peut contenir que des caractères alphabétiques ou des espaces."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;

    /**
     * @var integer
     * @Assert\Type(
     *     type="digit",
     *     message="Le code postal ne peut contenir que des caractères numériques."
     * )
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $zipCode;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\w[\w ]+/",
     *     message="Le pays ne peut contenir que des caractères alphabétiques ou des espaces."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    protected $country;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return $this
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * @param string $street2
     *
     * @return $this
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     *
     * @return $this
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }
}
