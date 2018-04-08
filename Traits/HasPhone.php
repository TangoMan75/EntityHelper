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
 * Trait HasPhone
 *
 * @package TangoMan\EntityHelper\Traits
 */
Trait HasPhone
{

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\+?(\(\d\))?\d+/",
     *     message="Votre numéro de téléphone doit être dans un format valide."
     * )
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $phone;

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
}
