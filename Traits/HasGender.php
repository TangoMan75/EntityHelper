<?php

namespace TangoMan\EntityHelper\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait HasGender
 *
 * @package TangoMan\EntityHelper
 */
Trait HasGender
{
    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $gender;

    /**
     * @return bool
     */
    public function isMale()
    {
        return $this->gender;
    }

    /**
     * @return bool
     */
    public function isFemale()
    {
        return !$this->gender;
    }

    /**
     * @return $this
     */
    public function setMale()
    {
        $this->gender = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function setFemale()
    {
        $this->gender = false;

        return $this;
    }
}
