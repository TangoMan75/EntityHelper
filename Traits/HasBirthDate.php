<?php

namespace TangoMan\EntityHelper\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait HasBirthDate
 *
 * @package TangoMan\EntityHelper
 */
Trait HasBirthDate
{
    /**
     * @var \DateTime
     * @Assert\Date(message="La date doit être dans un format valide.")
     * @ORM\Column(type="datetime")
     */
    protected $birthDate;

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     *
     * @return $this
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }
}
