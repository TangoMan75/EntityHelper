<?php

namespace TangoMan\EntityHelper;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

Trait HasAddress
{
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
     * @Assert\Type(
     *     type="alpha",
     *     message="La ville ne peut contenir que des caractères alphabétiques."
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
     * @Assert\Type(
     *     type="alpha",
     *     message="Le pays ne peut contenir que des caractères alphabétiques."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    protected $country;

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
     * @return HasAddress
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
     * @return HasAddress
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
