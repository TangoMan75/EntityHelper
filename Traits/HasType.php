<?php

namespace TangoMan\EntityHelper\Traits;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait HasType
 *
 * @author  Matthias Morin <tangoman@free.fr>
 * @package TangoMan\EntityHelper
 */
trait HasType
{
    /**
     * @var string
     * @Assert\Type(
     *     type="alpha",
     *     message="Le type ne peut contenir que des caractères alphabétiques."
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $type;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = strtolower($type);

        return $this;
    }
}
