<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait HasType
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
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
