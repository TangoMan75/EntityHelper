<?php

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait Privatable
 *
 * @author  Matthias Morin <tangoman@free.fr>
 * @package TangoMan\EntityHelper
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
        return !$this->public;
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
