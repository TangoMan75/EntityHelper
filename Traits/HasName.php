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
 * Trait HasName
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait HasName
{

    /**
     * @var String
     * @Assert\Regex(
     *     pattern="/^[\w\-\.]+/",
     *     message="Le nom ne peut contenir que des caractères alphabétiques,
     *     des tirets et des points."
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
