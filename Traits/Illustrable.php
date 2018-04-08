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
    .'\Illustrable class is deprecated and will be removed.',
    E_USER_DEPRECATED
);

/**
 * Trait Illustrable
 *
 * @author      Matthias Morin <matthias.morin@gmail.com>
 * @package     TangoMan\EntityHelper\Traits
 * @depreceated TangoMan\EntityHelper\Traits\Illustrable class is deprecated
 *              and will be removed.
 */
trait Illustrable
{

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $image;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
