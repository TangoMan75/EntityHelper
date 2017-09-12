<?php

namespace TangoMan\EntityHelper;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait HasName
 *
 * @author  Matthias Morin <tangoman@free.fr>
 * @package TangoMan\EntityHelper
 */
trait HasName
{
    /**
     * @var String
     * @Assert\Regex(
     *     pattern="/^[\w\-\.]+/",
     *     message="Le nom ne peut contenir que des caractères alphabétiques, des tirets et des points."
     * )
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
