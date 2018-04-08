<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait HasGender
 *
 * @package TangoMan\EntityHelper\Traits
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
        return ! $this->gender;
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
