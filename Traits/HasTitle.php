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
    .'\HasTitle class is deprecated and will be removed.',
    E_USER_DEPRECATED
);

/**
 * Trait HasTitle
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 * @depreceated TangoMan\EntityHelper\Traits\HasTitle class is deprecated and will be removed.
 */
trait HasTitle
{

    /**
     * @var String
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var String
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $subtitle;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     *
     * @return $this
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }
}
