<?php

namespace TangoMan\EntityHelper;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

Trait HasWork
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $organisation;

    /**
     * @var string
     * @Assert\Type(
     *     type="alpha",
     *     message="Le titre de votre poste ne peut contenir que des caractères alphabétiques."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    protected $occupation;

    /**
     * @return string
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * @param string $organisation
     *
     * @return $this
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param string $occupation
     *
     * @return $this
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }
}
