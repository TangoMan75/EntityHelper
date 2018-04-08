<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait Privatable
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait Privatable
{

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $public = false;

    /**
     * @return bool
     */
    public function isPrivate()
    {
        return ! $this->public;
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @return $this
     */
    public function setPrivate()
    {
        $this->public = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function setPublic()
    {
        $this->public = true;

        return $this;
    }
}
