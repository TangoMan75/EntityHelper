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
 * Trait HasWork
 *
 * @package TangoMan\EntityHelper\Traits
 */
Trait HasWork
{

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $organisation;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\w[\w ]+/",
     *     message="La ville ne peut contenir que des caractères alphabétiques
     *     ou des espaces."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    protected $occupation;

    /**
     * @return string
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * @param string $organisation
     *
     * @return $this
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param string $occupation
     *
     * @return $this
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }
}
