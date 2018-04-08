<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait HasMobile
 *
 * @package TangoMan\EntityHelper\Traits
 */
Trait HasMobile
{

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\+?(\(\d\))?\d+/",
     *     message="Votre numéro de portable doit être dans un format valide."
     * )
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    protected $mobile;

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     *
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }
}
