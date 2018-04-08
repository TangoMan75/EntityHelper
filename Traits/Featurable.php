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
    .'\Featurable class is deprecated and will be removed.',
    E_USER_DEPRECATED
);

/**
 * Trait Featurable
 *
 * @author      Matthias Morin <matthias.morin@gmail.com>
 * @package     TangoMan\EntityHelper
 * @depreceated TangoMan\EntityHelper\Traits\Featurable class is deprecated and will be removed.
 */
trait Featurable
{

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $featured = false;

    /**
     * @return bool
     */
    public function isFeatured()
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }
}
