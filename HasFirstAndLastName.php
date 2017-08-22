<?php

namespace TangoMan\EntityHelper;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait HasFirstAndLastName
 *
 * @package TangoMan\EntityHelper
 */
Trait HasFirstAndLastName
{
    /**
     * @var string
     * @Assert\Type(
     *     type="alpha",
     *     message="Votre prénom ne peut contenir que des caractères alphabétiques."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     * @Assert\Type(
     *     type="alpha",
     *     message="Votre nom ne peut contenir que des caractères alphabétiques."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lastName;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

}
