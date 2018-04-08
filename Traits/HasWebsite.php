<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait HasWebsite
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
Trait HasWebsite
{

    /**
     * @var String
     * @Assert\Url(message="L'url '{{ value }}' doit être dans un format
     *                            valide.")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $website;

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     *
     * @return $this
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }
}
