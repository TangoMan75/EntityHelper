<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

@trigger_error(
    'The '.__NAMESPACE__
    .'\Publishable class is deprecated and will be removed.',
    E_USER_DEPRECATED
);

/**
 * Trait Publishable
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 * @depreceated TangoMan\EntityHelper\Traits\Publishable class is deprecated and will be removed.
 */
trait Publishable
{

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $published = false;

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param boolean $published
     *
     * @return $this
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }
}
