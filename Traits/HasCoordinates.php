<?php

namespace TangoMan\EntityHelper\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait HasCoordinates
 *
 * @package TangoMan\EntityHelper
 */
Trait HasCoordinates
{
    /**
     * @var float
     * @Assert\Type(
     *     type="digit",
     *     message="La latitude ne peut contenir que des caractères numériques."
     * )
     * @ORM\Column(name="lat", type="string", length=255, nullable=true)
     */
    protected $lat;

    /**
     * @var float
     * @Assert\Type(
     *     type="digit",
     *     message="La longitude ne peut contenir que des caractères numériques."
     * )
     * @ORM\Column(name="lng", type="string", length=255, nullable=true)
     */
    protected $lng;

    /**
     * @param float $lat
     *
     * @return $this
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param float $lng
     *
     * @return $this
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @return string
     */
    public function getCoordinates()
    {
        return $this->getLat().','.$this->getLng();
    }
}
